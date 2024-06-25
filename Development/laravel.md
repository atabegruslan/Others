# Install Laravel

```
composer global require laravel/installer
laravel new app
```
or
```
composer create-project --prefer-dist laravel/laravel app
# composer install
php artisan key:generate
```

# Versions

To check Laravel version:
- https://benjamincrozat.com/check-laravel-version
- See in `/vendors/`: `Illuminate\Foundation\Application::VERSION`

Major changes from Laravel 5 to 10:
- `laravel/ui` has came out in version 5.8 https://github.com/laravel/ui#supported-versions . At this point, you can't use `php artisan make:auth` anymore, instead you need to do: `php artisan ui vue --auth`.
    - Version 8: Jetstream: 
        - https://www.youtube.com/playlist?list=PL8z-YHNIa8wksXALnv_PWPukBAr86pt7n 
        - https://laravel-news.com/jetstream-spatie-permission 
        - https://jetstream.laravel.com/2.x/introduction.html 
        - https://www.youtube.com/watch?v=NiQSNjWKLfU 
        - https://github.com/laravel/jetstream 
        - Laravel Jetstream uses Fortify: 
            - https://github.com/laravel/fortify#introduction 
            - https://www.youtube.com/playlist?list=PLxFwlLOncxFIbxi2gQCN3SR5e3-WB-4T2 
            - Fortify is just backend while Jetstream includes frontend (made from Tailwind with Livewire or Inertia).
        - Followed by Breeze: 
            - https://www.youtube.com/watch?v=3Jdy9rfYqN0 
            - https://www.youtube.com/watch?v=UsyAgb0-_IE 
            - https://www.youtube.com/watch?v=XVxyY_owL_M
            - https://www.grepper.com/answers/390424/laravel+install+breze?ucard=1
            - https://laravel-news.com/laravel-breeze-typescript
- Sanctum ( which uses https://github.com/firebase/php-jwt )
- Blade components: https://dev.to/ericchapman/laravel-blade-components-5c9c
- In version 9.19, Vite became the default bundler (instead of Mix): 
    - https://www.youtube.com/playlist?list=PLDc9bt_00KcJaUEt9_WLioydKazVJwaXZ 
    - https://www.youtube.com/watch?v=KCrXgy8qtjM 
    - https://www.youtube.com/watch?v=epMbfE37014 
    - https://laravel.com/docs/11.x/vite#running-vite
    - https://storybook.js.org/blog/storybook-performance-from-webpack-to-vite
    - https://laracasts.com/discuss/channels/vite/laravel-vite-setup-with-assets
- Mix:
    - https://laravel.com/docs/8.x/mix#introduction
    - https://stackoverflow.com/questions/49392001/laravel-project-auto-refresh-after-changes

## Good tutorials on new (2021) Laravel stuff

- https://www.youtube.com/playlist?list=PLe30vg_FG4OR3b24WlxeTWsj7Z2wOtYrH
- https://www.youtube.com/playlist?list=PLpzy7FIRqpGCl26FcHazZmIUwT7zFJu7U
- https://www.youtube.com/playlist?list=PL36CGZHZJqsXntCJceGN8J2B9wFZD7GFe
- https://www.youtube.com/playlist?list=PLvv7zSkflFHK-31jurIdTca-LXpu-QGKV
- https://www.youtube.com/c/drehimself/playlists
    - https://www.youtube.com/watch?v=9OKbmMqsREc&list=RDCMUCtb40EQj2inp8zuaQlLx3iQ&start_radio=1

## Notable articles

- https://laravel-news.com/laravel-10-4-0
- https://laravel-news.com/laravel-10-17-0
- Laravel 10.43: https://www.youtube.com/watch?v=BrXLbyVJaWw
- https://laravel-news.com/laravel-10-44-0

# Service Provider

https://www.youtube.com/watch?v=VYPfncvYW-Y

![](/Illustrations/Development/laravel/laravel_servicecontainer1.png)

![](/Illustrations/Development/laravel/laravel_servicecontainer2.png)

- https://code.tutsplus.com/tutorials/how-to-register-use-laravel-service-providers--cms-28966
- Then watch these tutorials:
    - https://www.youtube.com/watch?v=urycXvTEnF8&t=1m
    - https://www.youtube.com/watch?v=GqVdt6OWN-Y&list=PL_HVsP_TO8z7aeylCMe64BIx3VEfvPdn&index=34
- Then watch these tutorials:
    - https://www.youtube.com/watch?v=pIWDFVWQXMQ&list=PL_HVsP_TO8z7aey-lCMe64BIx3VEfvPdn&index=33&t=19m35s
    - https://www.youtube.com/watch?v=hy0oieokjtQ&list=PL_HVsP_TO8z7aey-lCMe64BIx3VEfvPdn&index=35
    - https://laravel.com/docs/8.x/container
        - https://laravel.com/docs/4.2/ioc
    - https://medium0.com/@NahidulHasan/laravel-ioc-container-why-we-need-it-and-how-it-works-a603d4cef10f

## Advantages

Better dependency management
- https://christoph-rumpel.com/2019/8/4-ways-the-laravel-service-container-helps-us-managing-our-dependencies

## More articles

- https://www.codementor.io/@decodeweb/laravel-service-providers-explained-in-depth-12uu86s2pq
- https://barryvanveen.nl/articles/34-laravel-service-provider-examples
- https://laravel.com/docs/7.x/container#the-make-method
- https://laravel-news.com/leaning-on-the-container
- https://stackoverflow.com/questions/62870556/how-this-app-singleton-works-in-laravel
- https://www.reddit.com/r/laravel/comments/4c0uew/is_resolving_instead_of_injecting_in_a
- https://dev.to/wilburpowery/resolve-classes-from-laravels-container-1lf4

# Lifecycle

- https://laravel.com/docs/8.x/lifecycle#first-steps
    - https://laravel.com/docs/4.2/lifecycle#request-lifecycle (Summary subsection)

# Notification

- https://github.com/atabegruslan/Laravel_CRUD_API/tree/master?tab=readme-ov-file#notifications
- https://www.itsolutionstuff.com/post/laravel-10-notification-create-notification-in-laravel-10example.html

# Event

- https://github.com/atabegruslan/Laravel_CRUD_API/tree/master?tab=readme-ov-file#events-hooks

Usage: eg: broadcast events thru a websocket server: https://github.com/Ruslan-Aliyev/laravel-websockets

# Job

- https://github.com/spatie/laravel-artisan-dispatchable

Usage: eg: dispatching a job into a queue: https://github.com/Ruslan-Aliyev/laravel-queue

# Scheduling tasks

- https://laravel.com/docs/8.x/scheduling
- https://www.youtube.com/watch?v=fUqrE9ZBH_Q
- ReactPHP Loop: https://freek.dev/1689-a-package-to-run-the-laravel-scheduler-without-relying-on-cron
- https://www.positronx.io/laravel-cron-job-task-scheduling-tutorial-with-example/

1. Add a command: `php artisan make:command minutely`
2. Do `app/Console/Commands/minutely.php`
3. Do `app/Console/Kernel.php`
4. When testing in console: `php artisan minutely:demonotice`. When put on server: `php artisan schedule:run`. `schedule:run` actually calls `minutely:demonotice` (and whatever other tasks are there). If you run them from console, they will run immediately. But on the server, the latter will run to schedule.
5. Do ONE minutely cronjob on the server for Laravel, and let Laravel's Scheduler handle the rest of its jobs. On linux, do the cron like this: `* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1`. On Windows, use Task Scheduler like this: https://quantizd.com/how-to-use-laravel-task-scheduler-on-windows-10/

# Cron

- https://laravel.com/docs/10.x/scheduling

`app/Console/Kernel.php`

```php
namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\TransactionChecker;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        TransactionChecker::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('transaction:check')->dailyAt('01:00');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
```

`app/Console/Commands/TransactionChecker.php`

```php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TransactionCompletenessService;

class TransactionChecker extends Command
{
    protected $signature = 'transaction:check';

    protected $description = 'Check the completeness of transactions';

    private $transactionCompletenessService;

    public function __construct(TransactionCompletenessService $transactionCompletenessService)
    {
        $this->transactionCompletenessService = $transactionCompletenessService;

        parent::__construct();
    }

    public function handle()
    {
        $result   = '';
        $finished = false;

        while (!$finished)
        {
            $response = $this->transactionCompletenessService->check();

            $result  .= $response['message'];
            $finished = $response['finished'];
        }

        $this->info("RESULTS: \n" . $result);

        return 0;
    }
}
```

Now you can invoke from terminal: `php artisan transaction:check`

In server:

1. SSH in
2. `crontab -e`
3. `* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1`

In Clevercloud server: 

- https://www.clever-cloud.com/doc/administrate/cron
- https://www.clever-cloud.com/doc/deploy/application/php/tutorials/tutorial-laravel/#optional-configure-task-scheduling

`clevercloud/cron.json`

```
[
  "0 1 * * * $ROOT/clevercloud/cron.sh"
]
```

`clevercloud/cron.sh`

```
#!/bin/bash -l
set -euo pipefail

pushd "$APP_HOME"
/path/to/php /path/to/artisan transaction:check >> /dev/null 2>&1
```

# Get Server's info from within Laravel

In Controller
```php
public function showInfo(Request $request)
{
    dd($request);
}
```
The `server` sub-section shows the equivalent info of `$_SERVER`

In Template, you can render
```
@php
    phpinfo();
@endphp
```

Find where the PHP executable is located
```php
public function findPhpExec()
{
    $phpFinder = new \Symfony\Component\Process\PhpExecutableFinder;

    if (!$phpPath = $phpFinder->find()) 
    {
        throw new \Exception('The php executable could not be found, add it to your PATH environment variable and try again');
    }

    return $phpPath;
}
```

See also for plain PHP: https://github.com/atabegruslan/Others/blob/master/Development/php_js_knowhows.md#get-various-info

# Facades

- https://laravel-news.com/process-facade-laravel-10

# Helper

- https://dev.to/kingsconsult/how-to-create-laravel-8-helpers-function-global-function-d8n
- https://laravel-news.com/laravel-array-helpers-every-developer-should-know-about

## Method 1

1. Make `app/XxxHelper.php`
```php
use ...\...;

if (! function_exists('helperFunction')) {
    function helperFunction() 
    {

    }
}
```

2. `composer.json`
```
"autoload": {
    "files": [
        "app/XxxHelper.php"
    ],
```

3. `composer dump-autoload`

## Method 2

1. Make `app/Helpers/XxxHelper.php`
```php
namespace App\Helpers;

use ...\...;

class XxxHelper
{
    public static function helperFunction()
    {

    }
}
```

2. `config/app.php`
```php
'aliases' => [
    'XxxHelper' => App\Helpers\XxxHelper::class,
]
```

3. `composer dump-autoload`

# Making Service

- https://github.com/artogrig/laravel-make-service
- https://laracasts.com/discuss/channels/laravel/howwhere-do-i-create-service-classes

In services, use:
- Static methods: If no need for objects. Eg yearly report service for year 2020, 2021, ...
- Non-static methods: If you want to chain methods
- DI service: slightly less code

# Different ways of writing things

In Blade
```
@if (!in_array($modLabel, ['xxx', 'yyy']))

@endif
```
is same as
```
@php {{ $skips = ['xxx','yyy','deleted_at']; }} @endphp
@if (!in_array($initLabel, $skips))

@endif
```

In PHP
```
$thisAndPrevious = ActionLog::where([
        [ 'time',            '<=', $log['time']            ],
        [ 'record_key_name', '=',  $log['record_key_name'] ],
        [ 'record_id',       '=',  $log['record_id']       ],
        [ 'model',           '=',  $log['model']           ],
    ])
    ->where(function ($query) {
        $query->where('method', '=', 'create')
              ->orWhere('method', '=', 'update');
    })
    ->orderBy('id', 'DESC')
    ->take(2)
    ->get();
```
is same as
```
$thisAndPrevious = CrudLog::where('time', '<=', $log['time'])
    ->where('record_key_name', '=',  $log['record_key_name'])
    ->where('record_id', '=',  $log['record_id'])
    ->where('model', '=',  $log['model'])
    ->whereIn('method', ['create', 'update'])
    ->orderBy('id', 'DESC')
    ->take(2)
    ->get();
```

# Patterns

- https://laraveldaily.com/post/design-patterns-examples-laravel-core
- Observer: https://viblo.asia/p/observer-events-trong-laravel-co-the-ban-chua-biet-gGJ59OQjZX2

# Shorter code

- https://www.youtube.com/watch?v=NUYqjdmsIj8

![](/Illustrations/Development/laravel/laravel_redirect_from_controller.png)

- https://www.youtube.com/watch?v=onkvcJMZ6Wo

# Redirect

- https://www.nicesnippets.com/blog/redirect-to-another-url-or-website-in-laravel

# Route

- https://www.youtube.com/watch?v=dPxUj7cNh9k
- https://github.com/atabegruslan/Laravel_CRUD_API/tree/master?tab=readme-ov-file#ziggy-routes

# View

- https://laravel.com/docs/10.x/blade#blade-directives
- https://laravelcollective.com/docs/5.8/html (Obsolete)
    - https://stackoverflow.com/questions/51968355/how-to-use-datetimepicker-in-laravel-using-laravelcollective
- https://stackoverflow.com/questions/45279612/including-a-css-file-in-a-blade-template/45290308
- https://laravel-news.com/basset
- https://laracasts.com/discuss/channels/laravel/how-to-link-external-css-file-to-laravel-blade-file
- https://dev.to/aschmelyun/four-ways-to-pass-data-from-laravel-to-vue-5d8m
- https://stackoverflow.com/questions/41520258/how-to-pass-a-php-variable-to-vue-component-instance-in-laravel-blade

# View Overriding

- THE tutorial: https://www.youtube.com/watch?v=BntEU1Q5ga8
- https://voyager-docs.devdojo.com/
    - https://voyager-docs.devdojo.com/customization/overriding-files
    - EG: For `{domain}/admin/posts`, override `vendor/tcg/voyager/resources/views/bread/browse.blade.php` with `resources/views/vendor/voyager/posts/browse.blade.php`

# Filter in view:

## In Blade

- https://codecourse.com/watch/filtering-in-laravel-blade  

- https://pineco.de/laravel-blade-filters/
- Unfortunately that library doesn't work in the newest versions of Laravel. But, we can still imitate it:

1. Make provider: `php artisan make:provider BladeFiltersServiceProvider` , https://github.com/atabegruslan/Laravel_CRUD_API/blob/master/app/Providers/BladeFiltersServiceProvider.php
2. Make service: https://github.com/atabegruslan/Laravel_CRUD_API/blob/master/app/Services/BladeFiltersCompiler.php
3. Make custom provider: `php artisan make:provider TranslateServiceProvider` , https://github.com/atabegruslan/Laravel_CRUD_API/blob/master/app/Providers/TranslateServiceProvider.php
4. Register in `config/app.php` : https://github.com/atabegruslan/Laravel_CRUD_API/blob/master/config/app.php#L187-188
5. Use it in Blade: `{{ $blablah | translate:'vn' }}`

## In Vue

- https://vuejs.org/v2/guide/filters.html
- https://v1.vuejs.org/guide/custom-filter.html
- https://stackoverflow.com/questions/54744877/vue-filters-for-input-v-model
- https://scotch.io/tutorials/how-to-create-filters-in-vuejs-with-examples#toc-defining-and-using-filters

1. In `resources\js\app.js` write your filter: https://github.com/atabegruslan/Laravel_CRUD_API/blob/master/resources/js/app.js
2. In Vue, use it like: `{{ blahblah | to_3dp }}`
3. run `npm run dev`

# Pagination (with and without Vue)

## Blade

### In controller
```php
    public function index()
    {
        //$data = WhateverModel::orderBy('updated_at', 'ASC')->get()->all();
        $data = WhateverModel::orderBy('updated_at', 'ASC')->paginate(10);

        return view('whatever.index', ['data' => $data]);
```

### In view `whatever/index.blade.php`
```
<div class="row" >
    <div id="paginate">
        {{ $data->links() }}
    </div>
</div>

```

## Vue

### For the view

1. Write your custom pagination component, like: https://github.com/atabegruslan/Laravel_CRUD_API/tree/master/resources/js/components/common/Pagination.vue

2. In `app.js`
```
import VuePagination from './components/common/Pagination';
Vue.component('vue-pagination', VuePagination);
```

3. Use it `<vue-pagination :pagination="pagination" @paginate="getItems()" />` where `pagination` is
```
{
    "current_page" :1,
    "from"         :1,
    "last_page"    :1,
    "per_page"     :20,
    "to"           :2,
    "total"        :2
}
```

### In API controller

Pass the `pagination` object into the view.

### Or you can use other's libraries

- https://bootstrap-vue.js.org/docs/components/pagination/
- https://www.npmjs.com/package/vuejs-paginate
- https://vuejsexamples.com/tag/pagination/
- https://github.com/gilbitron/laravel-vue-pagination/blob/master/README.md
- https://github.com/matfish2/vue-pagination-2/blob/master/README.md

# Blade Component

- https://www.youtube.com/watch?v=7E76PPoIVW4
- https://www.youtube.com/playlist?list=PL1JpS8jP1wgAm1z3ntJZQ0ef9vokjJ56Z

# Request & Response

- https://viblo.asia/p/su-khac-biet-giua-request-get-vs-request-input-vs-request-vs-get-data-trong-laravel-bJzKmgjkl9N
- https://stackoverflow.com/questions/37296654/laravel-lumen-ensure-json-response
- https://www.youtube.com/watch?v=mwi_mxqtVfc
- https://www.youtube.com/watch?v=QhzrVlPm6wk

# Model casts

- https://awesomeopensource.com/project/mad-web/laravel-enum
- https://laravel-news.com/model-casts

![](/Illustrations/Development/laravel/laravel_model_cast.png)

# File generating/manipulating libraries

- https://beyondco.de/blog/exporting-laravel-models-to-csv-and-xls
- https://github.com/PHPOffice/PhpSpreadsheet
- https://docs.laravel-excel.com/2.1/export/cells.html
- https://www.itsolutionstuff.com/post/laravel-merge-multiple-pdf-files-exampleexample.html
- https://www.youtube.com/watch?v=v8eSGeszu4U
- https://www.youtube.com/playlist?list=PL1TrjkMQ8UbWeumS9QLpRWpkG7qIKHSqX
- https://www.itsolutionstuff.com/post/how-to-merge-multiple-pdf-files-in-laravel-10example.html

# Documentation

Here are a few libraries:
- https://www.youtube.com/watch?v=gp-_kcblYGA
- https://www.youtube.com/watch?v=zky95P5ytic
- https://www.youtube.com/watch?v=PjwGI8c2IfA

## Swagger/OpenAPI

Nowadays, Swagger and OpenAPI can be loosely spoken about interchangably. But to be more exact, OpenAPI refers more to the standard, while Swagger refers more to the software tool for making documentation.

- https://www.youtube.com/watch?v=2pyUYJ4NiMI
- https://www.youtube.com/watch?v=87ZFvJ7_-n0

Document APIs using Swagger:
- https://github.com/DarkaOnLine/L5-Swagger
- https://www.youtube.com/playlist?list=PLnBvgoOXZNCOiV54qjDOPA9R7DIDazxBA
- https://idratherbewriting.com/learnapidoc/pubapis_swagger.html <sup>helpful</sup>
- https://swagger.io/blog/api-strategy/difference-between-swagger-and-openapi/ <sup>theory</sup>
- https://swagger.io/blog/api-development/swaggerhub-101-ondemand-tutorial/
- https://apihandyman.io/writing-openapi-swagger-specification-tutorial-part-1-introduction/
- https://www.youtube.com/watch?v=xggucT_xl5U
- https://youtu.be/q1UttpUXB3s?si=MG0hjlazaKT_bRZo

All the documentation libraries involves annotating the controller functions

An actual working example of Swagger in Laravel: https://github.com/Ruslan-Aliyev/laravel-swagger

# Date and time

- Tempo: https://laravel-news.com/tempo-js-dates
- Laravel Carbon:

![](/Illustrations/Development/laravel/laravel_carbon.png)

- https://github.com/atabegruslan/Others/blob/master/Development/php_js_knowhows.md#dates-and-times
- https://stackoverflow.com/questions/57761890/laravel-formatting-all-dates-simultaneously

# Validation

- https://www.youtube.com/watch?v=IkRXKRCPWeU
- Scroll to position: https://www.youtube.com/watch?v=YGbyKxw6a84
- https://laravel.com/docs/11.x/validation#custom-validation-rules
- https://stackoverflow.com/questions/50287823/validating-a-custom-date-format-in-with-laravel-validator
- https://www.leonelngande.com/laravel-validation-sometimes-vs-nullable
- https://laravel.com/docs/11.x/validation#rule-alpha-num
- https://stackcoder.in/posts/how-to-create-custom-validation-rules-in-php-laravel-using-artisan-command
- https://codingspoint.com/laravel-8-date-format-validation-example

![](/Illustrations/Development/laravel/laravel_validation_stopOnFirstFailure.png)

# Client Side Vallidation

- https://jqueryvalidation.org/
- https://www.youtube.com/watch?v=yfJP8CQJNYE

# Logging

Laravel uses Monolog under the hood.  
More about PHP logs and Monolog, see: https://github.com/Ruslan-Aliyev/log

1. Default log's path: `storage/logs/laravel.log`

2. In `.env`, you can see `LOG_CHANNEL=stack`

3. Then you can see `config/logging.php`

4. With the default "stack" channel, you can specify multiple channels, eg:

```php
'channels' => [
    'stack' => [
        'driver' => 'stack',
        'channels' => ['single', 'custom'],
    ],

    'single' => [
        'driver' => 'single',
        'path' => storage_path('logs/laravel.log'), // You can see that the default log path is indeed at 'storage/logs/laravel.log'
        ...
    ],

    'custom' => [ // You can specify your custom logs
        'driver' => 'single',
        'path' => storage_path('logs/custom.log'),
        ...
    ],
],
```

5. Then just test if it works by making a route
```php
Route::get('/log', function () {
    Log::channel('custom')->info('msg', ['data' => 'value']);
});
```

- https://laravel.com/docs/8.x/logging
- https://www.youtube.com/watch?v=GOmiWKpwFSo
- https://stackify.com/laravel-logging-tutorial/  

- https://www.youtube.com/watch?v=XWFXikdTFcw

# Multi Tenancy

- https://www.youtube.com/watch?v=pWVxWu0D9sY
- https://www.youtube.com/watch?v=GKBV0-u_-4A
- https://www.youtube.com/watch?v=8ot9IiGaqhk

# Integrations

## Email

- https://laracasts.com/discuss/channels/laravel/how-to-check-mail-is-send-successfully-in-laravel
- https://hotexamples.com/examples/illuminate.support.facades/Mail/failures/php-mail-failures-method-examples.html

## Recaptcha

- https://laravel-news.com/google-recaptcha-enterprise-for-laravel

## SMS SignIn

- https://codezen.io/how-to-send-sms-messages-in-laravel/
- https://stackoverflow.com/questions/48883060/laravel-register-and-log-in-via-phone-number-and-sms-confirmation
- https://laraveldaily.com/post/laravel-2fa-two-factor-auth-otp-email-sms

## Zalo Integration

https://www.youtube.com/watch?v=rXI03h4jbBg

# Web Scraping

https://gist.github.com/atabegruslan/b603476fbfa5a928ce92c0f9b49f29d7

# Package Development

- https://laravel.com/docs/8.x/packages , https://www.youtube.com/watch?v=gqYIxv7PXxQ
- https://wisdmlabs.com/blog/create-package-laravel/
- `artisan vendor:publish`: https://stillat.com/blog/2016/12/07/laravel-artisan-vendor-command-the-vendorpublish-command
- Override package views: https://stackoverflow.com/questions/57160594/is-it-possible-to-override-a-laravel-package-view-from-another-package

# Pipeline

- https://hafiqiqmal93.medium.com/laravel-eloquent-query-sfilter-using-pipeline-7c6f2673d5da
- https://laravel-news.com/livestream-laravel-pipelines

In controller
```php
namespace App\Http\Controllers;

use Illuminate\Pipeline\Pipeline;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $select   = ['title', 'contents'];
        $filters  = ['title' => 'Wanted Title', 'another_filter_name' => 'another_filter_value'];
        $paginate = true;
        $perPage  = 10;

        /** @var \Illuminate\Database\Query\Builder $query */
        $query = app(Pipeline::class)
            ->send( Post::with('comment') /* Of type Illuminate\Database\Eloquent\Builder */ )
            ->through( Post::PIPES )
            ->thenReturn();

        if (count($select)) 
        {
            $query->select(DB::raw(join(',', $select)));
        }
        if (!empty($filters))
        {
            $query->where($filters);
        }

        $data = null;

        if ($paginate) 
        {
            $data = $query->paginate($perPage);
        }
        else
        {
            $data = $query->get();
        }

        $entries           = $data->items();
        $numberOfPages     = ceil($data->total() / $data->perPage());
        $currentPageNumber = $data->currentPage();
    }
}
```

In model
```php
namespace App\Models;

use App\Models\Comment;
use App\Filters\Title;
use App\Filters\Contents;

class Post extends Model
{
    const PIPES = [
        Title::class,
        Contents::class,
    ];

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
```

Filters:
```php
namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class Filter
{
    protected $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Builder $builder, Closure $next)
    {
        if (
            !$this->request->has($this->filterName()) 
            || 
            $this->request->input($this->filterName(), '') === ''
        ) 
        {
            return $next($builder);
        }

        return $this->applyFilters($next($builder));
    }

    protected abstract function applyFilters(Builder $builder): Builder;

    protected function filterName()
    {
        return Str::snake(class_basename($this));
    }
}
```

```php
namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class Title extends Filter
{
    protected function applyFilters(Builder $builder): Builder
    {
        return $builder->where('title', 'ILIKE', '%' . $this->request->input($this->filterName()) . '%');
        // ILIKE only works in PostgreSql
    }
}
```

https://dev.to/abrardev99/pipeline-pattern-in-laravel-278p

# API returning file downloads

Download PDF on server: 
```php
return response()->download('/absolute/path/to/file.pdf', 'filename.pdf', ['Content-Type: application/pdf']);
```
- Multiple: https://www.itsolutionstuff.com/post/laravel-5-multiple-files-download-with-response-exampleexample.html
- Also note: https://stackoverflow.com/questions/29289177/binaryfileresponse-in-laravel-undefined

Download PDF directly from base64:
```php
return response()->make( base64_decode('base64_binary_string_blah_blah') , 200, [
    'Content-Type' => 'application/pdf',
    'Content-Disposition' => 'inline; filename="filename.pdf"'
]);
```
https://www.codegrepper.com/code-examples/php/response%28%29-%3Emake+laravel+pdf

Download CSV directly from stream: https://www.laravelcode.com/post/how-to-export-csv-file-in-laravel-example

# Nested controllers

- GOOD: https://www.youtube.com/watch?v=xqNip5PYBv8
- GOOD: https://laraveldaily.com/post/nested-resource-controllers-and-routes-laravel-crud-example
- Relevant: https://laracasts.com/discuss/channels/laravel/nested-resources-controllers-structure
- Relevant: https://laracasts.com/discuss/channels/laravel/artisan-nested-resource-controllers-creation

# Nested Models

- GOOD: https://www.youtube.com/watch?v=5s-_SnVl-1g
    - https://github.com/staudenmeir/eloquent-has-many-deep

# Accessors / Mutators

Eg: Get timestamps in a formatted way, get name with first letter capitalized, get a currency number in the currency format ...

https://laravel.com/docs/9.x/eloquent-mutators

![](/Illustrations/Development/laravel/laravel_model_attributes.png)

https://github.com/academico-sis/academico/blob/pro/app/Traits/PriceTrait.php#L7

# Permissions terminology

- `spatie/laravel-permission`: https://github.com/atabegruslan/Laravel_CRUD_API/tree/master?tab=readme-ov-file#permissions-spatie-library
- https://www.youtube.com/watch?v=kZOgH3-0Bko
- https://techsolutionstuff.com/post/laravel-8-user-roles-and-permissions-without-package
- https://techsolutionstuff.com/post/user-roles-and-permissions-without-package-laravel-9
- https://devnote.in/laravel-simple-role-based-authentication
- https://viblo.asia/p/laravel-8-tao-roles-va-permissions-khong-su-dung-package-maGK761b5j2

In Laravel, there is the regular User - Role - Permission

Then there are "weirder" terms like:
- Permission = gate
- Group of permissions = policy

![](/Illustrations/Development/laravel/laravel_policy.png)

# Security

- spatie/laravel-csp: https://laravel-news.com/laravel-content-security-policies
- https://laravel-news.com/passwordless-authentication-in-laravel
- https://laravel-news.com/use-1password-to-authenticate-with-forge-and-vapor-securely
- https://www.youtube.com/watch?v=dWVTfY6cMBs
- https://stackoverflow.com/questions/28899905/bcrypt-vs-hash-in-laravel
- https://flareapp.io/docs/ignition/introducing-ignition/security-recommendations

# Middleware

- https://laravel-news.com/laravel-security-middleware

# Auth

- https://code.tutsplus.com/how-to-create-a-custom-authentication-guard-in-laravel--cms-29667t
- https://laravel.com/docs/11.x/authentication
- Multi Auth using Guards: https://www.youtube.com/watch?v=JanA7k9IBdo

# Passport

https://github.com/atabegruslan/Laravel_CRUD_API?tab=readme-ov-file#passport

# JWT

- Intro: https://github.com/atabegruslan/Others/blob/master/Security/auth.md#jwt
    - https://jwt-auth.readthedocs.io/en/develop/laravel-installation/
- https://www.youtube.com/watch?v=VtAxYez4ZdQ

Note: Passport's bearer token is also a JWT. (There is no rule saying that a JWT can't be used as a bearer token). To test this:

```
composer create-project laravel/laravel test-passport-jwt
cd test-passport-jwt
php artisan key:generate

composer require laravel/passport
php artisan migrate
php artisan passport:install
```

By now, `php artisan passport:keys` should already been ran under the hood. If not, then please run this. This will generate `/storage/oauth-public.key` & `/storage/oauth-private.key`

Use Tinker to add a user:
```
php artisan tinker
> User::create(["name"=> "laravel", "email"=>"laravel@tinker.com", "password"=>bcrypt("secret")]);
```

Run server: `php artisan serve`

Get token: `curl --location 'http://127.0.0.1:8000/oauth/token' \
--form 'client_id="2"' \
--form 'client_secret="yXnMzsj6nnE0awGKpZ5l8elXpd0KFI19fd5KYEPe"' \
--form 'grant_type="password"' \
--form 'username="laravel@tinker.com"' \
--form 'password="secret"'`

Use Password type client (2) info from `oauth_clients` table. (This is treated as a 1st-party client)

Go to https://jwt.io/ to check

- Passport uses https://github.com/firebase/php-jwt under the hood. This does most of the work, like checking JWT's validity. If you tamper with `\storage\oauth-public.key`, you'll get error: `LogicException: Unable to read key from file ...\storage\oauth-public.key`.
    - https://discord.com/channels/297040613688475649/540190697962340363/1108671227784073327
    - https://discord.com/channels/297040613688475649/540190697962340363/1108785877737553961

- https://www.youtube.com/watch?v=jF9wdF0sViI
- https://www.youtube.com/watch?v=6eX9Pj-GhZs
- https://www.youtube.com/watch?v=jIzPuM76-nI

## JWT in Laravel using `php-jwt`

https://adevait.com/laravel/implementing-jwt-authentication-in-laravel

## JWT in Laravel using `tymon/jwt-auth`

https://github.com/Ruslan-Aliyev/laravel-jwt

# Laravel Sanctum

It generates an opaque token, like a Personal Access Token.  
This token can be passed in the API call, in the Authorization header, just like how you would for a bearer token.  
Furthermore, for SPAs, Sanctum can be used to provide session-based authentications.  
Sanctum's session-based authentications involves a HTTP-only cookie, which is safe for frontend SPAs (browser storage or regular cookie is unsafe because a bit of JS can acquire the sensitive credentials)  

Full tutorial: https://www.youtube.com/watch?v=TzAJfjCn7Ks

## Sanctum for session

For first party SPA frontends

https://github.com/Ruslan-Aliyev/laravel-sanctum-session-seperate-vue

https://github.com/Ruslan-Aliyev/laravel-sanctum-session-inlaravel-vue

The seperate front end way is more appropriate

## Sanctum for token

For third party apps

https://github.com/Ruslan-Aliyev/laravel-sanctum-token

## Sanctum for token (in SPA)

PS: This way isn't proper

- https://www.youtube.com/watch?v=8myQdPL8I1s&t=150s

## Passport vs Sanctum

- Sanctum offers both session-based and token-based authentication and is good for single-page application (SPA) authentications. 
- Passport uses JWT authentication as standard but also implements full OAuth2 authorization
    - This means that the bearer token that Passport generates is actually a JWT. Since OAuth2 makes no specifications on its bearer token's format, a JWT can be use.
        - The private and public keys for the signing of the generated JWT can be found in `/storage` folder

- Sanctum always requires that you're 'logging in' as a user. If there's ever a use-case for authentication without a user present you can look into laravel passport's client credential grant.

- https://www.youtube.com/watch?v=edcTejycirk
- https://www.youtube.com/watch?v=8myQdPL8I1s

## In relation to Breeze

- `php artisan install:breeze` uses sessions
- `php artisan install:breeze api` uses sanctum

- https://www.youtube.com/watch?v=2zKoS8GsKK8&t=160s
- https://www.youtube.com/watch?v=jGVHEgqkToc
- https://medium.com/@a3rxander/backend-api-in-laravel-10x-with-laravel-breeze-8c3b4b2fe6ca

# SSO

- https://www.youtube.com/playlist?list=PLC-R40l2hJfdyfZ3jkDKOcyoqmIgw2wda 
- https://github.com/mi-lopez/laravel-sso 

# Homestead

https://github.com/atabegruslan/Others/blob/master/Virtual/laravel_homestead.md

# Storage to AWS S3

- https://www.youtube.com/watch?v=xN-CF7dzeyM
- https://laravel.com/docs/11.x/filesystem

- https://github.com/thephpleague/flysystem-aws-s3-v3
    - https://github.com/thephpleague/flysystem
        - https://flysystem.thephpleague.com/docs/guides/laravel-usage/
            - https://laravel.com/docs/10.x/filesystem#s3-driver-configuration

- https://github.com/aws/aws-sdk-php-laravel
- https://iwconnect.com/working-with-amazonaws-s3-creds-in-laravel/
- https://readouble.com/laravel/8.x/en/filesystem.html
- https://www.clever-cloud.com/doc/deploy/addon/cellar

1. `composer require league/flysystem-aws-s3-v3`

2. `.env`
```
AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_ENDPOINT=https://cellar-c2.services.clever-cloud.com
```

3. `config/filesystems.php`
```php
'disks' => [
    'local' => [
        'driver' => 'local',
        'root' => storage_path('app'),
    ],
    'public' => [
        'driver' => 'local',
        'root' => storage_path('app/public'),
        'url' => env('APP_URL').'/storage',
        'visibility' => 'public',
    ],
    's3' => [
        'driver' => 's3',
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION'),
        'bucket' => env('AWS_BUCKET'),
        'url' => env('AWS_URL'),
        'endpoint' => env('AWS_ENDPOINT'),
    ],
],
```

4. Usage
```php
use Illuminate\Support\Facades\Storage;

$fileName = 'path/to/file/filename.txt';
$content = 'bla bla';

if (Storage::disk('s3')->exists($fileName))
{
  Storage::disk('s3')->append($fileName, $content);
  Storage::disk('s3')->setVisibility($fileName, 'public');
}
else
{
  Storage::disk('s3')->put($fileName, $heading . $content, 'public');
}
```

# Critical Sections

![](/Illustrations/Development/laravel/laravel_racing_condition.png)

# Laravel Ecosystem

https://ecosystem.laravel.io

## TALL 

- https://www.youtube.com/playlist?list=PLQVyhB87NYx6efRmZjLiCrrTzHTH5KDT0
- https://tallstack.dev/

## Alpine

Alternative to Vue

- https://www.youtube.com/watch?v=M3fY0E60cM0
- https://www.youtube.com/watch?v=DJjenhzqBHk
- https://blog.logrocket.com/intro-to-alpine-js-for-vue-developers

## Livewire

Unifying BE and FE from the back

- https://www.youtube.com/watch?v=4c7h2sIA8lc
- https://www.youtube.com/playlist?list=PLe30vg_FG4OQ8b813BDykoYz95Zc3xUWK
- Livewire prefetch: https://www.youtube.com/watch?v=1vnvLMkc7AM
- https://laravel-news.com/wirebox-livewire-playground
- https://laravel-news.com/how-to-add-a-confirmation-dialog-with-livewire
- https://laravel-news.com/livewire-toaster
- Order Management System: https://www.youtube.com/watch?v=-ExuAuCnyg4
- Livewire volt: https://www.youtube.com/watch?v=wa_NQTH1sQc
- Code review: https://www.youtube.com/watch?v=-48w_ZPuw34
- https://laravel-news.com/livewire-inertia

## InertiaJS

Unifying BE and FE from the front

- https://github.com/Ruslan-Aliyev/Laravel_Inertia

## Filament

- To help developing on TALL stack

- https://laravel-news.com/5-underrated-filament-features 
- https://www.youtube.com/watch?v=GKBV0-u_-4A
- https://www.youtube.com/watch?v=tznw7lTblbY 
- https://www.youtube.com/watch?v=JAHYfq07uiU
- Admin dashboard: https://github.com/Ruslan-Aliyev/laravel-filment-adminpanel

## Admin Dashboard

- https://reposhub.com/php/web-frameworks/the-control-group-voyager.html
- https://github.com/the-control-group/voyager

```
composer require tcg/voyager
# Update .env database connection and APP_URL
php artisan voyager:install --with-dummy
{domain}/admin : admin@admin.com/password
```

- https://github.com/filamentphp/filament?tab=readme-ov-file#panel-builder--documentation--demo (Laravel Filament is mainly for developing Tall Stack, but it have an admin panel)
- https://github.com/jeroennoten/Laravel-AdminLTE

## Nova

Admin dashboard

- https://www.youtube.com/watch?v=vBfaiZQDQrQ

## `LaravelDaily/Larastarters` library*

- https://github.com/LaravelDaily/Larastarters

## Statamic

Admin dashboard

- https://laravel-news.com/statamic-4-released

## Gitamic

- https://laravel-news.com/gitamic

## Kinetic

- https://github.com/ericdrowell/KineticJS/

## Shift

For update

- https://laravelshift.com

## Shift Blueprint

Scaffold

- https://www.youtube.com/watch?v=JgKJj2iDEHM

## Orion

Building REST APIs

- https://laravel-news.com/laravel-orion

## Pint

PHP code style fixer

- https://laravel-news.com/configuring-laravel-pint
- https://www.youtube.com/watch?v=L_ZnvP2qAds

## Herd

Laravel and PHP development environment for macOS

- https://laravel-news.com/laravel-herd
- https://www.youtube.com/watch?v=fQOw-wkQV7o

## Takeout

Docker related

- https://laravel-news.com/using-takeout-with-local-valet-and-docker-sites

## Valet

Docker related

- https://laravel-news.com/valet-v4-is-released
- https://spinupwp.com/laravel-valet-local-wordpress-dev

## Laradock

Docker related

- https://www.youtube.com/playlist?list=PLWvvi-jFYHUjfMprLCYA1ubflsirxKrVg
- https://github.com/LaraDock/
- https://laradock.io
- https://www.youtube.com/watch?v=q9bk9L2h8i8
- https://www.youtube.com/watch?v=yCZog0bk6sE
- https://www.youtube.com/watch?v=nDDtIYi-Zd4
- https://www.youtube.com/watch?v=PsHjQYNcMZg 

## Sail

Docker related

# Sail

- https://laravel.com/docs/11.x/sail
- https://laravel-news.com/laravel-sail
- https://www.youtube.com/watch?v=PDaGJ397Ing
- https://www.youtube.com/watch?v=5VxLX3aVs-E
- https://www.youtube.com/watch?v=4K4nkncZ2OQ
- https://laravel.com/docs/8.x/sail#installing-sail-into-existing-applications
- https://laravel.com/docs/8.x/installation#getting-started-on-macos
- https://www.youtube.com/watch?v=398J2rNQRGY

Setup in existing project
```
composer require laravel/sail --dev
php artisan sail:install # After here, a docker-compose.yaml will be created
```

## Basset 

Load CSS & JS

- https://laravel-news.com/basset

## Bun

JS package manager

- Bun vs NPM vs Yarn vs pnpm: https://benjamincrozat.com/bun-package-manager
- https://laravel-news.com/laravel-sail-bun

## Smart Ads

Make ad banners

- https://laravel-news.com/laravel-smart-ads

## TelemetryHub

Monitoring

- https://laravel-news.com/telemetryhub

## Benchmark

Test performance

- https://laravel-news.com/laravel-benchmark

## Ray

Test performance

- https://myray.app/docs/getting-started/introduction

## Sentry

Monitor performance

- https://laravel-news.com/how-sentry-can-improve-your-laravel-application

## Laravel 11's health-check endpoint*

Health-check

- https://laravel-news.com/laravel-11-health-endpoint

## `barryvdh/laravel-debugbar` library*

Debugging and Monitoring

- https://github.com/barryvdh/laravel-debugbar

## Folio

Simplify routing

- https://laravel.com/docs/11.x/folio

## Telescope

Logging

- https://laravel.com/docs/11.x/telescope

## Tinkerwell tool*

Code runner for PHP. Better than Tinker

- https://laravel-news.com/tinkerwell-v4

## Forge

Server management

- https://forge.laravel.com 

## Vapor 

Serverless deployment platform

- https://vapor.laravel.com

## Precognition

- https://laravel-news.com/laravel-precognition

# Deployment

Methods:

1. Upload `public` folder into server's `public_html` folder. Upload the rest to another folder outside of the server's `public_html` folder. In `public/index.php` rectify all relevant paths. Import .sql to server's database. Refactor database-name, username & password in the `.env` file.
2.  Load the entire folder as it is. To rid the `/public/` segment of the URL, put the following into the root folder's `.htaccess`: https://infyom.com/blog/how-to-remove-public-path-from-url-in-laravel-application
3. To rid the `/public/` by: https://www.devopsschool.com/blog/laravel-remove-public-from-url-using-htaccess/

- https://www.youtube.com/watch?v=UyopFbFRug8
- https://laravel-news.com/run-one-time-operations-after-deployment-with-laravel

# Clevercloud

- https://www.clever-cloud.com/doc/administrate
    - https://www.clever-cloud.com/doc/deploy/application/php/tutorials/tutorial-laravel/
- https://www.youtube.com/watch?v=ZWEbZhFk4bs

`clevercloud/php.json`

```
 {
   "deploy": {
     "webroot": "/public"
   }
 }
```

# HTTPS 

- https://github.com/atabegruslan/Others/blob/master/Server/https.md
- https://dev.to/robertobutti/laravel-artisan-serve-and-https-cb0

# Clear cache

- https://tecadmin.net/clear-cache-laravel-5/
- On top of the above `php artisan config:cache` is also an useful command

# File Upload

- https://www.digitalocean.com/community/tutorials/how-to-handle-file-uploads-in-vue-2
- https://therichpost.com/vue-laravel-image-upload/
- https://stackoverflow.com/questions/47630163/axios-post-request-to-send-form-data
- https://stackoverflow.com/questions/54057254/laravel-5-7-cant-parse-post-multipart-form-data-request/54059842
- https://stackoverflow.com/questions/54686218/laravel-vuejs-axios-put-request-formdata-is-empty
- https://stackoverflow.com/questions/5392344/sending-multipart-formdata-with-jquery-ajax
- https://viblo.asia/p/upload-file-su-dung-vue-dropzone-gAm5yRYAKdb

# EC

- https://www.youtube.com/watch?v=waojlxMBZ3U
- https://laravel-news.com/modelling-busines-processes-in-laravel

# AI

- https://laravel-news.com/openai-for-laravel

# Misc

- https://www.grepper.com/answers/155245/laravel+call+controller+method+from+view
- https://www.youtube.com/watch?v=6dEfxGLgevM
- https://stackoverflow.com/questions/14837065/how-to-get-public-directory
- https://appdividend.com/how-to-create-filters-in-laravel
- https://laravel-news.com/hiding-console-commands
- https://laravel-news.com/laravel-recurring-models
- https://www.youtube.com/watch?v=xk6kQAd_kj0
- https://www.youtube.com/watch?v=JGYn-qth-VQ
- https://www.youtube.com/watch?v=5qOwF-J5xxM
- Bad practices: https://www.youtube.com/watch?v=dSH4dyCQVas
- Interview: https://www.youtube.com/watch?v=OJoHJwDK-VQ
- https://laravel-news.com/using-attributes-to-add-value
- https://laracasts.com/discuss/channels/general-discussion/how-to-use-a-constructor-in-a-model-if-it-is-even-possible
- Progress bar: https://www.youtube.com/watch?v=9TT5VzSMMaU
- Call route from controller: https://panjeh.medium.com/laravel-call-named-routes-in-console-internally-php-artisan-command-15ba05ddafb1
- `Str`:

![](/Illustrations/Development/laravel/laravel_str.png)

Masking sensitive info:
![](/Illustrations/Development/laravel/laravel_mask.png)

---

# Places for info and help

- https://laracasts.com/series/demystifying-laravel-magic
- https://laracasts.com/series/automated-laravel-upgrades/episodes/1
- https://discord.com/invite/laravel
