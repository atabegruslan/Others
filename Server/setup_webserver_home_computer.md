# Steps

- Have server software on your computer
- After you made your website in it, everyone in your LAN can access it via your private IP@
- Log into your router and setup PORT FORWARDING to make your website accessible to the world via your LAN's public IP@: https://www.youtube.com/watch?v=92b-jjBURkw
- Go to a DOMAIN PROVIDER to get a domain name (so the world can access your website by an easy-to-remember URL): https://www.youtube.com/watch?v=mn-5HHDb79E 
	- This is where an A record is added to a Authoritative Name Server (See below DNS notes)
	- In your router, setup DDNS too, because your public IP@ won't always remain the same.

## DNS

When you put URL into a browser:
- DNS resolution (normally at ISP)
- Anycasts to the nearest Root Domain Server (only 13 worldwide)
- Top domain server (.com, .org, ...)
- ICANN's Authoritative Name Server https://www.cloudns.net/blog/authoritative-dns-server

Other relevant articles:

- https://en.wikipedia.org/wiki/List_of_DNS_record_types
- https://www.site24x7.com/learn/dns-record-types.html
- https://en.wikipedia.org/wiki/DNS_zone
- https://en.wikipedia.org/wiki/Domain_name_registrar 