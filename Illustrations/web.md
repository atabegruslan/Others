# Security

https://www.youtube.com/playlist?list=PLI_rLWXMqpSl_TqX9bbisW-d7tDqcVvOJ

## CSRF, SOP & CORS

### Cross Site Request Forgery

- https://youtube.com/watch?v=hW2ONyxAySY
- https://portswigger.net/web-security/csrf
- https://docs.spring.io/spring-security/site/docs/3.2.0.CI-SNAPSHOT/reference/html/csrf.html
- Recap on cookies: https://stackoverflow.com/questions/3514750/how-browser-relates-the-cookies-for-web-sites-in-each-tab
- Mitigation: https://markitzeroday.com/x-requested-with/cors/2017/06/29/csrf-mitigation-for-ajax-requests.html

### Same Origin Policy

### Cross Origin Resource Sharing

![](/cors_preflight.png)

### Flash Exploit

- https://github.com/atabegruslan/Others/blob/master/Illustrations/CSRF-Flash.pdf
- https://www.geekboy.ninja/blog/exploiting-json-cross-site-request-forgery-csrf-using-flash/
- https://blog.appsecco.com/exploiting-csrf-on-json-endpoints-with-flash-and-redirects-681d4ad6b31b

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

### Proxy

![](/cors_proxy.png)

#### Public Proxy

- In Nginx: https://github.com/atabegruslan/Others/blob/master/Illustrations/CORS-Public-Proxy.pdf
- https://httptoolkit.tech/blog/cors-proxies/

#### Own Proxy

- In Nginx: https://github.com/atabegruslan/Others/blob/master/Illustrations/CORS-Proxy-Nginx.pdf
- In Express/Node: https://github.com/atabegruslan/Others/blob/master/Illustrations/CORS-Proxy-Express.pdf

# Comparisons

## First Class Functions

Functions that are treated like passable variables.

### JavaScript

- https://www.vinta.com.br/blog/2015/javascript-lambda-and-arrow-functions/
- https://stackoverflow.com/questions/12930272/javascript-closures-vs-anonymous-functions
- https://medium0.com/@iampika/javascript-environment-lexical-scope-and-closures-9c8dfaeff73d

**Closure**

- FUNCTIONS WITH PRESERVED DATA. 
- Function that access variables outside its scope.  
- Function that captures the state of the surrounding environment.
- A function that remembers the external things used inside.

Example of a closure that isn't anonymous:
```js
function outer() {
    var greeting = "hello ";

    (function inner(name) {
        alert(greeting + name);
    })("John Doe");
}
```

The Counter Dilema (can be solved by using closures): https://www.w3schools.com/js/js_function_closures.asp

**Anonymous Function**

- Nameless

```js
function() { 
  alert('I am anonymous'); 
} 
```

Example of an anonymous function that isn't a lambda expression:
```js
(function () { 
  // Immediately Invoked Function Expression
})(); 
```
and another example:
```js
(msg) => {
  console.log(msg);
  // Just evaluated and dropped on the floor. Not used as data.
}('foo');
```

**Lambda Expression**

- Function expression used as data.
- A function that is passed around like data.

Example of an lambda expression that isn't anonymous:
```js
$('#el').on('click', function clickHandler() {
```

### PHP

- https://www.php.net/manual/en/functions.arrow.php

### C#

**Delegates**

- Pointers to functions.
- Allow functions to be passed around.

![](/csdelegate.png)

Delegates used for making callbacks:

![](/cscallback1.png)
![](/cscallback2.png)

**Anonymous Function**

![](/csanonymous.png)

**Lambda Expression**

![](/cslambda.png)

## Asyncs

## True/False

## Frameworks/Technologies

# JavaScript

## Past

![](/history.jpg)

https://www.w3schools.com/Js/js_history.asp

JavaScript mostly implements the ECMAScript specification.  
More info about JS vs ECMAScript: https://www.freecodecamp.org/news/whats-the-difference-between-javascript-and-ecmascript-cba48c73a2b5/

## Notes

### Terminology

**JavaScript engine**: A program or interpreter that understands and executes JavaScript code.  
Synonyms: JavaScript interpreter, JavaScript implementation

V8 in Chrome, SpiderMonkey in Firefox, and Chakra in Edge. Each engine is like a language module for its application, allowing it to support a certain subset of the JavaScript language.

A JavaScript engine to a browser is like language comprehension to a person

**JavaScript runtime**: The environment in which the JavaScript code runs and is interpreted by a JavaScript engine.The runtime provides the host objects that JavaScript can operate on and work with.  
Synonyms: Host environment

### JIT Compiler vs Transpiler

**JIT Compiler (eg in V8 Engine)**

![](/jit.png)

https://stackoverflow.com/questions/59807938/the-confusion-with-jit-compilation-in-v8

**Transpiler (eg Babel)**

A transpiler converts codes that are at similar levels of abstraction. Eg: ES6 code to ES5 code.
