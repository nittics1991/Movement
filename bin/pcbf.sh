#!/bin/bash

cd $(dirname "$0")

phpcbf --standard=PSR12 ../src
phpcbf --standard=PSR12 ../test

exit 0