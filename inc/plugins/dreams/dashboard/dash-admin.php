<?php
// Custom Styles and Effects
if(! function_exists('dreams_dashboard_css')) :
function dreams_dashboard_css(){
 wp_register_style('dreams_dashboard', get_template_directory_uri() . '/inc/plugins/dreams/dashboard/css/dashboard.css');
 wp_enqueue_style( 'dreams_dashboard');
}
endif;

if(! function_exists('dreams_login_css')) :
function dreams_login_css() {
  $template = get_template_directory_uri();
  echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$template}/inc/plugins/dreams/dashboard/css/dashboard.css\" />";
  echo "<style>
  html {
    background:none;
  }
</style>";
}
endif;

if(! function_exists('dreams_dashboard_js')) :
function dreams_dashboard_js() {
  wp_register_script('dashboard-js', get_template_directory_uri() . '/inc/plugins/dreams/dashboard/js/dashboard.js', array('jquery'), '2.0', false);

  wp_enqueue_script('dashboard-js');

}
endif;

if(!function_exists('dreams_login_url')) :
function dreams_login_url() {
  global $deCDN, $deSiteURL;
  return $deSiteURL;
}
endif;

if(! function_exists('dreams_footer_admin')) :
function dreams_footer_admin (){
  global $deCDN, $deSiteURL;
  echo "<span id=\"footer-thankyou\">Developed by <a href=\"$deSiteURL\" target=\"_blank\">Dreams Engineering</a></span>\n";
}
endif;

//Add Mime Types
if(! function_exists('cc_mime_types')) :
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
endif;


//Add Versions Control
/**
 * @param  string  $filename
 * @return string
 */
if(! function_exists('asset_path')) :
function asset_path($type,$filename){
 $theme_location = get_stylesheet_directory_uri();
 $url = wp_make_link_relative($theme_location);
 $manifest_path = ".$url/resources/$type/rev-manifest.json";


 if (file_exists($manifest_path)) {
  $manifest = json_decode(file_get_contents($manifest_path), TRUE);
} else {
  $manifest = [];
}

if (array_key_exists($filename, $manifest)) {
  return $manifest[$filename];
}

return $filename;
}
endif;

//Execute PHP on Widgets
if(! function_exists('php_execute')) :
function php_execute($html){
if(strpos($html,"<"."?php")!==false){
    ob_start();
    eval("?".">".$html);
    $html=ob_get_contents();
    ob_end_clean();
  }
  return $html;
}
endif;

//Remove Useless Titles of Widgets
if(! function_exists('remove_widget_title')) :
function remove_widget_title( $widget_title ) {
  if ( substr ( $widget_title, 0, 1 ) == '!' )
    return;
  else
    return ( $widget_title );
}
endif;

//Get Customizer Values && Functions
require get_template_directory() . '/inc/plugins/dreams/customize_values.php';


//Common Metas
add_filter('wp_head','do_metas', 10, 0);
//Common DNS prefetch
add_filter('wp_head','do_dnsprefetch', 10, 0);

add_filter('widget_text','php_execute',100);
add_filter( 'widget_title', 'remove_widget_title' );
add_filter('upload_mimes', 'cc_mime_types');

add_action( 'admin_enqueue_scripts', 'dreams_dashboard_css', 99 );
add_action('login_head', 'dreams_login_css');
add_action( 'admin_enqueue_scripts', 'dreams_dashboard_js', 100 );
add_action( 'login_headerurl', 'dreams_login_url',99);
add_action('admin_footer_text', 'dreams_footer_admin');
?>