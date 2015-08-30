//load plugins
var gulp    = require('gulp'),
runSequence = require('run-sequence'),
sass        = require('gulp-ruby-sass'),
compass     = require('gulp-compass'),
rev         = require('gulp-rev'),
revDel = require('rev-del'),
del         = require('del'),
minifycss   = require('gulp-minify-css'),
uglify      = require('gulp-uglify'),
rename      = require('gulp-rename'),
concat      = require('gulp-concat'),
notify      = require('gulp-notify'),
plumber     = require('gulp-plumber'),
watch       = require('gulp-watch'),
path        = require('path'),
browserSync = require('browser-sync'),
reload      = browserSync.reload;


  //the title and icon that will be used for the Grunt notifications
  var notifyInfo = {
    title: 'Gulp',
    icon: path.join(__dirname, 'gulp.png')
  };

  //error notification settings for plumber
  var plumberErrorHandler = { errorHandler: notify.onError({
    title: notifyInfo.title,
    icon: notifyInfo.icon,
    message: "Error: <%= error.message %>"
  })
};

//patches
var paths = {
  scriptsAbs : '_coffeescript/',
  stylesAbs: '_scss/',
  scriptsCom : '_coffeescript/' + '**/*.js',
  stylesCom :'_scss/' + '**/*.scss',
  cssCom : 'resources/css',
  jsCom : 'resources/js',
  imgCom : 'resources/img'
};

gulp.task('clean',
  function (cb) {
    del([
      paths.cssCom + '/*',
      paths.jsCom + '/*'
      ], cb);
  });

//styles
gulp.task('styles',
  function() {
    return gulp.src(paths.stylesCom)
    .pipe(plumber(plumberErrorHandler))
    .pipe(compass({
      sass: '_scss',
      css: paths.cssCom,
      image: paths.imgCom,
      style: 'expanded',
      relative: true,
      require: ['normalize-scss', 'susy']
    }))
    .pipe(gulp.dest(paths.cssCom))
    .pipe(rename({ suffix: '.min' }))
    .pipe(minifycss())
    .pipe(gulp.dest(paths.cssCom))
    .pipe(rev())
    .pipe(gulp.dest(paths.cssCom))
    .pipe(rev.manifest())
    .pipe(revDel({ dest: paths.cssCom }))
    .pipe(gulp.dest(paths.cssCom))
    .pipe(notify({ message: 'Styles task completed' }))
    .pipe(reload({stream:true}));

  });

//scripts
gulp.task('scripts',
  function() {
    return gulp.src(paths.scriptsCom)
    .pipe(plumber(plumberErrorHandler))
    .pipe(concat('main.js'))
    .pipe(gulp.dest(paths.jsCom))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest(paths.jsCom))
    .pipe(rev())
    .pipe(gulp.dest(paths.jsCom))
    .pipe(rev.manifest())
    .pipe(revDel({ dest: paths.jsCom }))
    .pipe(gulp.dest(paths.jsCom))
    .pipe(notify({ message: 'Scripts Concatenated completed' }))
  // .pipe(reload({stream:true}));

});

/* Relod task */
gulp.task('bs-reload',
  function () {
    browserSync.reload();
  });

/* Prepare Browser-sync for localhost */
gulp.task('browser-sync',
  function() {
    browserSync.init([patchs.stylesAbs, paths.jsCom], {
      proxy: 'www.forbes.com.mx',
      browser: ["google chrome"]

    });
  });

gulp.task('default', ['clean','styles','scripts'], function(){
  gulp.watch(paths.stylesCom, ['styles'])
  gulp.watch(paths.scriptsCom, ['scripts'])

//watch .php files
// gulp.watch(['*.php'], ['bs-reload'])
});