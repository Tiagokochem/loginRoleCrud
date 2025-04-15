# # Dockerfile

# FROM php:8.3-fpm

# # Instala extensões do PHP e dependências
# RUN apt-get update && apt-get install -y \
#     git curl zip unzip libpng-dev libonig-dev libxml2-dev \
#     libzip-dev libpq-dev libcurl4-openssl-dev libssl-dev \
#     && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath

# # Instala Composer
# COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# WORKDIR /var/www

# # Copia arquivos do projeto
# COPY . .

# # Instala dependências
# RUN composer install --optimize-autoloader --no-dev

# # Permissões
# RUN chown -R www-data:www-data /var/www \
#     && chmod -R 755 /var/www/storage

# # Expõe a porta padrão do Laravel
# EXPOSE 8000

# # Comando para iniciar o Laravel (com servidor embutido)
# CMD php artisan serve --host=0.0.0.0 --port=8000
