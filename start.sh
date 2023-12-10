#!/bin/bash

cd Apache
pwd
# Change permissions of files
sudo chown -R www-data:www-data ./public-html
sudo chmod -R 755 ./public-html

# # Start Docker container
docker-compose up --build