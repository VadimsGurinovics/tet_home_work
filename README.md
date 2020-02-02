Izmantotā OS versija -> NAME="Ubuntu", VERSION="18.04.3 LTS (Bionic Beaver)"

Turpmākās uzskaitītās komandas ir visas nepieciešamās komandas, lai pilnvērtīgi uzstādītu un izpildītu uzdevumu.

sudo apt-get update

sudo apt-get install apache2

sudo add-apt-repository ppa:ondrej/php

sudo apt-get update

sudo apt -y install php7.4

sudo apt-get install php-xml php7.4-mbstring php-bcmath php7.4-mysql

php -v //PHP 7.4.2 (cli) (built: Jan 23 2020 11:21: 30) ( NTS )

sudo apt-get update

sudo apt-get install mysql-server

sudo mysql

ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'Admin123';

FLUSH PRIVILEGES;

quit

mysql -u root -h localhost -p //Admin123

CREATE DATABASE rss_feed;

sudo service apache2 restart

sudo apt update

sudo apt install git

git --version //git version 2.17.1

sudo chmod -R 777 /var/www/html/

cd /var/www/html/

//COMPOSER
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'c5b9b6d368201a9db6f74e2611495f369991b72d9c8cbd3ffbc63edff210eb73d46ffbfce88669ad33695ef77dc76976') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

//makes it global
sudo mv composer.phar /usr/local/bin/composer

sudo chmod -R 777 /var/www/html/

cd /var/www/html/

git clone https://github.com/VadimsGurinovics/tet_home_work.git

composer install

php artisan migrate

//Cronjob
php artisan import:rssdata

php artisan serve
