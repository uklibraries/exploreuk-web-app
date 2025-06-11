#!/bin/sh
set -e # Exit immediately if a command exits with a non-zero status

# Paths for dev/omeka sync
APP_SRC="/app"
OMEKA_ROOT="/var/www/html"

# Paths for backup loading
BACKUP_FILES_SOURCE="/tmp/backup/files"
BACKUP_FILES_DESTINATION="/var/www/html/files"

DB_INI_FILE="/var/www/html/db.ini"

# These are expected to be set by docker-compose from values originating in the .env file
TARGET_APP_ENV="${APP_ENV}"
TARGET_DB_HOST="${DB_HOST}"
TARGET_DB_NAME="${DB_NAME}"
TARGET_DB_USER="${DB_USERNAME}"
TARGET_DB_PASS="${DB_PASSWORD}"
TARGET_DB_PREFIX="${DB_PREFIX}"
TARGET_DB_PORT="${DB_PORT:-3306}"
TARGET_DB_CHARSET="${DB_CHARSET:-utf8mb4}" 

# Create db.ini programmatically
# Using a compound command to group echos and redirect output 
{ 	echo "[database]" 
	echo "host = \"${TARGET_DB_HOST}\""
    echo "username = \"${TARGET_DB_USER}\""
    echo "password = \"${TARGET_DB_PASS}\""
    echo "dbname = \"${TARGET_DB_NAME}\""
    echo "prefix = \"${TARGET_DB_PREFIX}\""
    echo "port = \"${TARGET_DB_PORT}\""
    echo "charset = \"${TARGET_DB_CHARSET}\""
} > "$DB_INI_FILE"

# Set appropriate permissions for db.ini
chown www-data:www-data "$DB_INI_FILE"
chmod 640 "$DB_INI_FILE" # Owner can read/write, group can read

# If backup files directory provided, overwrite files directory
if [ -d "$BACKUP_FILES_SOURCE" ]; then
    echo 'loading files from backup'
    rsync -a "$BACKUP_FILES_SOURCE"/ "$BACKUP_FILES_DESTINATION"/
else
    echo 'skipping backup files load'
fi

# If we're in dev mode, start listening for changes in the loaded app directory

if [ "$TARGET_APP_ENV" = "dev" ]; then
	if [ ! -d "$APP_SRC" ]; then
		echo "Error: APP_ENV is 'dev' but the source code directory '$APP_SRC' is not mounted." >&2
		exit 1
	fi

	# Initial sync of folders and files from EUK
	rsync -av "$APP_SRC/theme/" 	"$OMEKA_ROOT/themes/${OMEKA_THEME}/"
	rsync -av "$APP_SRC/shim/" 		"$OMEKA_ROOT/"
	rsync -av "$APP_SRC/favicon/" 	"$OMEKA_ROOT/"

	exec "$@" &

	while true; do
		inotifywait -r -e create,modify,delete,move "$APP_SRC" 
		echo "-> Change detected, re-syncing..."

		rsync -av "$APP_SRC/theme/" 	"$OMEKA_ROOT/themes/${OMEKA_THEME}/"
		rsync -av "$APP_SRC/shim/" 		"$OMEKA_ROOT/"
		rsync -av "$APP_SRC/favicon/" 	"$OMEKA_ROOT/"

	done
else
	echo "-> Production mode enabled"
	exec "$@"
fi

