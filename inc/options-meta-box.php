<?php

function den_register_meta_boxes($meta_boxes){
  global $prefix;


  $meta_boxes[] = array(
    'title'  => 'Fotogalería',
    'pages' => array('posts','galerias','forbes_life'),
    'fields' => array(
      array(
        'name' => 'Agregar fotos',
        'id'   => $prefix .'photo',
        'type' => 'image_advanced',
        ),
      ),
  );




  return $meta_boxes;


}

?>