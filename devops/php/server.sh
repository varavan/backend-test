#!/bin/bash
cd /var/www/symfony && composer install --prefer-dist
cd /var/www/symfony && vendor/phpunit/phpunit/phpunit

/var/www/symfony/bin/console server:run 0.0.0.0 -vvv