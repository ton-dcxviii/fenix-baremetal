<?php
// Remove Gutenberg block library
function remove_block_css() {
wp_dequeue_style( 'wp-block-library' ); // Wordpress core
wp_dequeue_style( 'wp-block-library-theme' ); // Wordpress core
wp_dequeue_style( 'wc-block-style' ); // WooCommerce
wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront theme
}
add_filter('use_block_editor_for_post_type', '__return_false', 10);
add_action( 'wp_enqueue_scripts', 'remove_block_css', 100 );

// Woocommerce Checkout Addon positioning
function sv_wc_checkout_addons_change_position() {
	return 'woocommerce_review_order_before_payment';
}
add_filter( 'wc_checkout_add_ons_position', 'sv_wc_checkout_addons_change_position' );

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
