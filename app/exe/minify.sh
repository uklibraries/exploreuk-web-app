#!/bin/bash
APP_DIR="/app"
dir="$APP_DIR/theme/assets/css"
cd "$dir"
npx lightningcss -o main.min.css -m main.css
