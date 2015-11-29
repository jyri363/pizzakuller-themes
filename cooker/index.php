<?php get_header(); ?>
<div class="content clearfix">
	<?php
		$table_name = $wpdb->prefix . "sliders_options";
		$args = "SELECT * FROM ". $table_name ." WHERE slider = 2 ORDER BY `position`";
		$meals_slider_result = $wpdb->get_results($args);
	?>
	<?php if ($meals_slider_result) :	?>
	<div id="meals-of-the-day">
		<h3 class="title-separator"><span class="title">Meals of the day</span>
		<span class="sep"></span></h3>

		<nav class="jcarousel-controls">
			<a class="jcarousel-prev" href="#"></a>
			<a class="jcarousel-next" href="#"></a>
		</nav>

		<div class="jcarousel-wrapper">
			<div class="meals-of-the-day-jcarousel jcarousel off">
				<ul>
					<?php foreach ( $meals_slider_result as $slider ): ?>
						<?php 
							$slider_post = get_post($slider->product_id);
							$slide_link = get_permalink( $slider->product_id); 

							if($slider_post->post_type == 'product') {
								$product = wc_setup_product_data( $slider_post );
								$price = $product->get_price_html();
							} else {
								$price = '';
							}
						?>
						<li class="meal">
							<div class="img-holder">
								<a href="<?php echo $slide_link; ?>">
								<?php 
									$slide_img = get_post_meta($slider->product_id, '_daymeals-slider-input', true);
										
									if($slide_img != '') {
										echo "<img src='$slide_img' alt='' />";
									}else {
										echo get_the_post_thumbnail($slider->product_id, 'meals_of_the_day');
									}
								?>
								</a>
							</div>
							<a href="<?php echo $slide_link ?>" class="desc-holder">
								<span class='title'><?php echo $slider_post->post_title; ?></span>
								<span class='txt'><?php $short_descr= $slider_post->post_excerpt;
									if(strlen($short_descr) > 300){
										echo substr($short_descr, 0,300).'...';
									}else{
										echo $short_descr;
									}
								?></span>
								<span class="price"><?php echo $price; ?></span>
								<span class="button-ckr right">View</span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>

	<?php endif ?>

	<?php if ( is_active_sidebar( 'front-page-sidebar-ckrw' ) ) {
		dynamic_sidebar('front-page-sidebar-ckrw'); 
	}?>
</div>
<?php get_footer(); ?>