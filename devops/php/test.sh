#!/bin/bash
cd /var/www/symfony && composer install --prefer-dist
cd /var/www/symfony && vendor/phpunit/phpunit/phpunit
