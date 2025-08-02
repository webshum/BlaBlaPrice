FROM php:7.4-fpm

# Встановлюємо залежності
RUN apt update && apt -y install \
    vim less libzip-dev libpng-dev default-mysql-client git zip cron iputils-ping curl gnupg ca-certificates

# Встановлюємо PHP-розширення
RUN docker-php-ext-install mysqli pdo pdo_mysql zip gd bcmath && docker-php-ext-enable mysqli

# Встановлюємо Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Встановлюємо Node.js 20 + npm останньої версії
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm@latest
