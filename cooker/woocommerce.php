<?php
/**
 * The Template for displaying all single posts
 *
 * @author 		DesignMania
 * @package 	Cooker
 * @version     1.0.0
 *
 **/

get_header(); ?>
	<section id="content">
		<?php //========= Woo Content ========  ?>
		<div id="alammenuu">

		<?php 
		global $post;
		$terms = wp_get_post_terms( $post->ID, 'product_cat' );
		foreach ( $terms as $term ) $categories[] = $term->slug;
		
		if ( in_array( 'new-york-pizza', $categories ) || in_array( 'new-york-pizza-restaurant', $categories )) {
		  if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('alam')) {}
		 // woocommerce_get_template_part( 'content', 'single-product' );
		} elseif ( in_array( 'peetri-pizza', $categories ) || in_array( 'peetri-pizza-restaurant', $categories )) {
		  if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('alam2')) {}
		  // woocommerce_get_template_part( 'content', 'single-product' );
		} else {
		  echo 'some blabla';
		}

			//if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('alam')) {}
				
		?>
		</div>
		<?php get_template_part('breadcrumb'); ?>
		<div class="left-content">
			<?php if ( have_posts() ) : ?>
				<?php woocommerce_content(); ?>
			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</section>

<?php get_footer(); ?>