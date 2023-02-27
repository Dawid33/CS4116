FROM php:7.4-fpm
RUN apt-get update
RUN docker-php-ext-configure mysqli \
	&& docker-php-ext-install mysqli