FROM php:8.1.17-apache
ADD . /var/www/html/api
EXPOSE 8080:80
RUN apt update
RUN  docker-php-ext-install mysqli
RUN  docker-php-ext-enable mysqli
RUN apachectl restart

RUN docker-php-ext-install pdo pdo_mysql
RUN apt-get install nano