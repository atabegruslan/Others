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

You can't **receive** resources from a different origin.

Applies to XMLHttpRequest and fetch.  
Postman doesn't care about SOP, it's a dev tool not a browser.

### Cross Origin Resource Sharing

For requests to a different origin:

- Safe method: GET, POST or HEAD
- Safe headers – the only allowed custom headers are:
     - Accept,
     - Accept-Language,
     - Content-Language,
     - Content-Type with the value `application/x-www-form-urlencoded`, `multipart/form-data` or `text/plain`.

Any others cause a "pre-flight" request to be issued in CORS supported browsers.

![](https://github.com/atabegruslan/Others/blob/master/Illustrations/cors_preflight.png)


### JQuery quirk

CORS POST request works from plain javascript, but not with jQuery: 

jQuery 1.5.1 adds “Access-Control-Request-Headers: x-requested-with” header to all CORS requests. 

jQuery 1.5.2 does not do this. 

Setting a server response header to “Access-Control-Allow-Headers: \*” doesn’t solve the problem. 

Need “Access-Control-Allow-Headers: x-requested-with” specifically.

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

![](https://github.com/atabegruslan/Others/blob/master/Illustrations/cors_proxy.png)

#### Public Proxy

- In Nginx: https://github.com/atabegruslan/Others/blob/master/Illustrations/CORS-Public-Proxy.pdf
- https://httptoolkit.tech/blog/cors-proxies/

#### Own Proxy

- In Nginx: https://github.com/atabegruslan/Others/blob/master/Illustrations/CORS-Proxy-Nginx.pdf
- In Express/Node: https://github.com/atabegruslan/Others/blob/master/Illustrations/CORS-Proxy-Express.pdf

### CORS browser plugin

For every request, it will add the `Access-Control-Allow-Origin: *` header to the response.

# Comparisons

## First Class Functions

Functions that are treated like passable variables.

### JavaScript

- https://www.vinta.com.br/blog/2015/javascript-lambda-and-arrow-functions/
- https://stackoverflow.com/questions/12930272/javascript-closures-vs-anonymous-functions
- https://medium0.com/@iampika/javascript-environment-lexical-scope-and-closures-9c8dfaeff73d

**Closure**

- Function that uses variables to its outside and remembers their state.

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

Note:
- Function declarations that are hoisted as soon as program execution begins and can be called before its actual declaration.
- Function expressions (anonymous functions) are created at runtime and must be declared/defined before they can be called i.e. they are not hoisted

**Lambda Expression**

- A function that is passed around like data.

Example of an lambda expression that isn't anonymous:
```js
$('#el').on('click', function clickHandler() {
```

**Callback**
```js
function myCalculator(num1, num2, myCallback) {
  let sum = num1 + num2;
  myCallback(sum);
}
myCalculator(5, 5, function (theSum) {
  document.getElementById("demo").innerHTML = theSum;
});
```

**Arrow Functions**
![](https://github.com/atabegruslan/Others/blob/master/Illustrations/ES6_arrow_this.png)

### PHP

- https://www.php.net/manual/en/functions.arrow.php

**Callback**

Run a callback from a user-defined function:
```php
function exclaim($str) {
  return $str . "! ";
}
function printFormatted($str, $format) {
  // Calling the $format callback function
  echo $format($str);
}
printFormatted("Hello world", "exclaim");
```
Others ways: https://www.geeksforgeeks.org/implementing-callback-in-php

**Hooks/Triggers**

https://github.com/atabegruslan/Travellers_Forum#for-comparison

### C#

**Delegates**

- Pointers to functions.
- Allow functions to be passed around.

```cs
public static void AFunction() {…}
public delegate void ADelegate();
ADelegate pointer = new ADelegate(AFunction);
pointer();
```

Delegates used for making callbacks:

```cs
function myCalculator(num1, num2, myCallback) {
  let sum = num1 + num2;
  myCallback(sum);
}
myCalculator(5, 5, function (theSum) {
  document.getElementById("demo").innerHTML = theSum;
});
```
**Anonymous Function**

```cs
public delegate void ADelegate(string s);
ADelegate pointer = delegate () { … }
pointer(“param”);
```

**Lambda Expression**

```cs
public delegate void ADelegate(string s);
ADelegate pointer = () => { … }
pointer(“param”);
```

## Asyncs

### JavaScript

Good reads:
- https://hackernoon.com/async-await-generators-promises-51f1a6ceede2 (GOOD first half)
- https://blog.benestudio.co/async-await-vs-coroutines-vs-promises-eaedee4e0829 (GOOD)
- https://www.freecodecamp.org/news/write-modern-asynchronous-javascript-using-promises-generators-and-coroutines-5fa9fe62cf74/ (recap)

Ways:
- Promises - nesting prob
- Async Await - Not yet native.
     - Majority of ES7 features including async/await have not been natively implemented (11 JULY 2016). 
     - Native in current Chrome, Node.js but still needs to be transpiled with Babel for most projects (Mar 8, 2018).
- Generators and Coroutines - Need corouting libs. Generator by itself is like Goto

Async in Vue:
1. vue-async-function: https://xebia.com/blog/next-generation-async-functions-with-vue-async-function/
     - https://www.npmjs.com/package/vue-async-function
2. transform-regenerator & polyfill: https://stackoverflow.com/questions/46389267/using-async-await-with-webpack-simple-configuration-throwing-error-regeneratorr/46734082
     - https://www.npmjs.com/package/@babel/plugin-transform-regenerator
     -- https://babeljs.io/docs/en/next/babel-plugin-transform-regenerator.html
     - https://babeljs.io/docs/en/babel-polyfill
3. Bluebird: https://github.com/atabegruslan/Travel-Blog-Laravel-5-8/commit/9d710ec1b307a5922bf35304e260ff758f5e79ea
     - https://www.npmjs.com/package/bluebird

See more illustrations at: https://github.com/atabegruslan/Others/blob/master/Illustrations/js_async/

### PHP

https://github.com/Ruslan-Aliyev/async_php

## True/False

![](https://github.com/atabegruslan/Others/blob/master/Illustrations/booleans.png)

## Frameworks/Technologies

- https://github.com/atabegruslan/Others/blob/master/Illustrations/js_frameworks.pdf
- https://github.com/atabegruslan/Others/blob/master/Illustrations/soap_rest.pdf

![](https://github.com/atabegruslan/Others/blob/master/Illustrations/comparisons.PNG)

# JavaScript

## History

![](https://github.com/atabegruslan/Others/blob/master/Illustrations/history.jpg)

- https://www.w3schools.com/Js/js_history.asp
- https://www.codesdope.com/blog/article/javascript-es5-vs-es6/
- https://www.javatpoint.com/es5-vs-es6

JavaScript mostly implements the ECMAScript specification.  
More info about JS vs ECMAScript: https://www.freecodecamp.org/news/whats-the-difference-between-javascript-and-ecmascript-cba48c73a2b5/

## MISC Notes

### JS Terminology

**JavaScript engine**: A program or interpreter that understands and executes JavaScript code.  
Synonyms: JavaScript interpreter, JavaScript implementation

V8 in Chrome, SpiderMonkey in Firefox, and Chakra in Edge. Each engine is like a language module for its application, allowing it to support a certain subset of the JavaScript language.

A JavaScript engine to a browser is like language comprehension to a person

**JavaScript runtime**: The environment in which the JavaScript code runs and is interpreted by a JavaScript engine.The runtime provides the host objects that JavaScript can operate on and work with.  
Synonyms: Host environment

### JIT Compiler vs Transpiler

**JIT Compiler (eg in V8 Engine)**

![](https://github.com/atabegruslan/Others/blob/master/Illustrations/jit.png)

https://stackoverflow.com/questions/59807938/the-confusion-with-jit-compilation-in-v8

**Transpiler (eg Babel)**

A transpiler converts codes that are at similar levels of abstraction. Eg: ES6 code to ES5 code.

### Query params

#### How web browsers parse query params

![](https://github.com/atabegruslan/Others/blob/master/Illustrations/webserver_handle_query_params.png)

#### Best practices

https://stackoverflow.com/questions/611906/http-post-with-url-query-parameters-good-idea-or-not

### Detect mobile in web

- https://github.com/atabegruslan/Others/blob/master/Illustrations/android_detection_in_web.pdf

### Notes of interest regarding JS syntax:

#### Constants

https://www.infragistics.com/community/blogs/b/dhananjay_kumar/posts/how-to-create-constants-in-javascript

#### Check empty

https://levelup.gitconnected.com/different-ways-to-check-if-an-object-is-empty-in-javascript-e1252d1c0b34

#### Object to Array:

1. `Object.assign({}, ['a','b','c']); // {0:"a", 1:"b", 2:"c"}`

2. ES6 spread syntax: `{ ...['a', 'b', 'c'] }`

3. Array's map function
resp.data.data is the object:
```js
let listOfObjects = Object.keys(resp.data.data).map((key) => {
	return resp.data.data[key]
})
```

4. Array's reduce function: https://dev.to/afewminutesofcode/how-to-convert-an-array-into-an-object-in-javascript-25a4

#### Good Practices

https://www.youtube.com/watch?v=Mus_vwhTCq0

#### Destructuring and related techniques

https://stackoverflow.com/questions/22202766/keeping-only-certain-properties-in-a-javascript-object

### Debug

#### Live debug. 

Limit by IP Address

Use: https://www.ip2location.com/

```php
if ('14.161.26.170' == $_SERVER['REMOTE_ADDR'])
{
     // Debug code
}
```

#### Dump out debug messages

```php
ob_flush();
ob_start();
var_dump($session->get('auto_extended', 'default'));
file_put_contents("/home/genbrugsauktion/public_html/filename" . date("YFd_H-i-s") . ".txt", ob_get_flush());
```

```php
$myfile = fopen("C:/Users/Victor/Desktop/filename" . date("YFd_H-i-s") . rand(1, 99999) . ".txt", "w");
fwrite($myfile, debug_backtrace()[0]['file'] . ' | ' . debug_backtrace()[0]['line']);
fclose($myfile);
```

```php
echo '<pre>';
print_r($results);
echo '</pre>';
die();
```

```php
file_put_contents("/home/ruslan/Desktop/filename" . date("YFd_H-i-s") . ".txt", serialize($validData));
```

```php
$output = "|   |   |   |   |\n|---|---|---|---|\n";
foreach (debug_backtrace() as $stack)
{
  $output .= ' | ' . $stack['file'] . ' | ' . $stack['class'] . ' | ' . $stack['function'] . ' | ' . $stack['line'] . ' | ' . "\n";
}
var_dump($output);
file_put_contents("C:/Users/Victor/Desktop/stacktrace" . date("YFd_H-i-s") . rand(1, 99999) . ".md", $output);
```

### PUT and DELETE

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

### Prevent Resubmission

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

### Git submodule

Example: `git submodule add -b develop https://travisredweb:travisredweb2013github@github.com/redCOMPONENT-COM/redCORE build/redCORE`

### Joomla ORM DDL, Updates with FKs

Joomla PHP DB ORM code, need both before modifying FK restricted data:
```
$db->setQuery('SET FOREIGN_KEY_CHECKS=0;')->execute();
$db->setQuery("ALTER TABLE table_name DROP FOREIGN KEY fk_name;")->execute();
```

### Server quirks

HTTP is case-sensitive and the local filesystem isn't.  
Many servers cater for case imperfections.  
http://stackoverflow.com/questions/6852277/case-sensitive-urls-how-to-make-them-insensitive 

### JS call, apply and bind

- https://www.codementor.io/@niladrisekhardutta/how-to-call-apply-and-bind-in-javascript-8i1jca6jp
- https://stackoverflow.com/questions/15455009/javascript-call-apply-vs-bind

### Paradigms

Declarative - what, Imperative - how

### Reading HTTP request body from a JSON POST in PHP

```php
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);
```

### Dates and Times

- https://en.wikipedia.org/wiki/List_of_tz_database_time_zones
- https://stackoverflow.com/questions/39508963/calculate-difference-between-two-dates-using-carbon-and-blade
- https://stackoverflow.com/questions/13845554/php-date-get-name-of-the-months-in-local-language
