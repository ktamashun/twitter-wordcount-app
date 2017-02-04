FROM php:7.1-cli
ADD . /www
WORKDIR /www

RUN apt-get update
RUN docker-php-ext-install bcmath

CMD ./bin/setup.sh \
    nohup php ./bin/cli.php /read-stream & \
    php ./bin/cli.php /read-message-queue