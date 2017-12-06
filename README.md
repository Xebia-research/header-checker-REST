# About Xebia Header Checker

[![Build Status](https://travis-ci.org/xebia-research/header-checker-REST.svg?branch=develop)](https://travis-ci.org/xebia-research/header-checker-REST)
[![Style Status](https://styleci.io/repos/101330249/shield?branch=develop)](https://styleci.io/repos/101330249)

The Xebia Header Checker is build by five students from the [Amsterdam University of Applied Sciences](https://www.hva.nl/) on the PHP Micro-Framework [Lumen](https://lumen.laravel.com/). You can use Xebia Header Checker for checking HTTP headers for your website, API etc. on vulnerabilities or exposures. 

## Requirements
* PHP >= 7.1
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension

## Installation
### Clone the project
```
git clone git@github.com:xebia-research/header-checker-REST.git
```

### Configure environment variables
```
cp .env.develop .env
nano .env
```

### Running migrations and seeds
```
php artisan migrate
php artisan db:seed
```

### Running tests
```
vendor/bin/phpunit
```

## License
Xebia Header Checker is open-sourced licensed under the [MIT license](http://opensource.org/licenses/MIT).
