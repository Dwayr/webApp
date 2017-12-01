var gulp = require('gulp');
var concat = require('gulp-concat');

gulp.task('javascript', function() {
    return gulp.src([
        './components/moment/moment.min.js',
        './components/sweetalert2.all.min.js',
        
        './components/jquery/jquery-1.11.3.min.js',
        './components/bootstrap/bootstrap.min.js',
        './components/tagsinput/bootstrap-tagsinput.min.js',
        './components/angular/angular.min.js',
        './components/angular/angular-animate.min.js',
        './components/angular/ngAlertify.js',
        './components/angular/datepicker/datepicker.js',
        './components/angular/input_tag/ng-tags-input.min.js',
        './components/angular/v_accordion/v-accordion.js',
        
        './resources/js/*.js',
        './resources/js/controllers/*.js',
    ]).pipe(concat('js/all.js')).pipe(gulp.dest('./dist/'));
});

gulp.task('css', function() {
    return gulp.src([
        './components/bootstrap/bootstrap.min.css',
        './components/bootstrap/bootstrap.rtl.css',
        './resources/css/bootstrap.edit.css',
        './components/fontawesome/css/font-awesome.min.css',
        
        './components/angular/input_tag/ng-tags-input.css',
        './components/angular/datepicker/datepicker.css',
        './components/tagsinput/bootstrap-tagsinput.css',
        './components/angular/v_accordion/v-accordion.css',
        
        './resources/styles.css',
        './resources/styles/*.css',
    ]).pipe(concat('css/all.css')).pipe(gulp.dest('./dist/'));
});

gulp.task('fonts', function() {
    return gulp.src([
        './components/fontawesome/fonts/**.*',
        './components/fonts/DroidArabicKufiRegular.ttf',
    ]).pipe(gulp.dest('./dist/fonts'));
});

gulp.task('img', function() {
    return gulp.src([
        './resources/img/background-hi.jpg',
    ]).pipe(gulp.dest('./dist/img'));
});

gulp.task('default', [ 'javascript', 'css', 'fonts', 'img' ]);