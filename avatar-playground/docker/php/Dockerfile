FROM php:8.2-fpm-alpine

# Instala as dependências do sistema e extensões do PHP necessárias para o Laravel
RUN apk add --no-cache \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    oniguruma-dev

RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# Define o diretório de trabalho
WORKDIR /var/www/html

# Ajusta as permissões
RUN chown -R www-data:www-data /var/www/html