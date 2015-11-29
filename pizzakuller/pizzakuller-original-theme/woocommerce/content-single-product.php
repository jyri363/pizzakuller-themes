<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked woocommerce_show_messages - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
?>
<div id="alammenuu">
        <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('alam')) ?>
        </div>
<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class('left-content'); ?>>
	<div class="meal-details single">
		<?php
			/**
			 * woocommerce_show_product_images hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_show_product_sale_flash - 10
			 * @hooked woocommerce_show_product_images - 20
			 */
			
			add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 5 );
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
			do_action( 'woocommerce_before_single_product_summary' );
		?>
	
	<!--	<div class="summary">-->
	
			<?php
				/**
				 * woocommerce_single_product_summary hook
				 *
				 * @hooked woocommerce_template_single_meta - 5
				 * @hooked woocommerce_product_description_panel - 9
				 * @hooked woocommerce_template_single_price - 60
				 * @hooked woocommerce_template_single_add_to_cart - 50
				 * @hooked woocommerce_template_single_sharing - 70
				 */
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
				add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 9 );
				add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5 );
				do_action( 'woocommerce_single_product_summary' );
			?>
	
		<!--</div> .summary -->
		
		
		<?php
                    /**
                     * woocommerce_after_single_product_summary hook
                     *
                     * @hooked woocommerce_output_product_data_tabs - 10
                     * @hooked woocommerce_output_related_products - 20
                     */
                    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
                    do_action( 'woocommerce_after_single_product_summary' );
                ?>
	</div>
</div>

<!--===============  Print Right Sidebar  ================-->
	<div class="right-content">
		  <?php if ( is_active_sidebar( 'right-sidebar-cart-ckrw' ) ) {
				 dynamic_sidebar('right-sidebar-cart-ckrw'); 	
			} ?>	
		  <?php if ( is_active_sidebar( 'right-sidebar-widgets-ckrw' ) ) {
				 dynamic_sidebar('right-sidebar-widgets-ckrw'); 	
			} ?>	
	</div>
<!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>