FROM php:5.6-apache
ENV INSTALL_DIR /var/www/html
EXPOSE 80
VOLUME $INSTALL_DIR

RUN apt-get update && apt-get install -y libcurl4-openssl-dev 
RUN a2enmod rewrite

RUN docker-php-ext-install mysqli

WORKDIR /tmp
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && chmod +x wp-cli.phar && mv wp-cli.phar /usr/local/bin/wp



