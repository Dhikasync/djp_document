# Stage 1: Build Node assets
FROM node:20-alpine AS node_builder
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# Stage 2: PHP and Composer
FROM php:8.3-cli-alpine
WORKDIR /app

# Install system dependencies
RUN apk add --no-cache \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    libzip-dev \
    unzip \
    git \
    oniguruma-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Copy Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
COPY . .

# Copy built Node assets from Stage 1
COPY --from=node_builder /app/public/build /app/public/build

# Create .env from example and touch sqlite database
RUN cp .env.example .env && \
    mkdir -p database && \
    touch database/database.sqlite

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev

# Set permissions
RUN chown -R www-data:www-data /app \
    && chmod -R 775 /app/storage \
    && chmod -R 775 /app/bootstrap/cache

# Expose port (Render sets PORT env variable)
EXPOSE $PORT

# Start the application using artisan serve
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-10000}
