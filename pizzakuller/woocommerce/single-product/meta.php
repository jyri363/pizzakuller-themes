<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

?>
<div class="product_meta">
	<div class="hidden" id="single-product-categories"><?php
        $terms = get_the_terms($product->id, 'product_cat');
        if ($terms) {
            foreach ($terms as $term) {
                if ($term->parent == 0) {
                    $maincat = $term->name;
                } else {
                    $second = $term->name;
                }
            }

            echo '<a>' . $maincat . '</a>';
            echo '<a>' . $second . '</a>';
        }
    ?></div>
	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php /* if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

		<span class="sku_wrapper"><?php _e( 'SKU:', 'woocommerce' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ); ?></span></span>

	<?php endif; ?>

	<?php echo $product->get_categories( ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', '</span>' ); ?>

	<?php echo $product->get_tags( ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', '</span>' ); */ ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
