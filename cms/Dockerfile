FROM wyveo/nginx-php-fpm:php74
WORKDIR /var/www/cms
COPY . .
WORKDIR /etc/nginx/conf.d
COPY ./adp.conf ./default.conf
EXPOSE 3002