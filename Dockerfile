FROM composer:2

WORKDIR /var/www/html

RUN apk add --no-cache postgresql-dev \
    && docker-php-ext-install pdo_pgsql

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
