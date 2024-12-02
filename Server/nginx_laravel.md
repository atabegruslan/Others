# Nginx hosting Laravel with HTTPS

## Check OS Version

`cat /etc/os-release`

```
# Ubuntu 22.04.4 LTS
```

## Check firewall

`sudo ufw status`

Inactive is ok for development


## Install `nginx`

```
sudo apt update
sudo apt install nginx
sudo systemctl status nginx
sudo systemctl restart nginx
```

https://certbot.eff.org/instructions?ws=nginx&os=ubuntufocal

## check `snapd` is installed

`snap list`

## Get SSH via LetsEncrypt

```
sudo snap install --classic certbot
sudo ln -s /snap/bin/certbot /usr/bin/certbot
sudo certbot --nginx -d some.domain.com -n -m user.name@company.com --agree-tos
```

You'll see:  
```
Successfully received certificate.
Certificate is saved at: /etc/letsencrypt/live/some.domain.com/fullchain.pem
Key is saved at:         /etc/letsencrypt/live/some.domain.com/privkey.pem
This certificate expires on 2024-10-29.
```

### Let server's config file know about SSH

`cat /etc/nginx/sites-enabled/default`

```
server {
	listen 80 default_server;
	listen [::]:80 default_server;

	root /var/www/html;

	# Add index.php to the list if you are using PHP
	index index.html index.htm index.nginx-debian.html;

	server_name _;

	location / {
		# First attempt to serve request as file, then as directory, then fall back to displaying a 404.
		try_files $uri $uri/ =404;
	}
}

server {
    listen [::]:443 ssl ipv6only=on; # managed by Certbot
    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/some.domain.com/fullchain.pem; # managed by Certbot		# <----- HERE
    ssl_certificate_key /etc/letsencrypt/live/some.domain.com/privkey.pem; # managed by Certbot		# <----- HERE
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot

	root /var/www/html;

	# Add index.php to the list if you are using PHP
	index index.html index.htm index.nginx-debian.html;
    server_name some.domain.com; # managed by Certbot

	location / {
		# First attempt to serve request as file, then as directory, then fall back to displaying a 404.
		try_files $uri $uri/ =404;
	}
}
```

Now if you visit `https://localhost`, you'll see: `/var/www/html/index.nginx-debian.html`

## Install PHP

```
sudo apt install software-properties-common
sudo add-apt-repository ppa:ondrej/php
apt install php8.2 php8.2-fpm php8.2-pgsql php8.2-dev php8.2-zip php8.2-curl php8.2-xmlrpc php8.2-gd php8.2-mbstring php8.2-xml php8.2-intl
```

https://www.theserverside.com/blog/Coffee-Talk-Java-News-Stories-and-Opinions/Nginx-PHP-FPM-config-example

Just that in this case, its done in `/etc/nginx/sites-enabled/default`

```
server {
    listen [::]:443 ssl ipv6only=on; # managed by Certbot
    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/some.domain.com/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/some.domain.com/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot

	root /var/www/html;

	# Add index.php to the list if you are using PHP
	index index.php index.html index.htm index.nginx-debian.html;
    server_name some.domain.com; # managed by Certbot

	location / {
		# First attempt to serve request as file, then as directory, then fall back to displaying a 404.
		try_files $uri $uri/ =404;
	}

	# ------------------ AFTER HERE ------------------

	# pass PHP scripts to FastCGI server
	location ~ \.php$ {
		include snippets/fastcgi-php.conf;

		# With php-fpm (or other unix sockets):
		fastcgi_pass unix:/run/php/php8.2-fpm.sock;
		# With php-cgi (or other tcp sockets):
		# fastcgi_pass 127.0.0.1:9000;
	}

	# deny access to .htaccess files, if Apache's document root concurs with nginx's one
	location ~ /\.ht {
		deny all;
	}
}
```

The run:   

```
sudo nginx -t
systemctl restart nginx
```

## Test PostgreSQL

```
<?php
    $connection = pg_connect("host=oscar-db.postgres.database.azure.com dbname=postgres user=oscar password=MB_j1SJiFgb");
    if($connection) {
       echo 'connected';
    } else {
        echo 'there has been an error connecting';
    } 
?>
```

## Laravel

https://www.digitalocean.com/community/tutorials/how-to-deploy-a-laravel-application-with-nginx-on-ubuntu-16-04

## DNS

https://www.youtube.com/watch?v=L8LEUkhWmqY
