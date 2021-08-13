var gulp = require('gulp');
var path = require('path');
var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var open = require('gulp-open');
var gulpCopy = require('gulp-copy');
var through = require('through2');

var Paths = {
    HERE: './',
    DIST: 'dist/',
    CSS: './assets/css/',
    SCSS_TOOLKIT_SOURCES: './assets/scss/material-dashboard.scss',
    SCSS_PRINT_SOURCES: './assets/scss/print.scss',
    SCSS: './assets/scss/**/**',
    PLUGINS: './assets/js/plugins'
};

gulp.task('compile-scss', function() {
    return gulp.src(Paths.SCSS_TOOLKIT_SOURCES)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(sourcemaps.write(Paths.HERE))
        .pipe(gulp.dest(Paths.CSS));
});

gulp.task('compile-print-scss', function() {
    return gulp.src(Paths.SCSS_PRINT_SOURCES)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(sourcemaps.write(Paths.HERE))
        .pipe(gulp.dest(Paths.CSS));
});

gulp.task('js-chart-js', function() {
    return gulp
        .src(['./node_modules/chart.js/dist/Chart.min.js'])
        .pipe(gulpCopy(Paths.PLUGINS, { prefix: 3 }))
        .pipe(verify());
})

gulp.task('css-chart-js', function() {
    return gulp
        .src(['./node_modules/chart.js/dist/Chart.min.css'])
        .pipe(gulpCopy(Paths.CSS, { prefix: 3 }))
        .pipe(verify());
})

function verify() {
    var options = { objectMode: true };
    return through(options, write, end);

    function write(file, enc, cb) {
        console.log('Copied', file.path);
        cb(null, file);
    }

    function end(cb) {
        console.log('done');
        cb();
    }
}

gulp.task('watch', function() {
    gulp.watch(Paths.SCSS, ['compile-scss']);
});

gulp.task('open', function() {
    gulp.src('examples/dashboard.html')
        .pipe(open());
});

gulp.task('open-app', gulp.series('open', 'watch'));