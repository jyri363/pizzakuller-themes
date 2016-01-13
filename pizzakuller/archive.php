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

	<?php get_template_part('breadcrumb'); ?>
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
							<div class="product_meta">
								<p class="post-date">Date added: <?php the_date(); ?></p>
								<p>
									Categories: <?php the_category(', '); ?>
								</p>
							</div>
							<div class="post-excerpt">
								<?php the_excerpt();?>
							</div>
							<a href="<?php the_permalink(); ?>" class="button-ckr">Read More</a>
						</div>
					</div>
				</li>
				<?php endwhile; ?>
			</ul>
		</div>

		<div class="paging mar-t-20">
			<?php echo paginate_links($pg_arg); ?>
		</div>
	</div>

	<?php get_sidebar(); ?>
	<?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?>
</div>

<?php
	get_footer();
?>