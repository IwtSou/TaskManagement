FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    zip unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip

# npm
# 必要なパッケージのインストール
RUN apt-get update && apt-get install -y curl git unzip

# Node.jsのインストール（例：Node.js 18.xをインストール）
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

#  bcmath 拡張をインストール
RUN docker-php-ext-install bcmath

# npmがインストールされているか確認
RUN node -v
RUN npm -v

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
