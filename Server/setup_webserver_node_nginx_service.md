(old) Make background process: Use `screen`: https://askubuntu.com/questions/8653/how-to-keep-processes-running-after-ending-ssh-session/8657#8657

Better way:
- https://unix.stackexchange.com/questions/236084/how-do-i-create-a-service-for-a-shell-script-so-i-can-start-and-stop-it-like-a-d
- https://stackoverflow.com/questions/4018154/how-do-i-run-a-node-js-app-as-a-background-service

Take this Strapi app for example

`/etc/systemd/system/strapi-v4.service`
```
[Unit]
Description=Strapi v4

[Service]
ExecStart=yarn develop
Restart=always
User=root
# Note Debian/Ubuntu uses 'nogroup', RHEL/Fedora uses 'nobody'
Group=sudo
Environment=PATH=/root/.nvm/versions/node/v16.0.0/bin:/usr/bin:/usr
/local/bin
WorkingDirectory=/var/www/v4
RestartSec=10

[Install]
WantedBy=multi-user.target
```

Run
```
service strapi-v4 start
service strapi-v4 stop
service strapi-v4 restart
service strapi-v4 status
```

`/etc/nginx/conf.d/default.conf` is Nginx's default config file.

Make it call your config file `/etc/nginx/conf.d/custom.conf`. In it, have something like:

```
server {
    listen 80;
	listen [::]:80;
    server_name yourdomainname.com;

    # Proxy Config
    location / {
        proxy_pass http://127.0.0.1:8280;
```

When you run `service strapi-v4 start`, it will run it on the server on port 8280. Ports can be changed inside the Node.js app.

Then according to your confirguration file, any http request to `yourdomainname.com` will be forwarded to `http://127.0.0.1:8280`
