var plan = require('flightplan'),
$host = ,
$username = ,
$password = ,
$domain = ,
$localPath = ,
$remoteRootPath = ;

// configuration
plan.target('prod', [
{
  host: $host,
  username: $username,
  password: $password,
  port: 1617,
  agent: process.env.SSH_AUTH_SOCK
},
]);


plan.local(function(toLocal){
  toLocal.log('Run build');
  toLocal.log('Copy files to remote hosts');
  var filesToCopy = toLocal.exec('sudo git ls-files', {silent: true});
  toLocal.transfer(filesToCopy, '/home/forbesmx/tmp/');
});

plan.remote(function(toRemote){
  toRemote.log('Clean Install');
  toRemote.rm('-rf /home/forbesmx/forbes.com.mx/http/wp-content/themes/forbesmx-lite/resources/*');

  toRemote.log('Move folder to tmp folder in Remote');
  toRemote.rsync('-av --exclude=".*" /home/forbesmx/tmp/wp-content/themes/forbesmx-lite/* /home/forbesmx/forbes.com.mx/http/wp-content/themes/forbesmx-lite/');

  toRemote.log('Delete Garbage');
  toRemote.rm('-rf /home/forbesmx/forbes.com.mx/http/wp-content/themes/forbesmx-lite/_coffeescript/' )
  toRemote.rm('-rf /home/forbesmx/forbes.com.mx/http/wp-content/themes/forbesmx-lite/_scss/' )
  toRemote.rm('-rf /home/forbesmx/forbes.com.mx/http/wp-content/themes/forbesmx-lite/node_modules/' )
  toRemote.rm('-rf /home/forbesmx/forbes.com.mx/http/wp-content/themes/forbesmx-lite/_img/' )
  toRemote.rm('/home/forbesmx/forbes.com.mx/http/wp-content/themes/forbesmx-lite/gulpfile.js' )
  toRemote.rm('/home/forbesmx/forbes.com.mx/http/wp-content/themes/forbesmx-lite/gulp.png' )
  toRemote.rm('/home/forbesmx/forbes.com.mx/http/wp-content/themes/forbesmx-lite/package.json' )
  toRemote.rm('-rf /home/forbesmx/tmp/*');
  //toRemote.rm('-rf /home/forbesmx/tmp/.*');

  // toRemote.log('Change User');
  // toRemote.sudo('chown -R forbesmx:www-data /home/forbesmx/forbes.com.mx/http/wp-content/themes/forbesmx-lite/');
  // toRemote.sudo('chown -R forbesmx:www-data /home/forbesmx/forbes.com.mx/http/wp-content/themes/forbesmx-lite/*');

});

