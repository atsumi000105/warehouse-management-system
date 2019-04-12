# Donation Bank Manager (Dobaman)

## Development Installation

1. `composer install`
2. `yarn install`
3. Create a database (mysql, postgres, sqlite)
4. Copy `.env.dist` to `.env` and set the database connection
5. `bin/composer doctrine:schema:create`
6. `bin/composer doctrine:fixtures:load`

## Run Development Server and Build JS App

1. `bin/composer server:run` or `bin/composer server:start` (to run in background)
2. `yarn watch`

You should now be able to connect to your the dev server at the address reported by `composer server:run`