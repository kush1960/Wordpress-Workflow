// ------------------------------------------------- configs
var paths = {
  sass: {
    src: './scss/*.{scss,sass}',
    dest: './'
  },
  jsplugins: {
    src: 'js/dev/plugins/*.js',
    dest: 'js/dev'
  },
  jsscripts: {
    src: 'js/dev/*.js',
    dest: 'js'
  }    
};

var domain = "workflow.dev.co.uk";



// ------------------------------------------------ requires
var gulp = require('gulp'),
    sass = require('gulp-sass'),
    browserSync  = require('browser-sync'),
    autoprefixer = require('gulp-autoprefixer'),
    cssnano = require('gulp-cssnano'),
    rename  = require('gulp-rename'),
    concat  = require('gulp-concat'),
    uglify  = require('gulp-uglify'),
    jshint  = require('gulp-jshint');

// ---------------------------------------------- Gulp Task - CSS
gulp.task('sass', function () {
  return gulp.src(paths.sass.src)
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer('last 2 version'))
    .pipe(gulp.dest(paths.sass.dest))
    .pipe(browserSync.reload({stream: true}))
    .pipe(rename({ suffix: '.min' }))
        .pipe(cssnano())
        .pipe(gulp.dest(paths.sass.dest))  
});


// ---------------------------------------------- Gulp Task - JS Plugins combine
gulp.task('plugins', function() {
  return gulp.src(paths.jsplugins.src)
    .pipe(jshint('.jshintrc'))
    .pipe(jshint.reporter('jshint-stylish'))
    .pipe(concat('plugins.js'))
    .pipe(gulp.dest(paths.jsplugins.dest));
});


// ---------------------------------------------- Gulp Task - combine all JS into  one file
gulp.task('scripts', function() {
  return gulp.src(['js/dev/plugins.js',paths.jsscripts.src])
    .pipe(jshint('.jshintrc'))
    .pipe(jshint.reporter('jshint-stylish'))
    .pipe(concat('main.js'))
    .pipe(gulp.dest(paths.jsscripts.dest))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest(paths.jsscripts.dest));
});


// ---------------------------------------------- Gulp Task - Browser Sync
gulp.task('browser-sync', function () {
  return browserSync({
    open: false,
    files: "*.css",
    proxy: domain
  });
});





// ------------------------------------ Gulp Testing Message
gulp.task('message', function(){
  console.log('It works!!');
});

// ---------------------------------------------- Gulp Watch
gulp.task('watch:styles', function () {
  gulp.watch(paths.sass.src, gulp.series('sass'));
});
gulp.task('watch:plugins', function () {
  gulp.watch(paths.jsplugins.src, gulp.series('plugins'));
});
gulp.task('watch:scripts', function () {
  gulp.watch(paths.jsscripts.src, gulp.series('scripts'));
});
gulp.task('watch', gulp.series('sass',
  gulp.parallel('browser-sync','watch:styles','watch:plugins','watch:scripts')
));
