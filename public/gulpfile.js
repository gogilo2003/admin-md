var gulp = require('gulp');
var path = require('path');
var sass = require('gulp-sass')(require('sass'));
var less = require('gulp-less');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var open = require('gulp-open');
var minify = require('gulp-clean-css');
var gulpCopy = require('gulp-copy');
var through = require('through2');

var Paths = {
    HERE: './',
    DIST: 'dist/',
    CSS: './css/',
    SCSS_WEB: './scss/web.scss',
    SCSS: './scss/**/**'
};

gulp.task('compile-scss', function() {
    return gulp.src(Paths.SCSS_WEB)
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer())
        .pipe(minify())
        .pipe(sourcemaps.write(Paths.HERE))
        .pipe(gulp.dest(Paths.CSS));
});

const jsOutputPath = "js"
const cssOutputPath = "css"
const imgOutputPath = "img"
const themesOutputPath = "themes"
const fontsOutputPath = "fonts"

// Bootstrap resources
gulp.task('js-bootstrap', function() {
    return gulp
        .src(['./node_modules/bootstrap/dist/js/bootstrap.min.*'])
        .pipe(gulpCopy(jsOutputPath, { prefix: 4 }))
        .pipe(verify());
})

gulp.task('css-bootstrap', function() {
    return gulp
        .src(['./node_modules/bootstrap/dist/css/bootstrap.min.*'])
        .pipe(gulpCopy(cssOutputPath, { prefix: 4 }))
        .pipe(verify());
})

// Bootstrap-Datepicker resources
gulp.task('js-bootstrap-datetimepicker', function() {
    return gulp
        .src(['./node_modules/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.*', './node_modules/bootstrap-datetime-picker/js/locales/*.*'])
        .pipe(gulpCopy(jsOutputPath, { prefix: 3 }))
        .pipe(verify());
})

gulp.task('css-bootstrap-datetimepicker', function() {
    return gulp
        .src(['./node_modules/bootstrap-datetime-picker/css/bootstrap-datetimepicker.min.*'])
        .pipe(gulpCopy(cssOutputPath, { prefix: 3 }))
        .pipe(verify());
})

// Bootstrap-3-typeahead resources
gulp.task('js-bootstrap-3-typeahead', function() {
    return gulp
        .src(['./node_modules/bootstrap-3-typeahead/bootstrap3-typeahead.min.js'])
        .pipe(gulpCopy(jsOutputPath, { prefix: 2 }))
        .pipe(verify());
})

// Bootstrap-fileinput resources
gulp.task('js-bootstrap-fileinput', function() {
    return gulp
        .src(['./node_modules/bootstrap-fileinput/js/fileinput.min.js', './node_modules/bootstrap-fileinput/js/locales/*.*', './node_modules/bootstrap-fileinput/js/plugins/*.min*'])
        .pipe(gulpCopy(jsOutputPath, { prefix: 3 }))
        .pipe(verify());
})

gulp.task('css-bootstrap-fileinput', function() {
    return gulp
        .src(['./node_modules/bootstrap-fileinput/css/fileinput.min.*'])
        .pipe(gulpCopy(cssOutputPath, { prefix: 3 }))
        .pipe(verify());
})

gulp.task('img-bootstrap-fileinput', function() {
    return gulp
        .src(['./node_modules/bootstrap-fileinput/img/*.*'])
        .pipe(gulpCopy(imgOutputPath, { prefix: 3 }))
        .pipe(verify());
})

gulp.task('themes-bootstrap-fileinput', function() {
    return gulp
        .src(['./node_modules/bootstrap-fileinput/themes/*.*', './node_modules/bootstrap-fileinput/themes/*/*.*'])
        .pipe(gulpCopy(themesOutputPath, { prefix: 3 }))
        .pipe(verify());
})

// Bootstrap-hover-dropdown resources
gulp.task('js-bootstrap-hover-dropdown', function() {
    return gulp
        .src(['./node_modules/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js'])
        .pipe(gulpCopy(jsOutputPath, { prefix: 2 }))
        .pipe(verify());
})

// Bootstrap-notify resources
gulp.task('js-bootstrap-notify', function() {
    return gulp
        .src(['./node_modules/bootstrap-notify/bootstrap-notify.min.js'])
        .pipe(gulpCopy(jsOutputPath, { prefix: 2 }))
        .pipe(verify());
})

// Bootstrap-select resources
gulp.task('js-bootstrap-select', function() {
    return gulp
        .src(['./node_modules/bootstrap-select/dist/js/bootstrap-select.min.*', './node_modules/bootstrap-select/dist/js/locales/*.*', './node_modules/bootstrap-select/dist/js/i18n/*.*'])
        .pipe(gulpCopy(jsOutputPath, { prefix: 3 }))
        .pipe(verify());
})

gulp.task('css-bootstrap-select', function() {
    return gulp
        .src(['./node_modules/bootstrap-select/dist/css/bootstrap-select.min.*'])
        .pipe(gulpCopy(cssOutputPath, { prefix: 3 }))
        .pipe(verify());
})

// Cropper resources
gulp.task('js-cropper', function() {
    return gulp
        .src(['./node_modules/cropper/dist/cropper.min.js', './node_modules/cropper/dist/cropper.common.js', './node_modules/cropper/dist/cropper.esm.js'])
        .pipe(gulpCopy(jsOutputPath, { prefix: 3 }))
        .pipe(verify());
})

gulp.task('css-cropper', function() {
    return gulp
        .src(['./node_modules/cropper/dist/cropper.min.css'])
        .pipe(gulpCopy(cssOutputPath, { prefix: 3 }))
        .pipe(verify());
})

// Datatables resources
gulp.task('js-datatables', function() {
    return gulp
        .src(['./node_modules/datatables/media/js/*.min.js'])
        .pipe(gulpCopy(jsOutputPath, { prefix: 4 }))
        .pipe(verify());
})

gulp.task('css-datatables', function() {
    return gulp
        .src(['./node_modules/datatables/media/css/*.min.css'])
        .pipe(gulpCopy(cssOutputPath, { prefix: 4 }))
        .pipe(verify());
})

gulp.task('img-datatables', function() {
    return gulp
        .src(['./node_modules/datatables/media/images/*.*'])
        .pipe(gulpCopy('images', { prefix: 4 }))
        .pipe(verify());
})

// Fontawesome
gulp.task('css-font-awesome', function() {
    return gulp
        .src(['./node_modules/font-awesome/css/*.*'])
        .pipe(gulpCopy(cssOutputPath, { prefix: 3 }))
        .pipe(verify());
})

gulp.task('fonts-font-awesome', function() {
    return gulp
        .src(['./node_modules/font-awesome/fonts/*.*'])
        .pipe(gulpCopy(fontsOutputPath, { prefix: 3 }))
        .pipe(verify());
})

// Jquery
gulp.task('js-jquery', function() {
    return gulp
        .src(['./node_modules/jquery/dist/jquery.min.*'])
        .pipe(gulpCopy(jsOutputPath, { prefix: 3 }))
        .pipe(verify());
})

// Moment
gulp.task('js-moment', function() {
    return gulp
        .src(['./node_modules/moment/min/moment.min.*'])
        .pipe(gulpCopy(jsOutputPath, { prefix: 3 }))
        .pipe(verify());
})

// Popper
gulp.task('js-popper', function() {
    return gulp
        .src(['./node_modules/popper.js/dist/popper.min.*'])
        .pipe(gulpCopy(jsOutputPath, { prefix: 3 }))
        .pipe(verify());
})

// Tinymce
gulp.task('js-tinymce', function() {
    return gulp
        .src(['./node_modules/tinymce/*.min.*', './node_modules/tinymce/icons/default/*.*', './node_modules/tinymce/plugins/**/*.*', './node_modules/tinymce/skins/**/**/*.*', './node_modules/tinymce/themes/**/*.*'])
        .pipe(gulpCopy(jsOutputPath, { prefix: 2 }))
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

gulp.task('js', gulp.series('js-bootstrap', 'js-bootstrap-datetimepicker', 'js-bootstrap-3-typeahead', 'js-bootstrap-fileinput', 'js-bootstrap-hover-dropdown', 'js-bootstrap-select', 'js-cropper', 'js-datatables', 'js-jquery', 'js-moment'))
gulp.task('css', gulp.series('css-bootstrap', 'css-bootstrap-datetimepicker', 'css-bootstrap-fileinput', 'css-bootstrap-select', 'css-cropper', 'css-datatables', 'css-font-awesome'))
gulp.task('img', gulp.series('img-bootstrap-fileinput', 'img-datatables'))
gulp.task('themes', gulp.series('themes-bootstrap-fileinput'))
gulp.task('fonts', gulp.series('fonts-font-awesome'))
gulp.task('copy', gulp.series('js', 'css', 'img', 'themes', 'fonts'))

gulp.task('watch', function() {
    gulp.watch(Paths.SCSS, ['compile-scss']);
});