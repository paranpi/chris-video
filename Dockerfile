FROM php:7.0-apache
MAINTAINER chris@wishbeen.com

RUN apt-get update && \
  DEBIAN_FRONTEND=noninteractive apt-get -y upgrade && \
  apt-get -y install mysql-client 

RUN echo "alias /content /var/www" >> /etc/apache2/conf-available/docker-php.conf
RUN a2enmod rewrite 
RUN chown -R www-data:www-data /var/www
RUN usermod -u 1000 www-data
RUN usermod -G staff www-data
EXPOSE 80
