#!/bin/sh
set -eu

npm run --prefix /app minify-css
touch /tmp/css-watch-ready

exec watchexec \
    --postpone \
    --poll 500ms \
    --watch /app/assets/css/styles.css \
    -- npm run --prefix /app minify-css
