<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibilty
if ( ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;
?>
<div id="meals-of-the-day2">
<li class="meal <?php
	if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 3 )
		echo 'last';
	elseif ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 3 )
		echo 'first';
	?>" itemtype="http://schema.org/Product" itemscope="">

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>



		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */?>
			 <div class="tootekast">
					<div class="hoverkast">
			<div class="img-holder">
					<a href="<?php the_permalink(); ?>" itemprop="image"><?php	do_action( 'woocommerce_before_shop_loop_item_title' ); ?>	</a>
					<span class="alates"><?php _e('[:en]From[:et]Alates[:ru]Начиная'); ?></span>
					
					<?php if ( $price_html = $product->get_price_html() ) : ?>
	<span class="price"><?php echo $price_html; ?></span>
<?php endif; ?>
			</div>
		
	
		<a href="<?php the_permalink(); ?>" class="desc-holder">	
		<span class="title" itemprop="name"><?php the_title(); ?></span>

		<span class='txt'><?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?></span>
		
		
<span class="nupp"><?php _e('[:en]Add to cart[:et]Soovin[:ru]Желаю'); ?></span></a>
	</div></div>
</li>
</div>