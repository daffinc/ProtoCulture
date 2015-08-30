<?php


// Videos
function galerias() {

    $section = 'galerias';
    $slug = 'galerias';
    $names = 'Galerías';
    $name = 'galerias';
    $desc = 'galerias';
    $key = $section;

    $labels = array(
        'name'                => _x( $name, $desc, $section),
        'singular_name'       => _x( $name, $desc, $section),
        'menu_name'           => __( $names, $section ),
        'parent_item_colon'   => __( 'Parent '.$name.':', $section ),
        'all_items'           => __( 'All '.$names.'', $section ),
        'view_item'           => __( 'View '.$names.'', $section ),
        'add_new_item'        => __( 'Add New '.$name.'', $section ),
        'add_new'             => __( 'Add New '.$name.'', $section ),
        'edit_item'           => __( 'Edit '.$name.'', $section ),
        'update_item'         => __( 'Update '.$name.'', $section ),
        'search_items'        => __( 'Search '.$names.'', $section ),
        'not_found'           => __( 'Not found', $section ),
        'not_found_in_trash'  => __( 'Not found in Trash', $section ),
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
        'label'               => __( $key, $section ),
        'description'         => __( $desc, $section ),
        'menu_icon'           => 'dashicons-'.$slug.'',
        'labels'              => $labels,
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