<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $woocommerce;

$order = new WC_Order($_GET['order']);

if ($order) :
    ?>
    <div id="left_thanks_cont">
        <p class="thank-text"><?php _e('[:en]Thank you, your order is received[:et]Täname, sinu tellimus on edastatud[:ru]Спасибо, Ваш заказ передается'); ?></p>
        
<!-- AdChoice.eu Offer Conversion: Pizzakuller.ee -->

  <?php 
        $get_order_id_adchoice = $order->get_order_number();
	$adchoice_order_id = preg_replace("/[^0-9,.]/", "", $get_order_id_adchoice );

        $adchoice_subtotal = $order->get_total();
        $adchoice_shipping = 4;
        $adchoice_subtotal_minus_shipping = $adchoice_subtotal - $adchoice_shipping;
        $adchoice_subtotal_minus_shipping_minus_tax = $adchoice_subtotal_minus_shipping / 1.2;
	$adchoice_total = preg_replace("/[^0-9,.]/", "", $adchoice_subtotal_minus_shipping_minus_tax );
   ?>

<iframe src="http://s1.adchoice.eu/aff_l?offer_id=38&amount=<?php echo $adchoice_total; ?>&adv_sub=<?php echo $adchoice_order_id; ?>" scrolling="no" frameborder="0" width="1" height="1"></iframe>
        	

<!-- // End AdChoice.eu Offer Conversion -->    
        
        <?php //do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
        <?php do_action('woocommerce_thankyou', $order->id); ?>
    </div>
    <div id="right_thanks_container">
        <?php //do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
        <?php do_action('woocommerce_thankyou', $order->id); ?>
    </div>

<?php else : ?>

    <p><?php _e('Täname, sinu tellimus on edastatud', 'woocommerce'); ?></p>
    
   



<?php endif; ?>
<!-- Google Code for Tehing Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 962060131;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "D9LVCMrn21YQ477fygM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/962060131/?label=D9LVCMrn21YQ477fygM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>