#!/bin/bash

cd $(dirname "$0")

find ../src -name *.php \
    |xargs -n 1 php -l  \
    |grep -e "No syntax errors detected" -v

#grepはtarget発見でreturn 0

if [[ "$?" == 0 ]] ; then
    exit 1
fi

find ../test -name *.php \
    |xargs -n 1 php -l  \
    |grep -e "No syntax errors detected" -v

if [[ "$?" == 1 ]] ; then
    exit 0
else
    exit 1
fi
