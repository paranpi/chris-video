FROM php:7.0-apache
MAINTAINER chris@wishbeen.com

RUN apt-get update && \
  DEBIAN_FRONTEND=noninteractive apt-get -y upgrade && \
  apt-get -y install mysql-client transmission-daemon 

RUN echo "alias /content /var/www" >> /etc/apache2/conf-available/docker-php.conf
RUN docker-php-ext-install mysqli
RUN a2enmod rewrite 
RUN chown -R www-data:www-data /var/www
RUN usermod -u 1000 www-data
RUN usermod -G staff www-data
COPY ./Fun /var/www/
COPY ./Drama /var/www/
COPY ./config/settings.json /var/www/Torrent/.session/settings.json
COPY ./docker-entrypoint.sh /
ENTRYPOINT ["/docker-entrypoint.sh"]
EXPOSE 80
