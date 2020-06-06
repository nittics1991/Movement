cd $(dirname "$0"); cd ..; php ./dist/phpstan.phar analyze "$*" | tee ./log/phpstan.log
