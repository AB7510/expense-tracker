FROM php:8.2-cli

WORKDIR /var/www/html

RUN docker-php-ext-install mysqli

COPY . /var/www/html

ENV PORT=10000

CMD ["sh", "-c", "php -S 0.0.0.0:${PORT} -t /var/www/html"]
