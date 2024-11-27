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

---

/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"
    echo >> /Users/rus/.zprofile
    echo 'eval "$(/opt/homebrew/bin/brew shellenv)"' >> /Users/rus/.zprofile
    eval "$(/opt/homebrew/bin/brew shellenv)"

brew update
brew install git

ssh-keygen -t rsa -b 4096 -C "ruslanaliyev1849@gmail.com"
eval "$(ssh-agent -s)"
pbcopy < /Users/rus/.ssh/id_rsa.pub



brew install node@20

node@20 is keg-only, which means it was not symlinked into /opt/homebrew,
because this is an alternate version of another formula.

If you need to have node@20 first in your PATH, run:
  echo 'export PATH="/opt/homebrew/opt/node@20/bin:$PATH"' >> ~/.zshrc

For compilers to find node@20 you may need to set:
  export LDFLAGS="-L/opt/homebrew/opt/node@20/lib"
  export CPPFLAGS="-I/opt/homebrew/opt/node@20/include"

Then open new terminal 
node -v
npm -v



https://stackoverflow.com/questions/69875335/macos-how-to-install-java-17
brew install openjdk@17 

For the system Java wrappers to find this JDK, symlink it with
  sudo ln -sfn /opt/homebrew/opt/openjdk@17/libexec/openjdk.jdk /Library/Java/JavaVirtualMachines/openjdk-17.jdk

openjdk@17 is keg-only, which means it was not symlinked into /opt/homebrew,
because this is an alternate version of another formula.

If you need to have openjdk@17 first in your PATH, run:
  echo 'export PATH="/opt/homebrew/opt/openjdk@17/bin:$PATH"' >> ~/.zshrc

For compilers to find openjdk@17 you may need to set:
  export CPPFLAGS="-I/opt/homebrew/opt/openjdk@17/include"


java -version
openjdk version "17.0.13" 2024-10-15
OpenJDK Runtime Environment Homebrew (build 17.0.13+0)
OpenJDK 64-Bit Server VM Homebrew (build 17.0.13+0, mixed mode, sharing)



npm install --global yarn

# if yarn is installed, but not linked
brew link yarn









rus@Russ-Air quizlingo % yarn android
yarn run v1.22.22
$ expo run:android --variant debug
› Building app...
Downloading https://services.gradle.org/distributions/gradle-8.8-all.zip



https://docs.expo.dev/eas-update/getting-started/ 
npm install --global eas-cli



https://developer.apple.com/download/all/

