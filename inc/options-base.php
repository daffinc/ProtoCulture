<?php

/*********************
LAUNCH DREAMS
Let's get everything up and running.
*********************/

$social_networks = array("facebook" => "Facebook", "twitter" => "Twitter", "google-plus" =>  "Google Plus", "behance" => "Behance", "dribbble" => "Dribbble", "linkedin" => "Linked In", "youtube" => "Youtube", 'vimeo-square' => 'Vimeo', "vk" => "VK", "vine" => "Vine", "digg" => "Digg", "skype" => "Skype", "instagram" => "Instagram", "pinterest" => "Pinterest", "github" => "Github", "bitbucket" => "Bitbucket", "stack-overflow" => "Stack Overflow", "renren" => "Ren Ren", "flickr" => "Flickr", "soundcloud" => "Soundcloud", "steam" => "Steam", "qq" => "QQ", "slideshare" => "Slideshare", "rss" =>  "RSS");

if ( ! function_exists( 'dreasm_ahoy' ) ) :
  function dreams_ahoy() {

  // let's get language support going, if you need it
    load_theme_textdomain( 'dreamstheme', get_template_directory() . '/inc/langages' );

    add_action( 'init', 'galerias', 0 );

  //Metaboxes
    add_filter( 'rwmb_meta_boxes', 'den_register_meta_boxes' );

  //Defer Javascript

  // launching operation cleanup
    add_action( 'init', 'dreams_head_cleanup' );
  // remove WP version from RSS
    add_filter( 'the_generator', 'dreams_rss_version' );
  // remove pesky injected css for recent comments widget
    add_filter( 'wp_head', 'dreams_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
    add_action( 'wp_head', 'dreams_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
    add_filter( 'gallery_style', 'dreams_gallery_style' );
  // Google Analytics
    add_filter( 'wp_head', 'dreams_google_analytics', 100, 0 );

  //Custom CSS
  add_filter( 'wp_head', 'dreams_custom_css',90, 0 );

  //Custom JS
  add_filter( 'wp_head', 'dreams_custom_js',90, 0 );
  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'dreams_scripts_and_styles', 15);
  add_action( 'wp_print_styles', 'deregister_styles', 100 );

  // ie conditional wrapper

  //Remove Inline CSS
    add_action('get_header', 'remove_admin_login_header');

  // launching this stuff after theme setup
    dreams_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
    add_action( 'widgets_init', 'dreams_register_sidebars' );

  // cleaning up random code around images
    add_filter( 'the_content', 'dreams_filter_ptags' );

  // cleaning up excerpt
    add_filter( 'excerpt_more', 'dreams_excerpt_more' );

  // remove admin bar
    add_filter('show_admin_bar', 'remove_admin_bar');

    if ( !current_user_can('manage_options') ){
      remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
    }

  } /* end dreams ahoy */

  endif;

// let's get this party started
  add_action( 'after_setup_theme', 'dreams_ahoy' );



  /************* OEMBED SIZE OPTIONS *************/

  if ( ! isset( $content_width ) ) {
    $content_width = 960;
  }

  /************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail Default
  add_image_size( 'dreams-640x400', 640, 400, true, array( 'center', 'center' ) );
  add_image_size( 'dreams-320x200', 320, 200, true, array( 'center', 'center' )  );


  add_filter( 'image_size_names_choose', 'dreams_custom_image_sizes' );

  function dreams_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
      'dreams-640x400'  => __('640by400','dreamstheme'),
      'dreams-320x200'  => __('320by200','dreamstheme'),
      ) );
  }

/*********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by
removing all the junk we don't
need.
*********************/

if ( ! function_exists( 'dreams_head_cleanup' ) ) :

  function dreams_head_cleanup() {
  // category feeds
  // remove_action( 'wp_head', 'feed_links_extra', 3 );
  // post and comment feeds
  //remove_action( 'wp_head', 'feed_links', 2 );
  // EditURI link
    remove_action( 'wp_head', 'rsd_link' );
  // windows live writer
    remove_action( 'wp_head', 'wlwmanifest_link' );
  // index link
    remove_action( 'wp_head', 'index_rel_link' );
  // previous link
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
  // start link
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
  // links for adjacent posts
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
  // WP version
    remove_action( 'wp_head', 'wp_generator' );
  // remove WP version from css
    add_filter( 'style_loader_src', 'dreams_remove_wp_ver_css_js', 9999 );
  // remove WP version from scripts
    add_filter( 'script_loader_src', 'dreams_remove_wp_ver_css_js', 9999 );
  //change read more
    add_filter( 'the_content_more_link', 'modify_read_more_link' );
    add_filter('excerpt_more', 'new_excerpt_more');

   //literacy banners
    add_filter( 'the_content', 'prefix_insert_post_ads' );

    // all actions related to emojis
    // remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    // remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    // remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    // remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    // remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );


  } /* end dreams head cleanup */
  endif;

/*********************
THEME SUPPORT
*********************/
if ( ! function_exists( 'dreams_theme_support' ) ) :

// Adding WP 3+ Functions & Theme Support
  function dreams_theme_support() {

  // wp thumbnails (sizes handled in functions.php)
    add_theme_support( 'post-thumbnails' );

  //wp title tags
    add_theme_support( 'title-tag' );

  // default thumb size
    set_post_thumbnail_size(125, 125, true);

  // wp custom background (thx to @bransonwerner for update)
    add_theme_support( 'custom-background',
      array(
      'default-image' => '',    // background image default
      'default-color' => '',    // background color default (dont add the #)
      'wp-head-callback' => '_custom_background_cb',
      'admin-head-callback' => '',
      'admin-preview-callback' => ''
      )
      );

  // rss thingy
    add_theme_support('automatic-feed-links');

  // to add header image support go here: http://themble.com/support/adding-header-background-image-support/

  // adding post format support
    add_theme_support( 'post-formats',
      array(
      'gallery',           // gallery of images
      'video'             // video
      )
      );

  // wp menus
    add_theme_support( 'menus' );

  // registering wp3+ menus
    register_nav_menus(
      array(
      'main-nav' => __( 'Main Menu', 'dreamstheme' ),   // main nav in header
      'second-nav' => __( 'Mobile Menu', 'dreamstheme' ),   // main nav in header
      'footer-links' => __( 'Footer Links', 'dreamstheme' ) // secondary nav in footer
      )
      );
  } /* end dreams theme support */
  endif;

/* =============================================================================
   Functions
   ========================================================================== */

// remove WP version from RSS
    if ( ! function_exists( 'dreams_rss_version' ) ) :
      function dreams_rss_version() { return ''; }
    endif;

// remove WP version from scripts
    if ( ! function_exists( 'dreams_remove_wp_ver_css_js' ) ) :
      function dreams_remove_wp_ver_css_js( $src ) {
        if ( strpos( $src, 'ver=' ) )
          $src = remove_query_arg( 'ver', $src );
        return $src;
      }
      endif;

// remove injected CSS for recent comments widget
      if ( ! function_exists( 'dreams_remove_wp_widget_recent_comments_style' ) ) :
        function dreams_remove_wp_widget_recent_comments_style() {
          if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
            remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
          }
        }
        endif;

// remove injected CSS from recent comments widget
        if(! function_exists('dreams_remove_recent_comments_style')) :
          function dreams_remove_recent_comments_style() {
            global $wp_widget_factory;
            if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
              remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
            }
          }
          endif;

          if(! function_exists('remove_admin_login_header')) :
            function remove_admin_login_header() {
              remove_action('wp_head', '_admin_bar_bump_cb');
            }
            endif;

// remove injected CSS from gallery
            if(! function_exists('dreams_gallery_style')) :
              function dreams_gallery_style($css) {
                return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
              }
              endif;


//Exclude Categories
              if(! function_exists('exclude_category')) :
                function exclude_category($query) {
                  if ( $query->is_home  || $query->is_feed || $query->is_archive ) {
                    $query->set('cat', '-1');
                  }
                  return $query;
                }
                endif;

// Remove Admin bar
                if(! function_exists('remove_admin_bar')) :
                  function remove_admin_bar(){
                    return false;
                  }
                  endif;

/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
if(! function_exists('dreams_filter_ptags')) :
  function dreams_filter_ptags($content){

    $pee = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);

    $blockquotes = preg_replace('/<p>\s*(<a .*>)?\s*(<blockquote .* \>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);

    return $pee;
    return $blockquote;

  }
  endif;

// This removes the annoying […] to a Read More link
  if(! function_exists('dreams_excerpt_more')) :
    function dreams_excerpt_more($more) {
      global $post;
  // edit here if you like
      return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __( 'Read ', 'dreamstheme' ) . get_the_title($post->ID).'">'. __( 'Read more &raquo;', 'dreamstheme' ) .'</a>';
    }
    endif;

    ?>