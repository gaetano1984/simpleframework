gulp = require('gulp');
sass = require('gulp-sass');
concat = require('gulp-concat');
ugly = require('gulp-uglifycss');

gulp.task('compile-css', function(){
	gulp.src('scss/*scss')
		//.pipe(sass({outputStyle: 'compressed'}))
		.pipe(concat('app.css'))
		.pipe(ugly({
			"maxLineLen": 1,
		}))
		.pipe(gulp.dest('css'))
});