# Setup Node server from scratch to production

- Key tutorial https://www.youtube.com/playlist?list=PLdHg5T0SNpN38gy5xZ0PVEaDdZXlPkgP9 (Very Good)
	- https://github.com/Ruslan-Aliyev/server-setup

## Setup Server

Get Server

Digital Ocean Droplet is used

Centos is used

Generate and add your local SSH public key into server's `authorized_keys` file

To clear up any confusion between `authorized_keys` and `known hosts`, imagine this setup:

Your localhost -> your server -> Github

You add your localhost's SSH key into your server's `authorized_keys`, so that it will allows you to SSH in.     
When you give your server's SSH key to Github, in order to pull from Github via SSH, then an entry got Github will be added into your server's `known hosts`. https://stackoverflow.com/questions/33243393/what-is-actually-in-known-hosts     

Difference between SSH vs Deploy keys: https://stackoverflow.com/questions/39659302/difference-between-account-ssh-key-vs-deployment-ssh-key/39659393#39659393

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

## DNS

In this tutorial, **GoDaddy** is used.    
Need to A and CNAME records.   

## What are proxies

- https://www.youtube.com/watch?v=4NB0NDtOwIQ
- https://www.pomerium.com/blog/proxy-vs-reverse-proxy/
- https://www.youtube.com/watch?v=ozhe__GdWC8

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

## Load balancing methods

- https://docs.nginx.com/nginx/admin-guide/load-balancer/http-load-balancer/#choosing-a-load-balancing-method
- https://youtu.be/dBmxNsS3BGE?si=ASSdIDtdsj2yf9sw

![](/Illustrations/Server/load_balancing_methods.png)

## Load balancer uses

![](/Illustrations/Server/load_balancer_uses.png)

## Load balancer choices

- https://www.g2.com/categories/load-balancing
- https://www.nomios.com/news-blog/best-load-balancers-2024
- https://www.softwaretestinghelp.com/sofware-load-balancers
- https://logz.io/blog/best-open-source-load-balancers

![](/Illustrations/Server/load_balancer_choices.png)

## SSL certificate

**Certbot** is used in this tutorial

## Update server whenever Github updates

In this tutorial, this Webhook Server is used: https://github.com/adnanh/webhook

Github gets a new commit -> Github's Webhook calls server's Webhook Server -> Webhook Server's `hooks.json` -> `redeploy.sh` pulls in the new code from Github.

![](/Illustrations/Server/github_setup_webhook.png)

![](/Illustrations/Server/webhook_server.png)

![](/Illustrations/Server/webhook_files.png)

## Firewall

`firewalld` is used in this tutorial

## Fail2Ban 

If someone fails to eg login often enough, then he'll be banned for a set amount of time.

## Deployment strategies

- https://youtu.be/AWVTKBUnoIg?si=rTv922OtNL8GCWqw

![](/Illustrations/Server/deployment_strategies.png)

## API Gateways

- https://www.youtube.com/watch?v=6ULyxuHKxg8

![](/Illustrations/Server/api_gateway.png)

Uses:
- Authentication / authorization
- SSL cert rotation (obtaining new cert every N days) / SSL termination
- DDoS protection
- Throttling
- Routing
- Security policy enforcement
- Static content
- Something like auto-sending you discounts, sales and offers
- Cache
- Load Balancing
- Circuit breaking
- A/B Testing
- Protocol tranlation
- Service discovery
- Admin dashboard
- Monitoring, logging, analytics, billing
