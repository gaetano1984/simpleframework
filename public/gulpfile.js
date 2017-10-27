gulp = require('gulp');
sass = require('gulp-sass');
concat = require('gulp-concat');
ugly = require('gulp-uglifycss');
mincss = require('gulp-minify-css');

gulp.task('compile-css', function(){
	gulp.src('scss/*scss')
		.pipe(concat('app.css'))
		.pipe(mincss())
		.pipe(gulp.dest('css'))
});