<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post, $woocommerce, $product;

?>
<div class="images">
<!--============================-->
<!--Moving On Sale Icon In Image-->
<!--============================-->
<?php if ($product->is_on_sale()) : ?>

	<?php echo apply_filters('woocommerce_sale_flash', '<span class="onsale">'.__('Sale!', 'woocommerce').'</span>', $post, $product); ?>

<?php endif; ?>
<!--==============================-->

	<?php if ( has_post_thumbnail() ) : ?>

		<a itemprop="image" href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" class="zoom" rel="thumbnails" title="<?php echo get_the_title( get_post_thumbnail_id() ); ?>"><?php echo get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) ) ?></a>

	<?php else : ?>

		<img src="<?php echo woocommerce_placeholder_img_src(); ?>" alt="Placeholder" />

	<?php endif; ?>

	<?php do_action('woocommerce_product_thumbnails'); ?>

</div>