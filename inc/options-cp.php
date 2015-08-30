<?php
function dreams_register_theme_customizer( $wp_customize ) {

  /* --------
  add new sections
  ------------------------------------------- */
  $wp_customize->add_section( 'dreams_layout' , array(
      'title'      => __('Layout','asalah'),
      'priority'   => 2,
  ) );

    $wp_customize->add_section( 'dreams_images' , array(
        'title'      => __('Upload Images','asalah'),
        'priority'   => 2,
    ) );

    $wp_customize->add_section( 'dreams_social' , array(
        'title'      => __('Social Settings','asalah'),
        'priority'   => 2,
    ) );

  /* --------
  change title and description to postMessage
  ------------------------------------------- */
  $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

  /* --------
  add title logo settings
  ------------------------------------------- */
    $wp_customize->add_setting(
        'dreams_show_tagline',
        array(
            'default'     => 'right',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_show_tagline', array(
        'label'      => __('Tagline Place', 'asalah'),
        'section'    => 'title_tagline',
        'settings'   => 'dreams_show_tagline',
        'type'       => 'select',
        'choices'    => array(
            'beside' => __('Beside Title', 'asalah'),
            'below' => __('Below Title', 'asalah'),
            'hide' => __('Hide', 'asalah'),
        ),
    ));

    /* footer credits */
    $wp_customize->add_setting(
        'dreams_site_description',
        array(
            'default'     => '',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_site_description', array(
        'label'      => __('Site Description - Few words about your blog to introducte it to search engines and social networks', 'themename'),
        'section'    => 'title_tagline',
        'settings'   => 'dreams_site_description',
    ));

    /* footer credits */
    $wp_customize->add_setting(
        'dreams_footer_credits',
        array(
            'default'     => '',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_footer_credits', array(
        'label'      => __('Footer Credits Text', 'themename'),
        'section'    => 'title_tagline',
        'settings'   => 'dreams_footer_credits',
    ));

    /* facebook id */
    $wp_customize->add_setting(
        'dreams_fb_id',
        array(
            'default'     => '',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_fb_id', array(
        'label'      => __('Facebook App ID', 'themename'),
        'section'    => 'dreams_social',
        'settings'   => 'dreams_fb_id',
    ));

    /* twitter security keys */
    $wp_customize->add_setting(
        'dreams_conk_id',
        array(
            'default'     => '',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_conk_id', array(
        'label'      => __('Twitter Consumer Key', 'themename'),
        'section'    => 'dreams_social',
        'settings'   => 'dreams_conk_id',
    ));

    $wp_customize->add_setting(
        'dreams_cons_id',
        array(
            'default'     => '',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_cons_id', array(
        'label'      => __('Twitter Consumer Secret', 'themename'),
        'section'    => 'dreams_social',
        'settings'   => 'dreams_cons_id',
    ));

    $wp_customize->add_setting(
        'dreams_at_id',
        array(
            'default'     => '',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_at_id', array(
        'label'      => __('Twitter Access Token', 'themename'),
        'section'    => 'dreams_social',
        'settings'   => 'dreams_at_id',
    ));

    $wp_customize->add_setting(
        'dreams_ats_id',
        array(
            'default'     => '',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_ats_id', array(
        'label'      => __('Twitter Access Token Secret', 'themename'),
        'section'    => 'dreams_social',
        'settings'   => 'dreams_ats_id',
    ));

    /* social profiles */
    global $social_networks;
    foreach ($social_networks as $network => $social ) {
        $wp_customize->add_setting(
            'dreams_'.$network.'_url',
            array(
                'default'     => '',
                'sanitize_callback' => 'esc_url',
            )
        );

        $wp_customize->add_control('dreams_'.$network.'_url', array(
            'label'      => $social.' URL',
            'section'    => 'dreams_social',
            'settings'   => 'dreams_'.$network.'_url',
        ));
    }


  /* change links color */
    $wp_customize->add_setting(
        'dreams_main_color',
        array(
            'default'     => '#f47e00',
            'transport'   => 'postMessage',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'dreams_main_color',
            array(
                'label'      => __( 'Main Color', 'asalah' ),
                'section'    => 'colors',
                'settings'   => 'dreams_main_color'
            )
        )
    );

    /* upload site images */
    $wp_customize->add_setting(
        'dreams_header_avatar',
        array(
            'default'     => '',
            'sanitize_callback' => 'esc_url',
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'dreams_header_avatar', array(
        'label'      => __('Header User Avatar', 'asalah'),
        'section'    => 'dreams_images',
        'settings'   => 'dreams_header_avatar',
    )));

    /* upload site logo */
    $wp_customize->add_setting(
        'dreams_default_logo',
        array(
            'default'     => '',
            'sanitize_callback' => 'esc_url',
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'dreams_default_logo', array(
        'label'      => __('Site Logo', 'asalah'),
        'section'    => 'dreams_images',
        'settings'   => 'dreams_default_logo',
    )));

    $wp_customize->add_setting(
        'dreams_default_logo_retina',
        array(
            'default'     => '',
            'sanitize_callback' => 'esc_url',
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'dreams_default_logo_retina', array(
        'label'      => __('Retina Logo ( Double size as default logo )', 'asalah'),
        'section'    => 'dreams_images',
        'settings'   => 'dreams_default_logo_retina',
    )));

    $wp_customize->add_setting(
        'dreams_logo_width',
        array(
            'default'     => '0',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_logo_width', array(
        'label'      => __('Logo Width ( 0 for auto width )', 'themename'),
        'section'    => 'dreams_images',
        'settings'   => 'dreams_logo_width',
    ));

    $wp_customize->add_setting(
        'dreams_logo_height',
        array(
            'default'     => '0',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_logo_height', array(
        'label'      => __('Logo Height ( 0 for auto Height )', 'themename'),
        'section'    => 'dreams_images',
        'settings'   => 'dreams_logo_height',
    ));

    $wp_customize->add_setting(
        'dreams_fav_icon',
        array(
            'default'     => '',
            'sanitize_callback' => 'esc_url',
        )
    );

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'dreams_fav_icon', array(
        'label'      => __('Fav Icon', 'asalah'),
        'section'    => 'dreams_images',
        'settings'   => 'dreams_fav_icon',
    )));

    /* change layout settings */
    $wp_customize->add_setting(
        'dreams_sidebar_position',
        array(
            'default'     => 'right',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_sidebar_position', array(
        'label'      => __('Sidebar Position', 'asalah'),
        'section'    => 'dreams_layout',
        'settings'   => 'dreams_sidebar_position',
        'type'       => 'select',
        'choices'    => array(
            'left' => __('Left Sidebar', 'asalah'),
            'right' => __('Right Sidebar', 'asalah'),
            'none' => __('No Sidebar', 'asalah'),
        ),
    ));

    $wp_customize->add_setting(
        'dreams_blog_style',
        array(
            'default'     => 'default',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_blog_style', array(
        'label'      => __('Default Blog Style', 'asalah'),
        'section'    => 'dreams_layout',
        'settings'   => 'dreams_blog_style',
        'type'       => 'select',
        'choices'    => array(
            'default' => __('Default', 'asalah'),
            'banners' => __('Banners First', 'asalah'),
            'masonry' => __('Masonry', 'asalah'),
            'list' => __('List', 'asalah'),
        ),
    ));

    $wp_customize->add_setting(
        'dreams_pagination_style',
        array(
            'default'     => 'nav',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_pagination_style', array(
        'label'      => __('Pagination Style', 'asalah'),
        'section'    => 'dreams_layout',
        'settings'   => 'dreams_pagination_style',
        'type'       => 'select',
        'choices'    => array(
            'nav' => __('Older/Newer Links', 'asalah'),
            'num' => __('Numerical', 'asalah')
        ),
    ));

    $wp_customize->add_setting(
        'dreams_blog_image_crop',
        array(
            'default'     => 'yes',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_blog_image_crop', array(
        'label'      => __('Crop Blog Banners in Blog List', 'asalah'),
        'section'    => 'dreams_layout',
        'settings'   => 'dreams_blog_image_crop',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));

    $wp_customize->add_setting(
        'dreams_blog_gallery_crop',
        array(
            'default'     => 'yes',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_blog_gallery_crop', array(
        'label'      => __('Crop Gallery Images in Blog List', 'asalah'),
        'section'    => 'dreams_layout',
        'settings'   => 'dreams_blog_gallery_crop',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));


    $wp_customize->add_setting(
        'show_author_box',
        array(
            'default'     => 'yes',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('show_author_box', array(
        'label'      => __('Show Author Box', 'asalah'),
        'section'    => 'dreams_layout',
        'settings'   => 'show_author_box',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));

    $wp_customize->add_setting(
        'dreams_show_related',
        array(
            'default'     => 'yes',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_show_related', array(
        'label'      => __('Show Related Posts', 'asalah'),
        'section'    => 'dreams_layout',
        'settings'   => 'dreams_show_related',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));

    $wp_customize->add_setting(
        'dreams_show_share',
        array(
            'default'     => 'yes',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_show_share', array(
        'label'      => __('Show Share Icons', 'asalah'),
        'section'    => 'dreams_layout',
        'settings'   => 'dreams_show_share',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));

    $wp_customize->add_setting(
        'dreams_show_meta',
        array(
            'default'     => 'yes',
            'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_show_meta', array(
        'label'      => __('Show Meta Info', 'asalah'),
        'section'    => 'dreams_layout',
        'settings'   => 'dreams_show_meta',
        'type'       => 'select',
        'choices'    => array(
            'yes' => __('Yes', 'asalah'),
            'no' => __('No', 'asalah')
        ),
    ));
}
add_action( 'customize_register', 'dreams_register_theme_customizer' );
?>