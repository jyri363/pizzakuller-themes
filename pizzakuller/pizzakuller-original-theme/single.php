<?php 
    /**
     * Template Name: Single Page
     */
    get_header();
?>
<div class="content  full-content clearfix">
  <?php while ( have_posts() ) : the_post(); ?>
    <div class="breadcrumbs">
      <ul>
        <li><a href="#">Home</a></li>
        <li> <?php the_title() ?></li>
      </ul>
    </div>
	<?php wp_link_pages(); ?>
    <div class="left-content">
      <div class="post-details single">
        <h1> <?php the_title() ?></h1>
        <?php if(has_post_thumbnail()): ?>
          <div class="image"><?php the_post_thumbnail('large'); ?></div>
        <?php endif; ?>
        <div class="date_categories">Date added: <?php the_date(); ?> | Categories: <?php the_category(', '); ?></div>
        <?php the_content() ?>
        
        <?php comments_template( '', true ); ?>
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