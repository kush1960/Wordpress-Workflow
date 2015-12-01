// Based on markgoodyear.com/2014/01/getting-started-with-gulp/ with additions for BrowserSync


// Project Settings

var domain = "radiotherapyconference.dev.co.uk";


var gulp         = require('gulp');
var browserSync  = require('browser-sync').create();
var sass         = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var minifycss    = require('gulp-minify-css');
var rename 		 = require('gulp-rename');
var notify       = require('gulp-notify');
var jshint       = require('gulp-jshint');
var uglify       = require('gulp-uglify');
var concat       = require('gulp-concat');
var cache        = require('gulp-cache');
var imagemin     = require('gulp-imagemin');
var svg2png      = require('gulp-svg2png');

// Proxy Server + watching scss/html files
gulp.task('watch', ['sass'], function() {

    browserSync.init({
    	files: "*.css",
        proxy: domain,
       // tunnel: "cite", // use external domain (can be buggy)
        open: false, // stop browserSync from opening new browser tab
        online: true // change this to false if you want to speed up browserSync (prevents access from other machines)
    });    

    gulp.watch("scss/*.scss", ['sass']);
   
    gulp.watch("*.php").on('change', browserSync.reload);

    gulp.watch('js/dev/**/*.js', ['scripts']); // watch scripts dev folder and compress/move/etc if changes    
    gulp.watch(['js/*.js']).on('change', browserSync.reload); // reload browser if new js appears

   
    gulp.watch('img/dev/*', ['images']); // Watch image files and compress if changed
    gulp.watch(['img/*']).on('change', browserSync.reload); // reload browser if new imgs appear

});

gulp.task('clear', function (done) {
  return cache.clearAll(done);
});


// Compile sass into CSS & auto-inject into browsers
gulp.task('sass', function() {
    return gulp.src("scss/style.scss")
        .pipe(sass())
        .on('error', onError)
        .pipe(autoprefixer('last 2 version'))
        .pipe(gulp.dest(""))
        .pipe(rename({ suffix: '.min' }))
  		.pipe(minifycss())
		.pipe(gulp.dest(""))
        .pipe(browserSync.stream())		
        .pipe(notify({ message: 'SASS task complete' }));        
});


function onError(err) {
  console.log(err);
  this.emit('end');
}


// Custom JS Scripts
gulp.task('scripts', function() {

    // merge, minify, lint and move any JS in the dev folder
    return gulp.src('js/dev/*.js')
    .pipe(jshint('.jshintrc'))
    .pipe(jshint.reporter('jshint-stylish'))
    .pipe(concat('main.js'))
    .pipe(gulp.dest('js'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest('js'));
});



// Generate scripts task
gulp.task('generateScripts', function() {

    // move and compress Old IE Fixes
    gulp.src('bower_components/Old-IE-Fixes/IE7-8Fixes.js')
    .pipe(notify({ title: 'Adding project dependencies...', message: '' }))
    .pipe(gulp.dest('js'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest('js'))
    .pipe(notify({ title: 'Adding project dependencies...', message: 'IE7-8 fixes added' }));

    // move Jquery to JS folder
    gulp.src('bower_components/jquery/dist/jquery.min.js')
    .pipe(gulp.dest('js'))
    .pipe(notify({ title: 'Adding project dependencies...', message: 'jQuery CDN fallback' }));

    // move Responsive Nav to JS/dev/plugins folder
    gulp.src('bower_components/responsive-nav/responsive-nav.js')
    .pipe(gulp.dest('js/dev/plugins/'))
    .pipe(notify({ title: 'Adding project dependencies...', message: 'Responsive Nav' }));

    // Combine plugins and custom JS 
    gulp.src('js/dev/plugins/*.js')
    .pipe(jshint('.jshintrc'))
    .pipe(jshint.reporter('jshint-stylish'))
    .pipe(concat('0plugins.js'))
    .pipe(gulp.dest('js/dev'))
    .pipe(notify({ title: 'Adding project dependencies...', message: 'Plugins & custom JS generated in main.js'  }));

});

// There's a bug with this.... Because the tasks run asynchronously Build needs to be run 3 times to generate main.js
// Run 1 - creates Responsive nav in plugin folder
// Run 2 - creates plugins.js
// Run 3 - creates main.js


// Images
gulp.task('images', function() {

  gulp.src('img/dev/**/*.svg')
    .pipe(svg2png())
    .pipe(gulp.dest('img'));

  return gulp.src('img/dev/**/*')
    .pipe(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true }))
    .pipe(gulp.dest('img'))
    .pipe(notify({ message: 'Images task complete' }));
});



// Build Task
gulp.task('build', ['generateScripts'], function() {
    gulp.start('sass', 'images', 'scripts');
});
