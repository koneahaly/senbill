#!/bin/bash

# Assign the filename
filename_1="app/Http/Controllers/HomeController.php"
filename_2="app/Http/Controllers/ApiController.php"
filename_3="app/Http/Controllers/billController.php"
env_file=".env"

search="localhost"
replace="18.204.203.83"

search_a="APP_DEBUG=true"
search_b="APP_DEBUG=false"

search_c="DB_PASSWORD=Coumb@18"
search_d="DB_PASSWORD=XnnwuXCjWIx3"

sed -i "s/$search/$replace/" $filename_1
sed -i "s/$search/$replace/" $filename_2
sed -i "s/$search/$replace/" $filename_3
sed -i "s/$search_a/$search_b/" $env_file
sed -i "s/$search_c/$search_d/" $env_file


aws --endpoint-url=http://localhost:4566 s3 mb s3://housingimages
aws --endpoint-url=http://localhost:4566 s3api put-bucket-acl --bucket housingimages --acl public-read 
aws --endpoint-url=http://localhost:4566 s3 cp Desktop/electra/public/images s3://housingimages/ --recursive