# Install uninstall and change versions

## Git  

https://www.liquidweb.com/kb/install-git-ubuntu-16-04-lts

### Repository SSH Keys

https://docs.github.com/en/github/authenticating-to-github/connecting-to-github-with-ssh

## CURL  

`sudo apt install curl`

OR

```
sudo sed -i -e 's/us.archive.ubuntu.com/archive.ubuntu.com/g' /etc/apt/sources.list
sudo apt-get update
sudo apt-get install curl
sudo apt-get install php7.0
sudo apt-get install php7.0-curl
```

## Node

https://linuxize.com/post/how-to-install-node-js-on-ubuntu-18.04/#install-node-js-from-thenodesource-repository

### Uninstall Node

https://www.journaldev.com/27373/install-uninstall-nodejs-ubuntu

### Change Node versions 

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
- https://bytearcher.com/articles/ways-to-get-the-latest-node.js-version-on-a-mac
- Windows, NVM: https://stackoverflow.com/questions/25654234/node-version-manager-nvm-on-windows/61060494#61060494
- Linux, NVM: 
	- https://learn2torials.com/a/how-to-install-nvm
	- https://tecadmin.net/how-to-install-nvm-on-ubuntu-20-04

```
// Install NVM from https://github.com/coreybutler/nvm-windows/releases
nvm install <wanted-node-version>
nvm use <wanted-node-version>
```

## Composer  

`sudo apt install composer`

## Java

JDK includes the JRE, so you do not have to download both separately.

https://docs.oracle.com/javase/10/install/overview-jdk-10-and-jre-10-installation.htm  

## Gulp 

https://tecadmin.net/install-gulp-js-on-ubuntu

`sudo npm install -g gulp` 

## Yarn

https://linuxize.com/post/how-to-install-yarn-on-ubuntu-18-04
