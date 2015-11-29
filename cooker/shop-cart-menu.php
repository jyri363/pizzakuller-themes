<?php
/**
 *  Template Name: Menu Card
 *  The Template for displaying all Products in Menu Card
 */
	get_header();
?>

<div class="content full-content clearfix">
	<?php get_template_part('breadcrumb'); ?>
	<h1 class="page-title"><?php the_title(); ?></h1>
	<div class="page-content product-menu-holder">
		<?php the_category(); ?>
		<?php //dsm_get_products_for_category(202); ?>
			<?php
			$args = array(
				'orderby' => 'name',
				'order' => 'ASC',
				'taxonomy' => 'product_cat',
				'order' => 'ASC'
			);
			$categories = get_categories( $args );
		?>
		<?php echo dsm_get_menu_cats_list_nav($categories) ?>
		<?php echo dsm_get_menu_card($categories) ?>
	</div>
</div><!-- #content -->
<?php get_footer(); ?>