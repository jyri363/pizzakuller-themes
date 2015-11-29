<?php 
    /**
     * Template Name: Page + Sidebar
     */
    get_header();
?>
<div class="content  full-content clearfix">
	<?php while ( have_posts() ) : the_post(); ?>
		
		
			<?php the_content() ?>
		
	<?php endwhile; ?>
 	
</div>

<?php
    get_footer();
?>