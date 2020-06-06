#!/bin/bash

cd $(dirname "$0")
cd ..


echo 'cd $(dirname "$0"); cd ..; php ./dist/composer.phar "$*"' \
    > bin/composer
chmod +x bin/composer
