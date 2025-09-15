#!/bin/sh
set -eu

umask 077

mkdir -p "$HOST_BACKUP_DIR"

docker exec "$DB_CONTAINER" sh -c 'exec mysqldump --defaults-extra-file=/run/secrets/mysql_backup_cnf --all-databases --no-tablespaces' > "$HOST_BACKUP_DIR"/backup.sql

docker cp "$WEB_CONTAINER":/omeka/files "$HOST_BACKUP_DIR"
