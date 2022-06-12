FROM php:8.1.6
RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo_mysql
WORKDIR /app
COPY . /app
RUN composer update
RUN composer install --optimize-autoloader --no-dev

# RUN php artisan route:clear
# RUN php artisan cache:clear
# RUN php artisan config:clear
# RUN php artisan view:clear
# RUN php artisan key:generate
# RUN php artisan config:cache

CMD php artisan serve --host=0.0.0.0 --port $PORT
EXPOSE $PORT