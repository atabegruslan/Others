# Need to install it on Window's Linux Subsystem

https://developer.redis.com/create/windows/

## Run PowerShell as Admin

`Enable-WindowsOptionalFeature -Online -FeatureName Microsoft-Windows-Subsystem-Linux`

Open Windows Store: `start ms-windows-store:`

## Install Ubuntu

![](https://raw.githubusercontent.com/atabegruslan/Others/master/Illustrations/Storage/Windows_store_install_Ubuntu.png)

## In Ubuntu console:

First you will be prompted to set a username and password. I just used `ubuntu` and `ubuntu`

```
sudo apt-add-repository ppa:redislabs/redis
sudo apt-get update
sudo apt-get upgrade
sudo apt-get install redis-server
sudo service redis-server restart
redis-cli
```

```
127.0.0.1:6379> ping
PONG
```

`Control + C` to exit Redis CLI

`sudo service redis-server stop`

# From Windows host machine

```
npm install -g redis-cli
rdcli -h UBUNTU.IP.ADDRESS
```

- https://stackoverflow.com/questions/40678865/how-to-connect-to-remote-redis-server/40678950#40678950
- https://redis.com/blog/get-redis-cli-without-installing-redis-server/

## To find out the guest Ubuntu's IP address

From Ubuntu console

```
sudo apt install net-tools
ifconfig
```

From PowerShell

`wsl hostname -I`

# Connecting to Ubuntu's Redis server from Windows host

https://www.baeldung.com/linux/redis-server-remote-connect

If you run `rdcli -h UBUNTU.IP.ADDRESS` and get:

```
rdcli : File C:\Users\ADMIN\AppData\Roaming\npm\rdcli.ps1 cannot be loaded. The file
C:\Users\ADMIN\AppData\Roaming\npm\rdcli.ps1 is not digitally signed. You cannot run this script on the current
system. For more information about running scripts and setting execution policy, see about_Execution_Policies at
https:/go.microsoft.com/fwlink/?LinkID=135170.
```


