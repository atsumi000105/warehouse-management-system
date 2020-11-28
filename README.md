# Coverd Donation Bank Manager

Coverd is an open source Symfony/Vue.js web application that manages the inventory and distribution of donated goods in a `Bank -> Partner -> Client` model. While this app was developed for diaper banks, our intent is for Coverd to be product agnostic.

[![Build Status](https://travis-ci.org/happybottoms/coverd.svg?branch=master)](https://travis-ci.org/happybottoms/coverd)
[![Test Coverage](https://api.codeclimate.com/v1/badges/9faff8ad8d54cabb1ab8/test_coverage)](https://codeclimate.com/github/happybottoms/coverd/test_coverage)

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

1. Create a database (mysql, postgres, sqlite)
    - There is a docker compose file that will give you a Postgres DB by running `docker-compose up` in the repository root (this should only be used for development and testing purposes, not for Production)
1. Copy `.env` to `.env.local` and set the database connection
    - Example: `DATABASE_URL=postgres://postgres:coverd@127.0.0.1:5432/coverd?charset=UTF-8`
1. Build PHP and db: `./bin/php_install.sh`
1. Build JS: `./bin/js_install.sh`

### Update After Switching to a New Branch

1. `./bin/post-update.sh`

### Run Development Server and Build JS App

1. `bin/console server:run` or `bin/console server:start` (to run in background)
1. `yarn watch`


## Development Installation - Docker Compose

1. `./bin/dockerized-install.sh`
1. `docker-compose up`

You should now be able to connect to your the dev server at http://localhost:8080/

### Install just the PHP app with updated DB

1. `docker/app ./bin/php_install.sh`

### Install just the JS app

1. `docker/app ./bin/js_install.sh`

### Update After Switching to a New Branch

1. `docker/app ./bin/post-update.sh`

### Build and watch the Vue JS app

1. `docker/yarn watch`

### Debugging with Xdebug

1. In the "app" service of `docker-compose.unison.yml`, change `WITH_XDEBUG=false` to `WITH_XDEBUG=true`
1. Rebuild your environment: `docker-compose up --build`
1. If using PHPStorm, make sure you set your xdebug server to have the name "coverd"

## Work With the Dev Environment

We have fixtures to define basic users of certain roles:

  - admin (sees everything):
    - **email:** admin@example.com
    - **password:** password
  - manager:
    - **email:** manager@example.com
    - **password:** password
  - volunteer:
    - **email:** volunteer@example.com
    - **password:** password
      
Most of the time in development, you will probably want to log in as the admin. when needing to check access for certain types of users, log in as the appropriate role-based user.

## Zip Code/County Information

Coverd has a zip code/county lookup field to capture the number of people served by county. This information has to be sourced from two government data files listed below.

* Zipcode -> County ID (FIPS) : https://www.huduser.gov/portal/datasets/usps_crosswalk.html
* County ID (FIPS) -> County Name: https://www.census.gov/geographies/reference-files/time-series/geo/gazetteer-files.html (see "Counties" file)

These files are located in /src/Data/ and are imported with the `app:zip-county:import` command.

## FontAwesome

Coverd makes use of the free set of icons from FontAwesome. To search the available icons, see https://fontawesome.com/icons?m=free.