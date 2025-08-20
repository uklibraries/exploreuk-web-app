#!/bin/env bash
set -eu;

if [ -z $PATH_TO_PROFILE ]; then
	echo "Env variables not provided. Exiting."
	echo "Need PATH_TO_PROFILE"
	exit 1
fi

case $STACK in
	# Values based on configuration /nginx/euk.green & /nginx/euk.blue
	blue ) NGINX_PORT=8081 ;;
	green ) NGINX_PORT=8080 ;;
	*) echo "stack must be blue or green" ;;
esac

source $PATH_TO_PROFILE;

echo "Deploying exploreuk-web-app $REMOTE_HOST on port $NGINX_PORT"

ssh "$USER@$REMOTE_HOST" bash <<EOC
	set -e
	# export NGINX_PORT so it gets loaded in docker compose
	export NGINX_PORT=$NGINX_PORT
	cd "$PATH_TO_REMOTE_COMPOSE"
	docker compose -p $STACK -f docker-compose.prod.yml up -d --pull always
EOC

echo "Deployment dispatched to host"
