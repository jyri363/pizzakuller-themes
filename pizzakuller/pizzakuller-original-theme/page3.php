<?php 
    /**
     * Template Name: Sisuleht
     */
    get_header();
?>
<div class="content  full-content clearfix">
	<?php while ( have_posts() ) : the_post(); ?>
	<div class="right-content">
		  <?php if ( is_active_sidebar( 'right-sidebar-cart-ckrw' ) ) {
				 dynamic_sidebar('right-sidebar-cart-ckrw'); 	
			} ?>	
		  	
	</div>
		<div class="left-content2">
      
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php if(has_post_thumbnail()): ?>
          <div class="image"><?php the_post_thumbnail('large'); ?></div>
        <?php endif; ?>
        
		<?php the_content() ?>
		  
    </div>
	<?php endwhile; ?>
 	
</div>
<?php
    get_footer();
?>