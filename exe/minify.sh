#!/bin/bash
dir="theme/assets/css"
cd "$dir"
npx lightningcss -o main.min.css -m main.css
