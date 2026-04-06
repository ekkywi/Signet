# ─── Stage 1: Base (shared dependencies) ────
FROM php:8.4-cli AS base

RUN apt-get update && apt-get install -y --no-install-recommends \
    libpq-dev supervisor curl \
    && rm -rf /var/lib/apt/lists/*

COPY --from=mlocati/php-extension-installer \
    /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions pdo_pgsql pcntl bcmath gd sockets redis swoole

RUN usermod -a -G dialout www-data

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# ─── Stage 2: Development (zsh, watch, etc) ────
FROM base AS development

# All development tools can be entered here
RUN apt-get update && apt-get install -y --no-install-recommends \
    zsh git zip unzip udev \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js for Octane --watch and Vite
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

# Zsh setup for root and www-data
RUN usermod -s /usr/bin/zsh root \
    && usermod -s /usr/bin/zsh www-data

# Install oh-my-zsh (optional, can be removed if not needed)
RUN sh -c "$(curl -fsSL https://raw.github.com/ohmyzsh/ohmyzsh/master/tools/install.sh)"

COPY . .
RUN chown -R www-data:www-data /var/www

EXPOSE 8000 5173

# Dev command: watch mode
CMD ["zsh", "-c", "php artisan octane:start --server=swoole --host=0.0.0.0 --port=8000 --watch"]

# ─── Stage 3: Production (without zsh) ────
FROM base AS production

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --prefer-dist

COPY . .
RUN composer dump-autoload --optimize \
    && chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

USER www-data

EXPOSE 8000

CMD ["php", "artisan", "octane:start", "--server=swoole", "--host=0.0.0.0", "--port=8000"]