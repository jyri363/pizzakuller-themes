<?php 
	/**
	 * Template Name: 404 Page
	 */
	get_header();
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

?>

<div class="content full-content clearfix">

	<div class="error-404-content">
		<h1 class="page-title"><?php _e( 'Page not found' ); ?></h1>
		<p>
			<?php _e( 'We could not find the page you were looking for', 'cooker' ); ?>
			<br>
			<a href="<?php echo home_url(); ?>">
				<?php _e( 'Back to Cooker Home page', 'cooker' ); ?>
			</a>
		</p>
	</div>

</div>

<?php
	get_footer();
?>
