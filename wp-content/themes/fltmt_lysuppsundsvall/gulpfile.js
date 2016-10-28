var gulp         = require('gulp'),
    rename = require("gulp-rename"),
    autoprefixer = require('gulp-autoprefixer');


gulp.task('styles', function() {
  return gulp.src('./assets/css/main.dev.css')
    .pipe(autoprefixer({
      browsers: ['last 2 versions'],
      cascade: false
    }))
    .pipe(rename("main.css"))
    .pipe(gulp.dest('./assets/css/'))
});

gulp.task('default', ['styles']);
