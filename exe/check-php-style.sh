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
    phpcs $OPTS --standard=PSR12 shim | head -n 30
    echo
    uptime
    sleep 5
done
