#! /bin/bash

server_start(){
        echo "Starting server at port 8001"
	cd public/
	php -S localhost:8001
}

if [[ -f "config/config.php" ]]; then
	echo "The required file exists"
        server_start
else
	echo "We will have to create a new database inorder to import the schema sql"	
	$db_host,$db_port,$db_username,$db_name_of_database,$db_pwd
	echo 'Enter the details for database config file'
        read -p 'Enter the port for your database' db_port
	read -p 'Enter the database host, it has no relation with "8001"' db_host
	read -p 'Enter the name of the database to be used' db_name_of_database
	read -p 'Enter the username if not enter "root"' db_username
	read -s -p 'Enter your password' db_pwd
	touch config/config.php
	echo '<?php'>config/config.php
	echo '$DB_HOST= "'$db_host'";'>>config/config.php
	echo '$DB_PORT= "'$db_port'";'>>config/config.php
	echo '$DB_NAME= "'$db_name_of_database'";'>>config/config.php
	echo '$DB_USERNAME= "'$db_username'";'>>config/config.php
	echo '$DB_PASSWORD= "'$db_pwd'";'>>config/config.php
	echo '?>'>>config/config.php
	echo “Importing schema”
	$bool
	read -p 'Has this database been already created?If no enter 1 else enter 0' bool
	echo $bool
	if [ $bool -eq 1 ]; then
		MYSQL_PWD=$db_pwd mysql -u $db_username -e 'CREATE DATABASE '$db_name_of_database;
		echo "hello"
	fi
	if MYSQL_PWD=$db_pwd mysql -u $db_username $db_name_of_database < schema/schema.sql; then 
		echo 'Admin: gamma Password: 1 can be used'
    		server_start
	else 
		rm config/config.php
		echo "The file has been deleted due to incorrect credentials"
		./setup_shellscript.sh
	fi
fi



