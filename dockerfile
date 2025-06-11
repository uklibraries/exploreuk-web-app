FROM php:8.0-fpm AS base

RUN apt-get update && apt-get install -y \
	git \
	zip \
	unzip \
	libzip-dev \
	libpng-dev \
	libjpeg62-turbo-dev \
	libfreetype6-dev \
	imagemagick \
	libmagickwand-dev \
	rsync \
	wget \
	bash \
	inotify-tools \
	--no-install-recommends && \
	rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
	docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mysqli zip exif

RUN pecl install imagick && docker-php-ext-enable imagick

WORKDIR /var/www/html

RUN wget "https://github.com/omeka/Omeka/releases/download/v3.1.2/omeka-3.1.2.zip" -O omeka.zip && \
	unzip omeka.zip && \
	mv omeka-3.1.2/* . && \
	mv omeka-3.1.2/.htaccess . && \
	rmdir omeka-3.1.2 && \
	rm omeka.zip

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Wipe out existing plugins and use the latest version from github
RUN rm -rf ./plugins/HideElements && \
	rm -rf ./plugins/SimplePages && \
	git clone "https://github.com/zerocrates/HideElements.git" ./plugins/HideElements && \
	git clone "https://github.com/omeka/plugin-SimplePages.git" ./plugins/SimplePages

RUN mkdir -p files && \
	chown -R www-data:www-data /var/www/html

EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]

# Leaving this open for extension
FROM base as dev

FROM node:18-slim AS exploreuk_builder

RUN apt-get update && apt-get install -y rsync --no-install-recommends

WORKDIR /app

COPY ./app/package.json ./
COPY ./app/package-lock.json ./

RUN npm ci --only=production

COPY ./app ./

RUN chmod +x exe/*.sh

RUN ./exe/build.sh

FROM base AS prod

# Copy the artifact from the 'exploreuk_builder' stage
COPY --from=exploreuk_builder ./app/dist/omeuka.tar.gz /tmp/

# Untar the artifact into the web root
RUN tar -xzvf /tmp/omeuka.tar.gz -C /var/www/html \
	&& rm /tmp/omeuka.tar.gz

RUN chown -R www-data:www-data /var/www/html && \
	find /var/www/html -type d -exec chmod 755 {} \; && \
	find /var/www/html -type f -exec chmod 644 {} \; && \
	chmod -R u+w /var/www/html/files
