<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
global $post, $product;
?>
<div class="date_categories">

    <?php if ($product->is_type(array('simple', 'variable')) && get_option('woocommerce_enable_sku') == 'yes' && $product->get_sku()) : ?>
        <span itemprop="productID" class="sku"><?php _e('SKU:', 'woocommerce'); ?> <?php echo $product->get_sku(); ?>.</span>
    <?php endif; ?>

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

    <?php echo $product->get_tags(', ', ' <span class="tagged_as">' . __('Tags:', 'woocommerce') . ' ', '.</span>'); ?>

</div>