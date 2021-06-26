# PHP

## Composer

### Setup

https://github.com/atabegruslan/Others/blob/master/Illustrations/setup_developer_ubuntu_computer.md#composer

### Usage

- https://github.com/atabegruslan/Others/blob/master/Illustrations/composer/

#### Autoload

1. https://viblo.asia/p/php-autoloading-psr4-and-composer-V3m5Wy0QZO7
2. https://github.com/atabegruslan/Others/blob/master/Illustrations/composer/autoload.pdf

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

## Reading HTTP request body from a JSON POST in PHP

```php
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);
```

## Dates and Times

### Timezone standards

- https://en.wikipedia.org/wiki/List_of_tz_database_time_zones
	- IANA timezones: https://en.wikipedia.org/wiki/Tz_database

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

![](https://github.com/atabegruslan/Others/blob/master/Illustrations/php/DateTime-example.jpeg)

### misc others

- https://stackoverflow.com/questions/39508963/calculate-difference-between-two-dates-using-carbon-and-blade
- https://stackoverflow.com/questions/13845554/php-date-get-name-of-the-months-in-local-language
- https://www.codexworld.com/how-to/add-days-to-date-in-php/

## Sessions, Tokens, Auth

- https://github.com/Ruslan-Aliyev/auth
- https://www.youtube.com/watch?v=7Q17ubqLfaM
- https://github.com/atabegruslan/Others/blob/master/Illustrations/php/session/session_start.pdf
- https://github.com/atabegruslan/Others/blob/master/Illustrations/php/session/persistent_cookie.pdf
- https://github.com/atabegruslan/Trip-Blog-Plain-PHP-MVC#oauth2-theory

## Other knowhows

https://github.com/atabegruslan/Others/blob/master/Illustrations/php/

# JS

## Call, apply & bind

- https://www.codementor.io/@niladrisekhardutta/how-to-call-apply-and-bind-in-javascript-8i1jca6jp
- https://stackoverflow.com/questions/15455009/javascript-call-apply-vs-bind

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

## Good Practices

https://www.youtube.com/watch?v=Mus_vwhTCq0

## Destructuring and related techniques

https://stackoverflow.com/questions/22202766/keeping-only-certain-properties-in-a-javascript-object

# Others

## Constants

- JS: https://www.infragistics.com/community/blogs/b/dhananjay_kumar/posts/how-to-create-constants-in-javascript
- PHP: 
	- https://stackoverflow.com/questions/2447791/define%C2%ADvs%C2%ADconst
	- https://www.w3schools.com/php/func_misc_constant.asp

## Convert hyphen <-> camel case

- JS: https://stackoverflow.com/questions/6660977/convert-hyphens-to-camel-case-camelcase
- PHP: https://stackoverflow.com/questions/2791998/convert-dashes-to-camelcase-in-php

## Rid diacritics

https://github.com/atabegruslan/Others/blob/master/Illustrations/encode.md#rid-diacritics

## RegEx

http://www.regular-expressions.info/charclassintersect.html

## Paradigms

- Declarative - what
- Imperative - how
