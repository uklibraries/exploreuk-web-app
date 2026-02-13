#!/bin/bash
dir="theme/assets/css"
pushd "$dir"
npx lightningcss-cli -o main.min.css -m main.css
popd
