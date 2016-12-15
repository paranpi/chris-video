FROM php:7.0-apache
MAINTAINER chris@wishbeen.com

RUN apt-get update && \
  DEBIAN_FRONTEND=noninteractive apt-get -y upgrade && \
  apt-get -y install mysql-client transmission-daemon locales

RUN localedef -i ko_KR -f UTF-8 ko_KR.UTF-8
ENV LANG ko_KR.UTF-8
ENV LANGUAGE ko_KR.UTF-8
ENV LC_ALL ko_KR.UTF-8

RUN echo "alias /content /var/www" >> /etc/apache2/conf-available/docker-php.conf
RUN docker-php-ext-install mysqli
RUN a2enmod rewrite 
RUN chown -R www-data:www-data /var/www
RUN usermod -u 1000 www-data
RUN usermod -G staff www-data
COPY ./Fun /var/www/
COPY ./Drama /var/www/
COPY ./docker-entrypoint.sh /
ENTRYPOINT ["/docker-entrypoint.sh"]
EXPOSE 80
