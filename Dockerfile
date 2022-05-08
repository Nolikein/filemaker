FROM php:8.1-fpm

WORKDIR /app

# Add debug files
# COPY /docker/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Install xdebug
# RUN pecl install xdebug \
    # && docker-php-ext-enable xdebug

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
    && php ./composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv ./composer.phar /usr/bin/composer

# Install packages as git, unzip
RUN apt-get update \
    && apt-get install -y \
        git \
        unzip \
        && apt-get clean \
        && rm -rf /var/lib/apt/lists/*