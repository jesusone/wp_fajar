<?php
/**
 * Loop Add to Cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     9.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<div class="yeah-add-to-cart"><a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="%s product_type_%s product-cart-btn pull-left " title="%s"><i class="icon-icons240"></i><span>%s</span></a><a href="'.the_permalink().'" title="'.esc_html__('Details','woocommerce').'" class="product-detail-btn pull-right"><i class="icon-list3"></i> '.esc_html__('Details','woocommerce').'</a></div>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( $product->id ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
		esc_attr( $product->product_type ),
		esc_html( $product->add_to_cart_text() ),
		esc_html( $product->add_to_cart_text() )
	),
$product );
?>


