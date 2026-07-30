#!/bin/sh
set -eu # Exit immediately if a command exits with a non-zero status or if there are env variables unset

APP_ROOT="/app"

umask 002

chmod 755 "$APP_ROOT"

# files/ is bind mounted at runtime, so it is absent wherever no mount is supplied (e.g. CI)
if [ -d "$APP_ROOT/files" ]; then
    chown -R root:www-data "$APP_ROOT/files"
    find "$APP_ROOT/files" -type d -exec chmod 0775 "{}" \;
    find "$APP_ROOT/files" -type f -exec chmod 0664 "{}" \;
fi

if [ "$APP_ENV" == "development" ]; then
    # overwrites the bind mounted install to make sure dev is always up-to-date
	npm install --prefix "$APP_ROOT"
	npm run --prefix "$APP_ROOT" minify-css
fi

# If a command was provided, run that instead of php-fpm in the foreground
if [ "$#" -gt 0 ]; then
    exec "$@"
fi

exec php-fpm -F
