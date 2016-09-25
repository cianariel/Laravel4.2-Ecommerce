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
 * Body class filter
 *
 * @return return array
 * @since WooCommerce Integration 1.0
 */
function ideaing_body_class_filter($classes){

  $is_woocommmerce_checkout = apply_filters('is_ideaing_woocommerce_checkout_page', false, 'secure-checkout');
  if ( $is_woocommmerce_checkout ){
    $classes[] = $is_woocommmerce_checkout;
  }

  return $classes;
}
add_filter('body_class', 'ideaing_body_class_filter', 99, 1 );

/**
 * If this is a wc page
 *
 * @return return boolian | custom
 * @since WooCommerce Integration 1.0
 */
function is_ideaing_woocommerce_checkout_page( $default = false, $strict = true ){

  return is_cart()
    || is_checkout()
    || is_account_page()
  ? $strict : $default;
}
add_filter('is_ideaing_woocommerce_checkout_page', 'is_ideaing_woocommerce_checkout_page', 10, 2);

/**
 * If cart is not empty
 *
 * @return return boolean
 * @since WooCommerce Integration 1.0
 */
function is_ideaing_cart_empty(){

  return WC()->cart->is_empty();
}
add_filter('is_ideaing_cart_empty', 'is_ideaing_cart_empty');

/**
 * Get cart contents count
 *
 * @return return int
 * @since WooCommerce Integration 1.0
 */
function get_ideaing_cart_contents_count(){

  return WC()->cart->get_cart_contents_count();
}
add_filter('get_ideaing_cart_contents_count', 'get_ideaing_cart_contents_count');
