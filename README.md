# Library management system using PHP

## Setup

1. Clone this repo on your local device using `git clone 
      https://github.com/NehaGujar1/LMS_PHP.git`   

2. Now we will have to do a few installations:     
  i) Composer: 
     This must be installed in the **project directory** i.e. go to the project   directory and run :   
     `sudo apt update`  
     `sudo apt install php-cli unzip`  
     `cd ~`   
     `curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php`   
     `sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin -–filename=composer`  
     `php composer.phar`  
  ii) It's dependancies    
     For this you have to run : `composer install`    
     Also to ensure that you don't have to keep reloading it run : `composer    dump-autoload`     
From hereon you can use **setup_shellscript.sh** which will help you in setting up     the *database* in your local device.    


## Features

1. This Library management system, allows the user to do **check-in** requests without interference of admin, while **check-out** requests need to be approved by the admin.     

2. It also has an option of *admin registration*, which does not mean that anyone can become an admin as this also needs approval from a registered admin who has authority to *add books, delete books ,approve check-out requests as well as approve admin registration requests*.    

3. Books are given a specific **isbn** in this case generated using *time()* function to ensure that it is unique.    

4. It also has a **fee system**, the user has to pay a fine of 1 Rs per day post 7 days of keeping the book.    

5. The passwords are **salted and hashed** before saving which ensures more safety of the input data and srand(mktime()) has been used so that the randomly generated salt does not repeat.    
