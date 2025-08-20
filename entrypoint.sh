#!/bin/sh
set -e # Exit immediately if a command exits with a non-zero status or if there are env variables unset

# Paths for dev source code sync
DEV_APP_SRC="/app"
OMEKA_ROOT="/omeka"

# Create db.ini programmatically
# Using a compound command to group echos and redirect output
mkdir -p "/tmp/omeka"

{ 	echo "[database]"
	echo "host = '${DB_HOST}'"
	echo "username = '${MYSQL_USER}'"
	echo "password = '${MYSQL_PASSWORD}'"
	echo "dbname = '${MYSQL_DATABASE}'"
	echo "prefix = '${DB_PREFIX}'"
	echo "port = '${DB_PORT}'"
	echo "charset = '${DB_CHARSET}'"
} > "/tmp/omeka/db.ini"

# Set appropriate permissions for db.ini
chown nginx:nginx "/tmp/omeka/db.ini"
chmod 640 "/tmp/omeka/db.ini" # Owner can read/write, group can read
chown -R nginx:nginx "/tmp/omeka"
rsync -a "/tmp/omeka/" "$OMEKA_ROOT"

if [ "$APP_ENV" = "development" ]; then
	if [ ! -d "$DEV_APP_SRC" ]; then
		echo "Error: APP_ENV is $APP_ENV but the source code directory '$DEV_APP_SRC' is not mounted." >&2
		exit 1
	fi

	# Run the main command in the background as user 'nginx'
	su-exec nginx "$@" &

	echo "App Env is dev. Listening for changes to $DEV_APP_SRC"

	while true; do
		inotifywait -r -e create,modify,delete,move "$DEV_APP_SRC"
		echo "-> Change detected, re-building..."
		su-exec nginx sh $DEV_APP_SRC/exe/build.sh
		echo "omeuka built"
		su-exec nginx sh $DEV_APP_SRC/exe/stage.sh
		echo "-> Extracted in $OMEKA_ROOT"
	done
else
	echo "-> Production mode enabled"
	exec "$@"
fi
