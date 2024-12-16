# Run Strapi using PM2

- https://www.devbookmarks.com/p/strapi-knowledge-strapi-port-configuration
- https://pm2.keymetrics.io/docs/usage/quick-start
- https://docs-v4.strapi.io/dev-docs/deployment/process-manager#start-pm2-with-a-serverjs-file

Run either via `server.js` or via `ecosystem.config.js`

Typical `ecosystem.config.js`
```
module.exports = {
  apps: [
    {
      name: 'strapi',
      cwd: '/home/strapiuser/Strapi', // Path where Strapi is present
      script: 'npm',
      args: 'start',
      env: {
        NODE_ENV: 'production',
        DATABASE_HOST: 'localhost', // database endpoint
        DATABASE_PORT: '',
        DATABASE_NAME: '', // DB name
        DATABASE_USERNAME: '', // your username for psql
        DATABASE_PASSWORD: '', // your password for psql
      },
    },
  ],
};
```

Restart: 

`pm2 list`

`pm2 restart {number}`

# Nginx proxy setup

```
server {
    listen 80;
    listen [::]:80;

    server_name your.domain.com;

    location / {
        proxy_pass http://127.0.0.1:1338;
        proxy_set_header Host $http_host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }
}
```

Add an A Entry to your DNS settings

# HTTPS

- https://eff-certbot.readthedocs.io/en/latest/using.html#configuration-file

`sudo certbot --nginx -d your.domain.com -n -m ruslanaliyev1849@gmail.com --agree-tos`

```
server {
    server_name your.domain.com;

    location / {
        proxy_pass http://127.0.0.1:1338;
        proxy_set_header Host $http_host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
    }

    listen [::]:443 ssl ipv6only=on; # managed by Certbot
    listen 443 ssl; # managed by Certbot
    ssl_certificate /etc/letsencrypt/live/your.domain.com/fullchain.pem; # managed by Certbot
    ssl_certificate_key /etc/letsencrypt/live/your.domain.com/privkey.pem; # managed by Certbot
    include /etc/letsencrypt/options-ssl-nginx.conf; # managed by Certbot
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem; # managed by Certbot
}
server {
    if ($host = your.domain.com) {
        return 301 https://$host$request_uri;
    } # managed by Certbot


    listen 80;
    listen [::]:80;

    server_name your.domain.com;
    return 404; # managed by Certbot
}
```

Check config file: `nginx -t`

Older server OSs: `service nginx restart`

Newer server OSs: `systemctl restart nginx`


---

Increase max upload size

- https://docs.strapi.io/dev-docs/plugins/upload
- https://forum.strapi.io/t/cannot-upload-files-bigger-than-200mb/36682/2
- https://docs.rackspace.com/docs/limit-file-upload-size-in-nginx#edit-the-upload-file-size-value
