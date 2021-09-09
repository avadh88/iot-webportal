# iot-webportal

1) clone from github
    git clone https://github.com/avadh88/iot-webportal.git

2) create .env file in docker folder using sample.env set all port in sequence wise.
    set MYSQL_USER,MYSQL_PASSWORD,MYSQL_ROOT_PASSWORD
    for the first time run "docker-compose build" after that run "docker-compose up -d" every time for start docker container

3) create .env file in www/webversion using .env.example file
    set API_URL

4) create folder framework under storage folder after that create sessions,cache and views folder under framework folder give permission
   (chmod -R 777 path_to_framework_folder)

5) run composer install in www/webversion folder

6) create .env file in www/eblapihub using .env.example file
    set DB credentials

7) run composer install in www/eblapihub folder

8) After that run following command 
    docker exec -it "container_id_of_ebl_webserver" bash

9) Go to eblapihub and run following commmand
    php artisan migrate
    php artisan db:seed --class=UserSeeder
    php artisan passport:install
    php artisan key:generate

10) Add .htaccess in both folder (webversion/eblapihub)