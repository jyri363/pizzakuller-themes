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

		<?php get_template_part('breadcrumb'); ?>
		<div class="left-content">
			<?php if ( have_posts() ) : ?>
				<?php woocommerce_content(); ?>
			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</section>

<?php get_footer(); ?>