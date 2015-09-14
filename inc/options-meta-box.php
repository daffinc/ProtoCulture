<?php

function den_register_meta_boxes($meta_boxes){
  global $prefix;


  $meta_boxes[] = array(
    'title'  => 'Fotogalería',
    'id'  => $prefix . 'fotogaleria',
    'pages' => array('post','galerias'),
    'show'   => array(
      'relation'    => 'OR',
      'post_format' => array(  'Gallery' ),
      ),

    'fields' => array(
      array(
        'name' => 'Agregar fotos',
        'id'   => $prefix .'photo',
        'type' => 'image_advanced',
        ),
      ),
    );

  $meta_boxes[] = array(
    'title'  => 'Video',
    'id'  => $prefix . 'video',
    'pages' => array('post','galerias'),
    'show'   => array(
      'relation'    => 'OR',
      'post_format' => array(  'Video' ),
      ),
    'fields' => array(
      array(
        'name' => 'Agregar videos',
        'id'   => $prefix .'videos',
        'type' => 'oembed',
        ),
      ),
    );




  return $meta_boxes;


}

?>