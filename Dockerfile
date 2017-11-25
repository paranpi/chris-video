FROM php:5.6-apache
MAINTAINER paranpi666@gmail.com
RUN docker-php-ext-install mysqli
RUN a2enmod rewrite
