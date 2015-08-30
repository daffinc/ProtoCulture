<?php
/*===== Start Conditionals for Categories =====*/


$post = $wp_query->post;

if(is_tag())  {
 load_template( trailingslashit( get_template_directory() ) . '/layouts/tag-default.php' );
} else {
  load_template( trailingslashit( get_template_directory() ) . '/layouts/archive-default.php' );
}



/*===== End Conditionals for Categories =====*/

?>