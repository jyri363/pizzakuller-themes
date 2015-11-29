<?php 
	/**
	 * Template Name: Blog Page
	 */
	get_header();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

?>

<div class="content clearfix">
	<?php get_template_part('breadcrumb'); ?>
	<div class="left-content">
		<h1 class="page-title"> <?php the_title() ?></h1>
		<div class="post-listing">
			<ul>
				<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$query_args = array(
						'post_type' => 'post',
						'paged' => $paged
					);
					$dsm_query = new WP_Query($query_args);
					if ($dsm_query->have_posts()) :
			 			while ($dsm_query->have_posts()) :$dsm_query->the_post();
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
					<?php endif; ?>
			</ul>
		</div>

		<div class="paging mar-t-20">
			<?php dsm_paging_nav($dsm_query); ?>
		</div>
	</div>

	<?php get_sidebar(); ?>
	<?php the_tags('<ul><li>','</li><li>','</li></ul>'); ?>
</div>

<?php
	get_footer();
?>