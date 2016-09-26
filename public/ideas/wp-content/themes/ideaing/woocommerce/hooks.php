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

/**
 * Generate cart widget content
 *
 * @return string
 * @since WooCommerce Integration 1.0
 **/
function ideaing_cart_content(){

	$products = $classes = array();

	if ( ! WC()->cart->is_empty() ) :

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
				$thumbnail         = '';
			    $attachment_id = get_post_thumbnail_id( $product_id );
				if ( $attachment_id ){

					$attachment = wp_get_attachment_image_src( $attachment_id, 'full' );

					if ( $attachment ){

						$thumbnail = sprintf('<figure style="background-image:url(%s);"></figure>', esc_url($attachment[0]));
					}
				}

				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );


				$data = array();
				$attributes = $_product->get_attributes();

				if ( $attributes ):

					foreach ( $attributes as $attribute ) :

						if ( empty( $attribute['is_visible'] ) || ( $attribute['is_taxonomy'] && ! taxonomy_exists( $attribute['name'] ) ) ) {
							continue;
						}

						if ( $attribute['is_taxonomy'] ) {

							$values = wc_get_product_terms(  $product_id , $attribute['name'], array( 'fields' => 'names' ) );

							if ( 'pa_capacity' == $attribute['name'] ) {

								foreach ($values as $key => $value) {
									$values[$key] .= " GB";
								}
							}

							$data[] = wp_strip_all_tags( apply_filters( 'woocommerce_attribute', implode( ', ', $values ), $attribute, $values ) );

						} else {

							// Convert pipes to commas and display values
							$values = array_map( 'trim', explode( WC_DELIMITER, $attribute['value'] ) );
							$data[] = wp_strip_all_tags( apply_filters( 'woocommerce_attribute', implode( ', ', $values ) , $attribute, $values ) );

						}
					endforeach;
				endif;

        $remove = apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
          '<a href="%s" class="remove" data-product_id="%s" data-product_sku="%s"><i class="m-icon--close"></i></a>',
          esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
          esc_attr( $product_id ),
          esc_attr( $_product->get_sku() )
        ), $cart_item_key );

				$products[] = sprintf('<div class="cs--i"><a href="%s" class="item">%s<span class="name">%s</span><span class="spec">%s</span></a>%s</div>',
					esc_attr( $product_permalink ),
					$thumbnail,
					$product_name,
					implode(' &bull; ', $data),
          $remove
				);
			}
		}

	else :

		//
		$classes[] 	= 'empty';
		//
		$products[] = sprintf('<p>%s</p>', __( 'No products in the cart.', 'ideaing' ) );

	endif;

  $uniqid = uniqid('uniqid-');

	return sprintf( implode('', array(
		'<div class="cart-summary-inner %1$s">',
      '<input type="checkbox" id="%2$s" class="screen-reader-text">',
    	'<label for="%2$s" class="widget-title-alt">%3$s ( %4$s )</label>',
			'<div class="cart-items">%5$s</div>',
		'</div>' ) ),
		esc_attr( implode(' ', $classes) ),
    $uniqid,
    __( 'Cart Summary', 'ideaing' ),
    WC()->cart->cart_contents_count,
		implode('', $products)
	);
}

/**
 * Cart widget html
 *
 * @return return string
 * @since WooCommerce Integration 1.0
 */
function ideaing_cart_widget_render(){

	printf( '<div class="cart-summary">%s</div>', ideaing_cart_content() );
}
add_action('ideaing_cart_widget_render', 'ideaing_cart_widget_render');

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 *
 * @return array
 **/
function ideaing_cart_content_fragment( $fragments ) {

	$fragments['div.cart-summary-inner'] = ideaing_cart_content();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'ideaing_cart_content_fragment', 99, 1 );
