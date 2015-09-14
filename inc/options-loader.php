<?php
//Load Styles
if (!function_exists("dreams_scripts_and_styles")) :
function dreams_scripts_and_styles() {
  if (!is_admin()) {
    global $themename, $prefix;

//Versions Variables
    $jsPath = asset_path('js','main.min.js');
    $cssPath = asset_path('css','main.min.css');

    $mainVer = '1.0.0';

    $cssVer = '1.0';
    $jQver = '2.1.4';
    $mdzver = '2.8.3';

    $fontAwesome = '4.3.0';
    $jQui = '1.11.4';

    $ajaxify = array(
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
      );


    wp_enqueue_style(
      'style',
      get_template_directory_uri() . '/resources/css/'.$cssPath.'',
      false,
      '',
      'all'
      );

    wp_enqueue_style(
      'font-awesome',
      '//maxcdn.bootstrapcdn.com/font-awesome/'.$fontAwesome.'/css/font-awesome.min.css',
      false,
      '',
      'all'
      );



//Deregister Scripts

    wp_deregister_script('jquery');

//Register Scripts

    /* Modernizr */
    wp_enqueue_script( 'dreams-modernizr', get_template_directory_uri() . '/inc/scripts/vendor/modernizr.min.js', '', '', false );


    /* Jquery */
    wp_enqueue_script( 'dreams-jquery', '//ajax.googleapis.com/ajax/libs/jquery/'.$jQver.'/jquery.min.js', array( 'dreams-modernizr' ), '',true );



    /* Vendor */


    /* Plugins.jQuery */
    wp_register_script('dreams-main', get_template_directory_uri() . '/resources/js/' . $jsPath .'', array('dreams-jquery','dreams-modernizr'), '', true);


//Enqueue Scripts
    wp_enqueue_script('dreams-modernizr');
    wp_enqueue_script('dreams-jquery');
    //wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('dreams-main');

  }
}
endif;


if (!function_exists("deregister_styles")) :
function deregister_styles() {
  wp_dequeue_style('dreams-css-jquery-ui');

}
endif;


?>