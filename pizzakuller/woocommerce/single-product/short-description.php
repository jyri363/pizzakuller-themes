<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

if ( ! $post->post_excerpt ) {
	return;
}

?>
<div itemprop="description"  class="description">
	<?php 
	$short_descr = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
	if(strlen($short_descr) > 300){
		echo substr($short_descr, 0,300).'...';
	}else{
		echo $short_descr;
	}
	?>
</div>
