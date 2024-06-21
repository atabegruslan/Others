# PATH

https://stackoverflow.com/questions/415403/whats-the-difference-between-bashrc-bash-profile-and-environment

https://superuser.com/questions/1403007/zsh-npm-node-nvm-command-not-found-after-installing-ohmyzsh

In my current Mac, I have the below in my ~/.zshrc 

export MAMP_PHP=/Applications/MAMP/bin/php/php8.2.0/bin
export PATH="$MAMP_PHP:$PATH"

export NVM_DIR=~/.nvm
 [ -s "$NVM_DIR/nvm.sh" ] && . "$NVM_DIR/nvm.sh"
