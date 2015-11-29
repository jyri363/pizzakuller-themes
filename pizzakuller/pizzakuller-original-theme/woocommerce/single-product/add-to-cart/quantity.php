<?php
/**
 * Single product quantity inputs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
?>
<p style="margin-top:-5px; margin-bottom:0px; text-align:center; font-family:Lucida Sans, sans-serif; font-size:14px; z-index:99999;"><?php _e('[:en]Choose qty:[:et]Vali kogus:'); ?></p>
<div class="quantity"><input name="<?php echo $input_name; ?>" data-min="<?php echo $min_value; ?>" data-max="<?php echo $max_value; ?>" value="<?php echo $input_value; ?>" size="4" title="Qty" class="input-text qty text" maxlength="12" /></div>