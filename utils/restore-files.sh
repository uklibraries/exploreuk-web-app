#!/bin/sh
set -e

# Check to make sure all environment variables are set
if [ -z $LOCAL_FILES_DIR ] || [ -z $OMEKA_CONTAINER ]; then
	echo "One or more environment variables not set"
	echo "Need LOCAL_FILES_DIR, OMEKA_CONTAINER"
	exit 1
fi

# Check the local file locations
if [ ! -d "$LOCAL_FILES_DIR" ]; then
	echo "Error: Files backup directory not found at $LOCAL_FILES_DIR"
	exit 1
fi

docker cp "$LOCAL_FILES_DIR/." "$OMEKA_CONTAINER:/omeka/files/"

echo "Load from backup complete"
