# Handle async requests

- https://amp.reddit.com/r/PHP/comments/bmrfiq/reactphp_vs_swoole_vs_ratchet_vs_amp_which_do_you
- https://www.zend.com/blog/why-you-should-use-asynchronous-php

## Swoole

https://www.swoole.com/#http
```php
$http = new Swoole\Http\Server('127.0.0.1', 9501);

$http->on('start', function ($server) {
    echo "Swoole http server is started at http://127.0.0.1:9501\n";
});

$http->on('request', function ($request, $response) {
    $response->header('Content-Type', 'text/plain');
    $response->end('Hello World');
});

$http->start();
```

### Plain PHP

- https://www.swoole.co.uk/docs/get-started/installation
- https://openswoole.com
- https://www.youtube.com/watch?v=NbgyPAiop9k
- https://www.youtube.com/watch?v=nbBDxYEI35k

### Laravel

1. Make a API route. In `routes/api.php`
```php
Route::get('/test', function() {
    return \App\Models\User::all();
});
```

API can be accessed by `GET localhost/project/public/api/test`

According to POSTMAN, it takes an average of 240ms

2. Install Swoole

Run `pecl install swoole`

Use `php -i | grep php.ini` to find the correct `php.ini`

Add `extension=swoole.so` into `php.ini`

Run `composer require swooletw/laravel-swoole`

Add `SwooleTW\Http\LaravelServiceProvider::class` to the `providers` array of `config/app.php`

Run `php artisan vendor:publish --tag=laravel-swoole`

Run `php artisan swoole:http start`

Now API can be accessed by `GET 127.0.0.1:1215/api/test`

According to POSTMAN, it takes an average of 30ms

- Tutorials
	- https://www.youtube.com/watch?v=dx9k-ciI8ho
	- https://www.swoole.co.uk/article/laravel
	- https://laravel-news.com/laravel-swoole <sup>good</sup>
	- https://www.zend.com/blog/swoole
	- https://github.com/swoole/swoole-src
	- https://www.medianova.com/en-blog/2020/03/18/swoole-installation-and-laravel
	- https://stackoverflow.com/questions/51120098/how-to-install-swoole-in-mac-os
	- https://github.com/UniSharp/laravel-swoole-http/blob/master/docs/english.md

## FrankenPHP

### Laravel Octane

- https://laravel.com/docs/11.x/octane
- https://www.youtube.com/watch?v=s5mTa8df6rY
- https://www.youtube.com/watch?v=YGBvdAWt0W8

## ReactPHP

https://reactphp.org
```php
<?php

// $ composer require react/http react/socket # install example using Composer
// $ php example.php # run example on command line, requires no additional web server

require __DIR__ . '/vendor/autoload.php';

$http = new React\Http\HttpServer(function (Psr\Http\Message\ServerRequestInterface $request) {
    return React\Http\Message\Response::plaintext(
        "Hello World!\n"
    );
});

$socket = new React\Socket\SocketServer('127.0.0.1:8080');
$http->listen($socket);

echo "Server running at http://127.0.0.1:8080" . PHP_EOL;
```

## Plain PHP

https://gist.github.com/greut/949850

---

# Websockets

Some Websocket libraries are built atop those async technologies

## Plain PHP

- https://tsh.io/blog/php-websocket (GOOD)
- https://dev.to/robertobutti/websocket-with-php-4k2c
- https://stackoverflow.com/questions/14512182/how-to-create-websockets-server-in-php

## Laravel

- Ably
- Pusher
- Laravel Websockets (free Pusher, made obsolete by Reverb): https://github.com/Ruslan-Aliyev/laravel-websockets
- Reverb (built atop ReactPHP)
    - https://www.youtube.com/watch?v=TkYXIHgdrgA
    - https://www.youtube.com/watch?v=rMtlrsnChxw 

## JS

- Echo
- Soketi

# SSE

![](/Illustrations/Development/sse_vs_ws.png)

- https://www.youtube.com/watch?v=1cFyfT0m3bA
- https://www.youtube.com/watch?v=4HlNv1qpZFY
- https://www.youtube.com/watch?v=6QnTNKOJk5A

---

# Chat

Chat normally relies on Websockets

**Websockets**

- https://www.youtube.com/watch?v=1BfCnjr_Vjg

**Socket IO**

- https://socket.io/docs/v4
- https://socket.io/docs/v4/client-socket-instance

**Check Socket IO with Postman**

- https://github.com/atabegruslan/Others/blob/master/Development/socketio_postman.md

**Socket IO with Auth**

Backend

```
const socketIo = require("socket.io")(server);
socketIo.on("connection", (socket) => {
    // Here you have 
    //      socket.handshake.query      POSTMAN params
    //      socket.handshake.headers    POSTMAN headers
    //      socket.handshake.auth       Not supported in POSTMAN yet, but can via code. https://stackoverflow.com/a/70975533
```

Frontend

```
const socket = io.connect('https://{domain}',{
    auth: {
        username, password
    }
})
```

https://viblo.asia/p/authentication-cho-socketio-maGK78n9Zj2

**Examples**

- PHP, Ratchet: https://github.com/Ruslan-Aliyev/chat-php-ratchet
- Laravel Websockets: https://medium.com/@lfoster49203/building-real-time-applications-with-laravel-and-websockets-1f0e4465ef3a
- Laravel Chatify: https://www.youtube.com/watch?v=9tj7sz-JF3Q
- Node, WebSocket: https://github.com/Ruslan-Aliyev/chat-NodeJS-WebSocket
- Node, socket.io: https://github.com/Ruslan-Aliyev/chat-NodeJS-SocketIo
- Node, React, socket.io: https://github.com/Ruslan-Aliyev/chat-NodeJS-ReactJS-SocketIo
- Strapi v4, React, socket.io: https://github.com/Ruslan-Aliyev/chat-Strapi-ReactJS-SocketIo
- Node, React Native, socket.io: https://github.com/Ruslan-Aliyev/chat-NodeJS-ReactNative-SocketIo
- Strapi v4, React Native, socket.io: https://github.com/Ruslan-Aliyev/chat-Strapi-ReactNative-SocketIo
- Java: https://github.com/Ruslan-Aliyev/chat-java
- Express, React, socket.io: https://www.freecodecamp.org/news/build-a-realtime-chat-app-with-react-express-socketio-and-harperdb
- Zendesk: https://developer.zendesk.com/documentation/apps/build-an-app/build-your-first-chat-app/part-1-laying-the-groundwork
	- https://en.wikipedia.org/wiki/Zendesk

**Ones that don't rely on Websockets**

- PHP, AJAX: https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/another_php_ajax_chat_app_tutorial.txt
- RabbitMQ & PHP: https://github.com/Ruslan-Aliyev/chat-php-rabbitmq

## WebRTC

![](/Illustrations/Development/webrtc_theory.png)

### Free STUN servers

- stun.l.google.com: 19302
- stun1.l.google.com: 19302
- stun2.1.google.com: 19302
- stun3.l.google.com: 19302
- stun4.l.google.com: 19302
- stun01.sipphone.com
- stun.ekiga.net
- stun.fwdnet.net

### Basic WebRTC (intrinsic to every modern web browser)

- https://www.youtube.com/watch?v=g42yNO_dxWQ
    - https://github.com/robertbunch/webrtc-starter
- https://www.youtube.com/watch?v=WmR9IMUD_CY
    - https://github.com/fireship-io/webrtc-firebase-demo
- https://www.youtube.com/watch?v=SsN4gl_wV_8&list=PLsOU6EOcj51fvJK7Z5sb5qM57NU8vYhTy

### Using a library wrapping around WebRTC

- Using the `simple-peer` library: 
    - https://www.youtube.com/watch?v=BpN6ZwFjbCY
        - https://github.com/coding-with-chaim/react-video-chat
- Other libraries: https://www.quora.com/Which-is-the-best-WebRTC-JavaScript-library-PeerJS-or-EasyRTC

- WebRTC & React Native: 
    - https://www.youtube.com/watch?v=r-IlbcKoSRg
    - https://github.com/react-native-webrtc/react-native-webrtc
        - https://unpkg.com/browse/@livekit/react-native-webrtc@125.0.4
        - https://unpkg.com/browse/react-native-webrtc@1.69.0

### Using a WebRTC platform

- Using the Daily Co platform: https://www.daily.co
    - https://dashboard.daily.co
- Other platforms: https://www.zegocloud.com/blog/webrtc-api

Comparing pure WebRTC to a WebRTC platform: https://www.videosdk.live/webrtc-vs-daily

### Daily Co
- Tutorials:
    - https://docs.daily.co/guides/products/client-sdk#demo-apps-and-tutorials
    - https://github.com/daily-demos
        - https://docs.daily.co/guides/products/audio-only
    - https://www.youtube.com/watch?v=EukhMNNosXw
        - https://github.com/michaelkitas/Dailyco-Video-Chat
- Support:
    - https://www.daily.co/company/contact/support
- Common problems:
    - Cant use Expo Go
        - https://stackoverflow.com/questions/78806644/cant-use-webrtc-on-expo-go
        - https://www.daily.co/blog/deploying-webrtc-on-an-expo-react-native-app-2

#### HTML & JS:
- Requires:
    - `<script crossorigin src="https://unpkg.com/@daily-co/daily-js"></script>`
- Simplest HTML example: https://gist.github.com/atabegruslan/05b22b00ac2fc3cb3428fc3549d41b54
- Documentations: 
    - https://docs.daily.co/reference/daily-js
        - https://docs.daily.co/reference/daily-js/daily-call-client/properties
        - https://docs.daily.co/reference/daily-js/instance-methods
            - https://docs.daily.co/reference/daily-js/instance-methods/set-local-audio
- Tutorials:
    - https://github.com/daily-demos/daily-samples-js/tree/main/samples/client-sdk/getting-started-daily-js
- Common problems:
    - https://stackoverflow.com/questions/30014090/uncaught-typeerror-cannot-read-property-appendchild-of-null/58824439#58824439

#### NodeJS:
- Requires:
    - `@daily-co/daily-js`
- Documentations:
    - https://www.npmjs.com/package/@daily-co/daily-js/v/0.9.4-beta.1
- Tutorials:
    - https://www.daily.co/blog/deploy-a-daily-co-backend-node-js-server-instantly
- Common problems:
    - https://github.com/daily-co/daily-js/?tab=readme-ov-file#strictmode-false-will-no-longer-allow-multiple-call-instances

#### ReactJS
- Requires:
    - `"@daily-co/daily-js": "^0.73.0",`
    - `"@daily-co/daily-react": "^0.22.0",`
        - https://www.npmjs.com/package/@daily-co/daily-react
        - https://docs.daily.co/reference/daily-react
- Tutorials:
    - https://dev.to/trydaily/build-a-video-chat-app-in-minutes-with-react-and-daily-js-481c
    - https://github.com/kimberleehowley/daily-demos/blob/master/react-demo/src/index.js
    - https://www.daily.co/blog/building-a-custom-video-chat-app-with-react
- Common problems:
    - https://docs.daily.co/reference/daily-react/use-call-frame

#### React Native
- Requires:
    - `"@config-plugins/react-native-webrtc": "^8.0.0",`        
    - `"@daily-co/config-plugin-rn-daily-js": "^0.0.5",`        
    - `"@daily-co/react-native-daily-js": "^0.70.0",`          
        - https://docs.daily.co/reference/rn-daily-js 
        - https://docs.daily.co/reference/rn-daily-js/daily-call-client/properties
    - `"@daily-co/react-native-webrtc": "118.0.3-daily.2",`  
- Tutorials:
    - https://github.com/daily-demos/daily-expo-demo    

#### Non Coding
- Tutorials:
    - https://medium.com/geekculture/easiest-way-to-add-daily-co-video-call-support-to-your-react-app-19ad97441df3

# Make asynchronous work

## Process 

### Plain PHP

`composer require symfony/process`

`index.php`
```php
<?php
require "vendor/autoload.php";
use Symfony\Component\Process\Process;

$process = new Process(['php', 'process.php']);
$process->start();

echo 2;

while ($process->isRunning())
{
    sleep(1);
}

echo $process->getOutput();
```

`process.php`
```php
<?php
sleep(10);
echo 1;
```

- Tutorials
	- https://divinglaravel.com/asynchronous-php
	- https://tomasvotruba.com/blog/2018/02/05/how-to-run-symfony-processes-asynchronously/
	- https://symfony.com/doc/current/components/process.html

### Spatie

- https://github.com/spatie/async

`composer require spatie/async`

```php
<?php

require "vendor/autoload.php";

use Spatie\Async\Pool;

$pool = Pool::create();

$pool
    ->add(function () {
        sleep(10);
        return 1;
    })
    ->then(function ($output) {
        echo $output;
    })
    ->catch(function ($exception) {
        var_dump($exception);
    });

echo 2;

$pool->wait();
```

## Threads

- https://stackoverflow.com/questions/70855/how-can-one-use-multi-threading-in-php-applications
- https://blog.programster.org/php-multithreading-pool-example
- https://www.php.net/manual/en/book.pthreads.php

## Queue 

https://stackoverflow.com/questions/14236296/asynchronous-function-call-in-php

### Plain PHP

- https://devcenter.heroku.com/articles/php-workers

### Laravel

- https://github.com/Ruslan-Aliyev/laravel-queue

---

# Make async requests

## Async Guzzle

Theory: https://stackoverflow.com/questions/35655616/how-does-guzzle-send-async-web-requests

**Regular cURL**
```php
<?php

// https://jsonplaceholder.typicode.com/
$url = 'https://jsonplaceholder.typicode.com/posts';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$response = curl_exec($ch);
curl_close($ch);

var_dump($response);

// ---

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$payload = json_encode(["title" => "foo", "body" => "bar", "userId" => 1]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Content-Length: ' . strlen($payload)]);

$response = curl_exec($ch);
curl_close($ch);

var_dump($response);
```

**Regular Guzzle**

`guzzlehttp/guzzle`

```php
<?php
// https://jsonplaceholder.typicode.com/
$base_url = 'https://jsonplaceholder.typicode.com';
$path = '/posts';

require "vendor/autoload.php";

use GuzzleHttp\Client;

// GET
$client = new Client([
    'base_uri' => $base_url,
]);
$response = $client->request('GET', $path, [
    // 'query' => [
    //     'param' => 'blah',
    // ]
]);
if ($response->getStatusCode() === 200)
{
	$body = $response->getBody();
	$arr_body = json_decode($body);
	var_dump($arr_body);
}

// POST
$client = new Client([
    'base_uri' => $base_url,
]);
$response = $client->request('POST', $path, [
    'json' => ["title" => "foo", "body" => "bar", "userId" => 1]
]);
if ($response->getStatusCode() === 200)
{
	$body = $response->getBody();
	$arr_body = json_decode($body);
	var_dump($arr_body);
}
```

**Async Guzzle**

```php
<?php

// https://jsonplaceholder.typicode.com/
$base_url = 'https://jsonplaceholder.typicode.com';
$path = '/posts';

require "vendor/autoload.php";

use GuzzleHttp\Client;

// GET
$client = new Client();

// start request
$promise = $client->getAsync($base_url.$path)->then(
    function ($response) {
        echo 'test';
        sleep(10);echo 'test2';return;
        return $response->getBody();
    }, function ($exception) {
        return $exception->getMessage();
    }
);
 
// do other things
echo '<b>This will not wait for the previous get request to finish to be displayed!</b>';
 
// wait for request to finish and display its response
$response = $promise->wait();
echo $response;

// POST
$client = new Client();

// start request
$promise = $client->postAsync($base_url.$path, [ 'json' => ["title" => "foo", "body" => "bar", "userId" => 1] ])->then(
    function ($response) {
        return $response->getBody();
    }, function ($exception) {
        return $exception->getMessage();
    }
);
 
// do other things
echo '<b>This will not wait for the previous post request to finish to be displayed!</b>';
 
// wait for request to finish and display its response
$response = $promise->wait();
echo $response;
```

- Tutorials
	- http://artisansweb.net/use-guzzle-php-http-client-sending-http-requests/
	- https://www.geeksforgeeks.org/how-to-make-asynchronous-http-requests-in-php/
	- https://jeromejaglale.com/doc/php/laravel_asynchronous_guzzle_requests_using_promises
	- https://medium.com/@ardanirohman/how-to-handle-async-request-concurrency-with-promise-in-guzzle-6-cac10d76220e

## Socket and log file

- https://segment.com/blog/how-to-make-async-requests-in-php
	- https://stackoverflow.com/questions/124462/how-to-make-asynchronous-http-requests-in-php/2924987#2924987

---

# Workers

- https://github.com/atabegruslan/Others/blob/master/Development/comparisons.md#workers
- https://www.youtube.com/watch?v=-JE8P2TiJEg
- https://docs.deno.com/runtime/manual/runtime/workers#workers
- https://partytown.builder.io/
