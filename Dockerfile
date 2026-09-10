FROM php:8.2-apache

# Install ekstensi yang dibutuhkan Laravel dan Supabase (PostgreSQL)
RUN apt-get update && apt-get install -y libpq-dev zip unzip \
    && docker-php-ext-install pdo pdo_pgsql

# Mengaktifkan mod_rewrite Apache untuk routing Laravel
RUN a2enmod rewrite

# Mengarahkan domain langsung ke folder /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Memasukkan kode Laravel-mu ke dalam server
COPY . /var/www/html

# Menginstal dependensi Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Memberikan hak akses agar Laravel bisa menyimpan foto/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache