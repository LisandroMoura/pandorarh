FROM php:8.2-fpm

# Argumentos para evitar prompts interativos
ARG DEBIAN_FRONTEND=noninteractive

# Instala dependências do sistema e ferramentas de compilação
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libxml2-dev \
    libsqlite3-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    zip \
    unzip \
    git \
    build-essential \     
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \  
        pdo \
        pdo_sqlite \      
        pdo_mysql \      
        mbstring \       
        exif \           
        pcntl \         
        bcmath \        
        curl \         
        xml \         
        zip \        
        gd \        
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia o código e instala dependências do Composer
COPY . .
RUN composer install --optimize-autoloader --no-dev

# Ajusta permissões para pastas críticas
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# # Cria o arquivo SQLite se não existir
# RUN touch database/database.sqlite \
#     && chown www-data:www-data database/database.sqlite \
#     && chmod 664 database/database.sqlite

# Inicia o servidor Laravel
CMD php artisan serve --host=0.0.0.0 --port=8000

EXPOSE 8000