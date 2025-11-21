FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libonig-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev libxml2-dev ca-certificates \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer (from official composer image)
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Configure git to treat the bind-mounted repo as safe to avoid 'dubious ownership' errors
RUN git config --global --add safe.directory /var/www/html || true

# Copy composer.json (safe for caching). Do not use shell redirections in COPY.
COPY composer.json /var/www/html/

# Run composer install only if composer.json exists
RUN if [ -f composer.json ]; then composer install --prefer-dist --no-interaction --no-progress || true; fi

# Copy application code
COPY . /var/www/html

# Fix permissions for Laravel writable dirs
RUN mkdir -p storage bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
