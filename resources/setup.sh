#!/bin/bash
read -r -p "Are you sure to enter the setup? [y/N] " response
if [[ "$response" =~ ^([yY][eE][sS]|[yY])+$ ]]
then

echo "Setup is starting..."

else
    echo Exiting...
        exit 0
fi

echo "$(tput setab 1)Configure .env in root dir and Docker dir [y/N] $(tput sgr0)"

read environment

if [[ "$environment" =~ ^([yY][eE][sS]|[yY])+$ ]]
then
cp ../.env.develop  ../.env
cp ../resources/.env.example.yml ../resources/.env
else

echo "Continue..."

fi


echo "$(tput setaf 1)---Parse AppArmor profile for Docker container...$(tput sgr0)"
sleep 3
apparmor_parser -r -W ./AppArmor-Docker/docker_nginx


# Request database name
echo "$(tput setab 1)Please enter a database name. $(tput sgr0)"

read database

sed -i -- 's/DB_DATABASE=.*/DB_DATABASE='$database'/g' ../.env
#Docker mariaDB database name
sed -i -- 's/MARIADB_DATABASE_PROD=.*/MARIADB_DATABASE_PROD='$database'/g' ../resources/.env


read -r -p "Are you using a remote DB host? [y/N] " remote
if [[ "$remote" =~ ^([yY][eE][sS]|[yY])+$ ]]
then

echo "Please insert remote DB host IP address"

read ip

sed -i -- 's/DB_HOST=.*/DB_HOST='$ip'/g' ../.env

else

echo "Continue..."

fi

echo "$(tput setab 1)Please enter a port for database connection. (eg.3306) $(tput sgr0)"

read port

sed -i -- 's/DB_PORT=.*/DB_PORT='$port'/g' ../.env
#Docker mariaDB port
sed -i -- 's/MARIADB_PORT_PROD=.*/MARIADB_PORT_PROD='$port'/g' ../resources/.env


# Request database user
echo "$(tput setab 1)Please enter an username for the database user. $(tput sgr0)"

read username

sed -i -- 's/DB_USERNAME=.*/DB_USERNAME='$username'/g' ../.env
#Docker mariaDB username
sed -i -- 's/MARIADB_USER_PROD=.*/MARIADB_USER_PROD='$username'/g' ../resources/.env

# Request password
echo "$(tput setab 1)Please enter a password for database user "$username". $(tput sgr0)"

read password

sed -i -- 's/DB_PASSWORD=.*/DB_PASSWORD='$password'/g' ../.env
#Docker mariaDB password
sed -i -- 's/MARIADB_PASSWORD_PROD=.*/MARIADB_PASSWORD_PROD='$password'/g' ../resources/.env


# Request ROOT password
echo "$(tput setab 1)Please enter a password for database ROOT. $(tput sgr0)"

read rootpw

#Docker mariaDB ROOT password
sed -i -- 's/MARIADB_ROOT_PASSWORD_PROD=.*/MARIADB_ROOT_PASSWORD_PROD='$rootpw'/g' ../resources/.env

echo "$(tput setaf 1)---Setting up right permissions for storage folder...$(tput sgr0)"

chmod -R 777 ../storage

read -r -p "Do you want to pull Docker containers? [y/N] " response
if [[ "$response" =~ ^([yY][eE][sS]|[yY])+$ ]]
then

echo "Pulling Docker containers..."
docker-compose pull
else
    echo "Continue..."
fi

read -r -p "Do you want to start Docker containers? [y/N] " response
if [[ "$response" =~ ^([yY][eE][sS]|[yY])+$ ]]
then

echo "$(tput setaf 1)---Starting containers...$(tput sgr0)"
docker-compose up -d
sleep 15
echo "$(tput setaf 1)---Listing running containers...$(tput sgr0)"
sleep 3
docker-compose ps
echo "$(tput setaf 1)---Starting PHP Artisan migrate...$(tput sgr0)"
sleep 3
cd ../
php artisan migrate
echo "$(tput setaf 1)---Starting PHP Artisan DB:SEED...$(tput sgr0)"
sleep 3
php artisan db:seed

else
    echo "Continue..."
fi

echo "$(tput setaf 2)---Setup finished...$(tput sgr0)"
