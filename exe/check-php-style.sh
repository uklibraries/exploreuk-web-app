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
    phpcs $OPTS --standard=PSR2 --ignore=theme/openseadragon/*,theme/BookReader/* shim theme | head -n 30
    echo
    uptime
    sleep 5
done
