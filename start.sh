#!/bin/bash

# Проверка, установлен ли docker и docker-comoise
if ! type "docker-compose" > /dev/null; then
  echo Docker-compose not installed.
  exit 1
fi

# Инжект переменных окружения
source .env

# Если есть аргумент при запуске - проверяем, равен ли он prod || dev, иначе ставим как dev
# Если аргумента нет - так же dev
WORKSPACE=$1
if [ -z "$WORKSPACE" ] || [ "$WORKSPACE" != 'prod' ]; then
  WORKSPACE="dev"
fi

# Docker юзер
export DOCKER_USER="$UID:$GID"
# Путь к файлам сервера
SERVER_PATH="$PWD/server"
# Путь к файлам клиента
CLIENT_PATH="$PWD/client"
# Путь к файлу манифеста composer
COMPOSER_MANIFEST_PATH="$SERVER_PATH/www"

if [ "$WORKSPACE" == 'dev' ]; then
  # Указываем путь к описанию сборки среды
  export COMPOSE_FILE=docker-compose.dev.yml
else
  # Указываем путь к описанию сборки среды
  export COMPOSE_FILE=docker-compose.prod.yml
  # В случае с prod, нужно собрать файлы клиента в nodeJS на стадии сборки docker
  # В prod среде нет nodeJS.
  docker run --rm --interactive --tty \
    -u "${UID}:${GID}" \
    -v "$CLIENT_PATH":/app \
    -w "/app" \
    node \
    bash -c "npm install && npm run build"
fi

# Прокидывание имени серверов в конфигурацию nginx
sed -ri "s/server_name[^;]*;/server_name ${SERVER_NAME_CLIENT};/" docker-images/nginx/conf.d/client.conf
sed -ri "s/server_name[^;]*;/server_name ${SERVER_NAME_CLIENT};/" docker-images/nginx/conf.d/client-proxy.conf
sed -ri "s/server_name[^;]*;/server_name ${SERVER_NAME_SERVER};/" docker-images/nginx/conf.d/server.conf

# Прокидывание адреса сервера в конфиг клиента
echo "export const API_ADDRESS = '${SERVER_NAME_SERVER}'" > client/src/config/apiAddress.js

# Сборка сервера, установка зависимостей в отдельном composer контейнере
docker run --rm --interactive --tty \
  -u "${UID}:${GID}" \
  -v "$COMPOSER_MANIFEST_PATH":/app \
  composer install --ignore-platform-reqs


# Запуск и сборка контейнеров
docker-compose down
docker-compose build
docker-compose up