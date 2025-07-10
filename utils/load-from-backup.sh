#!/bin/sh
set -e

# Check to make sure all environment variables are set
if [ -z "$LOCAL_SQL_FILE" ] || [ -z $LOCAL_FILES_DIR ] || [ -z $DB_CONTAINER ] || [ -z $OMEKA_CONTAINER ]; then
	echo "One or more environment variables not set"
	echo "Need LOCAL_SQL_FILE, LOCAL_FILES_DIR, DB_CONTAINER, OMEKA_CONTAINER"
	exit 1
fi

# Check the local file locations
if [ ! -f "$LOCAL_SQL_FILE" ]; then
	echo "Error: SQL backup file not found at $LOCAL_SQL_FILE"
	exit 1
fi

if [ ! -d "$LOCAL_FILES_DIR" ]; then
	echo "Error: Files backup directory not found at $LOCAL_FILES_DIR"
	exit 1
fi

docker cp "$LOCAL_SQL_FILE" "$DB_CONTAINER:/tmp/backup.sql"

docker exec -it $DB_CONTAINER sh -c "mysql -u root -p omeka < /tmp/backup.sql"

docker cp "$LOCAL_FILES_DIR/." "$OMEKA_CONTAINER:/omeka/files/"

echo "Load from backup complete"
