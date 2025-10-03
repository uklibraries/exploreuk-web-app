FROM php:8.3-fpm-alpine AS builder

RUN apk add --no-cache \
    git \
    zip \
    unzip \
    rsync \
    bash \
    nodejs \
    npm

WORKDIR /app

# Install Omeka
ADD "https://github.com/omeka/Omeka/releases/download/v3.1.2/omeka-3.1.2.zip" /tmp/omeka.zip

RUN unzip /tmp/omeka.zip -d /tmp/omeka-unzipped && \
    mv /tmp/omeka-unzipped/omeka-3.1.2/* . && \
    mv /tmp/omeka-unzipped/omeka-3.1.2/.htaccess . && \
    rm -rf /tmp/omeka-unzipped

# Wipe out existing plugins if they exist and use the pinned versions from github
RUN rm -rf ./plugins/HideElements && \
    rm -rf ./plugins/SimplePages

ADD "https://github.com/zerocrates/HideElements/releases/download/v1.4/HideElements-1.4.zip" /tmp/HideElements.zip
ADD "https://github.com/omeka/plugin-SimplePages/releases/download/v3.2.1/SimplePages-3.2.1.zip" /tmp/SimplePages.zip

RUN unzip /tmp/HideElements.zip -d ./plugins \
    && rm /tmp/HideElements.zip
RUN unzip /tmp/SimplePages.zip -d ./plugins \
    && rm /tmp/SimplePages.zip

# Install application and any necesary packages.

COPY ./app/package.json .
COPY ./app/package-lock.json .

RUN npm install

COPY ./app .

# This will need to be reworked.
RUN /app/exe/minify.sh

FROM php:8.3-fpm-alpine AS development

RUN apk add --no-cache \
    procps \
    git \
    zip \
    unzip \
    libgomp \
    imagemagick \
    imagemagick-dev \
    rsync \
    wget \
    bash \
    nodejs \
    npm \
    # adds packages to build extensions
    $PHPIZE_DEPS \
    libzip-dev \
    libpng-dev \
    jpeg-dev \
    freetype-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mysqli zip exif

RUN pecl install imagick && docker-php-ext-enable imagick

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

RUN apk add --no-cache \
    rsync

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

FROM php:8.3-fpm-alpine AS production

RUN apk add --no-cache rsync \
    imagemagick \
    jpeg \
    libpng \
    libzip \
    libgomp \
    su-exec

# virtual will add these build dependencies and then delete them after build, keeping the image size small
RUN apk add --no-cache --virtual .build-deps\
    # adds packages to build extensions
    $PHPIZE_DEPS \
    pkgconfig \
    imagemagick-dev \
    zlib-dev \
    libpng-dev \
    jpeg-dev \
    freetype-dev \
    libzip-dev \
    autoconf \
    build-base \
    rsync && \
    docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mysqli zip exif && \
    pecl install imagick && docker-php-ext-enable imagick && \
    apk del .build-deps

WORKDIR /app

COPY --from=builder /app .
RUN rm -rf /app/exe

COPY ./php-fpm/php.ini-production /usr/local/etc/php/php.ini
COPY ./php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./php-fpm/php-fpm.conf /usr/local/etc/php-fpm.d/php-fpm.conf

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm", "-F"]
