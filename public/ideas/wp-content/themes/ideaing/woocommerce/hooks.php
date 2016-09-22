<?php
/**
 * WooCommerce template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @since WooCommerce Integration 1.0
 */


/**
 * Disable the default stylesheet
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


/**
 * If this is a wc page
 *
 * @since WooCommerce Integration 1.0
 */
function is_ideaing_woocommerce_page( $default = false, $strict = true ){

  return is_woocommerce()
    || is_shop()
    || is_cart()
    || is_checkout()
    || is_account_page()
    || is_wc_endpoint_url()
  ? $strict : $default;
}
add_filter('is_ideaing_woocommerce_page', 'is_ideaing_woocommerce_page', 10, 2);
