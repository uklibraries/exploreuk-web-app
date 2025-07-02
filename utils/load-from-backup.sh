#!/bin/sh
set -e

# Check to make sure all environment variables are set
if [ -z "$LOCAL_SQL_FILE" ]; then
	echo "environment variable LOCAL_SQL_FILE not set"
	exit 1
fi

if [ -z "$LOCAL_FILES_DIR" ]; then
	echo "environment variable LOCAL_FILES_DIR not set"
	exit 1
fi

if [ -z "$DB_CONTAINER" ]; then
	echo "environment variable DB_CONTAINER not set"
	exit 1
fi

if [ -z "$OMEKA_CONTAINER" ]; then
	echo "environment variable OMEKA_CONTAINER not set"
	exit 1
fi

if [ -z "$DB_USER" ]; then
	echo "environment variable DB_USER not set"
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

docker exec -it $DB_CONTAINER sh -c "mysql -u $DB_USER -p omeka < /tmp/backup.sql"

docker cp "$LOCAL_FILES_DIR/." "$OMEKA_CONTAINER:/omeka/files/"

echo "Load from backup complete"
