<?php
//Declare Dashboard Custom Dashboard
require get_template_directory() . '/inc/plugins/dreams/dashboard/dash-admin.php';


/************* DASHBOARD WIDGETS *****************/

// disable default dashboard widgets
if(! function_exists('disable_default_dashboard_widgets')):
  function disable_default_dashboard_widgets() {
  // remove_meta_box( 'dashboard_right_now', 'dashboard', 'core' );    // Right Now Widget
  remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' ); // Comments Widget
  remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );  // Incoming Links Widget
  remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );         // Plugins Widget

  // remove_meta_box('dashboard_quick_press', 'dashboard', 'core' );   // Quick Press Widget
  remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );   // Recent Drafts Widget
  remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );         //
  remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );       //

  // removing plugin dashboard boxes
  remove_meta_box( 'yoast_db_widget', 'dashboard', 'normal' );         // Yoast's SEO Plugin Widget

}
endif;

// RSS Dashboard Widget
if(! function_exists('dreams_in_rss_dashboard_widget')) :
  function dreams_in_rss_dashboard_widget() {
    if ( function_exists( 'fetch_feed' ) ) {
    // include_once( ABSPATH . WPINC . '/feed.php' );               // include the required file
    $feed = fetch_feed( 'http://feeds.devstate.de/devdreamsengine' );        // specify the source feed
    if (is_wp_error($feed)) {
      $limit = 0;
      $items = 0;
    } else {
      $limit = $feed->get_item_quantity(7);                        // specify number of items
      $items = $feed->get_items(0, $limit);                        // create an array of items
    }
  }
  if ($limit == 0) echo '<div>The RSS Feed is either empty or unavailable.</div>';   // fallback message
  else foreach ($items as $item) { ?>

  <h4 style="margin-bottom: 0;">
    <a href="<?php echo $item->get_permalink(); ?>" title="<?php echo mysql2date( __( 'j F Y @ g:i a', 'dreamstheme' ), $item->get_date( 'Y-m-d H:i:s' ) ); ?>" target="_blank">
      <?php echo $item->get_title(); ?>
    </a>
  </h4>
  <p style="margin-top: 0.5em;">
    <?php echo substr($item->get_description(), 0, 200); ?>
  </p>
  <?php }
}
endif;

// calling all custom dashboard widgets
if(! function_exists('dreams_custom_dashboard_widgets')) :
  function dreams_custom_dashboard_widgets() {
    $name = get_bloginfo('name');
    wp_add_dashboard_widget( 'dreams_rss_dashboard_widget', __( 'Recently on Dreams Engine DevState', 'dreamstheme' ), 'dreams_in_rss_dashboard_widget' );

    // wp_add_dashboard_widget( 'dreams_in_rss_dashboard_widget', __( 'Recently on ' . $name, 'dreamstheme' ), 'dreams_in_rss_dashboard_widget' );
  /*
  Be sure to drop any other created Dashboard Widgets
  in this function and they will all load.
  */
}
endif;

// removing the dashboard widgets
add_action( 'admin_menu', 'disable_default_dashboard_widgets' );
// adding any custom widgets
add_action( 'wp_dashboard_setup', 'dreams_custom_dashboard_widgets' );


/* =============================================================================
Meta Box
========================================================================== */
define( 'RWMB_DIR', trailingslashit( STYLESHEETPATH . '/inc/plugins/meta-box' ) );

define( 'RWMB_URL', trailingslashit( get_stylesheet_directory_uri() . '/inc/plugins/meta-box' ) );

define( 'RWMB_Show_Hide_DIR', trailingslashit( STYLESHEETPATH . '/inc/plugins/meta-box/meta-box-show-hide' ) );
define( 'RWMB_Show_Hide_URL', trailingslashit( get_stylesheet_directory_uri() . '/inc/plugins/meta-box/meta-box-show-hide' ) );



require_once RWMB_DIR . 'meta-box.php';
require_once RWMB_Show_Hide_DIR . 'meta-box-show-hide.php';


?>