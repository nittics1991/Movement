#!/bin/bash

cd $(dirname "$0")
cd ..

sudo apt install php7.4-cli php7.4-xml

mkdir dist

#composer
./bin/install_composer.sh

echo 'cd $(dirname "$0"); cd ..; php ./dist/composer.phar "$*"' \
    > bin/composer
chmod +x bin/composer




#phpunit
wget -P dist -O phpunit https://phar.phpunit.de/phpunit-9.phar
chmod +x dist/phpunit



###以下テスト中
#composer/autoloaderが必要?

#phpunit
echo 'cd $(dirname "$0"); cd ..; ./dist/phpunit "$*"' \
    > bin/punit.sh
chmod +x bin/punit.sh





#phpcs
wget -P dist https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar
wget -P dist https://squizlabs.github.io/PHP_CodeSniffer/phpcbf.pha

echo 'cd $(dirname "$0"); php ../dist/phpcs.phar "$*"' \
    > bin/pcs
chmod +x bin/pcs

echo 'cd $(dirname "$0"); php ../dist/phpcbf.phar "$*"' \
    > bin/pcbf
chmod +x bin/pcbf


