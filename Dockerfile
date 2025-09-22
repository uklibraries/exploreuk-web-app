FROM php:8.3-fpm-alpine AS development

# GID and UID of the nginx container
ARG GID=101
ARG UID=101

RUN apk add --no-cache su-exec && \
	addgroup -S -g ${GID} nginx && \
	adduser -S -u ${UID} -G nginx nginx

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
	inotify-tools \
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

WORKDIR /

COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

COPY ./composer.json .
COPY ./composer.lock .

RUN composer install

WORKDIR /app

COPY ./app/package.json .
COPY ./app/package-lock.json .

RUN npm install

COPY app .

# Or directory set in docker-compose for omeka installation step
WORKDIR /omeka

ADD "https://github.com/omeka/Omeka/releases/download/v3.1.2/omeka-3.1.2.zip" /tmp/omeka.zip

RUN unzip /tmp/omeka.zip -d /tmp/omeka-unzipped && \
	mv /tmp/omeka-unzipped/omeka-3.1.2/* . && \
	mv /tmp/omeka-unzipped/omeka-3.1.2/.htaccess . && \
	rm -rf /tmp/omeka-unzipped

# Wipe out existing plugins and use the latest version from github
RUN rm -rf ./plugins/HideElements && \
	rm -rf ./plugins/SimplePages && \
	git clone "https://github.com/zerocrates/HideElements.git" ./plugins/HideElements && \
	git clone "https://github.com/omeka/plugin-SimplePages.git" ./plugins/SimplePages

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN /app/exe/build.sh
RUN /app/exe/stage.sh

COPY ./php-fpm/php.ini-development /usr/local/etc/php/php.ini
COPY ./php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./php-fpm/php-fpm.conf /usr/local/etc/php-fpm/php-fpm.conf

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
EXPOSE 9000

CMD ["php-fpm", "-F"]

FROM php:8.3-fpm-alpine AS production

ARG GID=101
ARG UID=101

RUN apk add --no-cache su-exec && \
	addgroup -S -g ${GID} nginx && \
	adduser -S -u ${UID} -G nginx nginx

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

WORKDIR /omeka

COPY --from=development /omeka /tmp/omeka

COPY ./php-fpm/php.ini-production /usr/local/etc/php/php.ini
COPY ./php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./php-fpm/www.conf /usr/local/etc/php-fpm.d/php-fpm.conf

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm", "-F"]
