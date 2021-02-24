FROM nginx:alpine

RUN apk update && apk add --no-cache bash \
    && rm -rf /var/cache/apk/*

COPY ./.docker/nginx/nginx.conf  /etc/nginx/conf.d/default.conf
COPY ./.docker/nginx/index.php /app/web/index.php

VOLUME ["/app"]