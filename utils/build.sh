#!/bin/sh
set -eu;

docker build $PROJECT_ROOT -t nealpowers104/exploreuk-web-app:$EUK_VERSION
docker push nealpowers104/exploreuk-web-app:$EUK_VERSION
