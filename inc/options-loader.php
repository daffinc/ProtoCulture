<?php
//Load Styles
function dreams_scripts_and_styles() {
  if (!is_admin()) {
    global $themename, $prefix;

//Versions Variables
    $jsPath = asset_path('js','main.min.js');
    $cssPath = asset_path('css','main.min.css');

    $mainVer = '1.0';
    $jQver = '2.1.4';
    $mdzver = '2.8.3';

    $ajaxify = array(
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
      );


    $dreams_css = wp_enqueue_style(
      'style',
      get_template_directory_uri() . '/resources/css/'.$cssPath.'',
      false,
      ''.$mainVer.'',
      'all'
      );

    $fontawesome = wp_enqueue_style(
      'font-awesome',
      '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
      false,
      '4.3.0',
      'all'
      );

    $dreams_css_jquery_ui = wp_enqueue_style(
      'dreams-css-jquery-ui',
      '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css',
      false,
      '1.11.4',
      'all'
      );

    $dreams_css;
    $fontawesome;


//Deregister Scripts
    wp_deregister_script('jquery');
    wp_deregister_script('jquery-ui-core');

//Register Scripts


    /* Modernizr */
    wp_enqueue_script( 'dreams-modernizr', get_template_directory_uri() . '/js/modernizr.js', array( 'jquery' ), 'false' );

    /* Jquery */
    wp_enqueue_script( 'dreams-jquery', '//http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', array( 'jquery' ), 'true' );
    /* jQuery-UI */
    wp_enqueue_script( 'dreams-jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js', array( 'jquery' ), 'true' );


    /* Vendor */


    /* Plugins.jQuery */
    wp_register_script('main', get_template_directory_uri() . '/resources/js/' . $jsPath, array('jquery','modernizr'), true);


//Enqueue Scripts
    wp_enqueue_script('modernizr');
    wp_enqueue_script('jquery');
    //wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('main');

  }
}

function deregister_styles() {
}


?>