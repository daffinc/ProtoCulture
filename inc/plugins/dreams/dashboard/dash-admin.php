<?php
// Custom Styles and Effects
function dreams_dashboard_css(){
 wp_register_style('dreams_dashboard', get_template_directory_uri() . '/inc/plugins/dreams/dashboard/css/dashboard.css');
 wp_enqueue_style( 'dreams_dashboard');
}

function dreams_login_css() {
  $template = get_template_directory_uri();
  echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$template}/inc/plugins/dreams/dashboard/css/dashboard.css\" />";
  echo "<style>
  html {
    background:none;
  }
</style>";
}


function ot_theme() {

  wp_register_style('gcc_ot_admin_styles', get_template_directory_uri(). '/inc/plugins/dreams/dashboard/ot/admin-styles.css');
  wp_register_style('gcc_ot_admin_styles_IE8', get_template_directory_uri(). '/inc/plugins/dreams/dashboard/ot/admin-styles_IE8.css');
  wp_enqueue_style('gcc_ot_admin_styles');

  $GLOBALS['wp_styles']->add_data( 'gcc_ot_admin_styles_IE8', 'conditional', 'lte IE 9' );

  wp_enqueue_style('gcc_ot_admin_styles_IE8');
}


function dreams_dashboard_js() {
  wp_register_script('dashboard-js', get_template_directory_uri() . '/inc/plugins/dreams/dashboard/js/dashboard.js', array('jquery'), '2.0', false);

  wp_enqueue_script('dashboard-js');

}

function dreams_login_url() {
  global $deCDN, $deSiteURL;
  return $deSiteURL;
}


function dreams_footer_admin (){
  global $deCDN, $deSiteURL;
  echo "<span id=\"footer-thankyou\">Developed by <a href=\"$deSiteURL\" target=\"_blank\">Dreams Engineering</a></span>\n";
}

//Add Mime Types
function cc_mime_types($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}

//Add Versions Control
/**
 * @param  string  $filename
 * @return string
 */
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

//Execute PHP on Widgets

function php_execute($html){
if(strpos($html,"<"."?php")!==false){
    ob_start();
    eval("?".">".$html);
    $html=ob_get_contents();
    ob_end_clean();
  }
  return $html;
}

//Remove Useless Titles of Widgets

function remove_widget_title( $widget_title ) {
  if ( substr ( $widget_title, 0, 1 ) == '!' )
    return;
  else
    return ( $widget_title );
}

add_filter('widget_text','php_execute',100);
add_filter( 'widget_title', 'remove_widget_title' );
add_filter('upload_mimes', 'cc_mime_types');

add_action( 'admin_init', 'dreams_dashboard_css', 99 );
add_action('login_head', 'dreams_login_css');
add_action( 'admin_init', 'ot_theme', 99);
add_action( 'admin_head', 'dreams_dashboard_js', 99 );
add_action( 'login_headerurl', 'dreams_login_url',99);
add_action('admin_footer_text', 'dreams_footer_admin');
?>