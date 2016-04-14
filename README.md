# Wordpress Workflow

Skeleton project for Wordpress web development.

Includes Gulp for...

* SCSS compiling
* Automatically adding vendor prefixes to CSS
* Concatinating JS to minimise server requests
* Linting Javascript errrors
* Minifying CSS
* Browser Sync - https://www.browsersync.io/

(Optionally) Includes Bower for...

* Rebase - custom CSS reset/SASS defaults - https://gist.github.com/kush1960/f7a197adff86558d1451
* Old-IE-Fixes - Fixes issues with IE < 9 Comprises of a number of hacks/shims from other developers - https://github.com/kush1960/Old-IE-Fixes
* Responsive-nav - lightweight burger nav - http://responsive-nav.com/
* Modernizr - duh!
* Breakpoint-sass - Nice way of hangling media queries - http://breakpoint-sass.com/


## Installing

Checkout repo into the wp-content/themes/ folder
```
git clone https://github.com/kush1960/Wordpress-Workflow.git <theme-name>
```
Install development dependencies with NPM
```
npm install
```
(**Note** Bower is optional - just remove lines from `style.scss` and `header.php` if you don't want to use it)

Install front end dependencies with Bower 
```
bower install
```


## Project notes

* Modernizr should be custom built on a per project bases, only featuring the tests that the website need to test for. The version supplied includes all tests and should **not be used on production sites***.


## How to use

Once installed just run `npm run watch` and you're away.

When working with Javascript follow the simple rules...

1. Put all plugins in the `js/dev/plugins` folder.
2. Put all custom scripts in the `js/dev` folder.

Gulp will combine all JS in to `main.js` 

### Generating minified versions

At the end of a project you may want to minif your CSS/JS. Simply run
```
npm run minify
```
This will create `js/main.min.js` and `style.min.css`. It will only minify your existing CSS/JS - *it will not recompile anything*. 
