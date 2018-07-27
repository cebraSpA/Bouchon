<?php 
add_action( 'wp_enqueue_scripts', 's7upf_theme_enqueue_styles' );
function s7upf_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}


add_filter( 'woocommerce_product_tabs', 'reordered_tabs', 98 );
function reordered_tabs( $tabs ) {
    $tabs['reviews']['priority'] = 100;
 
    return $tabs;
}

?>