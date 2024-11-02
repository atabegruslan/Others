# PATH

- https://stackoverflow.com/questions/415403/whats-the-difference-between-bashrc-bash-profile-and-environment
- https://superuser.com/questions/1403007/zsh-npm-node-nvm-command-not-found-after-installing-ohmyzsh

In my current Mac, I have the below in my `~/.zshrc` 

```
export MAMP_PHP=/Applications/MAMP/bin/php/php8.2.0/bin
export PATH="$MAMP_PHP:$PATH"

export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh" # This loads nvm
```

Above can also be put into `~/.profile`

See also Linux's: https://github.com/atabegruslan/Others/blob/master/Development/setup_developer_ubuntu_computer.md#linuxs-env-vars

# Startup

Open System Preferences.  
Go to Users & Groups.  
Choose your nickname on the left.  
Choose Login items tab.  
Check startup programs you want to remove.  
Press the “–” sign below.  
