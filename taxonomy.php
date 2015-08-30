<?php
/*===== Start Conditionals for Taxonomies =====*/


$post = $wp_query->post;

if(is_archive() ||  is_post_type_archive() || is_tax())  {

    load_template( trailingslashit( get_template_directory() ) . '/layouts/archive-default.php' );

} else {

  get_template_part('404');

}



/*===== End Conditionals for Taxonomies =====*/

?>