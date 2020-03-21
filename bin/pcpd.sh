#!/bin/bash

cd $(dirname "$0")

phpcpd ../src
phpcpd ../test

exit 0