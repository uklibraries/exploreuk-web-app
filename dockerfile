FROM php:8.0-fpm AS dev

RUN apt-get update && apt-get install -y curl gnupg && \
	curl -sL https://deb.nodesource.com/setup_18.x | bash -

RUN apt-get update && apt-get install -y \
	procps \
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
	nodejs \
	--no-install-recommends && \
	rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
	docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mysqli zip exif

RUN pecl install imagick && docker-php-ext-enable imagick

WORKDIR /app

COPY ./app/package.json .
COPY ./app/package-lock.json .

RUN npm install

COPY /app .

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

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
EXPOSE 9000

CMD ["php-fpm"]

FROM php:8.0-fpm-alpine

RUN apk add --no-cache rsync \
	imagemagick \
	jpeg \
	libpng \
	libzip

# virtual will add these build dependencies and then delete them after build, keeping the image size small
RUN apk add --no-cache --virtual .build-deps\
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

COPY --from=dev /omeka /tmp/omeka

COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]
