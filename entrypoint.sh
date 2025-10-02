#!/bin/sh
set -e # Exit immediately if a command exits with a non-zero status or if there are env variables unset
if [ "$APP_ENV" == "production" ]; then
	MYSQL_USER=$(cat /run/secrets/mysql_user)
	MYSQL_PASSWORD=$(cat /run/secrets/mysql_password)
	MYSQL_DATABASE=$(cat /run/secrets/mysql_database)
fi

OMEKA_ROOT="/app"

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

if [ "$APP_ENV" == "development" ]; then
	bash "$OMEKA_ROOT/exe/minify.sh"
	set +e
	/vendor/bin/phpcs -w --exclude=Generic.Files.LineLength --standard=PSR12 /tests /app/catalog.php /app/application/libraries/ExploreUK
	/vendor/bin/phpunit --bootstrap /tests/bootstrap.php /tests
	set -e
fi

exec php-fpm -F
