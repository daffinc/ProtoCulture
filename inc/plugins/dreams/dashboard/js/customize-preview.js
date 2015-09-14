(function( $ ) {
    "use strict";

    // Site title.
    wp.customize( 'blogname', function( value ) {
        value.bind( function( to ) {
            $( '.site-title a' ).text( to );
        } );
    } );

    // Site tagline.
    wp.customize( 'blogdescription', function( value ) {
        value.bind( function( to ) {
            $( '.logo_tagline' ).text( to );
        } );
    } );

    wp.customize( 'dreams_background_color', function( value ) {
        value.bind( function( to ) {
            $( ".dreams_skin_switcher" ).remove();
            $('body').append('<div class="dreams_skin_switcher">foobar</div>');
            var response = '';
            response = response + ' <style> ' + '.skin_color, .skin_color_hover:hover, a, .user_info_button:hover, .header_social_icons a:hover, .blog_post_meta .blog_meta_item a:hover, .widget_container ul li a:hover, .dreams_post_gallery_nav_container ul.flex-direction-nav > li a:hover:before, .post_navigation_item:hover a.post_navigation_arrow, .comment_body p a:hover { color:' + to + ';}' +' </style>';

            response = response + ' <style> ' + '.skin_bg, .skin_bg_hover:hover, .blog_post_control_item a:hover, .widget_container.dreams-social-widget .widget_social_icon:hover, .tagcloud a:hover { background-color:' + to + ';}' +' </style>';

            response = response + ' <style> ' + '.skin_border, .blog_post_control_item a, .navigation.pagination .nav-links .page-numbers:hover, .navigation.pagination .nav-links .page-numbers.current, .navigation_links a:hover { border-color:' + to + ';}' +' </style>';

            response = response + ' <style> ' + '.skin_border_left { border-left-color:' + to + ';}' +' </style>';

            response = response + ' <style> ' + '.skin_border_right { border-right-color:' + to + ';}' +' </style>';

            response = response + ' <style> ' + '.skin_border_top { border-top-color:' + to + ';}' +' </style>';

            response = response + ' <style> ' + '.skin_border_bottom, .comment_body p a:hover { border-bottom-color:' + to + ';}' +' </style>';

            $(".dreams_skin_switcher").html(response);

            // $( '.skin_color, .skin_color_hover:hover, a, .user_info_button:hover, .header_social_icons a:hover, .blog_post_meta .blog_meta_item a:hover, .widget_container ul li a:hover, .dreams_post_gallery_nav_container ul.flex-direction-nav > li a:hover:before, .post_navigation_item:hover a.post_navigation_arrow, .comment_body p a:hover' ).css( 'color', to );

            // $( '.skin_bg, .skin_bg_hover:hover, .blog_post_control_item a:hover, .blog_post_control_item .share_item.share_sign:hover, .widget_container.dreams-social-widget .widget_social_icon:hover, .tagcloud a:hover' ).css( 'background-color', to );

            // $( '.skin_border, .blog_post_control_item a, .blog_post_control_item .share_item.share_sign, .navigation.pagination .nav-links .page-numbers:hover, .navigation.pagination .nav-links .page-numbers.current, .navigation_links a:hover' ).css( 'border-color', to );

            // $( '.skin_border_left' ).css( 'border-left-color', to );

            // $( '.skin_border_right' ).css( 'border-right-color', to );

            // $( '.skin_border_top' ).css( 'border-top-color', to );

            // $( '.skin_border_bottom, .comment_body p a:hover' ).css( 'border-bottom-color', to );
        } );
    });



})( jQuery );