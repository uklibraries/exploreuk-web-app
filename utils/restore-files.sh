#!/bin/sh
set -e

CONTAINER_FILES_DIR="/app/files"

# Check to make sure all environment variables are set
if [ -z "$LOCAL_FILES_DIR" ] || [ -z "$OMEKA_CONTAINER" ]; then
	echo "One or more environment variables not set"
	echo "Need LOCAL_FILES_DIR, OMEKA_CONTAINER"
	exit 1
fi

# Check the local file locations
if [ ! -d "$LOCAL_FILES_DIR" ]; then
	echo "Error: Files backup directory not found at $LOCAL_FILES_DIR"
	exit 1
fi

docker cp "$LOCAL_FILES_DIR/." "$OMEKA_CONTAINER:$CONTAINER_FILES_DIR"

echo "Setting permissions for $CONTAINER_FILES_DIR to www-data"
docker exec "$OMEKA_CONTAINER" chown -R root:www-data "$CONTAINER_FILES_DIR"
docker exec "$OMEKA_CONTAINER" find "$CONTAINER_FILES_DIR" -type d -exec chmod 0775 "{}" \;
docker exec "$OMEKA_CONTAINER" find "$CONTAINER_FILES_DIR" -type f -exec chmod 0664 "{}" \;

echo "Load from backup complete"
