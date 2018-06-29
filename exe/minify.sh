#!/bin/bash
dir="theme/assets/css"
cd "$dir"
cleancss -o main.min.css main.css
