#!/bin/bash

php app/console doctrine:database:drop --force && \
php app/console doctrine:database:create && \
php app/console doctrine:schema:create && \
php app/console doctrine:fixtures:load --no-interaction

php app/console doctrine:migrations:version 20131126220110 --add
php app/console doctrine:migrations:version 20140113213226 --add