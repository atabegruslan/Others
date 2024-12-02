# Ubuntu, Apache

## First - Install Apache

```
sudo apt update
sudo apt-get install apache2
sudo service apache2 start
```

https://ubuntu.com/tutorials/install-and-configure-apache

The default page you see is `/var/www/html/index.html`

## Enable SSL

Before you enable SSL, running `netstat -ano | grep 443` will show you nothing.   
(PS: `netstat` monitors network traffic)
```
ubuntu@LAPTOP-2UHBSPGK:~$ netstat -ano | grep 443
ubuntu@LAPTOP-2UHBSPGK:~$
```

Enable SSL
```
sudo a2enmod ssl
sudo service apache2 start
```

If it went well, then running `netstat -ano | grep 443` will show you
```
ubuntu@LAPTOP-2UHBSPGK:~$ netstat -ano | grep 443
tcp6       0      0 :::443                  :::*                    LISTEN      off (0.00/0/0)
```

**But you still need a valid SSL certificate**

## Make a self-signed certificate

`openssl req -x509 -newkey rsa:4096 -nodes -sha256 -subj '/CN=localhost' -keyout private.pem -out cert.pem`

```
ubuntu@LAPTOP-2UHBSPGK:~$ openssl req -x509 -newkey rsa:4096 -nodes -sha256 -subj '/CN=localhost' -keyout private.pem -out cert.pem
..........+...........+.+......+..++++++++++++++ ...
ubuntu@LAPTOP-2UHBSPGK:~$ ls
cert.pem  private.pem
ubuntu@LAPTOP-2UHBSPGK:~$ pwd
/home/ubuntu
```

So now the certificate is `/home/ubuntu/cert.pem` and key is `/home/ubuntu/private.pem`

Reference tutorial: https://www.youtube.com/watch?v=b35Dcz91ItE&t=380s

But just letting you know: self-signed certificates won’t work well, because browsers always trace to the root CA an raise an error immediately.

## Applying the certificate

Add the certificate to `/etc/apache2/sites-available/default-ssl.conf`

Before you'll see
```
<IfModule mod_ssl.c>
    <VirtualHost _default_:443>
        ServerAdmin webmaster@localhost

        DocumentRoot /var/www/html

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

        SSLEngine on

        SSLCertificateFile      /etc/ssl/certs/ssl-cert-snakeoil.pem
        SSLCertificateKeyFile /etc/ssl/private/ssl-cert-snakeoil.key
```

After your edits, it should be like
```
<IfModule mod_ssl.c>
    <VirtualHost _default_:443>
        ServerAdmin webmaster@localhost

        DocumentRoot /var/www/html

        ErrorLog ${APACHE_LOG_DIR}/error.log
        CustomLog ${APACHE_LOG_DIR}/access.log combined

        SSLEngine on

        SSLCertificateFile      /home/ubuntu/cert.pem
        SSLCertificateKeyFile 	/home/ubuntu/private.pem
```

PS: Sometimes the cert file can be called by other names, eg: `chained.crt`

## Tutorials

- https://www.arubacloud.com/tutorial/how-to-enable-https-protocol-with-apache-2-on-ubuntu-20-04.aspx

---

# Ubuntu, Nginx

## First - Install Nginx

```
sudo apt update
sudo apt install nginx
sudo service nginx restart
```

https://ubuntu.com/tutorials/install-and-configure-nginx

The default page you see is `/usr/share/nginx/html/index.html`

## Make a self-signed certificate

Same as above

## Applying the certificate

First, see: `/etc/nginx/nginx.conf`   
Scroll down a bit     
See line ` include /etc/nginx/conf.d/*.conf;`    

So lets create our own custom config file `/etc/nginx/conf.d/testhttpsnginx.conf`

```
server {
    listen              443 ssl;
    server_name         localhost;
    ssl_certificate     /home/ubuntu/cert.pem;
    ssl_certificate_key /home/ubuntu/private.pem;

    ...
}
```

---

# XAMPP

## Make a self-signed certificate

1. Make sure you have `C:\xampp\apache\conf\ssl.crt\server.crt` and `C:\xampp\apache\conf\ssl.key\server.key`.

If you don't have them, or if the existing are expired or have other problems, then run `C:\xampp\apache\makecert.bat` as admin.

Below is the contents of `C:\xampp\apache\makecert.bat`   
The key line is `bin\openssl x509 -in server.csr -out server.crt -req -signkey server.key -days 365`, which generates a self-signing cert   
```bat
@echo off
set OPENSSL_CONF=./conf/openssl.cnf

if not exist .\conf\ssl.crt mkdir .\conf\ssl.crt
if not exist .\conf\ssl.key mkdir .\conf\ssl.key

bin\openssl req -new -out server.csr
bin\openssl rsa -in privkey.pem -out server.key
bin\openssl x509 -in server.csr -out server.crt -req -signkey server.key -days 365

set OPENSSL_CONF=
del .rnd
del privkey.pem
del server.csr

move /y server.crt .\conf\ssl.crt
move /y server.key .\conf\ssl.key

echo.
echo -----
echo Das Zertifikat wurde erstellt.
echo The certificate was provided.
echo.
pause
```

Copy the generated cert to `C:\xampp\apache\conf\ssl.crt`   
Copy the generated key to `C:\xampp\apache\conf\ssl.key`   

## Applying the certificate

**Then do either of the 3 below:**

- By importing into "Trusted Root Certification Authorities"
	- https://www.youtube.com/watch?v=AKZU3SBZhfo
	- https://gist.github.com/adnan360/ad2b1cfc44114ac6f91fbb668c76798d
- By editing virtual host config
	- Tweek `makecert` if have `subjectAltName` problem: https://community.apachefriends.org/viewtopic.php?p=256423&sid=5118db64708ed66ea89f6b3481237986#p256489 
	- https://florianbrinkmann.com/en/https-virtual-hosts-xampp-4215
- By editing `httpd-xampp.conf`
	- https://gist.github.com/nguyenanhtu/33aa7ffb6c36fdc110ea8624eeb51e69
	- https://codelapan.com/post/how-to-install-ssl-certificate-on-xampp

**Potential problems:**

- https://www.ibm.com/support/pages/how-resolve-browser-certificate-warning-site-missing-valid-trusted-certificate

## Other tutorials

- https://www.youtube.com/watch?v=Mig9YPNiUZI
- https://www.youtube.com/watch?v=tngClv8Tmhk
- https://www.youtube.com/watch?v=eqrDHkIFe8U
- https://www.youtube.com/watch?v=zrbaE1Wdviw
- https://www.youtube.com/watch?v=qjQARtvS_OE

## Another example of `makecert.bat`

```bat
@echo off
set /p domain="Enter Domain: "
set OPENSSL_CONF=../conf/openssl.cnf

if not exist .\%domain% mkdir .\%domain%

..\bin\openssl req -config cert.conf -new -sha256 -newkey rsa:2048 -nodes -keyout %domain%\server.key -x509 -days 3650 -out %domain%\server.crt

echo.
echo -----
echo The certificate was provided.
echo.
pause
```

`cert.conf`
```
[ req ]

default_bits        = 2048
default_keyfile     = server-key.pem
distinguished_name  = subject
req_extensions      = req_ext
x509_extensions     = x509_ext
string_mask         = utf8only

[ subject ]

countryName                 = Country Name (2 letter code)
countryName_default         = US

stateOrProvinceName         = State or Province Name (full name)
stateOrProvinceName_default = NY

localityName                = Locality Name (eg, city)
localityName_default        = New York

organizationName            = Organization Name (eg, company)
organizationName_default    = Example, LLC

commonName                  = Common Name (e.g. server FQDN or YOUR name)
commonName_default          = localhost

emailAddress                = Email Address
emailAddress_default        = test@example.com

[ x509_ext ]

subjectKeyIdentifier   = hash
authorityKeyIdentifier = keyid,issuer

basicConstraints       = CA:FALSE
keyUsage               = digitalSignature, keyEncipherment
subjectAltName         = @alternate_names
nsComment              = "OpenSSL Generated Certificate"

[ req_ext ]

subjectKeyIdentifier = hash

basicConstraints     = CA:FALSE
keyUsage             = digitalSignature, keyEncipherment
subjectAltName       = @alternate_names
nsComment            = "OpenSSL Generated Certificate"

[ alternate_names ]

DNS.1       = localhost
```

PS: These need to be put inside `C:\xampp\apache\{any-folder-name}\`

# By CertBot & `LetsEncrypt`

- https://letsencrypt.org/getting-started
- Example: https://github.com/atabegruslan/Others/edit/master/Server/nginx_laravel.md

# By `mkcert`

- https://www.npmjs.com/package/mkcert
- https://www.youtube.com/watch?v=g42yNO_dxWQ&t=2136s
    - https://github.com/robertbunch/webrtc-starter/blob/main/taskList.md#setup-https
- https://www.youtube.com/watch?v=I-jULfZRejU

---

# Make a certificate

There are many ways to get a certificate. Different organizations have their own way of getting their certificates. Your company probably have their own way of doing so.

Here are some common ways:

- https://blog.short.io/ssl-certificate
- https://www.youtube.com/watch?v=b35Dcz91ItE&t=890s
- https://www.youtube.com/watch?v=2SzgmTIuHRU&t=94s
