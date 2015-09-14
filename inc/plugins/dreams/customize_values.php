<?php
if ( ! function_exists( 'dreams_option' ) ) :
    function dreams_option($id) {
        if (!$id) {
            return;
        }
        if (get_theme_mod($id) !== null ) {
            return get_theme_mod($id);
        }
    }
    endif;

//Custom Logo

    if(!function_exists('custom_logo')) :
       function custom_logo(){
         global $themename, $prefix;
         $customlogo   =  dreams_option('dreams_default_logo_retina');
         $template_url = get_template_directory_uri();
         $url = esc_url( home_url( '/' ) );
         $blogname = get_bloginfo( 'name' );

         $logo = '';

         $logo .= "<a class=\"dreams_logo retina_logo\" title=\"$blogname\" href=\"$url\" rel=\"home\">\n";
         $logo .= "<img src=\"$customlogo\" class=\"site_logo img-responsive site_logo_image pull-left cf\" alt=\"$blogname\" />\n";
         $logo .= "</a>";

         if (!empty($logo)) :
           $logo = "\n<!-- Show me the Logo -->\n" . $logo . "\n";
       echo $logo;
       endif;
   }
   endif;

//Inline CSS
   if(! function_exists('dreams_custom_css')) :
    function dreams_custom_css() {
      global $themename, $prefix;

      if (!get_theme_mod( 'dreams_background_color' )) {
        return;
    }

    $color = get_theme_mod( 'dreams_background_color' );
    $customcss  = dreams_option('dreams_custom_css');
    // $background = get_theme_mod('custom_background');

    // $image      = isset( $background['background-image'] ) ? $background['background-image'] : '';
    // $position   = isset( $background['background-position'] ) ? $background['background-position'] : '';
    // $attachment = isset( $background['background-attachment'] ) ? $background['background-attachment'] : '';
    // $repeat     = isset( $background['background-repeat'] ) ? $background['background-repeat'] : '';
    // $size       = isset( $background['background-size'] ) ? $background['background-size'] : '';
    $output     = '';

    // if($image) {
    //     $output.= "body {\n background:$color url($image) $attachment $position $repeat;\n background-size:$size;\n}\n";
    // } else
    if($color) {
        $output.= "body {\n background-color:$color;\n}\n ";
    } else {
        return;
    }

    if ($customcss) {
        $output .= "\n$customcss\n";
    }

    if (!empty($output)) {
        $output = "\n<!-- Custom Styles -->\n<style>\n" . $output . "</style>\n";
        echo $output;
    }
}
endif;

//Inline JS
if(! function_exists('dreams_custom_js')) :
    function dreams_custom_js() {
      global $themename, $prefix;

      $customjs  = dreams_option('dreams_custom_js');

      $output     = '';

      if ($customjs) {
        $output .= "\n$customjs\n";
    }

    if (!empty($output)) {
        $output = "\n<!-- Custom JS -->\n<script>\n" . $output . "</script>\n\n";
        echo $output;
    }
}
endif;


//Add Facebook SDK

if(! function_exists('facebookID')) :
    function facebookID(){
        $fbID = dreams_option('dreams_fb_id');
        $fb = '';

        if ($fbID):
            $fb .= "<script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = \"//connect.facebook.net/<?php echo get_locale(); ?>/sdk.js#xfbml=1&version=v2.3&appId=$fbID\";
              fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));</script>";
endif;

if (!empty($fb)) {
    $fb = "\n<!-- Load facebook SDK -->\n<div id=\"fb-root\"></div>\n" . $fb . "\n<!-- End Load facebook SDK -->\n";
    echo $fb;
}

}
endif;

//Summon Socials
if(! function_exists('summon_social_profile')) :
    function summon_social_profile($network){
        global $social_networks;
        $socialnetwork = dreams_option('dreams_'.$network.'_url');
        $sn = '';

        if ($socialnetwork):
            $sn .= "$socialnetwork";
        endif;

        if (!empty($sn)) {
            $sn = "" . $sn . "";
            echo $sn;
        }

    }
endif;

//Add Simple and common metas
if(! function_exists('do_metas')) :
  function do_metas(){
      $theme_location = get_stylesheet_directory_uri();
      // $favicon_url = dreams_option("dreams_fav_icon");

      echo "\n<!-- Meta Mobile View Ports -->\n";
      echo "<meta name=\"HandheldFriendly\" content=\"True\">\n";
      echo "<meta name=\"MobileOptimized\" content=\"320\">\n";
      echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n";
  }
endif;

//Add common DNS prefetchers
if(! function_exists('do_dnsprefetch')) :
   function do_dnsprefetch(){
       $theme_location = get_stylesheet_directory_uri();

       echo "\n<!-- DNS Prefetch -->\n";
       echo "<link rel=\"dns-prefetch\" href=\"//fonts.googleapis.com\">\n";
       echo "<link rel=\"dns-prefetch\" href=\"//google-analytics.com\">\n";
       echo "<link rel=\"dns-prefetch\" href=\"//www.google-analytics.com\">\n";
       echo "<link rel=\"dns-prefetch\" href=\"//platform.twitter.com\">\n\n";
   }
endif;


//Google Analytics
if(! function_exists('dreams_google_analytics')) :
    function dreams_google_analytics(){

global $themename, $prefix;
$template_url = get_template_directory_uri();
$gaCode       = dreams_option('dreams_google_analytics');
$ga           = '';


if($gaCode){
  $ga .= "!function(d,r,e,a,m,s){d.GoogleAnalyticsObject=e;d[e]||(d[e]=function(){
(d[e].q=d[e].q||[]).push(arguments)});d[e].l=+new Date;m=r.createElement(a);
s=r.getElementsByTagName(a)[0];m.src='//www.google-analytics.com/analytics.js';
s.parentNode.insertBefore(m,s)}(window,document,'ga','script');

ga('create', '$gaCode', 'auto');
ga('send', 'pageview');
";
}

if (!empty($ga)) {
  $ga = "\n<!-- Google Analytics -->\n<script>" . $ga . "</script>\n\n";
  echo $ga;
}

}
endif;
?>