#!/bin/bash

CWD=$(cd $(dirname "$0");pwd)

cd "$CWD"

phpunit -c "../phpunit.xml" > ../log/phpunit.log 2>&1