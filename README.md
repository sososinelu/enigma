
# Prerequisites
* Install Java JDK appropriate for your environment.
* Composer
* NPM

# Configuration

Run composer
`composer install`

Run npm
`npm install`

Configure Selenium
`./node_modules/.bin/selenium-standalone install`

Environment setup

* Copy `.env.example` to `.env`
* Set your application details in the `.env` file

# How it works

First you you need to start Selenium (instructions below). This connects Codeception (where we run the tests)
to the browser. You then run the tests command-line using the details below.

# Selenium

Run Selenium

* `./node_modules/.bin/selenium-standalone start --`
* If you need to run a different port other than `4444` then use - `./node_modules/.bin/selenium-standalone start -- -port 9515`
* If you change the `-port` please also change the `.suite.yml` under `port: 4444`

Debug Selenium

* `./node_modules/.bin/selenium-standalone start -- -debug`
* If you need to run a different port other than `4444` then use - `./node_modules/.bin/selenium-standalone start -- -debug -port 9515`

# Codeception

Run test

* `<path_to_codeception_library> run <configuration_suite> <path_to_test_file>`

Run test example

* `./vendor/bin/codecept run tests/acceptance/tests/acceptance/ItemCest.php`


