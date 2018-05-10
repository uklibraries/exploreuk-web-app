#!/bin/bash
THEME=omeukaprologue
rm -rf dist
mkdir -p "dist/pack/themes/$THEME"
rsync -crlpt shim/ dist/pack/
rsync -crlpt theme/ "dist/pack/themes/$THEME/"
cd dist/pack
tar zcf ../omeuka.tar.gz .
cd ../..
echo "Export stored in dist/omeuka.tar.gz"
