'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');

gulp.task('sass', function () {
	return gulp.src('./admin/scss/styles.scss')
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest('./admin/css/'));
});

gulp.task('watch', function() {
	gulp.watch('./admin/scss/**/*.scss', gulp.series('sass'));
});
