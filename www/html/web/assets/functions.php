<?php

// Disable plugin updates
remove_action('load-update-core.php', 'wp_update_plugins');
add_filter('pre_site_transient_update_plugins', '__return_null');

// Remove Gutenberg block library
function remove_block_css() {
wp_dequeue_style( 'wp-block-library' ); // Wordpress core
wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
wp_dequeue_style( 'wc-block-style' ); // WooCommerce
wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme
}
add_filter('use_block_editor_for_post_type', '__return_false', 10);
add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );

// Allow post tags
function wp_kses_allowed_html_post_tags( $allowedposttags, $context ) {
    if ( $context === 'post' ) {
        $allowedposttags['svg']  = array(
			'fill' => true,
			'stroke' => true,
            'xmlns'   => true,
            'viewbox' => true
        );
        $allowedposttags['path'] = array(
            'd'    => true,
            'fill' => true,
			'stroke-linecap' => true,
			'stroke-linejoin' => true,
			'stroke-width' => true


        );
    }
    return $allowedposttags;
}
add_filter( 'wp_kses_allowed_html', 'wp_kses_allowed_html_post_tags', 10, 2 );

// Woocommerce disable shipping calculation on cart page
function disable_shipping_calc_on_cart( $show_shipping ) {
    if( is_cart() ) {
        return false;
    }
    return $show_shipping;
}
add_filter( 'woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99 );

// Woocommerce remove product data tabs
function remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] );
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'remove_product_tabs', 98 );