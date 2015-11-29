<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;
?>

<?php foreach ( $messages as $message ) : 
    // The message does not contain the "add to cart" string, so print the message
    // http://stackoverflow.com/q/4366730/1287812
    if ( strpos( $message, 'added to your cart' ) === false ) :
        ?>
            
        <?php 
    endif; ?>
<?php endforeach; ?>