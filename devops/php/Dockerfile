FROM php:7

VOLUME /var/www/symfony

RUN apt-get update
RUN apt-get install -y git unzip

WORKDIR /home/root
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === 'e115a8dc7871f15d853148a7fbac7da27d6c0030b848d9b3dc09e2a0388afed865e6a3d6b3c0fad45c48e2b5fc1196ae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN ln -s /home/root/composer.phar /usr/local/bin/composer

ADD test.sh /home/root/test.sh
ADD server.sh /home/root/server.sh