FROM php:7.1.12-apache

# Cambiar el repositorio de Debian de "jessie" a "buster"
RUN sed -i 's/jessie/buster/g' /etc/apt/sources.list

RUN gpg --keyserver keyserver.ubuntu.com --recv-keys 648ACFD622F3D138 0E98404D386FA1D9 DCC9EFBF77E11517

# Instalar las dependencias necesarias
RUN apt-get update && \
    # apt-get install -y --allow-unauthenticated vim \
    # apt-get upgrade -y && \
    apt-get install -y --no-install-recommends --allow-unauthenticated\
        libjpeg-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        pkg-config\
        vim\
        unzip\
    && rm -rf /var/lib/apt/lists/*

#Agregar extension pdo_mysql al php.ini
RUN docker-php-ext-install pdo pdo_mysql 
RUN echo "extension=/usr/local/lib/php/extensions/no-debug-non-zts-*/pdo_mysql.so" >> /usr/local/etc/php/conf.d/docker-php-ext-pdo_mysql.ini


# Habilitar las extensiones necesarias
RUN docker-php-ext-configure gd --with-freetype=/usr/include/freetype2 --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install -j$(nproc) gd

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar tcpdf
WORKDIR /var/www/html
RUN composer require tecnickcom/tcpdf
