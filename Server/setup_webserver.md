# Setup Web Server

If you don't have a real server, you can use VirtualBox: https://github.com/atabegruslan/Others/blob/master/Virtual/terminal_into_virtual.md

https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-ubuntu-18-04

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
