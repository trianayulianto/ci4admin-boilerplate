FROM dunglas/frankenphp:latest

LABEL maintainer="Triana Yulianto <triana.yulianto2018@gmail.com>"

ENV APP_USER="ci4admin"
ARG MYSQL_CLIENT="mysql-client"

RUN install-php-extensions \
    gd \
    pcntl \
    pdo_mysql \
    sockets \
    redis \
    zip \
    intl \
    mysqli

USER root
RUN set -ex; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
    curl \
    git \
    unzip \
    libnss3-tools \
    ${MYSQL_CLIENT} \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY --from=node:lts-slim /usr/local/bin /usr/local/bin
COPY --from=node:lts-slim /usr/local/lib/node_modules /usr/local/lib/node_modules

RUN useradd ${APP_USER}; \
    setcap CAP_NET_BIND_SERVICE=+eip /usr/local/bin/frankenphp; \
    mkdir -p /home/${APP_USER}; \
	chown -R ${APP_USER}:${APP_USER} /home/${APP_USER}

USER ${APP_USER}

WORKDIR /app
