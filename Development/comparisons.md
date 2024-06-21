# Comparisons

## First Class Functions

Functions that are treated like passable variables.

### JavaScript

- https://www.vinta.com.br/blog/2015/javascript-lambda-and-arrow-functions/
- https://stackoverflow.com/questions/12930272/javascript-closures-vs-anonymous-functions
- https://medium.com/@iampika/javascript-environment-lexical-scope-and-closures-9c8dfaeff73d

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

https://www.w3schools.com/js/js_callback.asp

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

When regular functions are made in an object, `this` is pointed to that object.  
When arrow functions are made in an object, `this` doesn't change, so `this` stayed pointed to `window` (or whatever object it was pointing to before)

https://stackoverflow.com/questions/41690124/arrow-functions-return-this-as-the-window-object/41691192#41691192

https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/js/arrow_functions.html

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

### PHP

https://github.com/atabegruslan/Others/blob/master/Development/async.md

### C#

- Async & Await: https://www.youtube.com/watch?v=2moh18sh5p4

### JavaScript

- https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/js/async/readme.md
- https://github.com/atabegruslan/Others/blob/master/Development/async.md#workers

## Workers

|              | Service Workers  | Web Workers  | Worker Threads   | Worklets     |
|--------------|------------------|--------------|------------------|--------------|
|              |                  | In browsers  | In NodeJS        | Custom animations & effects |
| Instances    | One for all tabs | Many per tab |                  |              |
| Lifespan     | Independent      | Same as tab  |                  |              |
| Intended use | Offline support  | Parallelism  |                  |              |

- https://stackoverflow.com/questions/38632723/what-can-service-workers-do-that-web-workers-cannot
- https://stackoverflow.com/questions/60268604/whats-the-difference-between-web-workers-and-worker-threads
- https://dev.to/bharat5604/web-worker-service-worker-and-worklets-a-comprehensive-guide-1f64
- https://blog.logrocket.com/complete-guide-threads-node-js

## Dependency Management

### NodeJS

`^version`: Compatible with version - `^1.2.3` will use releases from `1.2.3` to `<2.0.0`

`~version`: Approximately equivalent to version - `~1.2.3` will use releases from `1.2.3` to `<1.3.0`

- https://stackoverflow.com/questions/22343224/whats-the-difference-between-tilde-and-caret-in-package-json
    - https://docs.npmjs.com/cli/v8/configuring-npm/package-json#dependencies
    - https://docs.npmjs.com/cli/v6/using-npm/semver
- https://docs.npmjs.com/about-semantic-versioning#using-semantic-versioning-to-specify-update-types-your-package-can-accept

### Composer

- https://getcomposer.org/doc/articles/versions.md

## Data Types

| PHP | JS |
|---|---|
|   | Undefined (Only declared, no value assigned, eg: `var x;`) |
| Null (Assigned nothing yet or assigned the constant `NULL`) | Null (eg: `var x = null;`) |
| boolean | boolean |
| float, integer | number. (Tricky thing about `NaN` https://medium0.com/@ntgard/why-nan-nan-3d41af988d30) |
| string | string |
|   | symbol |
|   | function object |
| object | object |
| array |   |
| resource |   |
|   | Host object |

## True/False

|   | PHP | JS | MySQL |
|---|---|---|---|
| **True** | Anything but below | Have 'real' value. No 0. Non-empty string | 1 |
| **False** | 0, 0.0, "0" | -0, 0 | 0 |
|   | Empty string | Empty string |   |
|   | Empty array |   |   |
|   |   | Undefined (ie: just `var x;`) |   |
|   | Null (incl. unset vars) | Null (eg: `var x = null;`) |   |
|   |   | NaN (eg: `1/"a"`) |   |
|   | SimpleXmlObject created from empty tags |   |   |

## Frameworks/Technologies

| SOAP | REST |
|---|---|
| Rigid message patterns |  |
| Standardized |  |
| Inbuilt error handling | If error happens, you have to figure out the problem |
| XML | More response types, smaller message formats |
| All protocols | HTTP |
| Distributed enterprise environment | Point-Point |
|  | No expensive tools to interact with web server. Fast. No expensive processing. |
|  | In-line with web technology |

| PHP | Node |
|---|---|
| HTML, fat PHP call | AJAX, thin call, dynamic |
| Use PHP to prepare HTML, no need for client | Same server and client language |
| Connection to DB: SQL | Connection to DB: JSON |
| Many versions, backwards compat support can be slow |  |
|  | Callbacks, closures, functions are all objects |
| Blocking execution model. Init once per every request. It handles each request in a separate process that don't share memory address space | Fast, event-driven. Init once - many requests |

- For PHP, note: https://stackoverflow.com/a/23291362
- https://www.geeksforgeeks.org/php-vs-node-js
- https://kinsta.com/blog/php-vs-javascript

## Thread

- Node: https://github.com/atabegruslan/Others/blob/master/Development/comparisons.md#workers
- PHP: 
  - https://www.php.net/manual/en/language.fibers.php
  - https://stackoverflow.com/questions/796217/what-is-the-difference-between-a-thread-and-a-fiber
  - https://stackoverflow.com/questions/77891921/using-fibers-in-php
  - https://hackaday.com/2023/09/25/processes-threads-and-fibers

## Thread models

![](/Illustrations/Development/ec/php_thread_model.png)

- PHP: https://stackoverflow.com/questions/7980111/can-php-serve-multiple-requests-at-the-same-time-or-one-by-one
- Node: https://www.digitalocean.com/community/tutorials/node-js-architecture-single-threaded-event-loop
- .NET: https://www.researchgate.net/figure/Architecture-of-ASPNET_fig1_245563991

## Performance

- https://www.turing.com/blog/php-vs-asp-net/#performance
- https://www.geeksforgeeks.org/difference-between-php-and-net
- https://www.educba.com/php-vs-dot-net
- https://stackoverflow.com/questions/691942/speed-of-code-execution-asp-net-mvc-versus-php

| Laravel | Cake |
|---|---|
| Blade Templates | Reverse Routing |
| Eloquent ORM | It's inbuilt ORM |
| Have DB migrations and seeders |  |
| Ease creation of things using Artisan | Also comes with it's own CLI |
|   | When compared to `Laravel`, `CakePHP` comes with robust plugins, using which, the code can be reused very easily, and the `app` folder can be kept clean. |
|   | Class inheritances of CakePHP are highly understandable |
| Highly configurable, so won't need to hack the core |   |
| Pagination abilities |   |
| Easy dependency injection using service container |   |

- https://www.youtube.com/watch?v=cuHDQhDhvPE

| AngularJS [Tutorial Series](https://egghead.io/courses/angularjs-fundamentals) | Angular [Tutorial Series](https://www.youtube.com/playlist?list=PLC8OkhrVTHNHi6Do0etu_wMvAvjdjukQp), [Example Project](https://github.com/atabegruslan/Angular_CRUD_API) | React [Example Project](https://github.com/atabegruslan/ReactJS-Flux-Redux) | Vue [Tutorial Series](https://www.youtube.com/playlist?list=PL4cUxeGkcC9hYYGbV60Vq3IXYNfDk8At1), [Tutorial Series](https://www.youtube.com/playlist?list=PLC3y8-rFHvwgeQIfSDtEGVvvSEPDkL_1f) | Svelte [Crash Course](https://www.youtube.com/watch?v=UU7MgYIbtAk), [Tutorial Series](https://www.youtube.com/playlist?list=PLC3y8-rFHvwiYZOsc2D8AO1MYwLjZQrKx), [Intro](https://svelte.dev/tutorial/basics) |
|---|---|---|---|---|
| Full MVC Framework | Full MVC Framework | JS Library. View only |  | Just a compiler |
| MVC Architecture. Controllers and Scopes. Weak component model. | Deeply-binded and loosely-coupled **components**. Strong component model. No concept of scopes nor controllers. Good modularity & scalability. Many core functionality are moved into modules. But poor backward compatibility. | No real architecture. Can optionally use Flux, Redux or MobX. Medium component model. | [VueX = Vue's Redux](https://github.com/Ruslan-Aliyev/vuex), [Vue3 Reactivity](https://github.com/Ruslan-Aliyev/vue3-reactivity), [Vue3 Reactivity](https://www.youtube.com/watch?v=7Cjb7Xj8fEI) | "Reactivity" auto taken care of for you |
|  | Dynamic loading: loading libraries into memory at runtime, retrieve and execute functions, and then unload library from memory. |  |  |  |
|  | Big but fast bundle | Small fast bundle | Small fast bundle | V Small fast bundle |
|  | Iterative callbacks (provided by RxJS): easy to compose async or callback-based code. RxJS can limit state visibility and debugging but can be solved with Reactive add-ons like `ngReact` or `ngRx`. |  |  |  |
|  | Async template compilation: no controllers nor scopes -> easier to pause template rendering & compile templates to generate the defined code. |  |  |  |
|  | Focus on app | Easy creation of functional stateless components, good for composition | Components |  |
|  | Huge set of core features | Just core features | Medium-sized set of core features | Just core features |
|  | All extensions, modules and dependencies within Angular core | Need many community extensions (eg router, form validator ...) | Provide some dependencies in core, eg have router but no form validator |  |
|  | 1 page apps only | 1 page and multi-page | 1 page and multi-page |  |
| JS | TypeScript | ES6 JS, JSX / Mix of improper JS and HTML | Any JS-type language |  |
| Client side rendering | Server side rendering | Server side rendering |  |  |
| 2 directional binding | 2 directional binding | 1 directional binding |  |  |
| Regular DOM | Regular DOM | Virtual DOM |  |  |
| HTML templating | TypeScript templating. | JSX templating |  |  |
| HTML centric. Easy to debug the HTML part, vice versa. | HTML centric. Easy to debug both. | JS centric. Easy to debug the JS part, vice versa. |  |  |
| Don't have Debug Line NO | Don't have Debug Line NO | Have Debug Line NO |  |  |
| Don't have Unclosed Tag Mentioned | Don't have Unclosed Tag Mentioned | Have Unclosed Tag Mentioned |  |  |
| Fails at runtime | Fails at runtime | Fails at compile-time |  |  |
| Ionic for mobile | Ionic for mobile | ReactNative for mobile |  |  |
| Weak packaging | Medium packaging | Strong packaging |  |  |
| Low Toolchaining | High Toolchaining | High Toolchaining |  |  |
| Reduced Churn | Reduced Churn | High Churn |  |  |
| Weak abstraction | Weak abstraction | Strong abstraction |  |  |
|  | TypeScript need offline compilation |  |  |  |
|  | Most established community support | Best CLI | Best Documentation |  |

|  | SQL | NoSQL |
|---|---|---|
| **Terms** |  |  |
|  | Table | Collection |
|  | Row | Document |
|  | Column | Field |
| **General** |  |  |
| Data | Related data tables | Objects (JSON-like field-value pair documents) |
| Combine tables | `JOIN` | Nested objects (Embedded documents, linking) |
|  | Have to design first, then fill data. Need to consider schema, normalization, data type, constraints ... | Freer |
|  | Data redundancy is seen as a bad thing and are eliminated by "normalization" | Data redundancy is NOT seen as a bad thing |
|  |  | No triggers nor stored procedures |
|  |  | Suited to projects where initial data requirements are difficult to ascertain & Easier to adapt to requirement changes. |
|  | Transactions | Modification of a single document is atomic (eg. updating 3 values within a document - either all 3 are updated |  successfully or it remains unchanged. But there's no transaction equivalent for updates to multiple documents. Though there are |  transaction-like options: https://docs.mongodb.com/manual/core/write-operations-atomicity/ |
|  |  | Suited to large, distributed systems where the emphasis is data availability |
|  |  | Easier to scale |
|  |  | Faster. NoSQL’s simpler denormalized store allows you to retrieve all information about a specific item in a single request. There’s no need for related JOINs or complex SQL queries. |
| Security | More older and proven technology | https://www.theregister.com/2015/07/21/drongo_mongodbs_spew_600_terabytes_of_unauthenticated_data/ |
| Query language | SQL: lightweight, declarative | JavaScripty-looking queries with JSON-like arguments |
| **MySQL/MongoDB** |  | https://github.com/atabegruslan/Others/blob/master/Illustrations/Storage/mongo/mongo.md |
|  |  | Can have nested records |
|  |  | Auto add a `unique_id` value to each document in a collection. You may still want to define indexes, but that can be done later if necessary |
| Rich Data Model | No | Yes |
| Dynamic Schema | No | Yes (Just another way of saying a much freer structure) |
|  | Need ORM | MongoDB documents map naturally to modern, object-oriented programming languages |
| Typed Data | Yes | Yes |
| Data Locality | No | Yes |
| Field Updates | Yes | Yes |
| Complex Transactions | Yes | No |
| Auditing | Yes | Yes |
| Auto-Sharding | No | Yes |
| **CRUD** |  |  |
| Create | ``INSERT INTO table_name (`col_a`, `col_b`) VALUES ('aa', 'bb')`` | `db.table_name.insert({ col_a: "aa", col_b: "bb" })` |
| Read | `SELECT column_name FROM table_name WHERE searched_column_name > 42` | `db.table_name.find( { searched_column_name: { &gt;: 42 } }, { _id: 0, column_name: 1 } )`. The second JSON object is known as a **projection**: it sets which fields are returned (`_id` is returned by default so it needs to be unset). |
| Read All | `SELECT * FROM table_name` | `db.table_name.find()` |
| Update | `UPDATE table_name SET column_name = "a value" WHERE searched_column_name = "something"` | `db.table_name.update( { searched_column_name: "something" }, { $set: { column_name: "a value" } }, { multi: true } )` |
| Delete | `DELETE FROM table_name WHERE searched_column_name = "something"` | `db.table_name.remove({ "searched_column_name": "something" })` |
| count | `SELECT COUNT(1) FROM table_name WHERE searched_column_name = "something"` | `db.table_name.count({ "searched_column_name": "something" })` |
| grouping/aggregation | ``SELECT column_name, COUNT(1) AS `alias` FROM table_name GROUP BY groupby_column_name`` | `db.table_name.aggregate([ { $group: { _id: "groupby_column_name", total: { $sum: 1 } } } ])`. This is known as **aggregation**: a new set of documents is computed from an original set. |
