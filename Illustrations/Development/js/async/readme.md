# Ways

## Callbacks

- nesting prob

## ES2016 Promises

- nesting prob

![](/Illustrations/Development/js/async/es2016_promises_1.PNG)

![](/Illustrations/Development/js/async/es2016_promises_2.PNG)

![](/Illustrations/Development/js/async/es2016_promises_3.PNG)

### ES2016 Generators (and Coroutines)

- Syntactic sugar over Promises
- Need corouting libs. 
- Generator by itself is like `Goto`

![](/Illustrations/Development/js/async/es2016_generators_and_promises.PNG)

![](/Illustrations/Development/js/async/async_and_generators.PNG)

### ES2017 Async and Await 

- Syntactic sugar over Promises
- Not yet native
     - Majority of ES7 features including async/await have not been natively implemented (11 July 2016). 
     - Native in current Chrome, Node.js but still needs to be transpiled with Babel for most projects (8 Mar 2018).

![](/Illustrations/Development/js/async/es2017_async_and_await_1.PNG)

Bad way:

![](/Illustrations/Development/js/async/es2017_async_and_await_2_bad_way.PNG)

![](/Illustrations/Development/js/async/es2017_async_and_await_3.PNG)

## RxJS (ReactiveX) Observables

- https://www.youtube.com/playlist?list=PL55RiY5tL51pHpagYcrN9ubNLVXF8rGVi
- https://itnext.io/javascript-promises-vs-rxjs-observables-de5309583ca2
- https://levelup.gitconnected.com/promise-vs-observable-vs-stream-165a310e886f

![](/Illustrations/Development/js/async/observe_mobx.PNG)

### Idea of Pull vs Push

![](/Illustrations/Development/js/async/push_pull_0.PNG)

![](/Illustrations/Development/js/async/push_pull_1.PNG)

![](/Illustrations/Development/js/async/push_pull_2.PNG)

# Async in Vue

1. `vue-async-function`: https://xebia.com/blog/next-generation-async-functions-with-vue-async-function/
     - https://www.npmjs.com/package/vue-async-function
2. `transform-regenerator` & `polyfill`: https://stackoverflow.com/questions/46389267/using-async-await-with-webpack-simple-configuration-throwing-error-regeneratorr/46734082
     - https://www.npmjs.com/package/@babel/plugin-transform-regenerator
          - https://babeljs.io/docs/en/next/babel-plugin-transform-regenerator.html
     - https://babeljs.io/docs/en/babel-polyfill
3. Bluebird: https://github.com/atabegruslan/Travel-Blog-Laravel-5-8/commit/9d710ec1b307a5922bf35304e260ff758f5e79ea
     - https://www.npmjs.com/package/bluebird

# Good reads

- https://hackernoon.com/async-await-generators-promises-51f1a6ceede2 <sup>Good - first half</sup>
- https://blog.benestudio.co/async-await-vs-coroutines-vs-promises-eaedee4e0829 <sup>Good</sup>
- https://www.freecodecamp.org/news/write-modern-asynchronous-javascript-using-promises-generators-and-coroutines-5fa9fe62cf74/ <sup>Recap</sup>
