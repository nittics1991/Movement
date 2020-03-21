#!/bin/bash

cd $(dirname "$0")

phpunit -c ../phpunit.xml

exit 0
