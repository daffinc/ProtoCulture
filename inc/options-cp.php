<?php
if (!function_exists("dreams_register_theme_customizer")) :
    function dreams_register_theme_customizer( $wp_customize ) {

  /* --------
  add new sections
  ------------------------------------------- */
  $wp_customize->add_section( 'dreams_images' , array(
    'title'      => __('Logos & Branding','dreamstheme'),
    'priority'   => 2,
    ) );

  $wp_customize->add_section( 'dreams_custom_scripts' , array(
    'title'      => __('Custom Styles & Scripts','dreamstheme'),
    'priority'   => 3,
    ) );

  $wp_customize->add_section( 'dreams_social' , array(
    'title'      => __('Social Settings','dreamstheme'),
    'priority'   => 100,
    ) );

  /* --------
  change title and description to postMessage
  ------------------------------------------- */
  $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

  /* --------
  remove section
  ------------------------------------------- */
  $wp_customize->remove_section( 'colors');
  $wp_customize->remove_section( 'background_image');

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
    'label'      => __('Tagline Place', 'dreamstheme'),
    'section'    => 'title_tagline',
    'settings'   => 'dreams_show_tagline',
    'type'       => 'select',
    'choices'    => array(
        'beside' => __('Beside Title', 'dreamstheme'),
        'below' => __('Below Title', 'dreamstheme'),
        'hide' => __('Hide', 'dreamstheme'),
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
    'label'      => __('Site Description - Few words about your blog to introducte it to search engines and social networks', 'dreamstheme'),
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
    'label'      => __('Footer Credits Text', 'dreamstheme'),
    'section'    => 'title_tagline',
    'settings'   => 'dreams_footer_credits',
    ));

    $wp_customize->add_setting(
    'dreams_google_analytics',
    array(
        'default'     => '',
        'sanitize_callback' => 'esc_attr',
        )
    );

    $wp_customize->add_control('dreams_google_analytics', array(
    'label'      => __('Google Analytics Code', 'dreamstheme'),
    'section'    => 'title_tagline',
    'settings'   => 'dreams_google_analytics',
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
    'label'      => __('Facebook App ID', 'dreamstheme'),
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
    'label'      => __('Twitter Consumer Key', 'dreamstheme'),
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
    'label'      => __('Twitter Consumer Secret', 'dreamstheme'),
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
    'label'      => __('Twitter Access Token', 'dreamstheme'),
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
    'label'      => __('Twitter Access Token Secret', 'dreamstheme'),
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
    'dreams_background_color',
    array(
        'default'     => '',
        'transport'   => 'postMessage',
        'sanitize_callback' => 'sanitize_hex_color',
        )
    );

$wp_customize->add_control(
    new WP_Customize_Color_Control(
        $wp_customize,
        'dreams_background_color',
        array(
            'label'      => __( 'Background Color', 'dreamstheme' ),
            'section'    => 'dreams_custom_scripts',
            'settings'   => 'dreams_background_color'
            )
        )
    );

/* upload site logo */
$wp_customize->add_setting(
    'dreams_default_logo',
    array(
        'default'     => '',
        'sanitize_callback' => 'esc_url',
        )
    );

$wp_customize->add_setting(
    'dreams_default_logo_retina',
    array(
        'default'     => '',
        'sanitize_callback' => 'esc_url',
        )
    );

$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'dreams_default_logo_retina', array(
    'label'      => __('Logo( Double size as default logo )', 'dreamstheme'),
    'section'    => 'dreams_images',
    'settings'   => 'dreams_default_logo_retina',
    )));

$wp_customize->add_setting(
    'dreams_fav_icon',
    array(
        'default'     => '',
        'sanitize_callback' => 'esc_url',
        )
    );

$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'dreams_fav_icon', array(
    'label'      => __('Fav Icon', 'dreamstheme'),
    'section'    => 'dreams_images',
    'settings'   => 'dreams_fav_icon',
    )));

/* change layout settings */
$wp_customize->add_setting(
    'dreams_custom_css',
    array(
        'default'     => '',
        'sanitize_callback' => 'esc_attr',
        )
    );

$wp_customize->add_control('dreams_custom_css', array(
    'label'      => __('Custom CSS', 'dreamstheme'),
    'section'    => 'dreams_custom_scripts',
    'settings'   => 'dreams_custom_css',
    'type'       => 'textarea'
    ));

$wp_customize->add_setting(
    'dreams_custom_js',
    array(
        'default'     => '',
        'sanitize_callback' => 'esc_attr',
        )
    );

$wp_customize->add_control('dreams_custom_js', array(
    'label'      => __('Custom JS', 'dreamstheme'),
    'section'    => 'dreams_custom_scripts',
    'settings'   => 'dreams_custom_js',
    'type'       => 'textarea'
    ));

};
endif;

/* --------
enqueue customizer live preview
------------------------------------------- */
if(! function_exists('dreams_customizer_live_preview')) :
function dreams_customizer_live_preview() {
    wp_enqueue_script( 'dreams-customize-preview', get_template_directory_uri() . '/inc/dashboard/js/customize-preview.js', array( 'jquery', 'customize-preview' ), '1.0', true );
}
endif;


add_action( 'customize_preview_init', 'dreams_customizer_live_preview' );
add_action( 'customize_register', 'dreams_register_theme_customizer' );
?>