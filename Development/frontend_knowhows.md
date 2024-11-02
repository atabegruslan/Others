# `<object>`

Generic way to embed media. https://www.geeksforgeeks.org/html-object-tag/

# Embed PDF

https://stackoverflow.com/questions/291813/recommended-way-to-embed-pdf-in-html

# Image zoom view

Tool: https://github.com/openseadragon/openseadragon 

Result: https://www.raremaps.com/gallery/detail/84631/medieval-mappa-mundi-apographon-descriptionis-orbis-ter-anonymous

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

https://github.com/atabegruslan/Others/blob/master/Development/php_js_knowhows.md#nodejs--npm

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

- https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/templating/jade
- https://github.com/Ruslan-Aliyev/ExpressJS-Google-SignIn/tree/master/views

## Smarty

- https://github.com/atabegruslan/Others/blob/master/Illustrations/Development/templating/smarty/smarty.md

# Web worker

- https://blog.logrocket.com/web-workers-react-typescript
- EG: https://github.com/atabegruslan/Laravel_CRUD_API#3rd-party-notifications---webpush
- All types of workers: https://github.com/atabegruslan/Others/blob/master/Development/comparisons.md#workers

# Performance

![](/Illustrations/Development/fe_performance.png)

# CSS

## Good Practice

- https://www.youtube.com/watch?v=Qhaz36TZG5Y

## Defer & Async

Defer:  
CSS files are render-blocking resources: they must be loaded and processed before the browser renders the page. Web pages that contain unnecessarily large styles take longer to render. `defer` defers non-critical CSS.

- If async is present: The script is downloaded in parallel to parsing the page, and executed as soon as it is available (before parsing completes)
- If defer is present (and not async): The script is downloaded in parallel to parsing the page, and executed after the page has finished parsing
- If neither async or defer is present: The script is downloaded and executed immediately, blocking parsing until the script is completed


https://web.dev/defer-non-critical-css

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

## Add lens flare

https://css-tricks.com/add-a-css-lens-flare-to-photos-for-a-bright-touch
