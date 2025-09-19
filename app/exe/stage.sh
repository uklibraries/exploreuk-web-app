#!/bin/sh
set -e

if [ -f /app/dist/omeuka.tar.gz ]; then
	tar -xzvf /app/dist/omeuka.tar.gz -C /omeka
	echo "omeuka.tar.gz extracted to /omeka"
else
	echo "omeuka.tar.gz not found" >&2
fi
