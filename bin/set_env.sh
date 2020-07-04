#!/bin/bash

cd $(dirname "$0")
cd ..

sudo apt install -y php7.4-cli php7.4-xml php7.4-mbstring php7.4-bcmath

if [[ ! -d dist ]] ; then
    mkdir dist
fi

if [[ ! -d log ]] ; then
    mkdir log
fi

#composer
if [[ ! -f ./dist/composer.phar ]] ; then
    ./bin/install_composer.sh
    
    #echo 'cd $(dirname "$0"); cd ..; php ./dist/composer.phar "$*"' \
        #> ./bin/composer
    #chmod +x ./bin/composer
fi

#phpunit

if [[ ! -f ./dist/phpunit ]] ; then
    wget -P ./dist -O phpunit https://phar.phpunit.de/phpunit-9.phar
    chmod +x ./dist/phpunit

    #echo 'cd $(dirname "$0"); cd ..; ./dist/phpunit "$*"' \
        #> ./bin/punit.sh
    #chmod +x ./bin/punit.sh
fi

#phpcs
if [[ ! -f ./dist/phpcs.phar ]] ; then
    wget -P ./dist https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar

    #echo 'cd $(dirname "$0"); cd ..; php ./dist/phpcs.phar "$*"' \
        #> ./bin/pcs.sh
    #chmod +x ./bin/pcs.sh
fi

#phpccbf
if [[ ! -f ./dist/phpcbf.phar ]] ; then
    wget -P ./dist https://squizlabs.github.io/PHP_CodeSniffer/phpcbf.phar

    #echo 'cd $(dirname "$0"); cd ..; php ./dist/phpcbf.phar "$*"' \
        #> ./bin/pcbf.sh
    #chmod +x ./bin/pcbf.sh
fi
