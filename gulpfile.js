var gulp = require('gulp');
var gulpCopy = require('gulp-copy');
var npmDist = require('gulp-npm-dist');

// Copy dependencies to ./web/libs/
gulp.task('default', function () {
    /*gulp.src(npmDist(), {base: './node_modules'})
        .pipe(gulp.dest('./web/libs'));*/

    // Copy other required files
    var sourceFiles = ['./node_modules/blueimp-canvas-to-blob/js/*.js', './node_modules/blueimp-load-image/js/*.js'];
    var outputPath = './web/libs/';

    return gulp
        .src(sourceFiles)
        .pipe(gulpCopy(outputPath, {prefix: 1}));
});