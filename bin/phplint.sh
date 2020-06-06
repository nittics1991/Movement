#!/bin/bash

cd $(dirname "$0")

find .. -name *.php -not -path '*/@/*' \
    |xargs -n 1 php -l  \
    |grep -e "No syntax errors detected" -v

#grepはtarget発見でreturn 0

if [[ "$?" == 1 ]] ; then
    exit 0
else
    exit 1
fi
