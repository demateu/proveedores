# Usa la imagen oficial de PHP con Apache
FROM php:8.1-apache

# Instala las extensiones necesarias para Symfony y PHP
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install intl pdo pdo_mysql zip

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configura el entorno de trabajo
WORKDIR /var/www/html

# Copia los archivos del proyecto al contenedor
COPY . /var/www/html

# Instala las dependencias de Symfony
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-progress --prefer-dist

# Configura permisos para las carpetas de Symfony
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/vendor /var/www/html/public

# Habilita el módulo de reescritura de Apache
RUN a2enmod rewrite

# Expone el puerto 80 para acceder a la aplicación
EXPOSE 80

# Define el comando predeterminado
CMD ["apache2-foreground"]