## Setup LAMP and other essentials

https://github.com/atabegruslan/Others/blob/master/Server/setup_webserver.md#the-setup

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

https://stackoverflow.com/questions/2184513/change-the-maximum-upload-file-size https://askubuntu.com/questions/356968/find-the-correct-php-ini-file  

2. Edit `php.ini`:  `sudo gedit php.ini`
```
upload_max_filesize=2G
post_max_size=2G
```

3. `sudo service apache2 restart`

### Increase the length of the dump-able string, to `var_dump` the entire long string 

Add `xdebug.var_display_max_depth=-1` to `php.ini`

https://stackoverflow.com/questions/34342777/how-to-see-full-content-of-long-strings-with-var-dump-in-php

Making the above edits to `php.ini` have the same results as

On top of each PHP file, after the Namespace declaraction, outside the Class 
```php
ini_set("xdebug.var_display_max_children", -1); 
ini_set("xdebug.var_display_max_data", -1); 
ini_set("xdebug.var_display_max_depth", -1); 
```

## Install other commonly used programs

### FileZilla 

https://www.atechtown.com/install-filezilla-on-ubuntu/

```
sudo add-apt-repository ppa:adabbas/1stppa 
sudo apt-get update  
sudo apt-get install filezilla
```

### MySQL WorkBench  

https://www.linode.com/docs/databases/mysql/install-and-configure-mysql-workbench-on-ubuntu/ 

### Video Screen Recorder (#2 Simple Screen Recorder is good)

https://www.ubuntupit.com/15-best-linux-screen-recorder-and-how-to-install-those-on-ubuntu/ 

### VLC Player

https://www.linuxhelp.com/how-to-install-vlc-media-player-on-ubuntu-17-04  

### Screenshooter

`sudo apt-get install gnome-screenshot`

### Meld 

https://www.linuxhelp.com/how-to-install-meld-tool-in-ubuntu 

### Sublime Text

https://linuxize.com/post/how-to-install-sublime-text-3-on-ubuntu-18-04/

### Chrome  

https://linuxize.com/post/how-to-install-google-chrome-web-browser-on-ubuntu-18-04/

### PHPStorm

- Open 'Ubuntu Software' and install from there.
- Or via terminal: https://www.linuxbabe.com/desktop-linux/install-phpstorm-ubuntu-15-10

To short-circuit the trial limit:

- Delete the Home directory > .config > JetBrains > PphStormXXXX.X > eval folder
- In file: Home directory > .config > JetBrains > PphStormXXXX.X > options > other.xml , remove `<property name="evl.blahblah"/>`
- Delete the Home directory > .java > .userPrefs > jetbrains > phpstorm

### Linux's 'Env Vars' 

- `.bash_profile` and `.profile` - Once
- `.bashrc` - Everytime

https://unix.stackexchange.com/questions/129143/what-is-the-purpose-of-bashrc-and-how-does-it-work

Example - Commonly used functions:

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

Example - PATH:

You would want to add eg: `export PATH="$PATH:/some/addition"` into `.bash_profile` instead of `.bashrc`.

https://hackprogramming.com/2-ways-to-permanently-set-path-variable-in-ubuntu/

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

## Notes

### See hidden files 

Control + H 
