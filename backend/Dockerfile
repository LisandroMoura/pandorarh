FROM php:8.2-fpm-alpine

# Instala pacotes do sistema
RUN apk update && apk add --no-cache \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    sqlite \
    sqlite-dev \
    libxml2-dev

# FROM php:8.2-fpm

# # Instala pacotes do sistema
# RUN apt-get update && apt-get install -y \
#      unzip \
#      git \
#      curl \
#      libpng-dev \
#      libjpeg-dev \
#      libfreetype6-dev \
#      libonig-dev \
#      sqlite3 \
#      libsqlite3-dev \
#      libxml2-dev

# Configura a extensão GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Instala extensões PHP
 RUN docker-php-ext-install \
     gd \
     mbstring \
     pdo \
     pdo_mysql \
     pdo_sqlite \
     xml

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configura o diretório de trabalho
WORKDIR /var/www/html

# Copia os arquivos da aplicação
COPY . .

# Copia apenas os arquivos necessários para instalar dependências
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# Ajusta permissões corretas
RUN chown -R www-data:www-data storage bootstrap/cache

# // Permissões para o arquivo database.sqlite
RUN chown www-data:www-data database/database.sqlite \
    && chmod 664 database/database.sqlite

CMD php artisan serve --host=0.0.0.0 --port=8000

#CMD ["tail","-f", "/dev/null"] #tranca o terminal com o container

# Expõe a porta do PHP-FPM
EXPOSE 8000

# Comando para iniciar o PHP-FPM
#CMD ["php-fpm"]



