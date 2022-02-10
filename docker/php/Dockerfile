FROM php:8.0-fpm

RUN sed -i '/jessie-updates/d' /etc/apt/sources.list  # Now archived

RUN apt-get update && apt-get install zlib1g-dev -y \
        libpq-dev \
        libjpeg-dev \
        libpng-dev \
        supervisor \
        git zip \
        xvfb libfontconfig wkhtmltopdf \
    && docker-php-ext-install -j$(nproc) bcmath\
    && docker-php-ext-install -j$(nproc) pdo \
    && docker-php-ext-install -j$(nproc) pdo_mysql \
    && docker-php-ext-install -j$(nproc) gd
    
RUN chown -R www-data:www-data /var/www
