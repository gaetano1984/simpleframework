gulp = require('gulp');
concat = require('gulp-concat');
mincss = require('gulp-clean-css');

gulp.task('compile-css', function(){
	gulp.src('scss/*scss')
		.pipe(concat('app.css'))
		.pipe(mincss())
		.pipe(gulp.dest('css'))
});	