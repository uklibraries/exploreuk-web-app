.PHONY: help dev dev-fa build down test lint lint-fix logs test-watch omeka-sh web-sh db-sh

help: ## Show this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-15s\033[0m %s\n", $$1, $$2}'

dev: ## Start development environment
	docker compose up -d

dev-fa: ## Start development environment with findingaid application
	docker compose --profile with_fa up --watch

build: ## Build containers
	docker compose build

down: ## Stop all containers
	docker compose down

test: ## Run PHPUnit tests
	docker compose exec omeka /vendor/bin/phpunit --bootstrap /tests/bootstrap.php /tests

lint: ## Run PHP_CodeSniffer (PSR-12)
	docker compose exec omeka /vendor/bin/phpcs -w --exclude=Generic.Files.LineLength --standard=PSR12 /tests /app/catalog.php /app/application/libraries/ExploreUK

lint-fix: ## Auto-fix PHP_CodeSniffer violations (PSR-12)
	docker compose exec omeka /vendor/bin/phpcbf --exclude=Generic.Files.LineLength --standard=PSR12 /tests /app/catalog.php /app/application/libraries/ExploreUK

check: ## Run linter and tests reports
	make lint
	make test

logs: ## Tail container logs
	docker compose logs -f

test-watch: ## Run tests on each file change (requires: watchexec)
	watchexec -w app -w tests --no-process-group 'make test'

omeka-sh: ## Shell into the omeka container
	docker compose exec omeka sh

web-sh: ## Shell into the web container
	docker compose exec web sh

db-sh: ## Shell into the database container
	docker compose exec db sh
