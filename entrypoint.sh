#!/bin/sh
set -e # Exit immediately if a command exits with a non-zero status

# Paths for backup loading
BACKUP_FILES_SOURCE="/tmp/backup/files"
BACKUP_FILES_DESTINATION="/var/www/html/files"

DB_INI_FILE="/var/www/html/db.ini"

# These are expected to be set by docker-compose from values originating in the .env file
TARGET_DB_HOST="${DB_HOST}"
TARGET_DB_NAME="${DB_NAME}"
TARGET_DB_USER="${DB_USERNAME}"
TARGET_DB_PASS="${DB_PASSWORD}"
TARGET_DB_PREFIX="${DB_PREFIX}"
TARGET_DB_PORT="${DB_PORT:-3306}"
TARGET_DB_CHARSET="${DB_CHARSET:-utf8mb4}" 

# Create db.ini programmatically
# Using a compound command to group echos and redirect output
{
    echo "[database]"
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
if [ -d "$BACKUP_FILES_SOURCE" ] && [ -n "$(ls -A "$BACKUP_FILES_DESTINATION")" ]; then
    rm -rf "$BACKUP_FILES_DESTINATION"
    mkdir "$BACKUP_FILES_DESTINATION"
    cp -a "$BACKUP_FILES_SOURCE"/. "$BACKUP_FILES_DESTINATION"/
fi

exec "$@"
