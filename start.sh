#!/bin/bash

if ! type "docker-compose" > /dev/null; then
  echo Docker-compose not installed.
  exit 1
fi

if [ ! -f ".env" ]; then
    echo ".env file does not exist"
    exit 1
fi

source .env


export DOCKER_USER="$UID:$GID"
export SERVER_PATH="$PWD/app/server"
export CLIENT_PATH="$PWD/app/client"
export NGINX_CONFIGS="./docker/nginx"

if [ ! -d "$NGINX_CONFIGS/working" ]; then
  cp -r "$NGINX_CONFIGS/original" "$NGINX_CONFIGS/working"
fi

sed -ri "s/server_name[^;]*;/server_name ${SERVER_NAME_CLIENT};/" "$NGINX_CONFIGS/working/client.conf"
sed -ri "s/server_name[^;]*;/server_name ${SERVER_NAME_SERVER};/" "$NGINX_CONFIGS/working/server.conf"

export VUE_ENV="app/client/.env.local"

if [ -f "$VUE_ENV" ]; then
  rm "$VUE_ENV"
fi

echo "VUE_APP_SERVER_ADDRESS=$SERVER_NAME_SERVER" >> "$VUE_ENV"
echo "VUE_APP_CLIENT_ADDRESS=$SERVER_NAME_CLIENT" >> "$VUE_ENV"

docker run --rm --interactive --tty \
  -u "${UID}:${GID}" \
  -v "$SERVER_PATH":/app \
  composer install --ignore-platform-reqs

docker-compose down
docker-compose build
docker-compose up
