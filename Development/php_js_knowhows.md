# PHP

## Composer

### Setup

https://github.com/atabegruslan/Others/blob/master/Development/setup_developer_ubuntu_computer.md#composer

### Usage

- https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/composer/

#### Autoload

1. https://viblo.asia/p/php-autoloading-psr4-and-composer-V3m5Wy0QZO7
2. https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/composer/autoload.pdf

## Debug

### Live debug. 

Limit by IP Address

Use: https://www.ip2location.com/

```php
if ('14.161.26.170' == $_SERVER['REMOTE_ADDR'])
{
     // Debug code
}
```

### Dump out debug messages

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

### Force out a Guzzle Request Exception

`throw new \GuzzleHttp\Exception\RequestException('test', new \GuzzleHttp\Psr7\Request('dummy', '', [], null, []));`

https://www.howtobuildsoftware.com/index.php/how-do/zlV/guzzle-how-to-create-own-requestexception-in-guzzle

## Reading HTTP request body from a JSON POST in PHP

```php
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);
```

## Make file from binary

```php
$pdf_base64 = "binary_string_inside.txt";
//Get File content from txt file
$pdf_base64_handler = fopen($pdf_base64,'r');
$pdf_content = fread($pdf_base64_handler, filesize($pdf_base64));
fclose ($pdf_base64_handler);
//Decode pdf content
$pdf_decoded = base64_decode($pdf_content);
//Write data back to pdf file
$pdf = fopen('document.pdf','w');
fwrite ($pdf, $pdf_decoded);
```

## Dates and Times

### Timezone standards

- https://en.wikipedia.org/wiki/List_of_tz_database_time_zones
	- IANA timezones: https://en.wikipedia.org/wiki/Tz_database
- https://www.timeanddate.com/time/gmt-utc-time.html

### Functions

- `date()` & other scattered functions:
	- https://www.php.net/manual/en/function.date.php
	- https://www.w3schools.com/php/php_date.asp
	- https://www.w3schools.com/php/php_ref_date.asp
- `DateTime`: 
	- https://www.php.net/manual/en/book.datetime.php
		- https://www.php.net/manual/en/class.datetime.php
	- https://www.php.net/manual/en/datetime.construct.php
- `nesbot/carbon`: https://carbon.nesbot.com/

Example of DateTime usage:

![](/Illustrations/Development/php/datetime_example.PNG)

### misc others

- https://stackoverflow.com/questions/39508963/calculate-difference-between-two-dates-using-carbon-and-blade
- https://stackoverflow.com/questions/13845554/php-date-get-name-of-the-months-in-local-language
- https://www.codexworld.com/how-to/add-days-to-date-in-php/
- https://stackoverflow.com/questions/2891937/strtotime-doesnt-work-with-dd-mm-yyyy-format
- https://stackoverflow.com/questions/54347430/laravel-carbon-get-next-occurrence-of-particular-date-from-current-date

## Sessions, Tokens, Auth

- https://github.com/Ruslan-Aliyev/auth
- https://www.youtube.com/watch?v=7Q17ubqLfaM
- https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/php/session/session_start.pdf
- https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/php/session/persistent_cookie.pdf
- https://github.com/atabegruslan/Trip-Blog-Plain-PHP-MVC#oauth2-theory

## Concurrency

- In DB: https://github.com/atabegruslan/Others/blob/master/Storage/db.md#concurrency
- In Code
  - Semaphore: http://www.re-cycledair.com/php-dark-arts-semaphores
    - In detail: https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/php/semaphore.php
  - Flock: https://locallost.net/?p=1091
  - Critical sections: 
    - **PHP handles each request in a separate process that don't share memory address space**
    - So solutions include:
      - DB: fastest, safest
      - Filesystem: creating file
      - Server cache: http://php.net/manual/en/book.apc.php

## `array_filter`

- https://appdividend.com/2019/04/04/php-array_filter-example-array_filter-function-tutorial/

## Make CSV and download directly

- https://stackoverflow.com/questions/32441327/csv-export-in-laravel-5-controller/32441846#32441846

## Rounding numbers

- Methods: https://findnerd.com/list/view/Different-ways-to-round-number-to-2-decimal-places-in-PHP/13665/
- Rounding issue: https://stackoverflow.com/questions/33225193/php-round-not-working-properly
  - https://stackoverflow.com/questions/14587290/can-i-rely-on-php-php-ini-precision-workaround-for-floating-point-issue
- BC Functions: 
	- https://www.php.net/manual/en/ref.bc.php
	- https://sodocumentation.net/php/topic/8550/bc-math--binary-calculator-

## Versions

- https://www.youtube.com/watch?v=3Be2T5dhN0A

## Others

https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/php/

# JS

## Call, apply & bind

- https://www.codementor.io/@niladrisekhardutta/how-to-call-apply-and-bind-in-javascript-8i1jca6jp
- https://stackoverflow.com/questions/15455009/javascript-call-apply-vs-bind
- https://www.youtube.com/watch?v=c0mLRpw-9rI&list=PL7pEw9n3GkoW5bYOhVAtmJlak3ZK7SaDf&index=6

## Map, Reduce & Filter

- https://www.freecodecamp.org/news/javascript-map-reduce-and-filter-explained-with-examples/
- https://www.youtube.com/watch?v=rRgD1yVwIvE

## Check empty

https://levelup.gitconnected.com/different-ways-to-check-if-an-object-is-empty-in-javascript-e1252d1c0b34

## Object to Array:

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

## Sleep

https://stackoverflow.com/questions/951021/what-is-the-javascript-version-of-sleep/39914235#39914235

```js
function sleep(ms) 
{
	return new Promise(resolve => setTimeout(resolve, ms));
}

await sleep(1000);
```

## Polling

```js
var thereYet = false;
var intervalName = setInterval(function() {
    if ( /* "there yet" condition */ ) 
    {
        thereYet = true;
    }
    
    if (thereYet) 
    {
        clearInterval(intervalName);
    }

    // Do action
}, 100);
```

## AJAX with recursion

https://stackoverflow.com/questions/19332049/while-loop-with-jquery-async-ajax-calls/19332078#19332078

```js
function recursive_function()
{
	$.ajax({
	    ...,
	    async: true,
	    success: function(res) {
		if ( NOT DONE ) 
		{
		    recursive_function();
		}
		else
		{
		    // DONE
		}
	    }
	});
}
```

## Differentiate browser refresh, visiting new website, forward, back

- https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/js/refresh_navigate_leave.html
- https://developer.mozilla.org/en-US/docs/Web/API/PerformanceNavigationTiming/type
- How to override unload over the years: https://stackoverflow.com/questions/1119289/how-to-show-the-are-you-sure-you-want-to-navigate-away-from-this-page-when-ch/1119324#1119324
- Detect different domain: https://stackoverflow.com/questions/7162300/how-can-i-detect-when-the-user-is-leaving-my-site-not-just-going-to-a-different/7162766#7162766
- React: https://dev.to/eons/detect-page-refresh-tab-close-and-route-change-with-react-router-v5-3pd
- Remove unload event listener: https://stackoverflow.com/questions/39094138/reactjs-event-listener-beforeunload-added-but-not-removed/39094299#39094299

## Download direct with AJAX

- https://stackoverflow.com/questions/60044205/download-response-data-as-stream-w-axios-in-react-app
- https://stackoverflow.com/questions/4545311/download-a-file-by-jquery-ajax

## Typed Arrays

- https://developer.mozilla.org/en-US/docs/Web/JavaScript/Typed_arrays
- https://stackoverflow.com/questions/3195865/converting-byte-array-to-string-in-javascript
- https://www.youtube.com/watch?v=UYkJaW3pmj0
- https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/DataView

## Destructuring and related techniques

https://stackoverflow.com/questions/22202766/keeping-only-certain-properties-in-a-javascript-object

## Eval

https://www.w3schools.com/jsref/jsref_eval.asp

But try not to use it, it may execute malicious code.

## Merge two Arrays and Remove Duplicates

https://thispointer.com/5-ways-to-merge-two-arrays-and-remove-duplicates-in-javascript/

## Deep-merge 2 objects

https://gist.github.com/ahtcx/0cd94e62691f539160b32ecda18af3d6

### with nested arrays

```js
const merge = (target, source) => {
  for (const key of Object.keys(source))
  {
    if (Array.isArray(source[key]))
    {
      Object.assign(source[key], [...new Set(target[key].concat(source[key]))]);
    }

    if (source[key] instanceof Object && !Array.isArray(source[key]))
    {
      Object.assign(source[key], merge(target[key], source[key]));
    }
  }

  Object.assign(target || {}, source)
  
  return target
}
```

## Get caret position in text area

https://github.com/atabegruslan/Others/blob/master/Development/js/get_caret_position.html

## Good Practices

https://www.youtube.com/watch?v=Mus_vwhTCq0

## Weird Parts Explained

- https://www.youtube.com/playlist?list=PLGnv0UtYYEZbfGp7Trh2xyGxyWaH71XyP
- https://www.youtube.com/playlist?list=PL7pEw9n3GkoW5bYOhVAtmJlak3ZK7SaDf

## History

![](/Illustrations/Development/js/history.PNG)

- https://www.w3schools.com/Js/js_history.asp
- https://www.codesdope.com/blog/article/javascript-es5-vs-es6/
- https://www.javatpoint.com/es5-vs-es6

JavaScript mostly implements the ECMAScript specification.  
More info about JS vs ECMAScript: https://www.freecodecamp.org/news/whats-the-difference-between-javascript-and-ecmascript-cba48c73a2b5/

## JS Terminology

**JavaScript engine**: A program or interpreter that understands and executes JavaScript code.  
Synonyms: JavaScript interpreter, JavaScript implementation

V8 in Chrome, SpiderMonkey in Firefox, and Chakra in Edge. Each engine is like a language module for its application, allowing it to support a certain subset of the JavaScript language.

A JavaScript engine to a browser is like language comprehension to a person

**JavaScript runtime**: The environment in which the JavaScript code runs and is interpreted by a JavaScript engine.The runtime provides the host objects that JavaScript can operate on and work with.  
Synonyms: Host environment

## JIT Compiler vs Transpiler

**JIT Compiler (eg in V8 Engine)**

A compiler compiles a language to bytecode at compile-time. Then the JIT-compiler compiles bytecode to native code at runtime.

https://stackoverflow.com/questions/59807938/the-confusion-with-jit-compilation-in-v8

**Transpiler (eg Babel)**

A transpiler converts codes that are at similar levels of abstraction. Eg: ES6 code to ES5 code.

# Node.js & NPM

## Modules

- CommonJS (Node.js, `require()` & `module.exports`) vs ES modules (browser, `import` & `export`): https://blog.logrocket.com/commonjs-vs-es-modules-node-js/ 
  - `require` vs `import`: https://flexiple.com/javascript-require-vs-import/
- Newer Node supports ES modules experimentally: https://stackoverflow.com/questions/43622337/using-import-fs-from-fs/43622412#43622412
- CommonJS, AMD & ES: https://medium.com/computed-comparisons/commonjs-vs-amd-vs-requirejs-vs-es6-modules-2e814b114a0b
  - https://stackoverflow.com/questions/34866510/building-a-javascript-library-why-use-an-iife-this-way/34866603#34866603
- UMD, unpkg: https://tutorial.tips/how-to-load-any-npm-module-in-browser/
- Importing a module's CSS: https://stackoverflow.com/questions/49518277/import-css-from-node-modules-in-webpack/49523565#49523565
  - Or like `import 'bootstrap/dist/css/bootstrap.min.css';` with `bootstrap` folder being located in `./node_modules/bootstrap/...`
- Webpack: https://webpack.js.org/api/module-methods/
- `package.json`'s `browser`: https://docs.npmjs.com/cli/v8/configuring-npm/package-json#browser
- Issue: "cannot use import statement outside a module": https://www.google.com/search?q=cannot+use+import+statement+outside+a+module

## Publish modules to npmjs

https://zellwk.com/blog/publish-to-npm/

`npm login`.  
It will ask for your NPM username, email and password and email you an OTP.  
Then `npm publish`.  

### Create Organization

https://docs.npmjs.com/creating-an-organization

### Publishing scoped public packages

https://docs.npmjs.com/creating-and-publishing-scoped-public-packages#publishing-scoped-public-packages 

## Force "downstream" dependencies' versions

### Overrides

Only works for NPM  >= v8.3

- https://www.stefanjudis.com/today-i-learned/how-to-override-your-dependencys-dependencies/
- https://docs.npmjs.com/cli/v8/configuring-npm/package-json#overrides

#### What you can do:

**Constrict dependency version**

```
"overrides": {
  "node-ipc@>9.2.1 <10": "9.2.1"
}
```

So that `node-ipc` of any version between 9.2.1 and 10 will be made to be v9.2.1

**Override "downstream" module**

```
"overrides": {
  "bar": {
    "foo": "1.0.0"
  }
}
```

Override `foo` to be 1.0.0 when it's a child (or grandchild, or great grandchild, etc) of the package `bar`.

There is another way of accomplishing the above: https://docs.npmjs.com/cli/v8/commands/npm-shrinkwrap

### Shrink Wrap

- https://www.youtube.com/watch?v=_Q9iHA8p3yE
- https://www.youtube.com/watch?v=9sITN5JcqfI

## package.json

### Local modules

In `./local_modules/@whatever-optional-namespace/local-module-name/package.json`
```
{
  "name": "local-module-name",
```

`npm i -S ./local_modules/@whatever-optional-namespace/local-module-name`

The following will be generated in `./package.json`
```
{
  "name": "whatever",
  "dependencies": {
    "@whatever-optional-namespace/local-module-name": "file:local_modules/@whatever-optional-namespace/local-module-name"
  },
```

Now your local module is in.

### Use forked NPM modules

- https://www.pluralsight.com/guides/how-to-use-forked-npm-dependencies
- https://dev.to/paddy57/how-to-fork-github-repository-and-use-as-npm-dependency-inside-a-react-native-project-2j21

For example, just put in the Github link (or a community-fork of it, or your own fork of it)

```
"dependencies": {
  "react-js-pagination": "https://github.com/wwwaiser/react-js-pagination.git",
```

This becomes useful when your dependency-module's develop haven't yet updated their work on `npmjs.com`.

### Pre and Post Scripts

- https://www.youtube.com/watch?v=kwn7tHJJoLA
- https://docs.npmjs.com/cli/v9/using-npm/scripts#pre--post-scripts
- Caution: https://www.youtube.com/watch?v=4vIhgaEMtOk
- Relevant: https://stackoverflow.com/questions/43664200/what-is-the-difference-between-npm-install-and-npm-run-build

## Process manager

PM2: 

- https://www.youtube.com/watch?v=yPd9sds9lJ4 (Very Good)
- https://www.youtube.com/watch?v=zrfRDGdp7Po&list=PLdHg5T0SNpN38gy5xZ0PVEaDdZXlPkgP9&index=6

# Others

## Constants

- JS: https://www.infragistics.com/community/blogs/b/dhananjay_kumar/posts/how-to-create-constants-in-javascript
- PHP: 
	- https://stackoverflow.com/questions/2447791/define%C2%ADvs%C2%ADconst
	- https://www.w3schools.com/php/func_misc_constant.asp

## Query Params

- JS: https://developer.mozilla.org/en-US/docs/Web/API/URLSearchParams/delete#examples
- PHP: https://stackoverflow.com/questions/4937478/strip-off-url-parameter-with-php/45713333#45713333

## Convert hyphen <-> camel case

- JS: https://stackoverflow.com/questions/6660977/convert-hyphens-to-camel-case-camelcase
- PHP: https://stackoverflow.com/questions/2791998/convert-dashes-to-camelcase-in-php

## Rid diacritics

https://github.com/atabegruslan/Others/blob/master/Security/encode.md#rid-diacritics

## RegEx

http://www.regular-expressions.info/charclassintersect.html

## Carousel

One example: https://github.com/atabegruslan/Others/blob/master/Development/js/owl.html
