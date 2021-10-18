# Query params

## How different platforms parse query params

If you have a GET request like `{domain}/path?param1=xxx&param2=yyy&param3=zzz`

| Server | how |
|---|---|
| Tomcat/JSP | first |
| Apache/PHP | last |
| IIS/ASP | all |

## Best practices

https://stackoverflow.com/questions/611906/http-post-with-url-query-parameters-good-idea-or-not

# Detect mobile in web

- https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/android_detection_in_web.pdf

# PUT and DELETE

Query override using HTML form. The following is for "post".
```
<form action="/ideas/{{idea.id}}?_method=PUT" method="post">
	<input type="hidden" name="_method" value="PUT">
</form>
```
Query override using HTML form. The following is for "delete".
```
<form method="post" action="/ideas/{{id}}?_method=DELETE">
	<input type="hidden" name="_method" value="DELETE">
</form>
```

# Prevent Resubmission

https://stackoverflow.com/questions/3923904/preventing-form-resubmission

1. Use AJAX + Redirect

This way you post your form in the background using JQuery or something similar to Page2, 
while the user still sees page1 displayed. 
Upon successful posting, you redirect the browser to Page2.

2. Post + Redirect to self
https://en.wikipedia.org/wiki/Post/Redirect/Get

This is a common technique on forums. 
Form on Page1 posts the data to Page2, 
Page2 processes the data and does what needs to be done, 
and then it does a HTTP redirect on itself. 
This way the last "action" the browser remembers is a simple GET on page2, 
so the form is not being resubmitted upon F5.

3. https://www.w3schools.com/jquery/event_one.asp

4. Locks https://www.bookstack.cn/read/symfony-v4.3/b5a210628d220088.md

# Server quirks

HTTP is case-sensitive and the local filesystem isn't.  
Many servers cater for case imperfections.  
http://stackoverflow.com/questions/6852277/case-sensitive-urls-how-to-make-them-insensitive 

# SOAP

- https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/soap/
