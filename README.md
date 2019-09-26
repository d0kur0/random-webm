# Алиасы
### Composer
``
alias composer='docker run --rm --interactive --tty --user "${UID}:${GID}" --volume $PWD:/app composer $1'
``

# Первый запуск
``cp .env-example .env`` и изменить в .env нужные настройки

``./start.sh dev`` или просто ``./start.sh`` - запуск dev версии

``./start.sh prod`` - запуск prod версии