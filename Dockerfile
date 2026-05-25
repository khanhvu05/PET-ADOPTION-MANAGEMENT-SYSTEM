FROM php:8.2-apache

# 1. Cài đặt các thư viện hệ thống cần thiết cho Laravel và Node.js
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    libzip-dev \
    curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql zip

# 2. Bật mod_rewrite của Apache (bắt buộc cho Laravel routing)
RUN a2enmod rewrite

# 3. Thay đổi Document Root của Apache trỏ vào thư mục public/ của Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 4. Cài đặt Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Thiết lập thư mục làm việc và copy mã nguồn vào container
WORKDIR /var/www/html
COPY . .

# 6. Build giao diện (CSS/JS) bằng Node.js (Vite/Tailwind)
RUN npm install && npm run build

# 7. Phân quyền cho www-data (Apache)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# 8. Cài đặt các thư viện PHP
# (Chạy với user www-data để không bị lỗi quyền)
USER www-data
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Đổi lại quyền root để chạy container
USER root

EXPOSE 80
