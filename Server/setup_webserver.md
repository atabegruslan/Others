# Setup Web Server

## Preliminary

If you don't have a real server, you can use VirtualBox: https://github.com/atabegruslan/Others/blob/master/Virtual/terminal_into_virtual.md

## The setup

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

### PhpMyAdmin

### Switch PHP versions

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
