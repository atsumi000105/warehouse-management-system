# Coverd Donation Bank Manager

Coverd is an open source Symfony/Vue.js web application that manages the inventory and distribution of donated goods in a `Bank -> Partner -> Client` model. While this app was developed for diaper banks, our intent is for Coverd to be product agnostic.

![Travis (.org) branch](https://img.shields.io/travis/happybottoms/coverd/master?style=flat-square) 

![Coverd Screenshot](doc/screenshot.png)

Coverd offers the following features.

- Product management
- Warehouse management
- Partner management
- Client management (planned)
- Warehouse and Partner Inventory
- Full inventory transaction history
- Partner login, ordering, and client management (planned)
- Custom Partner and Client fields (planned)
- Client (Recipient) record encryption (planned)
- Support for multiple warehouses
- Inventory transfers
- Partner Order workflow
- Order packing sheets
- Fine-grained permission levels

## History

Coverd comes out of the need of HappyBottoms to manage their diaper inventory and partner distribution. This app started as a Drupal (Commerce module) ordering system for distribution partners to record their distributions and place new orders. This worked for 6+ years, but due to HappyBottoms growth, the system proved unable to effectively handle the volume and lacked desired features. Additionally, HappyBottoms was able to fund the development of a warehouse inventory management app. This was developed in Laravel, Doctrine, and Vue.js and was designed to be a platform to rebuild the existing partner ordering system once complete.

Since Laravel with Doctrine is not a typical combination, a rewrite of the backend in Symfony was done for a shallower developer curve.

## About HappyBottoms

HappyBottoms is Kansas City's Diaper Bank. Its mission is to collaborate with community partners to empower, connect and impact low-income families by alleviating diaper need in the Kansas City community. 

HappyBottoms's vision is to positively impact the mental, physical and financial stability of a family in crisis and need through diaper assistance, education, and connection to services.

Learn More at https://www.happybottoms.org

## Special Thanks

- VMLY&R for originally sponsoring the development of the Drupal project
- William T. Kemper Foundation for sponsoring the development of the inventory system.

## Development Installation - On existing environment (with PHP and Database)

1. `composer install`
1. `yarn install`
1. Create a database (mysql, postgres, sqlite)
    - There is a docker compose file that will give you a Postgres DB by running `docker-compose up` in the repository root (this should only be used for development and testing purposes, not for Production)
1. Copy `.env` to `.env.local` and set the database connection
    - Example: `DATABASE_URL=postgres://postgres:coverd@127.0.0.1:5432/coverd?charset=UTF-8`
1. `bin/console doctrine:database:create`
1. `bin/console doctrine:schema:create`
1. `bin/console doctrine:fixtures:load`

### Run Development Server and Build JS App

1. `bin/console server:run` or `bin/console server:start` (to run in background)
1. `yarn watch`


## Development Installation - Docker Compose

1. `docker-compose up --build`
1. Copy `.env.docker` to `.env.localhost` and set the database connection
1. `docker/composer install`
1. `docker/yarn install`
1. `docker/app bin/console doctrine:database:create`
1. `docker/app bin/console doctrine:schema:create`
1. `docker/app bin/console doctrine:fixtures:load`

### Run Development Server and Build JS App

1. `docker/yarn watch`

You should now be able to connect to your the dev server at the address reported by `console server:run`
