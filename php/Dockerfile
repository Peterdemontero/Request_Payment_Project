# Use a PHP base image
FROM php:8.1-fpm-alpine

# Install required packages
RUN apk add --no-cache curl git zip libzip-dev $PHPIZE_DEPS

# Install MySQLi extension
RUN docker-php-ext-install mysqli pdo_mysql zip

# Set the working directory
WORKDIR /var/www/html/

# Copy composer.json and composer.lock from php/composer directory to the working directory
COPY ./php/composer/composer.json ./

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Composer dependencies
RUN composer install --prefer-dist --no-dev --no-progress --no-interaction

# Expose port
EXPOSE 9000
