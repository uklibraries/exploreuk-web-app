#!/bin/bash
THEME=omeukaprologue
OPT=$1

rm -rf dist
mkdir -p "dist/pack/themes/$THEME"
rsync -crlpt shim/ dist/pack/
case "$OPT" in
dev)
    echo "Exporting for development"
    cat "auxiliary/catalog-dev.php" >> dist/pack/catalog.php
    ;;
*)
    echo "Exporting for production"
    cat "auxiliary/catalog-prod.php" >> dist/pack/catalog.php
    ;;
esac
rsync -crlpt theme/ "dist/pack/themes/$THEME/"
cd dist/pack
find . -type f -name "*.swp" | xargs -n 1 rm
tar zcf ../omeuka.tar.gz .
cd ../..
echo "Export stored in dist/omeuka.tar.gz"
