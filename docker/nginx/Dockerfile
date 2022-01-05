FROM nginx:latest
LABEL maintainer="Jesus Fernandez"

ARG SERVER_NAME

RUN rm /etc/nginx/conf.d/default.conf
COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf

WORKDIR /var/www/html

COPY ./public /var/www/html/public
COPY docker/confd /etc/confd

ADD https://github.com/kelseyhightower/confd/releases/download/v0.16.0/confd-0.16.0-linux-amd64 /usr/local/bin/confd

RUN chmod +x /usr/local/bin/confd \
    && chown -R www-data:www-data /var/www/html/public \
    && echo "The hostname is $SERVER_NAME" \
    && confd -onetime -backend env

