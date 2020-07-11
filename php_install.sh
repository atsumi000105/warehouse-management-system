#!/usr/bin/env bash

rm .env.local
cp .env.docker .env.local

composer install

# start fresh
bin/console doctrine:database:drop --force
bin/console doctrine:database:create
bin/console doctrine:schema:create
bin/console doctrine:fixtures:load -n
