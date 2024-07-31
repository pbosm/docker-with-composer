# Use a imagem oficial do PHP com Apache
FROM php:8.1-cli

# Instale o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instale extensões necessárias
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mysqli

# Copie seu código para o container
COPY . /var/www/html/

# Defina o diretório de trabalho
WORKDIR /var/www/html/

# Exponha a porta 8000
EXPOSE 8000

# Comando padrão para rodar o PHP Built-in Server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "/var/www/html"]
