FROM php:8.3-fpm-alpine AS builder

RUN apk add --no-cache \
    bash \
    nodejs \
    npm

WORKDIR /app

# Install application and any necesary packages.

COPY ./app/package.json .
COPY ./app/package-lock.json .

RUN npm install

COPY ./app .

RUN npm run minify-css

FROM php:8.3-fpm-alpine AS development

RUN apk add --no-cache \
    bash \
    nodejs \
    npm

COPY --from=builder /app /app

WORKDIR /

COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer
COPY ./composer.json .
COPY ./composer.lock .
RUN composer install

WORKDIR /app

COPY ./entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

COPY ./tests /tests

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm", "-F"]

FROM php:8.3-fpm-alpine AS ci

COPY --from=builder /app /app

WORKDIR /

COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer
COPY ./composer.json .
COPY ./composer.lock .
COPY ./phpunit.xml .
RUN composer install

WORKDIR /app

COPY ./php-fpm/php.ini-production /usr/local/etc/php/php.ini
COPY ./php-fpm/php-fpm.conf /usr/local/etc/php-fpm.conf
COPY ./php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf

COPY ./entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

COPY ./tests /tests

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm", "-F"]

FROM php:8.3-fpm-alpine AS production

WORKDIR /app

COPY --from=builder /app .
RUN rm -rf /app/exe

WORKDIR /
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer
COPY ./composer.json .
COPY ./composer.lock .
RUN composer install --no-dev --optimize-autoloader

WORKDIR /app

COPY ./php-fpm/php.ini-production /usr/local/etc/php/php.ini
COPY ./php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./php-fpm/php-fpm.conf /usr/local/etc/php-fpm.conf

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm", "-F"]
