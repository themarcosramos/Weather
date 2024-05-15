# Use a imagem oficial do PHP 8.2 com FPM
FROM php:8.2-fpm

# Instale extensões PHP necessárias
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo_mysql zip

# Defina o diretório de trabalho para o diretório do aplicativo Laravel
WORKDIR /var/www/html

# Copie o código do aplicativo Laravel para o contêiner
COPY . .

# Instale as dependências do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

# Defina as permissões adequadas nos diretórios de armazenamento do Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exponha a porta 9000 para conexão com o servidor da web (Nginx ou Apache)
EXPOSE 9000

# Comando para iniciar o servidor PHP-FPM
CMD ["php-fpm"]
