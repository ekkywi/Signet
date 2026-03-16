FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git curl zip unzip udev supervisor zsh libpq-dev \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_pgsql pcntl bcmath gd sockets redis swoole

RUN usermod -s /usr/bin/zsh root \
    && usermod -s /usr/bin/zsh www-data \
    && usermod -a -G dialout www-data

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www
COPY . .
RUN chown -R www-data:www-data /var/www

EXPOSE 8000 5173