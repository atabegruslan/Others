# Setup Node server from scratch to production

- Key tutorial https://www.youtube.com/playlist?list=PLdHg5T0SNpN38gy5xZ0PVEaDdZXlPkgP9 (Very Good)
	- https://github.com/Ruslan-Aliyev/server-setup

## Setup Server

Get Server

Digital Ocean Droplet is used

Centos is used

Generate and ddd your local SSH public key into server's `authorized_keys` file

Relevant: https://stackoverflow.com/questions/33243393/what-is-actually-in-known-hosts

`dnf` is Centos's package manager
```
dnf update
dnf instal curl vim git wget '@Development tools' nmap net-tools epel-release
epel-release is extra packages for enterprise linux
```

Install `snapcraft` (another package manager) easier to install Node and Certbot with this

`dnf install snapd`

![](/Illustrations/Server/snapcraft.png)

```
dnf install dnf-automatic # this installs OS updates
systemctl enable --now dnf-automatic.timer # enables auto OS updates
```

## Users

### SSH in

`ssh root@{ip-address}`

### Create new user

```
adduser {username} # Create new user
usermod -aG wheel {username} # Add that user to group 'wheel'
```

### Some theory

By default, centos have a user called `centos`, and a `root` user.    
By default, centos have a sudo-access group called `wheel`

Look into `/etc/sudoers`:

![](/Illustrations/Server/sudoers.png)

Look into `/etc/sudoers/90-cloud-init-users`: Already exists a user 'centos', represented in this file, in which 'centos' is specified.


What is `visudo`: https://www.unixtutorial.org/commands/visudo

> `visudo`: safely updating the `/etc/sudoers` file

### Give new user sudo permissions

Create a new file, for the new user: `visudo /etc/sudoers/{username}`.    

Then give it sudo priviledge and password-less SSH entry. Recall:

![](/Illustrations/Server/sudoers.png)

`visudo -cf /etc/sudoers # to verify the file you just created`

### Setup SSH for new user

Create directory and file: `/home/{username}/.ssh/authorized_keys`

`.ssh` folder should have permissions `700`

`authorized_keys` file should have permissions `600`

Append your local SSH public key into server's {username}'s `authorized_keys` file

### Delete old default user 'centos'

`userdel -r centos`

### Remove password-less SSH entry from `root`

`vim sshd_config`

Set `PasswordAuthentication` from `yes` to `no`     
Set `PermitRootLogin` from `yes` to `no`

## Change terminal

Up to now, the terminal you are using is `zsh`, `fishshell` is better.

`sudo dnf install fish`

## Install Node.js

`sudo snap install node --classic --channel=14`

## PM2 Example

https://gist.github.com/atabegruslan/10c8a71a184adc0091e153b5cd7446bd

## Reverse Proxy

Tutorial's Nginx reverse-proxy setup

![](/Illustrations/Server/nginx_reverse_proxy_1.png)

Another example of a simple Nginx reverse-proxy setup

https://phoenixnap.com/kb/nginx-reverse-proxy

![](/Illustrations/Server/nginx_reverse_proxy_2.png)

## Load Balancing

https://docs.nginx.com/nginx/admin-guide/load-balancer/http-load-balancer

![](/Illustrations/Server/nginx_load_balancer.png)

## For reference - Reverse proxy & Load balancing in HAProxy

- https://webhostinggeeks.com/howto/how-to-configure-and-use-haproxy-as-a-reverse-proxy
- https://www.haproxy.com/blog/layer-4-and-layer-7-proxy-mode
- https://www.youtube.com/watch?v=aKMLgFVxZYk&list=PLpXfHEl2fzl6A8U5X0amZiYewxNQ01ERK&index=2
