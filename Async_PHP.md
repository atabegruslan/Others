# Handle async requests

- https://amp.reddit.com/r/PHP/comments/bmrfiq/reactphp_vs_swoole_vs_ratchet_vs_amp_which_do_you/
- https://www.zend.com/blog/why-you-should-use-asynchronous-php

## Swoole

### Plain PHP

- https://www.swoole.co.uk/docs/get-started/installation
- https://www.swoole.co.uk/

### Laravel

1. Make a API route. In `routes/api.php`
```php
Route::get('/test', function() {
    return \App\Models\User::all();
});
```

Accessed by `GET localhost:8888/proj/public/api/test`

According to POSTMAN, it takes an average of 240ms

2. Install Swoole

- https://www.youtube.com/watch?v=dx9k-ciI8ho
- https://www.swoole.co.uk/article/laravel
- THE tutorial: https://laravel-news.com/laravel-swoole

Now accessed by `GET 127.0.0.1:1215/api/test`

According to POSTMAN, it takes an average of 30ms

- https://www.zend.com/blog/swoole
- https://github.com/swoole/swoole-src
- https://www.medianova.com/en-blog/2020/03/18/swoole-installation-and-laravel
- https://stackoverflow.com/questions/51120098/how-to-install-swoole-in-mac-os

## ReactPHP

---

# Make asynchronous work

## Process 

### Plain PHP

- https://divinglaravel.com/asynchronous-php

### Spatie

- https://github.com/spatie/async

## Queue 

https://stackoverflow.com/questions/14236296/asynchronous-function-call-in-php

### Plain PHP

- https://devcenter.heroku.com/articles/php-workers

### Laravel

- https://www.youtube.com/watch?v=fFy-s7_SbYM

---

# Make async http requests

## Async Guzzle

- https://www.geeksforgeeks.org/how-to-make-asynchronous-http-requests-in-php/
- https://jeromejaglale.com/doc/php/laravel_asynchronous_guzzle_requests_using_promises
- https://medium.com/@ardanirohman/how-to-handle-async-request-concurrency-with-promise-in-guzzle-6-cac10d76220e

## Socket and log file

- https://segment.com/blog/how-to-make-async-requests-in-php/
	- https://stackoverflow.com/questions/124462/how-to-make-asynchronous-http-requests-in-php/2924987#2924987
