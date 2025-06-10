#!/bin/bash
while true; do
    echo
    jshint shim theme | head -n 30
    echo
    uptime
    sleep 5
done
