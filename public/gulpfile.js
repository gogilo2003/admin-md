var gulp = require('gulp');
var path = require('path');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var open = require('gulp-open');
var minify = require('gulp-minify-css');

var Paths = {
    HERE: './',
    DIST: 'dist/',
    CSS: './css/',
    SCSS_WEB: './scss/web.scss',
    SCSS: './scss/**/**'
};

gulp.task('compile-scss', function () {
    return gulp.src(Paths.SCSS_WEB)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(minify())
        .pipe(sourcemaps.write(Paths.HERE))
        .pipe(gulp.dest(Paths.CSS));
});


gulp.task('watch', function () {
    gulp.watch(Paths.SCSS, ['compile-scss']);
});

