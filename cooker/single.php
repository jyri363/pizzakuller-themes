<?php 
	/**
	 * Template Name: Single Page
	 */
	get_header();
?>
<div class="content  full-content clearfix">
	<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part('breadcrumb'); ?>
	<?php wp_link_pages(); ?>
		<div class="left-content">
			<h1 class="page-title"> <?php the_title() ?></h1>
			<?php if(has_post_thumbnail()): ?>
			<div class="image"><?php the_post_thumbnail('large'); ?></div>
			<?php endif; ?>
			<div class="post-details single">
				<h1> <?php the_title() ?></h1>
				<div class="product_meta">
					<p class="post-date">Date added: <?php the_date(); ?></p>
					<p>
						Categories: <?php the_category(', '); ?>
					</p>
				</div>
				<?php the_content() ?>
			</div>

			<div class="comments-holder">
				<?php comments_template( '', true ); ?>
			</div>
		</div>
	<?php endwhile; ?>
	
	<?php get_sidebar(); ?>
</div>
<?php
	get_footer();
?>