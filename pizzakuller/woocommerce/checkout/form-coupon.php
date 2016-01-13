<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! WC()->cart->coupons_enabled() ) {
	return;
}

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'woocommerce' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'woocommerce' ) . '</a>' );
wc_print_notice( $info_message, 'notice' );
?>

<form class="checkout_coupon checkout woocommerce-checkout" method="post" style="display:none">

	<div class="col1-set">
		<div class="col">
			<!--<h3><?php _e( 'Coupon code', 'woocommerce' ); ?></h3>-->
			<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />

			<input type="submit" class="button alt submit" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'woocommerce' ); ?>" />
		</div>
	</div>
	<div class="clear"></div>
</form>
