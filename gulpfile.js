
var gulp         = require('gulp'),
    sass         = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    cssmin       = require('gulp-cssmin'),
    rename       = require('gulp-rename'),
    concat       = require('gulp-concat'),
    uglify       = require('gulp-uglify'),
    notify       = require('gulp-notify'),
    watch        = require('gulp-watch'),
    livereload   = require('gulp-livereload');


gulp.task('sass', function() {
    return gulp.src('./scss/style.scss')
        // sass, notify
        .pipe(sass({
            errLogToConsole: false,
            onError: function(err) {
                return notify().write(err);
            }
        }))
        .pipe(gulp.dest('./dist'))
        // autoprefixer
        .pipe(rename('style.prefixed.css'))
        .pipe(autoprefixer('last 2 version', 'ie 9'))
        .pipe(gulp.dest('./dist'))
        // cssmin
        .pipe(rename('style.min.css'))
        .pipe(cssmin())
        .pipe(gulp.dest('./dist'));
});


gulp.task('js', function() {
    gulp.src(['./js/scripts.js', './js/*/*.js'])
        // concat
        .pipe(concat('scripts.concat.js'))
        .pipe(gulp.dest('./dist'))
        // uglify
        .pipe(rename('scripts.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./dist'));
});


gulp.task('watch', function() {
    livereload.listen();

    gulp.watch('./scss/**/*.scss', ['sass']).on('change', livereload.changed);
    gulp.watch('./js/**/*.js', ['js']).on('change', livereload.changed);;
    gulp.watch('./**/*.php').on('change', livereload.changed);
});
