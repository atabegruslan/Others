# Authentication and Authorization

- Authentication: Who you are
- Authorization: What you can do

# Ways

Good readings:
- https://learning.postman.com/docs/sending-requests/authorization/
- https://www.rfc-editor.org/rfc/rfc2617
- https://www.cloudflare.com/en-gb/learning/performance/http2-vs-http1.1/
- https://howtodoinjava.com/java/java-security/rest-api-security-guide/
- https://www.trendmicro.com/en_vn/research/21/f/secure_secrets_managing_authentication_credentials.html
- https://cheatsheetseries.owasp.org/cheatsheets/REST_Security_Cheat_Sheet.html#security-headers
	- https://www.youtube.com/watch?v=OREjhwSOXDI
	- https://www.invicti.com/blog/web-security/rest-api-web-service-security/

# Basic Auth

Providing username and password for each and every request you make

`'Authorization: Basic '. base64_encode("user:password")`

Good:
- Widely recognized
- Works through proxies
Bad:
- Not encrypted (though alleviated by HTTPS)
- Every request is a potential victim to password thieves

Good articles:
- https://stackoverflow.com/questions/2140419/how-do-i-make-a-request-using-http-basic-authentication-with-php-curl
- https://www.devdungeon.com/content/http-basic-authentication-php
- https://www.sciencedirect.com/topics/computer-science/basic-authentication

**Securely in cURL**
- https://reqbin.com/req/c-haxm0xgr/curl-basic-auth-example
- https://success.qualys.com/discussions/s/question/0D52L00004VmEKSSA3/how-to-securely-pass-credentials-in-curl-request-

**Securely in PowerShell**
- https://www.servicenow.com/community/developer-forum/how-can-we-pass-the-credentials-in-a-secure-way-in-servicenow/m-p/2391780
- https://www.servicenow.com/community/developer-forum/how-can-we-pass-credentials-in-a-secure-way-in-powershell-script/m-p/1449804

# Digest Auth

2 rounds:
1. Client sends a 'probe', without credentials, server returns some info
2. Client sends a second request, including username, password and the above returned info. They are all MD5 hashed.

Good articles:
- https://www.youtube.com/watch?v=eAQC3JfDUl8
- https://en.wikipedia.org/wiki/Digest_access_authentication

# SCRAM

- https://www.youtube.com/watch?v=RH0ZslQABVI
- https://en.m.wikipedia.org/wiki/Salted_Challenge_Response_Authentication_Mechanism

# Sessions (& cookies)

![](/Illustrations/Security/session.png)

# Tokens

- ID Tokens/API tokens: Eg: JWT. It is considered stateless
- Access tokens/Bearer tokens: Considered as an opaque token. No specific format. For authorization. It is considered stateful. Eg: OAuth2's bearer token
- PAT (Personal Access Tokens): Eg: Github's, Laravel Sanctum's. 
	- https://stackoverflow.com/questions/66977193/which-algorithm-does-github-uses-to-generate-their-personal-access-tokens/66977757#66977757
	- https://github.blog/2021-04-05-behind-githubs-new-authentication-token-formats/
	- Example in Laravel Sanctum: https://github.com/atabegruslan/Laravel_CRUD_API/blob/master/README.md#laravel-sanctum

**Stateful vs Stateless**

- https://www.openidentityplatform.org/blog/stateless-vs-stateful-authentication
- https://www.baeldung.com/csrf-stateless-rest-api
- https://www.youtube.com/watch?v=nFPzI_Qg3FU

## OAuth2

Used when your app needs to access data from another platform (eg: your user's google info).

OAuth2 is used for authorization (at least originally)

- https://www.c-sharpcorner.com/article/accesstoken-vs-id-token-vs-refresh-token-what-whywhen
- https://cloudinfrastructureservices.co.uk/oauth2-vs-jwt
- https://supertokens.com/blog/oauth-vs-jwt
- https://blog.loginradius.com/engineering/using-jwt-with-oauth2-when-and-why/
- https://stackoverflow.com/questions/40375508/whats-the-difference-between-jwts-and-bearer-token/40375722#40375722
- Laravel Passport, 1st party app example: https://github.com/atabegruslan/Laravel_CRUD_API#get-access-token
- Plain PHP, 3rd party app example: https://github.com/atabegruslan/Plain_PHP_CRUD_MVC#oauth2-theory
- https://www.oauth.com/oauth2-servers/differences-between-oauth-1-2/

**Grant (or flow) types**

![](/Illustrations/Security/grant_types.png)

![](/Illustrations/Security/which_grant_type.png)

Types:
- `client_credentials`: Used only by confidential clients, eg: a trusted machine. Only pass client key and secret 
- `password` AKA **resource owner password credentials** or **username-password auth flow**: Used by a trusted app, eg: 1st-party apps. Pass client key and secret & username and password
- **Authorization Code**: Used by Personal Access Clients, eg: 3rd party apps. Firstly redirect with code, then get access token with code.
- **implicit**: For client side apps, eg: mobile or SPA. Deprecated in favor of PKCE because it's so insecure. The redirect with code step is omitted, instead the redirection gives the access token in the callback URL's fragment (after #).
	- **Authorization Code PKCE** (Proof Key for Code Exchange): 
		- Flow:
			- https://auth0.com/docs/get-started/authentication-and-authorization-flow/authorization-code-flow-with-proof-key-for-code-exchange-pkce
			- ![](/Illustrations/Security/PKCE_flow.png)
		- It addresses the Authorization Code Interception Attack
			- https://www.youtube.com/watch?v=Gtbm5Fut-j8
			- ![](/Illustrations/Security/authorization_code_interception_attack.png)
			- ![](/Illustrations/Security/PKCE.png)
- **Hybrid**: 
	- https://backstage.forgerock.com/docs/am/7/oidc1-guide/openid-connect-hybrid-flow.html	
	- ![](/Illustrations/Security/hybrid_grant.png)		
- **Device Authorization Grant/Device Code** (urn:ietf:params:oauth:grant-type:device_code): https://www.youtube.com/watch?v=QdFjaOb-KTs 
- **Refresh Token**

Good tutorials:
- https://portswigger.net/web-security/oauth/grant-types
- https://oauth.net/2/grant-types/
- https://auth0.com/docs/get-started/applications/application-grant-types 
- https://web.archive.org/web/20210125202508/https://www.bubblecode.net/en/2016/01/22/understanding-oauth2/ [GOOD]
- https://www.youtube.com/watch?v=hcSG5ktkasg
- https://www.youtube.com/watch?v=dLsyvP1UCVk 
- https://www.youtube.com/watch?v=1ZX7554l8hY [GOOD]
- https://www.youtube.com/watch?v=ukbDPUnKRGQ
- https://www.youtube.com/playlist?list=PL1Nml43UBm6dOj4UuH-7a9e3wO6eL2SCi 

## SSO

- https://www.youtube.com/watch?v=t18YB3xDfXI
- https://www.youtube.com/watch?v=O1cRJWYF-g4

It is an identity layer on top of authorization.  
It uses a JWT identity token.

- https://auth0.com/blog/what-is-and-how-does-single-sign-on-work
- https://www.onelogin.com/pages/openid-connect
- https://cloudinfrastructureservices.co.uk/what-is-single-sign-on-and-how-does-sso-work/
- https://auth0.com/intro-to-iam/saml-vs-openid-connect-oidc
- https://frontegg.com/blog/a-complete-guide-to-implementing-single-sign-on

### OpenID Connect (OIDC)

OIDC is build on top of OAuth2.  
It utilizes an Identity Token (JWT).  
Google uses this.   
OpenID 2.0 is now obsolete. They achieve the same goal, but are technically different.  
Originally OAuth2 was made for Authorization. But when you SignIn with a Social Media platform (eg: SignIn with Google or Facebook), that is actually Authentication. Different platforms uses different scope names (eg: "family_name" vs "surname", "first_name" vs "given_name", etc). This non-standardization isn't good. So OIDC standardizes this by introducing an new scope name called "openId", which can be used whenever identity needs to be obtained while using OAuth2.  
What differs from OAuth2 is mainly: The scope includes an extra "openId", and an ID Token (JWT) is returned on top of the Access Token.  

- https://security.stackexchange.com/questions/44797/when-do-you-use-openid-vs-openid-connect/182083#182083
- https://www.youtube.com/watch?v=t18YB3xDfXI
- https://www.youtube.com/watch?v=S_sVBpEI-WQ
- https://openid.net/connect
- https://curity.io/resources/learn/web-client-sso-with-openid-connect
- https://www.youtube.com/watch?v=VI3G4Quzsb8
	- https://www.youtube.com/watch?v=3u1el6f6mdE

#### Facebook Connect

https://stackoverflow.com/questions/1827997/is-facebook-an-openid-provider/1828333#1828333

#### Microsoft Account (formerly known as Passport)

https://en.wikipedia.org/wiki/Microsoft_account#Support_for_OpenID

### Security Assertion Markup Language (SAML)

Okta, Auth0 and OneLogin uses this.

![](/Illustrations/Security/saml.png)

- https://help.okta.com/en-us/Content/Topics/Apps/apps-about-saml.htm
- https://developer.okta.com/docs/concepts/saml/#planning-for-saml
- https://www.onelogin.com/learn/saml
- https://cloudinfrastructureservices.co.uk/auth0-vs-okta/
- Sign into Google Workspace by using Auth0. Very good tutorial: https://www.youtube.com/watch?v=fDnT0VERIFI
- https://gauday.com/saml-la-gi-1640833378
- https://www.youtube.com/watch?v=uH80ud5yKOs
- https://www.youtube.com/watch?v=t2Cnn1o2DG4&t=362s

## JWT 

Problems of Session:
- Problematic when there are multiple servers behind the load balancer, because not every server knows the user by session ID.
- Can't use sticky session. Unscalable and have microservices problems.

The insides of JWT:

![](/Illustrations/Security/jwt_insides.png)

Best to put the JWT into an HTTP-only cookie or the Authorization header.

- Good intro explaination: https://www.youtube.com/watch?v=soGRyl9ztjI
- Good detailed explaination:
	- https://www.youtube.com/watch?v=7Q17ubqLfaM
	- https://medium0.com/batc/jwt-for-dummies-ok-not-100-dummies-1f08d3279a0b
- https://www.youtube.com/watch?v=UBUNrFtufWo
- https://www.youtube.com/playlist?list=PLCakfctNSHkGQ6S557u-6sLEYsfWje47P
- https://www.youtube.com/playlist?list=PLe30vg_FG4OQRZhQY57FCIyk1cPGDAc6k
- https://dev.to/kmistele/demystifying-jwt-how-to-secure-your-next-web-app-9h0
- https://levelup.gitconnected.com/crud-restful-api-with-go-gorm-jwt-postgres-mysql-and-testing-460a85ab7121
- https://www.youtube.com/watch?v=M4JIvUIE17c
- JWT decoder: https://jwt.io/
- Example in Laravel: https://github.com/atabegruslan/Others/blob/master/Development/laravel.md#jwt
- https://auth0.com/docs/secure/tokens/json-web-tokens/json-web-token-claims
- https://stackoverflow.com/questions/58341833/why-base64-is-used-in-jwts/58344036#58344036
- Vulnerabilities: https://www.invicti.com/blog/web-security/json-web-token-jwt-attacks-vulnerabilities/
- https://blog.logrocket.com/secure-rest-api-jwt-authentication/
- https://www.moesif.com/blog/technical/restful-apis/Authorization-on-RESTful-APIs/

# API KEY

For an client app, instead of a user's credentials.

- https://www.youtube.com/watch?v=sNn23dPRUS8
- https://blog.mergify.com/api-keys-best-practice/amp/
- A good example: https://scaleflex.zendesk.com/hc/en-gb/articles/360018054180-What-is-the-difference-between-Filerobot-API-Secret-Keys-and-Security-Templates-

Can be used against DDoS attacks, because with API Keys, you can set a visit-frequency max limit.

# SSH

SSH's inner workings: https://github.com/atabegruslan/Others/blob/master/Security/security.md#ssh

When SSH-ing into server without password, the server admin need to add your computer's SSH key into the server's `/root/.ssh/authorized_keys`

> One benefit of tokens over SSH keys: while tokens and SSH keys both share the Unique, Revocable, and Random benefits quoted in the blog post below, tokens are also limited in comparison to SSH keys in that they come with their own scoped permissions.

> While SSH keys can be read-only or read-write enabled, or scoped to specific repositories, personal access tokens do have an edge in terms of their finer-grained permissions model in comparison. This is likely why GitHub recommends tokens over SSH keys.

https://stackoverflow.com/questions/67077837/in-what-ways-is-an-ssh-key-different-from-tokens-for-git-authentication

Difference between `~/.ssh/id_ed12345`, `~/.ssh/id_ed12345.pub` & `~/.ssh/known_hosts/` to PEM: https://stackoverflow.com/questions/17670446/what-is-the-difference-between-various-keys-in-public-key-encryption/17674179#17674179

> SSH (Secure Shell) is a tool for secure system administration, file transfers, and other communication across the Internet or other untrusted network. It encrypts identities, passwords, and transmitted data so that they cannot be eavesdropped and stolen. OpenSSH is an open-source implementation of the SSH protocol.

SSH is a protocol. OpenSSH is a software tool.  
https://www.ssh.com/academy/ssh/openssh

# LDAP

https://www.youtube.com/watch?v=QyhNaY5O468

> What is the difference between SSO and LDAP? SSO is a convenient authentication method that allows users to access multiple applications and systems using just one login. LDAP is the protocol or communication process that will enable users to access a network resource through a directory service.

https://www.strongdm.com/blog/saml-vs-ldap

> SSO is a method of authentication in which a user has access to many systems with a single login, whereas LDAP is a method of authentication in which the protocol is authenticated by utilizing an application that assists in obtaining information from the server.

> LDAP a modification of an x500, which is a complicated enterprise directory system.

https://cloudinfrastructureservices.co.uk/ldap-vs-sso/

MS AD uses LDAP

https://cloudinfrastructureservices.co.uk/ldap-vs-active-directory

## AD FS

A feature of the Windows Server OS that extends users' SSO to beyond its corporate firewall.

https://www.techtarget.com/searchmobilecomputing/definition/Active-Directory-Federation-Services-AD-Federation-Services

# RADIUS

- https://cloudinfrastructureservices.co.uk/how-does-radius-server-authentication-work-using-nps-server/
- https://en.wikipedia.org/wiki/RADIUS
- https://en.wikipedia.org/wiki/AAA_(computer_security)

---

# Other related things

## Password Reset

![](/Illustrations/Security/password_reset.png)

- Above flow taken from: https://www.troyhunt.com/everything-you-ever-wanted-to-know/
- 2 more ways are suggested here: https://softwareengineering.stackexchange.com/questions/303854/putting-a-password-in-a-rest-api-call/303996#303996

## Remember Me

Just set the expiry time of the cookie long into the future

- https://stackoverflow.com/questions/244882/what-is-the-best-way-to-implement-remember-me-for-a-website/244907#244907
- https://paragonie.com/blog/2015/04/secure-authentication-php-with-long-term-persistence
- https://www.youtube.com/watch?v=72JYhSoVYPc

## MFA

- https://www.spiceworks.com/it-security/identity-access-management/articles/top-10-multi-factor-authentication-software-solutions/
- https://authy.com/
- https://en.wikipedia.org/wiki/RSA_SecurID
- https://en.wikipedia.org/wiki/Google_Authenticator

Below is a way

![](/Illustrations/Security/MFA.png)

## Captcha

## Question & Answer challenge

## "Not a Robot" challenge

## OTP
