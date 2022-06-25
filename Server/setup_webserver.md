# Setup Web Server

## Preliminary

If you don't have a real server, you can use VirtualBox: https://github.com/atabegruslan/Others/blob/master/Virtual/terminal_into_virtual.md

--- 

## Setup Web Server (old fashioned way)

Follow this remote LAMP installation tutorial: https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-ubuntu-18-04

Just for comparison, this is how you install LAMP when you are at the computer: https://howtoubuntu.org/how-to-install-lamp-on-ubuntu

While doing this, make sure the virtual machine can access internet.

### Install Apache

```
# Install Apache
sudo su
apt update
apt install apache2
# Adjust the Firewall to Allow Web Traffic (http & https)
ufw app list
ufw app info "Apache Full"
ufw allow in "Apache Full"
```

To check that you installed Apache server correctly:

- You get the `/var/www/html/index.html` directory
- You can see http://127.0.0.1/

#### If with virtual machine / port-forwarding

On virtual box -> the virtual machine -> settings -> network -> NAT -> Port forwarding: match 127.0.0.1:8000 to {virtual_machine_ip}:80

Visit http://127.0.0.1:8000/

You can edit the default index page. by `vim /var/www/html/index.html`

### Install MySQL Server

```
# Install MySQL
sudo su
apt install mysql-server
```

To check that you installed MySQL server correctly:

- If you can enter mysql shell by running `sudo mysql`, then you installed MySQL server correctly.

#### Install MySQL Client - PhpMyAdmin

1. After you install MySQL Server, you have to enter the mysql shell as root, create a new user and give it a password.

Now you can log into mysql shell by running `mysql -u sammy -p`, and enter "password" when password is prompted.

```
sudo mysql
mysql> CREATE USER 'sammy'@'localhost' IDENTIFIED BY 'password';
mysql> GRANT ALL PRIVILEGES ON *.* TO 'sammy'@'localhost' WITH GRANT OPTION;
```

##### 'Cheap' way (Don't use this way when setting up actual server)

2. Download the `.zip` from https://www.phpmyadmin.net/downloads/  
3. Unzip the downloaded `.zip`, rename it to `phpmyadmin` and move it into `/var/www/html/`
4. This is sufficient for you to access http://127.0.0.1/phpmyadmin
5. You can then use the username and password of the newly created mysql user (step 1)
6. Visit http://localhost/phpmyadmin and login with "sammy / password"

##### Proper way

https://www.digitalocean.com/community/tutorials/how-to-install-and-secure-phpmyadmin-on-ubuntu-18-04

2. Run these commands:
```
sudo apt update
sudo apt install phpmyadmin
sudo systemctl restart apache2
```

3. Visit http://localhost/phpmyadmin and login with "sammy / password"

#### Uninstall MySQL Server

https://askubuntu.com/questions/172514/how-do-i-uninstall-mysql

```
sudo systemctl stop mysql
sudo apt-get purge mysql-server mysql-client mysql-common mysql-server-core-* mysql-client-core-*
sudo rm -rf /etc/mysql /var/lib/mysql
sudo apt autoremove
sudo apt autoclean
```

### Install PHP

https://thishosting.rocks/install-php-on-ubuntu/ 

`sudo apt install php-pear php-fpm php-dev php-zip php-curl php-xmlrpc php-gd php-mysql php-mbstring php-xml libapache2-mod-php`

#### Install specific PHP versions

- https://www.colinodell.com/blog/201911/how-to-install-php-74
- https://stackoverflow.com/questions/40815984/how-to-install-all-required-php-extensions-for-laravel/40816033#40816033

```
sudo apt install -y software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php7.4
sudo apt-get install php7.4-cli php7.4-fpm php7.4-bcmath php7.4-curl php7.4-gd php7.4-intl php7.4-json php7.4-mbstring php7.4-mysql php7.4-opcache php7.4-sqlite3 php7.4-xml php7.4-zip
```

#### Switch PHP versions

```
sudo update-alternatives --set php /usr/bin/php7.0 
sudo update-alternatives --set phar /usr/bin/phar7.0 
sudo update-alternatives --set phar.phar /usr/bin/phar.phar7.0 
sudo update-alternatives --set phpize /usr/bin/phpize7.0 
sudo update-alternatives --set php-config /usr/bin/php-config7.0 
sudo a2dismod php7.1 
sudo a2enmod php7.0 
sudo service apache2 restart 

sudo update-alternatives --set php /usr/bin/php7.1 
sudo update-alternatives --set phar /usr/bin/phar7.1 
sudo update-alternatives --set phar.phar /usr/bin/phar.phar7.1 
sudo update-alternatives --set phpize /usr/bin/phpize7.1 
sudo update-alternatives --set php-config /usr/bin/php-config7.1 
sudo a2dismod php7.0 
sudo a2enmod php7.1 
sudo service apache2 restart 
```

To check that you installed PHP correctly:

- If running `php -v` returns you the PHP version number, then you installed PHP correctly.
- You can also use `php -i | grep php.ini` to find out the correct `php.ini` (More details: https://askubuntu.com/questions/356968/find-the-correct-php-ini-file)
- Then you can create a PHP info page and visit http://127.0.0.1/info.php to see all the PHP info.
```
sudo su
cd /var/www/html
touch info.php
echo '<?php phpinfo(); ?>' >> info.php
```

Related tutorials:
- https://tecadmin.net/switch-between-multiple-php-version-on-ubuntu/# 
- https://askubuntu.com/questions/705880/how-to-install-php-7 
- https://www.vultr.com/docs/how-to-install-and-configure-php-70-or-php-71-on-ubuntu-16-04

#### Apache and PHP log files

By default `/var/log/apache2/error.log`

Can be configured in `/etc/php{version}/apache2/php.ini`

### Install other minor things

#### Git  

https://www.liquidweb.com/kb/install-git-ubuntu-16-04-lts/  

#### CURL  

`sudo apt install curl`

OR

```
sudo sed -i -e 's/us.archive.ubuntu.com/archive.ubuntu.com/g' /etc/apt/sources.list
sudo apt-get update
sudo apt-get install curl
sudo apt-get install php7.0
sudo apt-get install php7.0-curl
```

#### Node

https://linuxize.com/post/how-to-install-node-js-on-ubuntu-18.04/#install-node-js-from-thenodesource-repository

##### Uninstall Node

https://www.journaldev.com/27373/install-uninstall-nodejs-ubuntu

##### Change Node versions 

```
npm install -g npm@6.4.1 
sudo npm cache clean -f 
sudo npm install -g n 
sudo n 8.15.0 
```

or 

```
nvm install v14.0.0         # Install v14.0.0
nvm use v14.0.0             # Use v14.0.0
```

1. https://www.abeautifulsite.net/how-to-upgrade-or-downgrade-nodejs-using-npm 
2. https://stackoverflow.com/questions/7718313/how-to-change-to-an-older-version-of-node-js/23569481#23569481
3. https://docs.npmjs.com/resolving-eacces-permissions-errors-when-installing-packages-globally 

Node: Tutorial 2 above: Manually change npm's default directory. Later on you don't need to run node & npm under sudo  

Other tutorials on this:

- https://michael-kuehnel.de/node.js/2015/09/08/using-vm-to-switch-node-versions.html
- https://bytearcher.com/articles/ways-to-get-the-latest-node.js-version-on-a-mac/
- Windows, NVM: https://stackoverflow.com/questions/25654234/node-version-manager-nvm-on-windows/61060494#61060494
- Linux, NVM: https://learn2torials.com/a/how-to-install-nvm , https://tecadmin.net/how-to-install-nvm-on-ubuntu-20-04/

```
// Install NVM from https://github.com/coreybutler/nvm-windows/releases
nvm install <wanted-node-version>
nvm use <wanted-node-version>
```

#### Composer  

`sudo apt install composer`

#### Gulp 

https://tecadmin.net/install-gulp-js-on-ubuntu/

`sudo npm install -g gulp` 

#### Yarn

https://linuxize.com/post/how-to-install-yarn-on-ubuntu-18-04/

### Repository SSH Keys

https://docs.github.com/en/github/authenticating-to-github/connecting-to-github-with-ssh

---

### Other tutorials

- https://www.youtube.com/watch?v=hVNWkAK70UQ
- https://phoenixnap.com/kb/how-to-install-lamp-stack-on-ubuntu
- https://askubuntu.com/questions/997317/how-to-upgrade-the-php-version-in-lampp-in-ubuntu

---

## Setup Web Server via Docker

- https://medium0.com/@vi1996ash/steps-to-build-apache-web-server-docker-image-1a2f21504a8e
- https://www.youtube.com/watch?v=7GTYB8RVYBc <sup>Very Good</sup>
	- https://www.the-digital-life.com/webserver-linux
	- https://hub.docker.com/r/linuxserver/swag
	- https://docs.linuxserver.io/general/swag
- https://www.youtube.com/watch?v=_trJf3GbZXg
- https://www.tecmint.com/install-apache-web-server-in-a-docker-container/amp/
- https://www.geeksforgeeks.org/setup-web-server-over-docker-container-in-linux/amp/
- https://www.tutorialspoint.com/docker/building_web_server_docker_file.htm

1. Install Docker and Docker-Compose: https://github.com/Ruslan-Aliyev/Docker#install
2. Check with `docker --version` and `docker-compose --version`
3. Create and give permissions for the needed directories
4. Make `docker-compose.yaml`. Easiest to copy it over. Note: https://adminhacks.com/scp-not-port-22.html EG: `scp -P {remote-port} {local-path}/docker-compose.yaml {remote-username}@{remote-host-domain}:{remote-path}/docker-compose.yaml`
5. `docker-compose up`

---

## Directory permissions

- https://www.digitalocean.com/community/questions/proper-permissions-for-web-server-s-directory
- https://serverfault.com/questions/357108/what-permissions-should-my-website-files-folders-have-on-a-linux-webserver

---

## Start all from scratch

- https://www.youtube.com/watch?v=be4W-pSk8Ac
