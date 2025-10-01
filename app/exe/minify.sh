#!/bin/bash
APP_DIR="/app"
dir="$APP_DIR/themes/omeukaprologue/assets/css"
cd "$dir"
npx lightningcss -o main.min.css -m main.css
