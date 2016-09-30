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
 * Body class filter
 *
 * @return return string
 * @since WooCommerce Integration 1.0
 */
function ideaing_gateway_icon($icon, $gateway){

  switch ($gateway) {
    case 'paypal':
      $icon = '<img alt="Paypal" src="/../assets/images/paypal.svg">';
      break;

    case 'stripe':
      $icon = '<img alt="Visa Mastercart" src="/../assets/images/visa-mc.png">';
      break;
  }
  return $icon;
}
add_filter('woocommerce_gateway_icon', 'ideaing_gateway_icon', 99, 2);

/**
 * If this is a checkout page process
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
 * If this is a checkout page process
 *
 * @return return boolian | custom
 * @since WooCommerce Integration 1.0
 */
function is_ideaing_cart( $default ){

  return is_cart();
}
add_filter('is_ideaing_cart', 'is_ideaing_cart', 10, 1);

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
 * Get cart total contents
 *
 * @return return string
 * @since WooCommerce Integration 1.0
 */
function get_ideaing_woocommerce_cart_totals(){

  wc_get_template( 'cart/cart-totals.php' );
}
add_action('get_ideaing_woocommerce_cart_totals', 'get_ideaing_woocommerce_cart_totals');

/**
 * Page title.
 *
 * @since WooCommerce Integration 1.0
 */
function get_ideaing_page_title_rener() {

  wc_get_template( 'page/title.php' );
}
add_action( 'ideaing_page_title', 'get_ideaing_page_title_rener' );


/**
 * Filter woocommerce_form_field function
 *
 * @since WooCommerce Integration 1.0
 **/
function ideaing_form_field_email_modify( $field, $key, $args, $value ){

	switch ( $key ) {
		case 'order_email':
			$field = sprintf('<p class="opacity-3">%s</p>%s<p class="opacity-3">%s</p>',
				__('Shipment notification emails are sent to the Billing Contact. Another recipient email address may be added below.', 'ideaing'),
				$field,
				__('For shipment updates via text messages, enter a mobile number below.', 'ideaing')
			);
			break;

		case 'shipping_postcode':
		case 'billing_postcode':
			$field = sprintf('<div class="has-extra-desc">%s<p class="desc opacity-3">%s</p></div><div class="clear"></div>',
				$field,
				__('Enter ZIP for City and State', 'ideaing')
			);
			break;
	}

	return $field;
}
add_filter( 'woocommerce_form_field_email' , 'ideaing_form_field_email_modify', 99, 4 );
add_filter( 'woocommerce_form_field_text' , 'ideaing_form_field_email_modify', 99, 4 );

/**
 * Get a shipping methods full label including price.
 * @param  WC_Shipping_Rate $method
 * @return string
 */
function ideaing_cart_totals_shipping_method_label( $method ) {
	$label = sprintf('<th>%s</th><td>', $method->get_label() );

	if ( $method->cost > 0 ) {
		if ( WC()->cart->tax_display_cart == 'excl' ) {
			$label .= wc_price( $method->cost );
			if ( $method->get_shipping_tax() > 0 && WC()->cart->prices_include_tax ) {
				$label .= ' <small class="tax_label">' . WC()->countries->ex_tax_or_vat() . '</small>';
			}
		} else {
			$label .= wc_price( $method->cost + $method->get_shipping_tax() );
			if ( $method->get_shipping_tax() > 0 && ! WC()->cart->prices_include_tax ) {
				$label .= ' <small class="tax_label">' . WC()->countries->inc_tax_or_vat() . '</small>';
			}
		}
	} else {
    $label .= __('FREE');
  }

  $label .= '</td>';

	return apply_filters( 'ideaing_cart_shipping_method_full_label', $label, $method );
}

/**
 * Filter cart_shipping_method_full_label function
 *
 * @since WooCommerce Integration 1.0
 */
function ideaing_cart_shipping_method_full_label( $label, $method ) {

  if ( $method->cost > 0 ) {
    $label = str_replace(':', '', $label);
  } else {
    $label .= ' <span class="amount amount-free">'.__('FREE').'</span>';
  }

  return $label;
}
add_filter( 'woocommerce_cart_shipping_method_full_label', 'ideaing_cart_shipping_method_full_label', 99, 2 );


/**
 * undocumented function summary
 *
 * Undocumented function long description
 *
 * @param type var Description
 * @return return type
 */
function ideaing_selected_shipping(){
  $packages = WC()->shipping->get_packages();

	foreach ( $packages as $i => $package ) {
		$chosen_method = isset( WC()->session->chosen_shipping_methods[ $i ] ) ? WC()->session->chosen_shipping_methods[ $i ] : '';
		$product_names = array();

		if ( sizeof( $packages ) > 1 ) {
			foreach ( $package['contents'] as $item_id => $values ) {
				$product_names[] = $values['data']->get_title() . ' &times;' . $values['quantity'];
			}
		}

		wc_get_template( 'cart/cart-selected-shipping.php', array(
			'package'              => $package,
			'available_methods'    => $package['rates'],
			'show_package_details' => sizeof( $packages ) > 1,
			'package_details'      => implode( ', ', $product_names ),
			'package_name'         => apply_filters( 'woocommerce_shipping_package_name', sprintf( _n( 'Shipping', 'Shipping %d', ( $i + 1 ), 'woocommerce' ), ( $i + 1 ) ), $i, $package ),
			'index'                => $i,
			'chosen_method'        => $chosen_method
		) );
	}
}
/**
 * Checkout.
 *
 * @see woocommerce_checkout_login_form()
 * @see woocommerce_checkout_coupon_form()
 * @see woocommerce_order_review()
 * @see woocommerce_checkout_payment()
 */
// remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
// remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );
// remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );

add_filter( 'woocommerce_cart_needs_shipping_address', '__return_true', 99 );

/**
 * undocumented function summary
 *
 * Undocumented function long description
 *
 * @param type var Description
 * @return return type
 */
function ideaing_terms_is_checked_default( $term ){

  return true;
}
add_filter('woocommerce_terms_is_checked_default', 'ideaing_terms_is_checked_default', 99, 1);


function ideaing_override_checkout_fields( $fields ) {
    unset($fields['billing']['billing_company']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['shipping']['shipping_company']);
    unset($fields['shipping']['shipping_address_2']);
    unset($fields['order']['order_comments']);

    $fields['account']['account_password']['placeholder'] = '';

    return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'ideaing_override_checkout_fields' );

/**
 * Secure checkout nav walking
 *
 * @return print string
 * @since WooCommerce Integration 1.0
 */
function ideaing_secure_checkout_nav(){

  if (is_cart()){

    printf(
      implode(
        array(
          '<span class="active"><span>%s</span></span>',
          '<a href="%s"><span>%s</span></a>',
          '<span><span>%s</span></span>'
        )
      )
      , __('Cart', 'ideaing')
      , esc_url(WC()->cart->get_checkout_url())
      , __('Your information', 'ideaing')
      , __('Success', 'ideaing')
    );

  } elseif (is_checkout()) {

    printf(
      implode(
        array(
          '<a href="%s" class="active"><span>%s</span></a>',
          '<span class="active"><span>%s</span></span>',
          '<span><span>%s</span></span>'
        )
      )
      , esc_url(WC()->cart->get_cart_url())
      , __('Cart', 'ideaing')
      , __('Your information', 'ideaing')
      , __('Success', 'ideaing')
    );

  } else {

    printf(
      implode(
        array(
          '<a href="%s" class="active"><span>%s</span></a>',
          '<a href="%s" class="active"><span>%s</span></a>',
          '<span class="active"><span>%s</span></span>'
        )
      )
      , esc_url(WC()->cart->get_cart_url())
      , __('Cart', 'ideaing')
      , esc_url(WC()->cart->get_checkout_url())
      , __('Your information', 'ideaing')
      , __('Success', 'ideaing')
    );
  }
}
add_action('ideaing_secure_checkout_nav', 'ideaing_secure_checkout_nav');

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

				$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

        $price = apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key );

        $remove = apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
          '<a href="%s" class="remove" data-product_id="%s" data-product_sku="%s"><i class="m-icon--close"></i></a>',
          esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
          esc_attr( $product_id ),
          esc_attr( $_product->get_sku() )
        ), $cart_item_key );

				$products[] = sprintf('<div class="cs--i"><a href="%s" class="item">%s<span class="name">%s</span><span class="price">%s</span></a>%s</div>',
					esc_attr( $product_permalink ),
					$thumbnail,
					$product_name,
					$price,
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
 * Ensure cart contents updates when products are added to the cart via AJAX
 *
 * @return array
 **/
function ideaing_cart_content_fragment( $fragments ) {

	$fragments['div.cart-summary-inner'] = ideaing_cart_content();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'ideaing_cart_content_fragment', 99, 1 );

/**
 * Ensure order summary updates when checkout page is updates via AJAX
 *
 * @return array
 **/
function ideaing_update_order_review_fragments( $fragments ) {

  unset($fragments['.woocommerce-checkout-review-order-table']);

  ob_start();
    do_action('get_ideaing_woocommerce_cart_totals');
    $order_summary = ob_get_contents();
  ob_end_clean();

	$fragments['.cart_totals'] = $order_summary;

  ob_start();
    if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) :

  		do_action( 'woocommerce_review_order_before_shipping' );

  		  wc_cart_totals_shipping_html();

  		do_action( 'woocommerce_review_order_after_shipping' );

  	endif;
    $select_shipping_method = ob_get_contents();
  ob_end_clean();

  $fragments['.select-shipping-method'] = $select_shipping_method;

	return $fragments;
}
add_filter( 'woocommerce_update_order_review_fragments', 'ideaing_update_order_review_fragments', 99, 1 );
