<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<div class="cart-box">
	<div class="top">Ostukorv</div>
	<div class="body">
		<ul>
			<li class="info">

		<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

				<span class="products"><strong><?php  echo count($woocommerce->cart->get_cart());?></strong> products</span>
				<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><?php _e('View Cart', 'woocommerce'); ?></a>
		
		<?php else : ?>
		
				<span class="products"><strong><?php _e('No products in the cart.', 'woocommerce'); ?></strong></span>
		
		<?php endif; ?>
		
			</li>
			<li class="price">
				<span class="label"><?php _e('Subtotal', 'woocommerce'); ?></span>
				<span class="value"><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span>
			</li>
		</ul>
		<a class="submit-button" href="<?php echo $woocommerce->cart->get_checkout_url(); ?>"><?php _e('Checkout', 'woocommerce'); ?></a>
		<div class="graphic"></div>
	</div>
</div>

<hr />
