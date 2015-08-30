var plan = require('flightplan'),
$host = '162.250.145.172',
$username = 'root',
$password = 'apollo+luna!',
$domain = '162.250.145.172',
$themeName = 'dev.proto.culture',
$localPath = '/var/www/html/tmp',
$remoteRootPath = '/var/www/html/public/wp-content/themes/$themeName';


// configuration
plan.target('dev', [
{
  host: $host,
  username: $username,
  password:$password,
  port: 1617,
  agent: process.env.SSH_AUTH_SOCK
},
]);


plan.local(function(toLocal){
  toLocal.log('Run build');
  toLocal.log('Copy files to remote hosts');
  var filesToCopy = toLocal.exec('sudo git ls-files', {silent: true});
  toLocal.transfer(filesToCopy, $localPath);
});

plan.remote(function(toEarth){
  toEarth.log('Clean Install');
  toEarth.rm('-rf $remoteRootPath/resources/*');

  toEarth.log('Move folder to tmp folder in Earth Local');
  toEarth.rsync('-a --info=progress2 --exclude=".*" $localPath/wp-content/themes/$themeName/* $remoteRootPath');

  toEarth.log('Delete Garbage');
  toEarth.rm('-rf $remoteRootPath/_coffeescript/' )
  toEarth.rm('-rf $remoteRootPath/_scss/' )
  toEarth.rm('-rf $remoteRootPath/node_modules/' )
  toEarth.rm('-rf $remoteRootPath/_img/' )
  toEarth.rm('$remoteRootPath/gulpfile.js' )
  toEarth.rm('$remoteRootPath/gulp.png' )
  toEarth.rm('$remoteRootPath/package.json' )
  toEarth.rm('-rf $localPath/.*');
  toEarth.rm('-rf $localPath/*');

  toEarth.log('Change User');
  toEarth.chown('-R www-data:www-data $remoteRootPath/');
  toEarth.chown('-R www-data:www-data $remoteRootPath/*');

});

