FROM php:apache

# Install Zip Archive dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    && docker-php-ext-install zip

# Install default JDK
RUN apt-get update && apt-get install -y \
    default-jdk