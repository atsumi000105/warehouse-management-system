#!/usr/bin/env bash

rm .env.local
cp .env.docker .env.local

docker-compose down && docker-compose up --detach --build

./docker/app ./php_install.sh
./docker/app ./js_install.sh

docker-compose stop
