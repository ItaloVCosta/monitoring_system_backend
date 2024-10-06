
FROM php:8.3-cli

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
