#!/bin/bash
THEME=omeukaprologue

bash exe/minify.sh

rm -rf dist
mkdir -p "dist/pack/themes/$THEME"
rsync -crlpt favicon/ dist/pack/
rsync -crlpt shim/ dist/pack/
rsync -crlpt theme/ "dist/pack/themes/$THEME/"
cd dist/pack
find . -type f -name "*.swp" | xargs -n 1 --no-run-if-empty rm
rm "themes/$THEME/assets/css/main.css"
find . -type d -exec chmod 0755 {} \;
find . -type f -exec chmod 0644 {} \;
tar zcf ../omeuka.tar.gz .
cd ../..
echo "Export stored in dist/omeuka.tar.gz"
