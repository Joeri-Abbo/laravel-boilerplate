#!/bin/sh

if [ "$SECRET_ENV_FILE" ]; then
    ln -s "/run/secrets/$SECRET_ENV_FILE" /var/www/.env
else
    ln -s "/run/secrets/laravel_rds_env_1" /var/www/.env || true
fi

# This will exec the CMD from your Dockerfile
exec "$@"
