<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<!--[if IE]>  
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<![endif]-->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title>
		<?php
		/*
			* Print the <title> tag based on what is being viewed.
		*/
		global $page, $paged;

		wp_title( '|', true, 'right' );

		// Add the blog name.
		bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'cooker' ), max( $paged, $page ) );

		?></title>

	<?php
		global $cooker_options, $woocommerce;
	?>
	<link rel="shortcut icon" href="/favicon.ico">
	<script src="<?php echo get_template_directory_uri() . '/js/maps.js'; ?>"></script>
	<?php
        if (function_exists('home_page_pop_up')) {
            home_page_pop_up();
        }
        ?>
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class='wrapper'>
	<header>
		<div class="top-nav">
			<nav class="desktop">
				<?php 
					$args = array(
						'theme_location'  => 'topNav',
						'container'       => false,
						'menu_class'      => '',
						'fallback_cb'     => false,
					);
					wp_nav_menu( $args ); 
				?>
			</nav>
			<!-- Search Bar Widget -->
			<?php if ( is_active_sidebar( 'search-product-ckrw' ) ) : ?> 
				<?php 	dynamic_sidebar('search-product-ckrw'); ?> 
			<?php endif ?>
			<!-- End Search Bar Widget -->

			<ul class="dsm-mobile-nav">
				<?php if ( is_active_sidebar( 'search-product-ckrw' ) ) : ?> 
					<li class="dsm-search">
						<span class="dsm-icon"></span>
					</li>
				<?php endif ?>
				<li class="dsm-mobile-nav">
					<span class="dsm-icon"></span>
				</li>
			</ul>
		</div>
		<div class="dsm-mobile-nav-dropdown">
			<div class="dsm-mobile-search-hidden hidden">
				<?php if ( is_active_sidebar( 'search-product-ckrw' ) ) : ?> 
					<?php 	dynamic_sidebar('search-product-ckrw'); ?> 
				<?php endif ?>
			</div>
			<div class="dsm-mobile-nav-hidden hidden">
				<?php 
					$args = array(
						'theme_location'  => 'mobileNav',
						'container'       => false,
						'menu_class'      => '',
						'fallback_cb'     => false,
					);
					wp_nav_menu( $args ); 
				?>
			</div>
		</div>

		<a href="<?php echo home_url(); ?> " class="logo" style="top:<?php echo $cooker_options['logo_offset_top'].'px'?>;left: <?php echo $cooker_options['logo_offset_left'].'px'?>;">
			<img src="<?php echo $cooker_options['logo_image']?>" alt="your logo" />
		</a>
	<?php if(is_home() || is_front_page()): ?>
		<!--========Main Menu=======-->
		<?php if ( is_active_sidebar( 'main-menu-ckrw' ) ) : ?>
			<nav class="main-menu">
				<?php dynamic_sidebar('main-menu-ckrw'); ?>
			</nav>
		<?php endif ?>
		<!--=======End Main Menu========-->
		<div class="dsm-header-main-slider-holder">
			<div class="header-slider-canvas">
				<div class="parts part-1"></div>
				<div class="parts part-2"></div>
				<div class="parts part-3"></div>
				<a class="header-slider-prev">Prev</a>
				<a class="header-slider-next">Next</a>
			</div>
			<?php
				$table_name = $wpdb->prefix . "sliders_options";
				$args = "SELECT * FROM ". $table_name ." WHERE slider = 1 ORDER BY `position`";
				$front_slider_result = $wpdb->get_results($args);
			?>
			<?php if ($front_slider_result) :	?>
				<div class="jcarousel-wrapper jcarousel-skin-header-slider">
					<div class="jcarousel">
						<ul>
							<?php foreach ( $front_slider_result as $slider ): ?>
							<?php $slider_post = get_post($slider->product_id); ?>
							<?php if($slider_post->post_type == 'product'): ?>
							<?php $product = wc_setup_product_data( $slider_post );//$product = new WC_Product($slider->product_id); ?>
							<?php $price = $product->get_price_html();?>
							<?php else: ?>
							<?php $price = ''; ?>
							<?php endif; ?>

							<li>
								<?php 
									$slide_img = get_post_meta($slider->product_id, '_front-slider-input', true);	
									if($slide_img != '') {
										echo "<img src='$slide_img' alt='' />";
									}else {
										echo get_the_post_thumbnail($slider->product_id, 'slider');
									}
								?>
								<div class="description">
									<?php if($price): ?>
									<span class='price'><?php echo $price; ?></span>
									<span class='name'><?php echo $slider_post->post_title; ?></span>
									<a href="<?php echo get_permalink( $slider->product_id ); ?>" class="shop">shop now</a>
									<?php else:?>
									<span class='name' style="margin-top: 20px;"><?php echo $slider_post->post_title; ?></span>
									<a href="<?php echo get_permalink( $slider->product_id ); ?>" class="shop">View</a>
									<?php endif;?>
								</div>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			<?php endif ?>
		</div>
	<?php else: //is_home ?>
	<!--========Main Menu=======-->
		<?php if ( is_active_sidebar( 'main-menu-ckrw' ) ) : ?>
			<nav class="main-menu">
				<?php dynamic_sidebar('main-menu-ckrw'); ?>
			</nav>
		<?php endif ?>
	<!--========End Main Menu=======-->
	<?php endif ?>
	<?php /* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
	?>
	</header>