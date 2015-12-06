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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>
<div id="alammenuu">
    <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('alam')) ?>
</div>
<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class('left-content'); ?>>
	<div class="meal-details single">
	<?php
		/**
		 * woocommerce_before_single_product_summary hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		//do_action( 'woocommerce_before_single_product_summary' );
		add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 5 );
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
		do_action( 'woocommerce_before_single_product_summary' );
	?>
	<!-- <div id="product-top">
		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 */
			//do_action( 'woocommerce_single_product_summary_top' );
		?>
	</div> -->
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
				 //do_action( 'woocommerce_single_product_summary' );
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
				add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 9 );
				add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5 );
				do_action( 'woocommerce_single_product_summary' );
			?>
	
		<!--</div> .summary -->

	
	<!--<div class="summary entry-summary">

		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			//do_action( 'woocommerce_single_product_summary' );
		?>
	</div> .summary -->

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		//do_action( 'woocommerce_after_single_product_summary' );
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
        do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

	</div>
</div>


<?php do_action( 'woocommerce_after_single_product' ); ?>
