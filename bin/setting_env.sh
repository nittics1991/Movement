#!/bin/bash

cd $(dirname "$0")

source ../env.list

#sudo apt install -y ${TOOLS[@]}
sudo apt install ${TOOLS[@]}

cd ..

composer update
