<?php 
    /**
     * Template Name: Single Page + Sidebar
     */
    get_header();
?>

<div class="content  full-content clearfix">
<div id="alammenuu">
        <?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('alam')) ?>
        </div>
  <?php while ( have_posts() ) : the_post(); ?>
    
	<?php wp_link_pages(); ?>
    <div class="left-content">
      <div class="post-details single">
        
        <?php if(has_post_thumbnail()): ?>
          <div class="image"><?php the_post_thumbnail('large'); ?></div>
        <?php endif; ?>
        <?php the_content() ?>
        
      </div>  
    </div>
  <?php endwhile; ?>
<!--===============  Print Right Sidebar  ================-->
	<div class="right-content">
		  <?php if ( is_active_sidebar( 'right-sidebar-cart-ckrw' ) ) {
				 dynamic_sidebar('right-sidebar-cart-ckrw'); 	
			} ?>	
		  <?php if ( is_active_sidebar( 'right-sidebar-widgets-ckrw' ) ) {
				 dynamic_sidebar('right-sidebar-widgets-ckrw'); 	
			} ?>	
	</div>	
</div>
<?php
    get_footer();
?>