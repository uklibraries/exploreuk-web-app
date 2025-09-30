#!/bin/sh
set -e # Exit immediately if a command exits with a non-zero status or if there are env variables unset
if [ "$APP_ENV" == "production" ]; then
	MYSQL_USER=$(cat /run/secrets/mysql_user)
	MYSQL_PASSWORD=$(cat /run/secrets/mysql_password)
	MYSQL_DATABASE=$(cat /run/secrets/mysql_database)
fi

# Paths for dev source code sync
DEV_APP_SRC="/app"
OMEKA_ROOT="/omeka"

umask 077

# Create db.ini programmatically
# Using a compound command to group echos and redirect output
mkdir -p "/tmp/omeka"

{
	echo "[database]"
	echo "host = '${DB_HOST}'"
	echo "username = '${MYSQL_USER}'"
	echo "password = '${MYSQL_PASSWORD}'"
	echo "dbname = '${MYSQL_DATABASE}'"
	echo "prefix = '${DB_PREFIX}'"
	echo "port = '${DB_PORT}'"
	echo "charset = '${DB_CHARSET}'"
} > "/tmp/omeka/db.ini"

# Set appropriate permissions
rsync -a "/tmp/omeka/db.ini" "$OMEKA_ROOT/"
chown root:www-data "$OMEKA_ROOT/db.ini"
chmod 640 "$OMEKA_ROOT/db.ini"

umask 002

chmod 755 "$OMEKA_ROOT"
chown -R root:www-data "$OMEKA_ROOT/files"
find "$OMEKA_ROOT/files" -type d -exec chmod 0775 "{}" \;
find "$OMEKA_ROOT/files" -type f -exec chmod 0664 "{}" \;

if [ "$APP_ENV" = "development" ]; then
	if [ ! -d "$DEV_APP_SRC" ]; then
		echo "Error: APP_ENV is $APP_ENV but the source code directory '$DEV_APP_SRC' is not mounted." >&2
		exit 1
	fi

	echo "App Env is dev. Listening for changes to $DEV_APP_SRC"

	(
		while true; do
			inotifywait -r -e create,modify,delete,move "$DEV_APP_SRC"
			echo "-> Change detected, re-building..."

			sh $DEV_APP_SRC/exe/build.sh
			echo "omeuka built"

			sh $DEV_APP_SRC/exe/stage.sh
			echo "-> Extracted in $OMEKA_ROOT"
		done
	) &
	exec php-fpm -F
else
	echo "-> Production mode enabled"
	exec php-fpm -F
fi
