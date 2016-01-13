<?php 
    /**
     * Template Name: Tooted - NY Pizza
     */
    get_header();
?>
<?php /*
<div class="content  full-content clearfix">
	<div id="alammenuu">
        <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('alam')) ?>
    </div>
	<?php while ( have_posts() ) : the_post(); ?>

	<?php wp_link_pages(); ?>
		<div class="left-content">
			<div class="post-details single">
				<h1> <?php the_title() ?></h1>
				<?php if(has_post_thumbnail()): ?>
					<div class="image"><?php the_post_thumbnail('large'); ?></div>
				<?php endif; ?>
				<?php the_content() ?>
			</div>
		</div>
	<?php endwhile; ?>

	<?php get_sidebar(); ?>
</div>
<?php
	get_footer();
?>*/
?>
<div id="content">
	<div id="alammenuu">
        <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('alam')) ?>
    </div>
	<?php while ( have_posts() ) : the_post(); ?>

	<?php wp_link_pages(); ?>
		<div class="left-content woocommerce-page">
				<h1 class="product-category-title"> <?php the_title() ?></h1>
				<?php /* if(has_post_thumbnail()): ?>
					<div class="image"><?php the_post_thumbnail('large'); ?></div>
				<?php endif; */ ?>
				<?php the_content() ?>
		</div>
	<?php endwhile; ?>

	<?php get_sidebar(); ?>
</div>
<?php
	get_footer();
?>