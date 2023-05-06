# On Linux Server

## Enable SSL

```
a2enmod ssl
systemctl restart apache2
netstat -ano | grep 443
```

If you see something like below, then good

![](https://user-images.githubusercontent.com/20809372/236618295-6a17a49c-d31f-414b-b9a4-13083dbcbec4.png)

**But you still need a valid SSL certificate**

Self-signed certificates won’t work well. Because browsers always trace to the root CA an raise an error immediately.

## Make a certificate

There are many ways to get a certificate. Different organizations have their own way of getting their certificates. Your company probably have their own way of doing so.

Here are some ways:
- https://blog.short.io/ssl-certificate
- https://letsencrypt.org/getting-started

But once you get the certificate: Add the certificate to `/etc/apache2/sites-enabled/default-ssl.conf`

![image](https://user-images.githubusercontent.com/20809372/236618695-2bd96879-ae3c-49bf-813d-81f620e10825.png)

```
ln -S /etc/apache2/sites-enabled/default-ssl.conf /etc/apache2/sites-available/default-ssl.conf
ln -S /etc/apache2/sites-enabled/000-default.conf /etc/apache2/sites-available/000-default.conf
service apache2 restart
```

So that `/etc/apache2/apache2.conf` (the global configuration) loads `/etc/apache2/sites-enabled/000-default.conf` , which in turn loads `/etc/apache2/sites-available/000-default.conf`
