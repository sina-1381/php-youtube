FROM nginx:latest

RUN rm -f /var/log/nginx/*

RUN touch /var/log/nginx/access.log \
&& touch /var/log/nginx/error.log

ADD ./docker/nginx/conf/site.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /var/www/html
WORKDIR /var/www/html

ADD ./src /var/www/html