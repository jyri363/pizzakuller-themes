<?php 
	/**
	 * Template Name: Page + Sidebar
	 */
	get_header();
?>
<div class="content  full-content clearfix">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php get_template_part('breadcrumb'); ?>
		<div class="page-content">
			<?php the_content() ?>
		</div>
	<?php endwhile; ?>

</div>

<?php
	get_footer();
?>