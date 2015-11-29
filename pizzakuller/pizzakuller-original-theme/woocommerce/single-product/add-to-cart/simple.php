<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce, $product;

if ( ! $product->is_purchasable() ) return;
?>

<?php
	// Availability
	$availability = $product->get_availability();

	if ($availability['availability']) :
		echo apply_filters( 'woocommerce_stock_html', '<p class="stock '.$availability['class'].'">'.$availability['availability'].'</p>', $availability['availability'] );
    endif;
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action('woocommerce_before_add_to_cart_form'); ?>

	<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="cart" method="post" enctype='multipart/form-data'>

	 	<?php do_action('woocommerce_before_add_to_cart_button'); ?>

	 	<div class="single_variation_wrap">
		<div class="single_variation"></div>
		<div class="variations_button" style="margin-top:80px; margin-right:28px;">
			<input type="hidden" name="variation_id" value="" />
			<p style="margin-top:-5px; margin-bottom:0px; text-align:center; font-family:Lucida Sans, sans-serif; font-size:14px;"><?php _e('[:en]Choose qty:[:et]Vali kogus:[:ru]количество:'); ?></p>
			<?php woocommerce_quantity_input(); ?>
			
		</div>
		<button type="submit" class="checkout-button2" style="margin-top:160px !important; margin-left:-110px !important; position:absolute;"><?php echo apply_filters('single_add_to_cart_text', __( 'Add to cart', 'woocommerce' ), $product->product_type); ?></button>
	</div>
	<div>
		<input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
		<input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
	</div>

	 	<?php do_action('woocommerce_after_add_to_cart_button'); ?>

	</form>

	<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>