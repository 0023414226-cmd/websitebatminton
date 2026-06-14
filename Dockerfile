FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN a2enmod rewrite

COPY . /var/www/html

RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

RUN ln -s /var/www/html/assets /var/www/html/public/assets \
    && ln -s /var/www/html/storage /var/www/html/public/storage

WORKDIR /var/www/html

EXPOSE 80
