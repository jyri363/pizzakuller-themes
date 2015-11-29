<?php 
    /**
     * Template Name: Archive Page + Sidebar
     */
    get_header();
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $cat = get_query_var('cat');
    $query_string = 'paged=' . $paged;
    
    if(isset($cat))
      $query_string .= '&cat=' . $cat;
    
    query_posts($query_string);
    
?>
<div class="content clearfix">
  <div class="breadcrumbs">
    <ul>
      <li><a href="#">Home</a></li>
      <li>Entrees</li>
    </ul>
  </div>
  <div class="left-content">				
    <div class="paging">
       <?php
//global $wp_query;

$big = 999999999; // need an unlikely integer
$pg_arg = array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'type'         => 'list',
	'current' => max( 1, get_query_var('paged') ),
	'total' => $wp_query->max_num_pages
);
echo paginate_links($pg_arg);
?>
    </div>

    <div class="post-listing">
      <ul>
        <?php
        
          while(have_posts()): the_post();
        ?>
        <li>
          <?php if(has_post_thumbnail()): ?>
            <div class="image"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a></div>
          <?php endif; ?>
          <div class="info">
            <div class="descr-holder">
              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <div class="date_categories">Date added: <?php the_date(); ?> | Categories: <?php the_category(', '); ?></div>
              <?php the_excerpt();?>
            </div>
              <a href="<?php the_permalink(); ?>" class="button-ckr right">Read More</a>
          </div>
        </li>
        <?php endwhile; ?>
      </ul>
    </div>

    <div class="paging mar-t-20">
      <?php echo paginate_links($pg_arg); ?>
    </div>
  </div>
  
  <!--===============  Print Right Sidebar  ================-->
	<div class="right-content">
		  <?php if ( is_active_sidebar( 'right-sidebar-cart-ckrw' ) ) {
				 dynamic_sidebar('right-sidebar-cart-ckrw'); 	
			} ?>	
		  <?php if ( is_active_sidebar( 'right-sidebar-widgets-ckrw' ) ) {
				 dynamic_sidebar('right-sidebar-widgets-ckrw'); 	
			} ?>	
	</div>	
	<?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?>
</div>

<?php
    get_footer();
?>