# Donation Bank Manager (Dobaman)

## Development Installation

1. `composer install`
1. `yarn install`
1. Create a database (mysql, postgres, sqlite)
1. Copy `.env.dist` to `.env` and set the database connection
1. `bin/console doctrine:database:create`
1. `bin/console doctrine:schema:create`
1. `bin/console doctrine:fixtures:load`

## Run Development Server and Build JS App

1. `bin/console server:run` or `bin/console server:start` (to run in background)
1. `yarn watch`

You should now be able to connect to your the dev server at the address reported by `console server:run`