<?php


// Videos
function galerias() {

    $section = 'dreamstheme';
    $slug = 'galerias';
    $names = 'Galerías';
    $name = 'galerias';
    $desc = 'galerias';
    $key = 'dreamstheme';

    $labels = array(
        'name'                => _x( ''.$names.'', ''.$names.'', 'dreamstheme'),
        'singular_name'       => _x( ''.$name.'', ''.$names.'', 'dreamstheme'),
        'menu_name'           => _x( ''.$names.'', 'admin menu', 'dreamstheme'),
        'name_admin_bar'      => _x( ''.$name.'','add new on admin bar', 'dreamstheme' ),
        'add_new'             => _x( 'Add New','+', 'dreamstheme' ),
        'new_item'            => __( 'New', 'dreamstheme' ),
        'add_new_item'        => __( 'Add New', 'dreamstheme' ),
        'parent_item_colon'   => __( 'Parent:', 'dreamstheme' ),
        'all_items'           => __( 'All', 'dreamstheme' ),
        'view_item'           => __( 'View', 'dreamstheme' ),
        'edit_item'           => __( 'Edit', 'dreamstheme' ),
        'update_item'         => __( 'Update', 'dreamstheme' ),
        'search_items'        => __( 'Search', 'dreamstheme' ),
        'not_found'           => __( 'Not found', 'dreamstheme' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'dreamstheme' ),
        );

    $rewrite = array(
        'slug'                => $slug,
        'with_front'          => true,
        'pages'               => true,
        'feeds'               => true,
        );

    $supports = array(
        'title',
        'editor',
        'excerpt',
        'author',
        'thumbnail',
        'comments',
        'revisions',
        'post_formats',
        );

    $taxonomies = array(
        'category',
        'post_tag',
        );

    $args = array(
        'labels'              => $labels,
        'description'         => __( 'Description.', 'dreamstheme' ),
        'menu_icon'           => 'dashicons-'.$slug.'',
        'supports'            => $supports,
        'taxonomies'          => $taxonomies,
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 4,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'query_var'           => $key,
        'rewrite'             => $rewrite,
        'capability_type'     => 'page'
        );


    register_post_type( $key, $args );

}



?>