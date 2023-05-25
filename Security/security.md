# Security

- https://www.youtube.com/channel/UCW6MNdOsqv2E9AjQkv9we7A
- https://www.youtube.com/playlist?list=PLd_xj7N1B5DrPxtdD3JqMxeMlqJEBaXrA
- https://www.youtube.com/c/InfiniteLogins/playlists
- https://www.youtube.com/user/Computerphile/playlists
- https://www.youtube.com/playlist?list=PLafAeunGxeD65npWl1Io16TlusUitmMRc
- https://www.youtube.com/playlist?list=PLsEwfqXV6RRqGjyWixmpMQPyy-VU64Z7r
- https://www.youtube.com/channel/UCjkzxg31WhD2dbacUYSIxXw
- https://www.youtube.com/c/SathvikTechtuber/videos
- https://www.youtube.com/playlist?list=PLoEpvlpUwwkbWXz0UjwDDYb91ZpjN5ScV

# Preliminary knowledge

Cryptography: https://github.com/atabegruslan/Others/blob/master/Security/cryptography.md

# SSL & TLS

TLS is a bit better than SSL.  
SSL is by port - secure connection used from the get-go.  
TLS is by protocol - these connections first begin with an insecure "hello" to the server  
and only then switch to secured communication after the handshake between the client and server is successful.  
If this shandshake fails for any reason, the connection is severed.  

Very good tutorial: https://www.youtube.com/watch?v=iQsKdtjwtYI

![](/Illustrations/Security/ssl.PNG)

![](/Illustrations/Security/ssl_tls.PNG)

https://www.youtube.com/watch?v=niLaNbOsn28

https://github.com/atabegruslan/Others/blob/master/Illustrations/Security/ssl_tls_details.pdf

## Having HTTPS on your server

- XAMPP: https://github.com/atabegruslan/Others/blob/master/Development/xampp.md#https-on-local-xampp
- https://github.com/atabegruslan/Others/blob/master/Server/https.md
- https://en.wikipedia.org/wiki/Public_key_certificate
- Getting certificate: https://certbot.eff.org/instructions?ws=nginx&os=centosrhel8

Below is what it looks like after you got the certificate

![](/Illustrations/Security/after_setup_ssl_cert.png)

PEM: The default format for storing keys. Can have extensions of `.pem`, `.crt` or `.key`. They can be encoded in `base64`.  
X.509: The standard for defining those formats. It is also used for SSL certificates.  

# SSH

![](/Illustrations/Security/ssh1.PNG)

![](/Illustrations/Security/ssh2.PNG)

SSH2 breaks SSH1 down into: Transport Layer, Connection & Authentication Protocols.  

Differences:  
- Session symmetrical key goes from client to server via Diffie-Hellman method, not encrypted using server key.  
- CA will sign the public keys used in the communication. (same procedure as in SSL)
- SSH1 enforce integrity via CRC, SSH2 uses message authentication codes, eg: hmac-md5, hmac-sha1, hmac-ripemd160.  
- No Rhosts support in SSH2.  
- SSH1 only allows negotiation of the symmetric encryption algorithm, all other things are hard coded (mac, compression etc).  
- SSH2 server can dictate the client to use multiple authentication methods in a single session to succeed. However SSH1 only support one method per session.  
- SSH2 allows the change of session key periodically.  

https://www.slashroot.in/secure-shell-how-does-ssh-work

Below is what it looks after immediately after creating SSH keys:

![](/Illustrations/Security/ssh_keys_immed_after_setup.png)

## SSH Tunneling

http://chamibuddhika.wordpress.com/2012/03/21/ssh-tunnelling-explained/

## Remote Access

https://www.techotopia.com/index.php/Configuring_CentOS_Remote_Access_using_SSH

# Kerberos

![](/Illustrations/Security/kerberos.PNG)

---

# Auth and related security issues

Auth techniques: https://github.com/atabegruslan/Others/blob/master/Security/auth.md

Simple common-sense things you can do

- Use HTTPS
- Never put sensitive credentials into URLs. Put them into headers or POST payload, where they'll be encrypted.
  - If you put them in URLs, it can be seen in
  - Logs
  - Man in the middle attacks
  - Referrer header
  - History
  - Proxy's cache
- Avoid using Basic Authentication, because it isn't very secure.
- If you want to be paranoid about security, then encrypt your credentials
- Have some kind of mechanism to do integrity checks on the other end
- Make your requests one-time
  - Nonce
  - timestamp
  - OTP
- One-time links when appropriate. Eg: when resetting password
- GET should never make modifications nor deletions
  - Else that would violate REST conventions
  - It might be accidently invoked by web-crawlers
    - Use `robots.txt` to limit crawlers
- Sanitize and validate inputs
- Restrict HTTP methods to only those that's needed
- Content type validation for both request and response
- In users table (and other tables that REST APIs access), use random UUIDs instead of auto-incrementing IDs
- Store passwords in DB as hashes
- Don't upload config files into repositories
- Don't make error messages too revealing
- Use logs
- Test regularly
- Rate limit
  - Quota: Responds with HTTP 429 Too Many Requests error when requests come too often
  - Throttle: Slow the requests down
  - Example on Laravel: https://github.com/Ruslan-Aliyev/Laravel10_Newest_Notes/blob/master/README.md#rate-limit
  - Example in plain PHP:
    - https://www.digitalocean.com/community/tutorials/how-to-implement-php-rate-limiting-with-redis-on-ubuntu-20-04
    - https://helloacm.com/easy-rate-limit-in-php-using-simple-strategy-an-api-example/
- Use firewall: https://en.wikipedia.org/wiki/Application_firewall#Description
  - https://en.wikipedia.org/wiki/Web_application_firewall
- Utilize reverse proxy https://www.youtube.com/watch?v=9sAg7RooEDc /API gateway https://www.youtube.com/watch?v=vHQqQBYJtLI

Below is how you can have a symmetric encryption on credentials when sending them over APIs

![](/Illustrations/Security/encrypt_credentials.png)

Below is how you can hide secrets in the proxy

![](/Illustrations/Security/hide_secrets_in_proxy.png)

# SQL Injection

Injection of malicious SQL code. Use PDO or any modern framework to sanitize any malicious SQL code into mere text.

# XSS

Injection of malicious JS code. Sanitize user input. Especially escape all the `<script>` tags.

# XXE

# Directory traversal attack & File inclusion vulnerability & Remote code execution

- https://www.youtube.com/watch?v=qFRgIAtWKc4
- https://www.youtube.com/watch?v=rK5TFXom34w
- (include derek bana's video here)

# Clickjacking

# Timing attack

# Replay attack

Eg: Call the request to deposit money into my account multiple times.

On a similar topic: Use this POST and Redirect pattern to avoid multiple submits when user clicks the submit button too many times: https://en.wikipedia.org/wiki/Post/Redirect/Get

# Cookie Poisoning

- https://www.f5.com/glossary/cookie-poisoning
- https://www.youtube.com/watch?v=qAc9R5Xs6ew

# Header security

Q: Are HTTPS headers encrypted?  
A: Everything are encrypted (Header and Body).  

That's why SSL on vhosts doesn't work too well - you need a dedicated IP address because the Host header is encrypted.

The Server Name Identification (SNI) standard means that the hostname may not be encrypted if you're using TLS.   
Also, whether you're using SNI or not, the TCP and IP headers are never encrypted. (If they were, your packets would not be routable)  

Protect Response Headers: https://scotthelme.co.uk/hardening-your-http-response-headers/

Defending Against Web Attacks:  
- https://resources.infosecinstitute.com/topic/defending-against-web-attacks-using-http-headers-part-1/
- https://resources.infosecinstitute.com/topic/defending-against-web-attacks-using-http-headers-part-2/
- https://resources.infosecinstitute.com/topic/defending-against-web-attacks-using-http-headers-part-3/

HTTP header security: https://www.contextis.com/en/blog/security-http-headers

## Use headers:

- `Content-Security-Policy` : define a whitelist of approved sources of content for your site (eg css & js ...)
- `Strict-Transport-Security` : force https usage
- `Public-Key-Pins` : providing a whitelist of cryptographic identities that the browser should trust. only ever accept a specific set of certificates
- `!X-Frame-Options` : stop attacker forging your site via iframe. against click jacking
- `!X-Xss-Protection` : dont execute unescaped malicious(xss) input 
- `X-Content-Type-Options` : prevents browser from trying to mime-sniff the content type of a response

## Remove headers:

- `Server` : not reveal server software
- `X-Powered-By` : not reveal web technology

## Secure cookies:

Example: `SetCookie: PHPSESSID=36cb82e1d98853f8e250d89be857a0d3; path=/; HttpOnly; secure`

- `HttpOnly` attribute on setcookie header : disable the ability to read cookies using external JavaScript.
- `secure` attribute on setcookie header : forces your application to send cookies only over HTTPS.
- Killing the session upon closing the browser.

## Consider this scenario

A user may view an authenticated page, log out,   
and then a malicious user can use the browser history to view the cached page.  

Mitigation:
```
Cache-Control: no-cache, no-store, max-age=0, must-revalidate
Pragma: no-cache
Expires: 0
```

## `Referrer-Policy: same-origin`

- `Referrer Policy` is a mechanism that web applications can leverage to manage the referrer field, which contains the last page the user was on.
- The `Referrer-Policy` response header instructs the browser to let the destination knows the source where the user was previously.

# CSRF, SOP & CORS

## Cross Site Request Forgery

This is a subtype of a larger category of attacks
- Privledge escalation
  - Confused deputy attack
    - CSRF

Articles:
- https://youtube.com/watch?v=hW2ONyxAySY
- https://portswigger.net/web-security/csrf
- https://docs.spring.io/spring-security/site/docs/3.2.0.CI-SNAPSHOT/reference/html/csrf.html
- https://www.youtube.com/watch?v=XRW_US5BCxk
- Recap on cookies: https://stackoverflow.com/questions/3514750/how-browser-relates-the-cookies-for-web-sites-in-each-tab
- Mitigation: 
  - CSRF Token: 
    - https://markitzeroday.com/x-requested-with/cors/2017/06/29/csrf-mitigation-for-ajax-requests.html
    - https://stackoverflow.com/questions/20504846/why-is-it-common-to-put-csrf-prevention-tokens-in-cookies/20518324#20518324
    - Note: Nonce isn't exactly the same as CSRF tokens:
      - https://stackoverflow.com/questions/5691492/csrf-tokens-vs-nonce-confusion-are-they-the-same/5691513#5691513
      - https://codex.wordpress.org/WordPress_Nonces
   - Cookie's samesite set to `strict`

## Same Origin Policy

You can't **receive** resources from a different origin.

Applies to XMLHttpRequest and fetch.  
Postman doesn't care about SOP, it's a dev tool not a browser.

## Cross Origin Resource Sharing

For requests to a different origin:

- Safe method: GET, POST or HEAD
- Safe headers – the only allowed custom headers are:
     - Accept,
     - Accept-Language,
     - Content-Language,
     - Content-Type with the value `application/x-www-form-urlencoded`, `multipart/form-data` or `text/plain`.

Any others cause a "pre-flight" request to be issued in CORS supported browsers.

![](/Illustrations/Security/cors_preflight.PNG)

### JQuery quirk

CORS POST request works from plain javascript, but not with jQuery: 

jQuery 1.5.1 adds "Access-Control-Request-Headers: x-requested-with" header to all CORS requests. 

jQuery 1.5.2 does not do this. 

Setting a server response header to "Access-Control-Allow-Headers: \*" doesn’t solve the problem. 

Need “Access-Control-Allow-Headers: x-requested-with” specifically.

### Flash Exploit

Scenario:

Server expects JSON POST body. These are a bit harder to exploit because:
- Harder to craft using form inputs
- Setting custom headers requires AJAX which will fire an OPTIONS pre-flight request
But still, if `content-type` header is ignored by server, then:
- We can craft JSON body using form inputs
- We can use AJAX to make and send the JSON (Response may be blocked by SOP, but the attack request will still make it to the server)
But if `content-type` header is explicit, ie: server expects the request's `content-type` header to be `application/json`, then
- We can no longer exploit using form inputs.
But if the server allows your browser to set the `content-type` header (ie: `Access-Control-Allow-Headers:Content-Type`)
- We can still exploit via AJAX
But if the server don't have `Access-Control-Allow-Headers:Content-Type`, then we'll have to use the **Flash exploit**:
- Flash isn't affected by SOP. It operates on its own rules. 
- So we use ActionScript to make the request with a forged `content-type` header. 
But Flash will not make a request to a different origin with custom headers unless the server have `crossdomain.xml`. So if the `crossdomain.xml` isn't there, then:
-  We send the Flash request to another file on the same server as the Flash file. 
- This file will do a 307 redirect (307 redirects without changing the headers). 
- The HTTP 307 will redirect the POST body and the headers to the victim.

References:
- Theory: https://www.youtube.com/watch?v=eWEgUcHPle0&t=690s
- Theory: https://blog.appsecco.com/exploiting-csrf-on-json-endpoints-with-flash-and-redirects-681d4ad6b31b
- Code: https://www.geekboy.ninja/blog/exploiting-json-cross-site-request-forgery-csrf-using-flash/
- Variant scenario: https://stackoverflow.com/questions/17478731/whats-the-point-of-the-x-requested-with-header
- Variant scenario: https://www.youtube.com/watch?v=IW9VGipXpgw

### Related things

JQuery AJAX:

**crossDomain (default: false for same-domain requests, true for cross-domain requests)**  
Type: Boolean  
If you wish to force a crossDomain request (such as JSONP) on the same domain, set the value of crossDomain to true. This allows, for example, server-side redirection to another domain. (version added: 1.5)  

https://stackoverflow.com/questions/21255194/usages-of-jquerys-ajax-crossdomain-property/32296615

**headers (default: {})**  
Type: PlainObject  
An object of additional header key/value pairs to send along with requests using the XMLHttpRequest transport. The header `X-Requested-With: XMLHttpRequest` is always added, but its default XMLHttpRequest value can be changed here. Values in the headers setting can also be overwritten from within the beforeSend function. (version added: 1.5)

`X-Requested-With: XMLHttpRequest` means indicates that the request was made by XMLHttpRequest instead of being triggered by clicking a regular hyperlink or form submit button.

## Overcome CORS blockages

### Headers in server

In server, add `Access-Control-Allow-Origin: *` to response headers.

### JSONP

Example:

```html
<script>
function getCountries(data) 
{
  window.countries = data;
}
</script>
<script src="https://ruslan-website.com/misc/autosugg/autosugg.php?callback=getCountries"></script>
```

```js
var countries = JSON.parse(window.countries);
```

```php
$countries = $sth->fetchAll(PDO::FETCH_COLUMN, 0);
$countries = implode($countries, '","');
$countries = '["' . $countries . '"]';

echo $_GET['callback']."(".json_encode($countries).");";
```

Live Example: https://jsfiddle.net/atabegaslan/6f7rpgLw/

### Proxy

![](/Illustrations/Security/cors_proxy.PNG)

#### Public Proxy

- In Nginx: https://github.com/atabegruslan/Others/blob/master/Illustrations/Security/cors_public_proxy.pdf
- https://httptoolkit.tech/blog/cors-proxies/

#### Own Proxy

- In Nginx: https://github.com/atabegruslan/Others/blob/master/Illustrations/Security/cors_proxy_nginx.pdf
- In Express/Node: https://github.com/atabegruslan/Others/blob/master/Illustrations/Security/cors_proxy_express.pdf

### CORS browser plugin

For every request, it will add the `Access-Control-Allow-Origin: *` header to the response.

# Content Security Policy

- https://en.wikipedia.org/wiki/Content_Security_Policy
- https://content-security-policy.com/
- https://developer.mozilla.org/en-US/docs/Web/HTTP/CSP
- https://content-security-policy.com/style-src/
