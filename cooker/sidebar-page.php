<?php 
	/**
	 * Template Name: Single Page + Sidebar
	 */
	get_header();
?>
<div class="content  full-content clearfix">
	<?php while ( have_posts() ) : the_post(); ?>

	<?php get_template_part('breadcrumb'); ?>
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
?>