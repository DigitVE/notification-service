#!/usr/bin/env bash

if [[ "$OSTYPE" == "darwin"* ]]; then
    docker exec -it notification-service_1 /bin/bash
else
    docker exec -it -u $(whoami) notification-service_1 /bin/bash
fi
