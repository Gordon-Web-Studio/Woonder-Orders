'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('sass', function () {
	gulp.src('admin/scss/*.scss')
	.pipe(sass().on('error', sass.logError))
	.pipe(gulp.dest('admin/css/'));
});

gulp.task('sass:watch', function() {
	gulp.watch('admin/scss/*.scss', ['sass']);
});
