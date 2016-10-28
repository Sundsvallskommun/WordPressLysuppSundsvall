<?php

    function lysuppsundsvall_setup() {

        load_theme_textdomain( 'lysuppsundsvall', get_template_directory() . '/languages' );

        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

        register_nav_menu( 'primary', __( 'Standard Meny', 'lysuppsundsvall' ) );

        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 1000, 1000 );
    }
    add_action( 'after_setup_theme', 'lysuppsundsvall_setup' );

    function scripts_styles() {
        global $wp_styles;

        //Styles
        wp_enqueue_style('normalize', get_template_directory_uri().'/assets/css/normalize.css', false);

        if ( is_page_template( 'templates/vote.php' ) ) {
            wp_enqueue_style('core', get_template_directory_uri().'/assets/css/main_stage1.css', false);
        }

        else if ( is_page_template( 'templates/winner.php' ) ) {
            wp_enqueue_style('core', get_template_directory_uri().'/assets/css/main_stage2.css', false);   
        }

        //Scripts
        wp_enqueue_script('main', get_template_directory_uri().'/assets/js/main.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('fitvids', get_template_directory_uri().'/assets/js/vendor/jquery.fitvids.js', '1.1', true);

        wp_localize_script('main', 'ajaxurl', admin_url('admin-ajax.php'));

    }
    add_action( 'wp_enqueue_scripts', 'scripts_styles' );

?>