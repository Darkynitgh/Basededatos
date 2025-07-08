# Usa una imagen oficial de PHP con Apache y SQLite habilitado
FROM php:8.1-apache

# Instala extensiones necesarias: SQLite y otras comunes
RUN docker-php-ext-install pdo pdo_sqlite

# Copia tu proyecto al directorio raíz de Apache
COPY . /var/www/html/

# Dale permisos de escritura a la carpeta para que SQLite pueda crear la DB
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expone el puerto 80
EXPOSE 80

# El CMD ya viene en la imagen base (Apache)
