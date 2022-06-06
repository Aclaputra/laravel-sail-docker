deployed laravel sail application using docker container to heroku -> https://evening-eyrie-58496.herokuapp.com/

Requirements
- Installed Heroku CLI
- Installed Docker Engine for Linux OS, Docker Desktop for Windows OS
- Installed php >=8.1 & composer >=2.3.7
- No need XAMPP or installing apache mysql, etc. we will create Docker images for mysql-server, redis, alpine, sail and run all of them in the Docker containers instead (alternative for XAMPP, Laragon, or Valet for mac OS).

## Stop Apache2 & MySQL
Make sure to stop Apache2 & MySQL that running in the port background

for linux Ubuntu :
```
sudo systemctl status apache2 mysql
sudo systemctl stop apache2 mysql
```

## Create Laravel Sail App

Copy the example laravel sail file :
```
curl -s https://laravel.build/example-app | bash
```
Then run it using Sail :
```
cd example-app
./vendor/bin/sail up
```
it will run on localhost:80 or http://localhost

## create your Dockerfile
```
touch Dockerfile
```
Inside Dockerfile :
```
FROM php:8.0.5
RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN docker-php-ext-install pdo_mysql
WORKDIR /app
COPY . /app
RUN composer update
RUN composer install --optimize-autoloader --no-dev
CMD php artisan serve --host=0.0.0.0 --port $PORT
EXPOSE $PORT
```
## Build image, push it to Heroku Container Registry, & Release the image to your app
Make sure you have a working Docker installation (eg. docker ps) and that you’re logged in to Heroku (heroku login).

Log in to Container Registry:
```
heroku container:login

heroku create
heroku container:push web
heroku container:release web

heroku open
```
Done, It will be deployed to Heroku and redirect you to the endpoint url

Easter egg :
```
php artisan inspire
```
learning resources :
- Laravel official documentation for linux - https://laravel.com/docs/9.x#getting-started-on-linux
- Heroku Dev Center - https://devcenter.heroku.com/articles/container-registry-and-runtime#:~:text=Heroku%20Container%20Registry%20allows%20you,yml.