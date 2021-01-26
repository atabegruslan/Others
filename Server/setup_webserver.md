# Setup Web Server

## Preliminary

If you don't have a real server, you can use VirtualBox: https://github.com/atabegruslan/Others/blob/master/Virtual/terminal_into_virtual.md

## The setup

Follow this remote LAMP installation tutorial: https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-ubuntu-18-04

Just for comparison, this is how you install LAMP when you are at the computer: https://howtoubuntu.org/how-to-install-lamp-on-ubuntu

Note: to install specific versions of PHP (now 7.4) - do something like this: 
- https://www.colinodell.com/blog/201911/how-to-install-php-74
- https://stackoverflow.com/questions/40815984/how-to-install-all-required-php-extensions-for-laravel/40816033#40816033

Doing this, make sure the virtual machine can access internet

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

On virtual box -> the virtual machine -> settings -> network -> NAT -> Port forwarding: match 127.0.0.1:8000 to {virtual_machine_ip}:80

Visit http://127.0.0.1:8000/

You will see the default index page. You can edit this by `vim /var/www/html/index.html`

### PhpMyAdmin

https://www.phpmyadmin.net/downloads/  

Unzipping the download and moving it to `/var/www/html/phpmyadmin` is sufficient for you to see http://127.0.0.1:8000/phpmyadmin

https://www.digitalocean.com/community/tutorials/how-to-install-and-secure-phpmyadmin-on-ubuntu-18-04#step-2-%E2%80%94-adjusting-user-authentication-and-privileges

### Switch PHP versions

https://thishosting.rocks/install-php-on-ubuntu/ 

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

## Other tutorials

- https://www.youtube.com/watch?v=hVNWkAK70UQ
- https://phoenixnap.com/kb/how-to-install-lamp-stack-on-ubuntu
- https://askubuntu.com/questions/997317/how-to-upgrade-the-php-version-in-lampp-in-ubuntu

---

# Setup Web Server via Docker

- https://www.youtube.com/watch?v=7GTYB8RVYBc <sup>Very Good</sup>
	- https://www.the-digital-life.com/webserver-linux
- https://www.youtube.com/watch?v=_trJf3GbZXg
- https://www.tecmint.com/install-apache-web-server-in-a-docker-container/amp/
- https://www.geeksforgeeks.org/setup-web-server-over-docker-container-in-linux/amp/
- https://www.tutorialspoint.com/docker/building_web_server_docker_file.htm

![](https://raw.githubusercontent.com/atabegruslan/Others/master/Illustrations/WebServer%20Docker%20setup.jpg)

## With Kubernetes

- https://www.youtube.com/watch?v=7bA0gTroJjw

---

# Directory permissions

- https://www.digitalocean.com/community/questions/proper-permissions-for-web-server-s-directory
- https://serverfault.com/questions/357108/what-permissions-should-my-website-files-folders-have-on-a-linux-webserver
