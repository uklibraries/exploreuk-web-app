.PHONY: help env require-env dev dev-fa build down test lint lint-fix logs test-watch exploreuk-sh web-sh db-sh sample

export COMPOSE_FILE ?= docker-compose.yml:docker-compose.dev.override.yml

help: ## Show this help
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-15s\033[0m %s\n", $$1, $$2}'

env: ## Generate an .env file from .env.example (interactive)
	app/exe/make-env.sh

require-env:
	@test -f .env.dev || { echo ".env.dev not found - run 'make env' to create one"; exit 1; }

dev: require-env ## Start development environment
	docker compose up -d

dev-fa: require-env ## Start development environment with findingaid application (requires FA_IMAGE=IMAGE_LOCATION environment variable)
	docker compose --profile with_fa up -d

build: ## Build containers
	docker compose build

down: ## Stop all containers
	docker compose down

test: ## Run PHPUnit tests
	docker compose exec exploreuk /vendor/bin/phpunit -c /phpunit.xml /tests

lint: ## Run PHP_CodeSniffer (PSR-12)
	docker compose exec exploreuk /vendor/bin/phpcs -w --exclude=Generic.Files.LineLength --standard=PSR12 /tests /app/catalog.php /app/application/libraries/ExploreUK

lint-fix: ## Auto-fix PHP_CodeSniffer violations (PSR-12)
	docker compose exec exploreuk /vendor/bin/phpcbf --exclude=Generic.Files.LineLength --standard=PSR12 /tests /app/catalog.php /app/application/libraries/ExploreUK

check: ## Run linter and tests reports
	make lint
	make test

logs: ## Tail container logs
	docker compose logs -f

test-watch: ## Run tests on each file change (requires: watchexec)
	watchexec -w app -w tests --no-process-group 'make test'

exploreuk-sh: ## Shell into the exploreuk container
	docker compose exec exploreuk sh

web-sh: ## Shell into the web container
	docker compose exec web sh

db-sh: ## Shell into the database container
	docker compose exec db sh

sample: ## Download and extract sample finding aid data (~1GB)
	wget -O xml.tar.gz https://solrindex.uky.edu/fa/findingaid/xml.tar.gz
	tar zxf xml.tar.gz
	rm xml.tar.gz
