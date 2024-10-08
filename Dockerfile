# Usa la imagen oficial de PHP desde Docker Hub
FROM php:8.2.4-alpine

# Install bundled extensions
RUN apk add --no-cache mysql-client msmtp perl wget procps shadow libzip libpng libjpeg-turbo libwebp freetype icu icu-data-full

RUN apk add --no-cache --virtual build-essentials \
    icu-dev icu-libs zlib-dev g++ make automake autoconf libzip-dev \
    libpng-dev libwebp-dev libjpeg-turbo-dev freetype-dev && \
    docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp && \
    docker-php-ext-install gd && \
    docker-php-ext-install mysqli && \
    docker-php-ext-install pdo_mysql && \
    docker-php-ext-install intl && \
    docker-php-ext-install opcache && \
    docker-php-ext-install exif && \
    docker-php-ext-install zip && \
    apk del build-essentials && rm -rf /usr/src/php*

# Instalar composer
RUN wget https://getcomposer.org/composer-stable.phar -O /usr/local/bin/composer && chmod +x /usr/local/bin/composer

# Instalar cronie para el cron
RUN apk add --no-cache cronie

# Crear un archivo crontab
COPY crontab /etc/crontabs/root

# Asegurar permisos para el archivo crontab
RUN chmod 0644 /etc/crontabs/root

# Habilitar cronie
RUN rc-update add crond

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar el código fuente de la aplicación
COPY . .

# Instalar dependencias con Composer
RUN composer install --no-dev --optimize-autoloader

# Copiar los archivos modificados de Klein y rm
COPY klein/Klein.php /var/www/html/vendor/klein/klein/src/Klein/Klein.php
COPY klein/DataCollection.php /var/www/html/vendor/klein/klein/src/Klein/DataCollection/DataCollection.php
COPY klein/HttpException.php /var/www/html/vendor/klein/klein/src/Klein/Exceptions/HttpException.php
RUN rm -rf klein

COPY .env.prod .env
RUN rm -rf .env.prod 
# Exponer el puerto 8001 para el servidor PHP
EXPOSE 8001

# Iniciar el servidor PHP
CMD ["php", "-S", "0.0.0.0:8001", "./router.php"]
# docker build -t api-agenda-cron-service .
# docker container run -d --name nec-admin-service -p 8080:8001 api-agenda-cron-service