FROM php:5.6-apache
MAINTAINER paranpi666@gmail.com
RUN docker-php-ext-install mysql mysqli pdo pdo_mysql
RUN a2enmod rewrite
