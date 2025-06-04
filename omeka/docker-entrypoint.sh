#!/bin/sh
set -e

DB_HOST=${OMEKA_DB_HOST:-db}
DB_USER=${OMEKA_DB_USER:-omeka}
DB_PASSWORD=${OMEKA_DB_PASSWORD:-omeka}
DB_NAME=${OMEKA_DB_NAME:-omeka_db}
DB_PREFIX=${OMEKA_DB_PREFIX:-omeka_}
DB_PORT=${OMEKA_DB_PORT:-3306}

cat > "$DB_INI_PATH" <<EOF
host = "${DB_HOST}"
username = "${DB_USER}"
password = "${DB_PASSWORD}"
dbname = "${DB_NAME}"
prefix = "${DB_PREFIX}"
port = "${DB_PORT}"
EOF

exec "$@"
