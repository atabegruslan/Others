## Install Apache:

```
apt update
apt install apache2

# Firewall
ufw app list
ufw app info "Apache Full"
ufw allow in "Apache Full"
```

More about firewall: https://www.digitalocean.com/community/tutorials/how-to-set-up-a-firewall-with-ufw-on-ubuntu

## Install PHP:

```
apt update
apt install php
apt install php-pear php-fpm php-dev php-zip php-curl php-xmlrpc php-gd php-mysql php-mbstring php-xml libapache2-mod-php
```

## Install MySQL:
```
apt install mysql-server
mysql -u root
> CREATE USER 'wpadmin'@'localhost' IDENTIFIED BY '123456';
> GRANT ALL PRIVILEGES ON *.* TO 'wpadmin'@'localhost' WITH GRANT OPTION;

service apache2 restart
service mysql restart
```

## Install WP:

https://code.tutsplus.com/articles/download-and-install-wordpress-via-the-shell-over-ssh--wp-24403

```
wget http://wordpress.org/latest.tar.gz
# latest.tar.gz
tar xfz latest.tar.gz
# wordpress

rm /var/www/html/index.html
mv /wordpress/* /var/www/html/
```

## Setup:

Visit {domain}

```
mysql -u root
> CREATE DATABASE dbname;
```

## Update:

Change to a more secure password. `123456` is too unsafe.

```
mysql -u root
> UPDATE wp_users SET user_pass = MD5('gdEgdszrgra') WHERE ID=1;
```

So now the login is: `wpadmin` / `gdEgdszrgra`

---

## See also

https://code.tutsplus.com/download-and-install-wordpress-via-the-shell-over-ssh--wp-24403a
