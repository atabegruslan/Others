# JS Templating

https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/js/js_templating.html

# `<object>`

Generic way to embed media. https://www.geeksforgeeks.org/html-object-tag/

# `<noscript>`

When JS isn't supported. https://www.w3schools.com/tags/tag_noscript.asp

# Boilerplates (scaffolder)

## With Initializr

Initializr website: http://www.initializr.com/  
You can chose choose Modernizr, Shivs ... here

Ability-wise: Modernizr includes shiv. They are used to detect browser differences.

https://stackoverflow.com/questions/8275580/modernizr-vs-html-shiv

### The "no-js" class

> When Modernizr runs, it removes the "no-js" class and replaces it with "js".

https://stackoverflow.com/questions/6724515/what-is-the-purpose-of-the-html-no-js-class

## With Yeoman

```
npm install -g yo
npm install -g generator-webapp
```

cd into project folder, `yo`  
choose eg webapp  
choose what u wanna include: eg modernizr ...  

https://www.youtube.com/watch?v=gKiaLSJW5xI&t=317s

# Node.js & NPM (package manager)

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

# Other frontend tools

## Yarn (package manager)

## Bower (package manager)

- https://www.youtube.com/watch?v=Vs2wduoN9Ws

1. Install Node
2. Run in terminal from any directory: `npm install -g bower`
3. Run in terminal from project directory: `bower install jquery`, `bower list --paths`

- https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/bower_grunt_cheatsheets.pdf

## Grunt (automatic task runner)

- https://github.com/atabegruslan/Trip-Blog-Plain-PHP-MVC#grunt

## Gulp (automatic task runner)

Have Node.js first
```
npm install --global gulp-cli # Install Gulp
mkdir my-project # Make project
cd my-project
npm init
mkdir sass
touch index.html
touch sass/one.scss
touch sass/two.scss
npm install --save-dev gulp # Install Gulp into project
touch gulpfile.js
npm install sass
npm install gulp-sass
npm install gulp-concat-css
npm install gulp-uglifycss
```

`gulpfile.js`
```js
'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass')(require('sass'));
const concatCss = require('gulp-concat-css');
var uglifycss = require('gulp-uglifycss');


gulp.task('sass', function() {
  return gulp.src('./sass/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(concatCss('all.css'))
    .pipe(gulp.dest('./css'));
});

gulp.task('css', function () {
  return gulp.src('./css/*.css')
    .pipe(uglifycss({
      "uglyComments": true
    }))
    .pipe(gulp.dest('./dist/'));
});

gulp.task('run', gulp.series('sass', 'css'));

gulp.task('watch', function(){
  gulp.watch('./sass/*.scss', gulp.series('sass'));
  gulp.watch('./css/*.css', gulp.series('css'));
});

gulp.task('default', gulp.series('run', 'watch'));
```

In `index.html` make `<link rel="stylesheet" href="/dist/all.css">`

```
gulp
```

- https://www.youtube.com/watch?v=LYbt50dhTko
- https://www.npmjs.com/package/gulp-sass
- https://www.npmjs.com/package/gulp-uglifycss
- https://medium0.com/@withApples/gulp-intro-from-sass-to-minify-css-96c628846c1d
- https://stackoverflow.com/questions/64868905/combine-all-scss-file-to-one-css-file-using-gulp/64869031#64869031
- https://stackoverflow.com/questions/51098749/everytime-i-run-gulp-anything-i-get-a-assertion-error-task-function-must-be/57451302#57451302
- https://stackoverflow.com/questions/59509001/gulp-watch-requires-watch-task-to-be-a-function-but-the-task-is-already-a-funct/60141480#60141480

## Compass (automatic task runner)

https://github.com/Ruslan-Aliyev/compass_sprites

# Templating Engines

## Twig

- https://github.com/atabegruslan/Trip-Blog-Plain-PHP-MVC#twig

## Jade/Pug

- https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/templating/jade/
- https://github.com/Ruslan-Aliyev/ExpressJS-Google-SignIn/tree/master/views

## Smarty

- https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/templating/smarty/smarty.md

# CSS

## Defer

CSS files are render-blocking resources: they must be loaded and processed before the browser renders the page. Web pages that contain unnecessarily large styles take longer to render. `defer` defers non-critical CSS.

https://web.dev/defer-non-critical-css/

## Font-size, accessability

These are the available CSS font-size units: https://www.w3schools.com/cssref/css_units.asp  
Most notably: `em` and `rem`.   
Take this setting for example: `<p>Some text<span>Some more text</span></p>`:   
- For `em`: If `p` is set to have `font-size` of `30px`, and then you give `span` a `font-size` of `0.5em`, then `span` will have a `font-size` of `15px`.    
- For `rem`: If the root element (normally `<html>`) have a `font-size` of `30px`, and then you give `span` a `font-size` of `0.5em`, then `span` will have a `font-size` of `15px`.  
With that background knowledge, we can start talking about the visually-impared: https://whitep4nth3r.com/blog/how-to-make-your-font-sizes-accessible-with-css/   
In Chrome, a user can go to `settings > appearance > font size` and set font size to XL, L, M, S or XS.  
What you, as a developer should do next is:  
- Set the root element to: `html { font-size: 100% }`
- Use `rem` as font units for all the text elements.  

## `attr` vs `data`

Read: https://coderwall.com/p/t_cgwq/when-is-better-to-use-data-or-attr

Note, If you are programming a website for iPhone Safari, `data-{stuff}` will be lost. Better to use attr.  
