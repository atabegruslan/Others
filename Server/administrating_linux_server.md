# Server Admin

## Tutorials

- https://www.youtube.com/playlist?list=PLtK75qxsQaMLZSo7KL-PmiRarU7hrpnwK
- https://www.youtube.com/playlist?list=PL9ooVrP1hQOH3SvcgkC4Qv2cyCebvs0Ik

---

## Misc

- https://ostechnix.com/how-to-enable-timestamp-in-bash-history-in-linux/


Other Useful commands

https://gist.github.com/Integralist/a49df746e2bd30bff047

`ps` is for seeing what processes are running. To list all node processes: `ps -ef | grep node`. https://www.cyberciti.biz/faq/show-all-running-processes-in-linux

Kill background process: `pkill -9 {process ID}`. https://linuxhint.com/kill-background-process-linux . But better NOT to use this command in this server setup.

Free up port: `sudo kill -9 $(sudo lsof -t -i:80)`. (`lsof` is for listing of open files). But better NOT to use this command in this server setup.

`top`: check what CPU and Memory running processes are utilizing

`netstat`: monitoring network traffic (eg: `netstat -ano | grep 1337`)

If any file is changed, you need to reload by `systemctl daemon-reload`

`journalctl`: to view log easier. Eg view log for strapi-v4 app: `journalctl -u strapi-v4 -f`

# SCP

Useful commands on server
Upload: scp -r -P 8022 ./scaleflex-filerobot root@strapi.sfxconnector.com:/var/www/v3/plugins
Download: scp -P 8022 root@strapi.sfxconnector.com:/var/www/v4/.tmp/data.db ./data.db
Full notes on the usage of scp
# download: remote -> local
scp user@remote_host:remote_file local_file
# upload: local -> remote
scp local_file user@remote_host:remote_file
# upload: with key
scp -i key.pem local_file user@remote_host:remote_file
# upload: specify port
scp -P 2222 local_file user@remote_host:remote_file

# Finding out about OS

1/ `cat /etc/os-release`
2/ `lsb_release -a`
3/ `hostnamectl`