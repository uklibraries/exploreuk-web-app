#!/bin/bash
find shim -type f -name '*.php' | xargs -n 1 php -l
#find theme -type f -name '*.php' | xargs -n 1 php -l
