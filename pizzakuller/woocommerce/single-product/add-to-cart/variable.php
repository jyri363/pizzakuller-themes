<?php
/**
 * Variable product add to cart
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->id ); ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>
	
		<table class="variations" cellspacing="0">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<tr>
						<td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td>
						<td class="value">
							<?php
								$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) : $product->get_variation_default_attribute( $attribute_name );
								wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
								echo end( $attribute_keys ) === $attribute_name ? '<a class="reset_variations" href="#">' . __( 'Clear selection', 'woocommerce' ) . '</a>' : '';
							?>
						</td>
					</tr>
		        <?php endforeach;?>
			</tbody>
		</table>
		
		<div class="single_variation_wrap" style="display:none;">
			<?php
				/**
				 * woocommerce_before_single_variation Hook
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				//do_action( 'woocommerce_single_variation' );
				?>
				<div class="single_variation" style="margin-top:-32px; margin-right:-2px !important; padding-top:15px; padding-bottom:15px;"></div>
				<div class="variations_button">
					<p style="margin-top:-5px; margin-bottom:0px; text-align:center; font-family:Lucida Sans, sans-serif; font-size:14px;"><?php _e('Choose qty:'); ?></p>
					<input type="hidden" name="variation_id" value="" />
					<?php woocommerce_quantity_input(); ?>
				</div>
				<?php
				/**
				 * woocommerce_after_single_variation Hook
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
			<?php /* <div style="width:320px !important; margin:0 auto !important; text-align:center !important;position: relative;"><button type="submit" class="checkout-button2" style="margin-top:55px; position:absolute; bottom: -300px;"><?php echo apply_filters('single_add_to_cart_text', __('Add to cart', 'woocommerce'), $product->product_type); ?></button></div> */ ?>
			<div class="buttondiv" style="width:auto !important; margin:0 auto !important; text-align:center !important;position: relative;"><button type="submit" class="checkout-button2" style="width: 280px !important; margin: 0 3px 0 0 !important;background: #E13B09 none repeat scroll 0% 0% !important;border-radius: 5px 5px 0px 0px !important;height: 45px !important;line-height: 45px!important;padding: 0px !important;font-size: 20px !important;color: rgb(255, 255, 255) !important;"><?php echo apply_filters('single_add_to_cart_text', __('Add to cart', 'woocommerce'), $product->product_type); ?></button></div>
		</div>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
		
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
