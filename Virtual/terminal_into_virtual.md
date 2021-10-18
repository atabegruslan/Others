# SSH into locally-hosted virtual machine

## Setup virtual machine

Download Virtual Box: https://www.virtualbox.org/wiki/Downloads

Download and Install Ubuntu OS Image: https://ubuntu.com/download/desktop

![](/Illustrations/Virtual/setup_virtual_ubuntu.PNG)

Make sure u can use internet on virtual machine first (Chose a network setting that allows internet)

Install these essential functionalities:

```
sudo apt-get update
sudo apt-get install net-tools
sudo apt-get install openssh-server
```

## Setup virtual machine's network

### Option 1 - Bridge adapter

Make virtual machine on the same private network as your physical host machine:

- https://www.youtube.com/watch?v=5BsShkcweIs
- https://www.techrepublic.com/blog/diy-it-guy/using-virtualbox-vms-on-your-networks-subnet/

What is bridge adapter:
![](/Illustrations/Virtual/whats_bridge_adapter.PNG)

How to use bridge adapter:
![](/Illustrations/Virtual/use_bridge_adapter.PNG)

### Option 2 - NAT & port forwarding (better)

- https://www.youtube.com/watch?v=ErzhbUusgdI
- https://phoenixnap.com/kb/how-to-enable-ssh-on-ubuntu

![](/Illustrations/Virtual/virtual_network.PNG)

![](/Illustrations/Virtual/virtual_network_port_forward.PNG)

You will need `net-tools`'s `ifconfig` to find out the virtual machine's IP address.

On virtual machine, check and start the SSH service:
```
sudo service ssh status
sudo service ssh start
```

On host machine's terminal: `ssh ruslan@127.0.0.1 -p2222`
Use the `123456` password when prompted.

## Setup SSH login

Physical machine's terminal: `cat ~/.ssh/id_rsa.pub`

In the terminal SSH'ed to the virtual machine: 
```
echo "ssh-rsa…" >> /home/{user}/.ssh/authorized_keys

exit
ssh ruslan@127.0.0.1 -p2222 # Now you don't need password
```

## Setup more users

In the terminal SSH'ed to the virtual machine: 
```
sudo su

useradd pwuser -m -c "login with password" -G sudo -s /bin/bash
# Useful options of useradd are -c comment, -m to create his home directory and -s /bin/bash to define his shell.

passwd pwuser
# Enter password when prompted (eg: abcdef)

exit

ssh pwuser@127.0.0.1 -p2222
# Use the above set password: abcdef
```

## Common issues and answers:

- http://manpages.ubuntu.com/manpages/trusty/man8/adduser.8.html

- https://linoxide.com/linux-how-to/solution-linux-useradd-error-cannot-lock-etcpasswd-try-again-later/
	- https://superuser.com/questions/296373/cannot-lock-etc-passwd-try-again-later

- https://askubuntu.com/questions/982395/where-to-find-password-for-users-created-in-ubuntu-16-04
- https://websiteforstudents.com/how-to-list-all-user-accounts-on-ubuntu-16-04-18-04/
- https://www.answertopia.com/ubuntu/managing-ubuntu-users-and-groups/
- https://askubuntu.com/questions/612751/what-is-the-difference-between-the-groups-adm-and-admin
- https://www.configserverfirewall.com/ubuntu-linux/add-user-to-docker-group-ubuntu/
