## Setup LAMP and other essentials

https://github.com/atabegruslan/Others/blob/master/Server/setup_webserver.md#the-setup

### Other ways/tutorials for installing LAMP

- `sudo /opt/lampp/manager-linux-x64.run`
- https://www.taniarascia.com/how-to-install-apache-php-7-1-and-mysql-on-ubuntu-with-vagrant/
- https://www.howtoforge.com/tutorial/install-apache-with-php-and-mysql-on-ubuntu-16-04-lamp/#-install-phpmyadmin
- https://askubuntu.com/questions/387062/how-to-solve-the-phpmyadmin-not-found-issue-after-upgrading-php-and-apache

Then don't forget to append `Include /etc/phpmyadmin/apache.conf` to `/etc/apache2/apache2.conf`

### Start and stop `apache` and `mysql`

```
sudo service apache2 stop
sudo service mysql stop
sudo service apache2 start
sudo service mysql start
```

## For the easy of localhost development

1. User and web server run with the same permissions

https://askubuntu.com/questions/733193/give-web-sever-directory-fullpermission  

```
## sudo chown -R [USER NAME]:[USER NAME] /var/www  
sudo chown -R ruslan:ruslan /var/www/html  

sudo gedit /etc/apache2/envvars  
# Edit the following:
# ---
# export APACHE_RUN_USER=ruslan  
# export APACHE_RUN_GROUP=ruslan  
# ---
# Save and close

sudo service apache2 restart
```

## The other looser restrictions that we can afford to set on our localhost

### Increase the max size of the `.sql` import files, to avoid 

> MySQL database import fails: ERROR 1118 (42000): Row size too large              

Add to `/etc/mysql/my.cnf`:
```
[mysqld] 
max_allowed_packet = 2G 
innodb_log_file_size = 2G 
innodb_log_buffer_size = 2G 
internal_tmp_disk_storage_engine=MyISAM 
innodb_strict_mode = 0 
innodb_file_per_table=1 
innodb_file_format = Barracuda 
```

Or `cp etc/mysql/mysql.cnf /home/ruslan/mysql.cnf` and add the same lines above.

https://support.plesk.com/hc/en-us/articles/115000256794-MySQL-database-import-fails-ERROR-1118-42000-Row-size-too-large 

### Increase upload size

1. Use `php -i | grep php.ini` to find out the correct `php.ini`

- https://stackoverflow.com/questions/2184513/change-the-maximum-upload-file-size 
- https://askubuntu.com/questions/356968/find-the-correct-php-ini-file  

2. Edit `php.ini`:  `sudo gedit php.ini`
```
upload_max_filesize=2G
post_max_size=2G
```

3. `sudo service apache2 restart`

### Increase the length of the dump-able string, to `var_dump` the entire long string 

#### Method 1

On top of each PHP file, after the Namespace declaraction, outside the Class 
```php
ini_set("xdebug.var_display_max_children", -1); 
ini_set("xdebug.var_display_max_data", -1); 
ini_set("xdebug.var_display_max_depth", -1); 
```

#### Method 2

Add `xdebug.var_display_max_depth=-1` to `php.ini`

In detail:

```
; with sane limits
xdebug.var_display_max_depth = 10
xdebug.var_display_max_children = 256
xdebug.var_display_max_data = 1024 

; with no limits
; (maximum nesting is 1023)
xdebug.var_display_max_depth = -1 
xdebug.var_display_max_children = -1
xdebug.var_display_max_data = -1 
```

Of course, these may also be set at runtime via `ini_set()`.

Useful if you don't want to modify `php.ini` and restart your web server.

But need to quickly inspect something more deeply.

```
ini_set('xdebug.var_display_max_depth', '10');
ini_set('xdebug.var_display_max_children', '256');
ini_set('xdebug.var_display_max_data', '1024');
```

- xdebug: http://xdebug.org/docs/all_settings#var_display_max_children
- https://stackoverflow.com/questions/34342777/how-to-see-full-content-of-long-strings-with-var-dump-in-php
- https://stackoverflow.com/questions/9998490/how-to-get-xdebug-var-dump-to-show-full-object-array

### Turn off MySQL strict mode

#### Method 1:

Check current sql_modes by: `show variables like 'sql_mode';`

Remove the sql_mode `"NO_ZERO_IN_DATE,NO_ZERO_DATE`

https://stackoverflow.com/questions/36882149/error-1067-42000-invalid-default-value-for-created-at

#### Method 2:

`sudo gedit /etc/mysql/conf.d/disable_strict_mode.cnf`

Append these:
```
[mysqld]
sql_mode=IGNORE_SPACE,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION
```

Save and restart with: `sudo service mysql restart`

https://serverpilot.io/docs/how-to-disable-strict-mode-in-mysql-5-7/

**By disabling strict mode** problems like `ERROR 1067 Invalid default value for 'another_col'` and `ERROR 1118 (42000): Row size too large` can be avoided.

- https://support.plesk.com/hc/en-us/articles/115000256794-MySQL-database-import-fails-ERROR-1118-42000-Row-size-too-large
- https://dev.mysql.com/doc/mysql-reslimits-excerpt/5.6/en/column-count-limit.html
- Just for reference: https://stackoverflow.com/questions/40881773/how-to-turn-on-off-mysql-strict-mode-in-localhost-xampp

## Install other commonly used programs

### FileZilla 

https://www.atechtown.com/install-filezilla-on-ubuntu/

```
sudo add-apt-repository ppa:adabbas/1stppa 
sudo apt-get update  
sudo apt-get install filezilla
```

### MySQL WorkBench  

- https://www.linode.com/docs/databases/mysql/install-and-configure-mysql-workbench-on-ubuntu/ 
- https://www.linode.com/docs/guides/install-and-configure-mysql-workbench-on-ubuntu/#install-mysql-workbench

### Navicat

- https://www.navicat.com/en/navicat-monitor-installation-guide?ver=ubuntu

or

Download: https://downloadly.ir/software/programming/navicat-premium/

Run: `cd navicat121_premium_en_x64 && sh start_navicat`

Renew: `cd ~ && rm -rf .navicat64`

### DBeaver

- https://computingforgeeks.com/install-and-configure-dbeaver-on-ubuntu-debian/

### POEdit

- https://snapcraft.io/poedit

### Video Screen Recorder (#2 Simple Screen Recorder is good)

https://www.ubuntupit.com/15-best-linux-screen-recorder-and-how-to-install-those-on-ubuntu/ 

### VLC Player

https://www.linuxhelp.com/how-to-install-vlc-media-player-on-ubuntu-17-04  

### Screenshooter

`sudo apt-get install gnome-screenshot`

### Meld 

- https://www.linuxhelp.com/how-to-install-meld-tool-in-ubuntu 
- https://www.howtoforge.com/tutorial/beginners-guide-to-visual-merge-tool-meld-on-linux/

### Sublime Text

https://linuxize.com/post/how-to-install-sublime-text-3-on-ubuntu-18-04/

### Chrome  

https://linuxize.com/post/how-to-install-google-chrome-web-browser-on-ubuntu-18-04/

### JDK

https://stackoverflow.com/questions/14788345/how-to-install-the-jdk-on-ubuntu-linux

### Git

https://www.liquidweb.com/kb/install-git-ubuntu-16-04-lts/ 

#### Github 2FA

- https://help.github.com/articles/adding-a-new-ssh-key-to-your-github-account/ 
- https://help.github.com/articles/securing-your-account-with-two-factor-authentication-2fa/

#### Gitlab 2FA

- https://gitlab.{company}.dk/profile/keys 
- https://docs.gitlab.com/ee/user/profile/account/two_factor_authentication.html

#### Gitlab Personal Access Token

https://gitlab.{company}.dk/profile/personal_access_tokens
```
composer config http-basic.gitlab.{company}.dk <username> <personal access token>
composer install
```

### Slack

#### 2FA

https://get.slack.help/hc/en-us/articles/204509068-Set-up-two-factor-authentication

### PHPStorm

#### Install

Open 'Ubuntu Software' and install from there (old way)

![](/Illustrations/Development/install_phpstorm_old.PNG)

Or via terminal: https://www.linuxbabe.com/desktop-linux/install-phpstorm-ubuntu-15-10

#### License

![](/Illustrations/Development/phpstorm_license.PNG)

> A JetBrains PhpStorm license has been assigned to your JetBrains Account.   
> Please use your JetBrains Account credentials in the product to activate your license.   
> https://www.jetbrains.com/phpstorm/buy/#edition=commercial   

A license file will be received.  
When PHPStorm start for first time, register with code then drag this file in.

#### To short-circuit the trial limit

- Delete the `Home directory > .config > JetBrains > PphStormXXXX.X > eval` folder
- In file: `Home directory > .config > JetBrains > PphStormXXXX.X > options > other.xml` , remove `<property name="evl.blahblah"/>`
- Delete the `Home directory > .java > .userPrefs > jetbrains > phpstorm`

Example
```
rm -rf ~/.config/JetBrains/PhpStorm2020.2/eval
sudo sed -i -E 's/<property name=\"evl.*\".*\/>//' ~/.config/JetBrains/PhpStorm2020.2/options/other.xml
rm -rf ~/.java/.userPrefs/jetbrains/phpstorm
```

### Compress Zip

- https://www.cyberciti.biz/faq/how-to-zip-a-folder-in-ubuntu-linux/

### Virtual Hosts

1. `/etc/apache2/sites-available/000-default.conf` (XAMPP's is here: `xampp\apache\conf\extra\httpd-vhosts.conf`)
```
<VirtualHost 127.0.0.3:80>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html/website
    ServerName www.website.local
    ServerAlias website.local
</VirtualHost>
```

2. `/etc/hosts` (XAMPP's is here: `C:\Windows\System32\drivers\etc\hosts`)
```
127.0.0.3    website.local
```

3. `sudo service apache2 restart`

- https://viblo.asia/p/cau-hinh-virtual-host-myprojectdev-thay-vi-localhostmyproject-4dbZN0jq5YM 
- https://weblizar.com/blog/how-setup-virtual-host-for-laravel-xampp-wamp/

### Linux's 'Env Vars' 

- `.bash_profile` and `.profile` - Once
- `.bashrc` - Everytime

https://unix.stackexchange.com/questions/129143/what-is-the-purpose-of-bashrc-and-how-does-it-work

#### Example - Commonly used functions:

`sudo gedit ~/.profile`

```
refresh-phpstorm-lisense() {
  rm -rf ~/.config/JetBrains/PhpStorm2020.2/eval
  sudo sed -i -E 's/<property name=\"evl.*\".*\/>//' ~/.config/JetBrains/PhpStorm2020.2/options/other.xml
  rm -rf ~/.java/.userPrefs/jetbrains/phpstorm
}

add-permission() {
  sudo chmod 777 -R $1
}

alias edit-hosts="sudo gedit /etc/hosts";
```

`source ~/.profile`

#### Example - PATH:

You would want to add eg: `export PATH="$PATH:/some/addition"` into `.bash_profile` instead of `.bashrc`.

https://hackprogramming.com/2-ways-to-permanently-set-path-variable-in-ubuntu/

```
export PATH=$PATH:/some/addition/bin
source ~/.profile
```

### Ubuntu's 'control panel' 

`sudo apt install gnome-control-center`

### Install non-linux-native software eg MS Edge

**Use WINE or PlayOnLinux**, then install MS Edge on it.

Wine is a free and open-source compatibility layer that aims to allow application software and computer games developed for Microsoft Windows to run on Unix-like operating systems. Wine also provides a software library, known as "Winelib", against which developers can compile Windows applications to help port them to Unix-like systems.

Wine provides its compatibility layer for Windows runtime system (also called runtime environment) which translates Windows system calls into POSIX-compliant system calls, recreating the directory structure of Windows, and providing alternative implementations of Windows system libraries, system services through `wineserver` and various other components (such as Internet Explorer, the Windows Registry Editor, and msiexec). Wine is predominantly written using black-box testing reverse-engineering, to avoid copyright issues.

https://en.wikipedia.org/wiki/Wine_(software)

PlayOnLinux is a graphical frontend for the Wine software compatibility layer which allows Linux users to install Windows-based video games, Microsoft Office (2000 to 2010), Microsoft Internet Explorer, as well as many other applications such as Apple iTunes and Safari.

While initially developed for Linux-based systems, it is also used on macOS and FreeBSD under the names PlayOnMac and PlayOnBSD, respectively. It can also be used on other operating systems supported by Wine.

https://en.wikipedia.org/wiki/PlayOnLinux

## Install, uninstall and manage versions of very common tools

### Ubuntu

#### Version

https://linuxize.com/post/how-to-check-your-ubuntu-version/

### PHP

- https://www.dev2qa.com/how-to-check-php-version-and-php-install-path-on-linux-and-windows/

#### Version

- LAMP: https://github.com/atabegruslan/Others/blob/master/Server/setup_webserver.md#switch-php-versions
- XAMPP: https://webhostingmedia.net/update-xampp-php-version-windows/

### Composer

#### Install 

https://github.com/atabegruslan/Others/blob/master/Server/setup_webserver.md#composer

#### Uninstall 

During the installation you got a message Composer successfully installed to: ... this indicates where Composer was installed. 

But you might also search for the file `composer.phar` on your system.

Then simply:

Delete the file `composer.phar`

Delete the Cache Folder:
- Linux: /home/<user>/.composer
- Windows: C:\Users\<username>\AppData\Roaming\Composer

https://stackoverflow.com/questions/30396451/remove-composer

#### Version

https://stackoverflow.com/questions/64597051/how-to-downgrade-or-install-a-specific-version-of-composer

### Node

#### Install 

https://github.com/atabegruslan/Others/blob/master/Server/setup_webserver.md#node

#### Uninstall 

https://github.com/atabegruslan/Others/blob/master/Server/setup_webserver.md#uninstall-node

#### Version

https://github.com/atabegruslan/Others/blob/master/Server/setup_webserver.md#change-node-versions

### Docker

#### Install

https://github.com/Ruslan-Aliyev/Docker#install
    
#### Uninstall

Mac: https://nektony.com/how-to/uninstall-docker-on-mac

### Android Studio

#### Uninstall 

https://github.com/atabegruslan/Others/blob/master/Illustrations/Mobile/complete_uninstall.pdf

### Python

#### Uninstall 

- https://www.delftstack.com/howto/python/python-uninstall-from-windows/

### WP

#### Install

https://code.tutsplus.com/articles/download-and-install-wordpress-via-the-shell-over-ssh--wp-24403

#### Version

- https://codex.wordpress.org/WordPress_Versions
- Check version: 
    - https://wpbuffs.com/wordpress-php-version-check/
    - https://www.hostinger.com/tutorials/how-to-check-which-version-of-wordpress-you-are-using
    - Admin, Tools > Site Health
- Upgrade: https://wordpress.org/support/wordpress-version/version-5-7/#installation-update-information
    - https://wordpress.org/support/article/updating-wordpress/#manual-update
- Downgrade: `{domain}/wp-admin/options-general.php?page=wpdowngrade`

### Laravel

#### Version

http://www.elcoderino.com/check-laravel-version/

## Notes

### See hidden files 

Ubuntu: Control + H 
Mac: Command + Shift + .

#### Apache and PHP log files

- https://github.com/atabegruslan/Others/blob/master/Server/setup_webserver.md#apache-and-php-log-files
- https://github.com/Ruslan-Aliyev/Log#php-logs

### Composer Memory Limit

Set in `php.ini`
```
php -i | grep php.ini # Find correct php.ini
gedit /…/bin/php/php7.4.12/conf/php.ini # Or in Mac: open -e /…/bin/php/php7.4.12/conf/php.ini
```
Set: `memory_limit = -1`
    
Or in terminal everytime: `php -d memory_limit=-1 /usr/local/bin/composer ...` 

### XAMPP on Linux

- Good tutorial: https://www.ubuntubuzz.com/2017/06/how-to-install-xampp-on-ubuntu-64-bit.html
- https://www.click4infos.com/install-xampp-on-linux/
- https://askubuntu.com/questions/890818/ubuntu-16-04-how-to-start-xampp-control-panel
    
### Get your public ssh key

`cat ~/.ssh/id_rsa.pub`
