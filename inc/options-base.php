<?php

/*********************
LAUNCH DREAMS
Let's get everything up and running.
*********************/

if ( ! function_exists( 'dreasm_ahoy' ) ) :
function dreams_ahoy() {

  // let's get language support going, if you need it
  load_theme_textdomain( 'dreamstheme', get_template_directory() . '/inc/langages' );

  //init brandvoice y videos
  add_action( 'init', 'brand_voice', 0 );

  //Metaboxes
  add_filter( 'rwmb_meta_boxes', 'den_register_meta_boxes' );

  //Defer Javascript

  // launching operation cleanup
  add_action( 'init', 'dreams_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'dreams_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'dreams_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'dreams_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'dreams_gallery_style' );
  // Google Analytics
  add_filter( 'wp_head', 'dreams_google_analytics' );
  //Custom CSS
  add_filter( 'wp_head', 'dreams_custom_css' );

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
    'dreams-640x400'  => __('640 by 400'),
    'dreams-320x200'  => __('320 by 200'),
    ) );
}

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function dreams_register_sidebars() {
  register_sidebar(array(
    'id' => 'type-a',
    'name' => __( 'Full Top Banner', 'dreamstheme' ),
    'description' => __( 'Full Top Banner.', 'dreamstheme' ),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '',
    'after_title' => '',
    ));
}

/*********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by
removing all the junk we don't
need.
*********************/

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


} /* end dreams head cleanup */


/*********************
THEME SUPPORT
*********************/

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
      'aside',             // title less blurb
      'gallery',           // gallery of images
      //'link',              // quick link to other site
      //'image',             // an image
      'quote',             // a quick quote
      //'status',            // a Facebook like status update
      'video',             // video
      //'audio',             // audio
      //'chat'               // chat transcript
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


/* =============================================================================
   Functions
   ========================================================================== */


// Better Titel
   function rw_title( $title, $sep, $seplocation ) {
    global $page, $paged;

  // Don't affect in feeds.
    if ( is_feed() ) return $title;

  // Add the blog's name
    if ( 'right' == $seplocation ) {
      $title .= get_bloginfo('url');
    } else {
      $title = get_bloginfo('url') . $title;
    }

  // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );

    if ( $site_description && ( is_home() || is_front_page() ) ) {
      $title .= " {$sep} {$site_description}";
    }

  // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 ) {
      $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
    }

    return $title;

} // end better title


// remove WP version from RSS
function dreams_rss_version() { return ''; }

// remove WP version from scripts
function dreams_remove_wp_ver_css_js( $src ) {
  if ( strpos( $src, 'ver=' ) )
    $src = remove_query_arg( 'ver', $src );
  return $src;
}

// remove injected CSS for recent comments widget
function dreams_remove_wp_widget_recent_comments_style() {
  if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
    remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
  }
}

// remove injected CSS from recent comments widget
function dreams_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
  }
}

function remove_admin_login_header() {
  remove_action('wp_head', '_admin_bar_bump_cb');
}

// remove injected CSS from gallery
function dreams_gallery_style($css) {
  return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


//Exclude Categories
function exclude_category($query) {
  if ( $query->is_home  || $query->is_feed || $query->is_archive ) {
    $query->set('cat', '-1');
  }
  return $query;
}

// Remove Admin bar
function remove_admin_bar(){
  return false;
}

/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function dreams_filter_ptags($content){

  $pee = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);

  $blockquotes = preg_replace('/<p>\s*(<a .*>)?\s*(<blockquote .* \>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);

  return $pee;
  return $blockquote;

}


// This removes the annoying […] to a Read More link
function dreams_excerpt_more($more) {
  global $post;
  // edit here if you like
  return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __( 'Read ', 'dreamstheme' ) . get_the_title($post->ID).'">'. __( 'Read more &raquo;', 'dreamstheme' ) .'</a>';
}




?>