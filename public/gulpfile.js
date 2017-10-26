gulp = require('gulp');
sass = require('gulp-sass');
concat = require('gulp-concat');

gulp.task('compile-css', function(){
	gulp.src('scss/*scss')
		.pipe(sass({outputStyle: 'compressed'}))
		.pipe(concat('app.css'))
		.pipe(gulp.dest('css'))
});