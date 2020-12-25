#!/usr/bin/env bash

rm .env.local
cp .env.docker .env.local

docker-compose -f docker-compose.yml -f docker-compose.unison.yml down -v --rmi all --remove-orphans /
 && docker-compose -f docker-compose.yml -f docker-compose.unison.yml up --detach --build

./docker/app ./bin/php_install.sh
./docker/app ./bin/js_install.sh

docker-compose -f docker-compose.yml -f docker-compose.unison.yml stop
