# Wordpress Workflow

Skeleton project for Wordpress web development.

Includes Gulp for...

* SCSS compiling
* Automatically adding vendor prefixes to CSS
* Concatinating JS to minimise server requests and allow dev js to be seperated in to multiple files for modularity 
* Linting Javascript errrors
* Minifying CSS
* Browser Sync - https://www.browsersync.io/
* CSS sourcemaps

(Optionally) Includes Bower for...

* Rebase - custom CSS reset/SASS defaults - https://gist.github.com/kush1960/f7a197adff86558d1451
* Old-IE-Fixes - Fixes issues with IE < 9 Comprises of a number of hacks/shims from other developers - https://github.com/kush1960/Old-IE-Fixes
* Responsive-nav - lightweight burger nav - http://responsive-nav.com/
* Modernizr - duh!
* Breakpoint-sass - Nice way of handling media queries - http://breakpoint-sass.com/


## Installing

Checkout repo into the project root folder
```
git clone https://github.com/kush1960/Wordpress-Workflow.git <public>
```
Download the lastest stable Wordpress (https://wordpress.org/latest.zip) and copy over the top of the Workflow files

In Terminal navigate to `wp-content/themes/workflow/`

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
3. Prefix your files with numbers if you need to ensure something is loaded before something else.

Gulp will combine all JS in to `main.js` 

### Generating minified versions

At the end of a project you may want to minif your CSS/JS. Simply run
```
npm run minify
```
This will create `js/main.min.js` and `style.min.css`. It will only minify your existing CSS/JS - *it will not recompile anything*. 










-----------------------------------------

# README.md template for your live project #

-----------------------------------------



# {Name of Project} #


{Brief paragraph introducing the project and describing it's functionality}


Live URL 
```
http://www.{name of project}.co.uk/
```


Staging URL
```
http://{name of project}.devcite.co.uk/
```


Development URL
```
http://{name of project}.dev.co.uk/
```


## Local development setup ##


{Description of how to setup the project for local development}


### Project dependencies: 
+ [WordPress core](https://en-gb.wordpress.org/)


### Front-end dependencies: 


+ [Sass](http://sass-lang.com/)
+ [Grunt](http://gruntjs.com/)
+ [Gulp](http://gulpjs.com/)


### Required Plugins : 


+ [Advanced Custom Fields](https://en-gb.wordpress.org/plugins/advanced-custom-fields/)
+ [Advanced Custom Fields: Repeater Field](https://www.advancedcustomfields.com/add-ons/repeater-field/)
+ [Contact Form 7](https://wordpress.org/plugins/contact-form-7/)
+ [Really Simple CAPTCHA](https://wordpress.org/plugins/really-simple-captcha/)
+ [Redirection](https://wordpress.org/plugins/redirection/)
+ [Sitemap](https://wordpress.org/plugins/sitemap/)
+ [Types - Complete Solution for Custom Fields and Types](https://wp-types.com/)
+ [WordPress SEO](https://wordpress.org/plugins/wordpress-seo/)
+ [WP Store Locator](https://wordpress.org/plugins/wp-store-locator/)




## Deployment ##


This project is configured for auto deployment using DeployHQ. Auto deployment has been setup for the following branches:


Staging site
```
staging
```


Live site
```
production
```


## Further information ##


{Other information about the project here}
