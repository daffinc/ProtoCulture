<?php
// Sidebars & Widgetizes Areas
if(! function_exists('dreams_register_sidebars')) :
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
endif;
?>