<?php
/*===== Start Conditionals for Pages =====*/

  $post = $wp_query->post;

  if ( is_page() ) {
      get_template_part('layouts/page','default');
  } else {
      get_template_part('404');
  }

/*===== End Conditionals for Categories =====*/

?>