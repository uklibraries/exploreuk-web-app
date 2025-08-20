#!/bin/bash
set -e

OMEKA_THEME=omeukaprologue
APP_DIR=/app

bash $APP_DIR/exe/minify.sh

rm -rf dist

mkdir -p "$APP_DIR/dist/pack/themes/$OMEKA_THEME"
rsync -crlpt $APP_DIR/favicon/ $APP_DIR/dist/pack/
rsync -crlpt $APP_DIR/shim/ $APP_DIR/dist/pack/
rsync -crlpt $APP_DIR/theme/ "$APP_DIR/dist/pack/themes/$OMEKA_THEME/"
cd $APP_DIR/dist/pack
find . -type f -name "*.swp" | xargs -n 1 --no-run-if-empty rm
rm "$APP_DIR/dist/pack/themes/$OMEKA_THEME/assets/css/main.css"
find . -type d -exec chmod 0755 {} \;
find . -type f -exec chmod 0644 {} \;
tar zcf ../omeuka.tar.gz .
cd ../..
echo "Export stored in dist/omeuka.tar.gz"
