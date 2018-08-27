#!/bin/bash
if [[ "$1" == "strict" ]]; then
    OPTS='-w'
elif [[ "$1" == "errorsonly" ]]; then
    OPTS='-n'
else
    OPTS='-w --exclude=Generic.Files.LineLength'
fi

while true; do
    echo
    phpcs $OPTS --standard=PSR2 --ignore=theme/assets/*,theme/openseadragon/*,theme/BookReader/*,theme/BookReaderDemo/BookReaderJSSimple.js,theme/javascripts/*.min.js shim theme | head -n 30
    echo
    uptime
    sleep 5
done
