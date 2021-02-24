FROM php:fpm-alpine

# Install linux tools
RUN apk update && apk add --no-cache \
        autoconf gcc make g++ \
		ca-certificates \
		bash \
		curl \
		tar \
		xz \
		openssl \
		zip unzip libzip-dev\
		git \
        && rm -rf /var/cache/apk/* \
        && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install php extenstions
RUN docker-php-ext-install \
        mysqli \
        pdo pdo_mysql \
        zip

# Install remiaing php extensions dependecies
RUN pecl install -o -f redis \
        && rm -rf /tmp/pear

# Enable remamining php extensisons
RUN docker-php-ext-enable \
        redis

#Yii2 dependecy (Deprecated)
#RUN composer global require fxp/composer-asset-plugin --ignore-platform-reqs

COPY . /app

WORKDIR /app

CMD ["php-fpm"]

EXPOSE 9000
