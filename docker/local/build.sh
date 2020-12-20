#!/usr/bin/env bash

docker network create webproxy

if [[ "$OSTYPE" == "darwin"* ]]; then
    docker-compose build notification-service
else
    docker-compose build --build-arg GROUP_NAME=$(whoami) --build-arg USER_NAME=$(whoami) --build-arg USER_UID=$(id -u) --build-arg USER_GID=$(id -g) notification-service
fi
