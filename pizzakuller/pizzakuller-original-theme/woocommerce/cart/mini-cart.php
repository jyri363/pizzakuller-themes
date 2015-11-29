<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce;
?>

<div class="cart-box">
	<div class="top"><?php _e('Soovide korv', 'woocommerce'); ?></div>
	<div class="body">
		<ul>
			<li class="info">
			<?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>
				<span class="products"><strong><?php  echo count($woocommerce->cart->get_cart());?></strong> <?php _e('[:en]Product(s)[:et]Toode(t)[:ru]товар'); ?></span>
				<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><?php _e('[:en]View cart[:et]Vaata korvi[:ru]посмотри в корзину'); ?></a>
		<?php else : ?>
				<span class="products"><strong><?php _e('[:en]No products in the cart[:et]Soovide korv on tühi[:ru]корзинa пуста'); ?></strong></span>
		<?php endif; ?>
			</li>
			<li class="price">
				<span class="label"><?php _e('Tellimuse summa', 'woocommerce'); ?></span>
				<span class="value"><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span>
			</li>
		</ul>
        <a class="submit-button cart_check_home_button" href="<?php echo $woocommerce->cart->get_checkout_url(); ?>"><?php _e('Vormista tellimus', 'woocommerce'); ?></a>
       
               
       
        
        
       
		
	</div>
</div>
