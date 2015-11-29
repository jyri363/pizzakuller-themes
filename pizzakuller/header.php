<?php // Clear cart
global $cooker_options, $woocommerce;
if ($_GET['clear-cart'] == 1) {
    $woocommerce->cart->empty_cart();
}

$session = WP_Session::get_instance(); ?>
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
	
	<?php wp_head(); ?>
	
	<script src="<?php echo get_template_directory_uri() . '/js/maps.js'; ?>"></script>
	<?php
        if (function_exists('home_page_pop_up')) {
            home_page_pop_up();
        }
        ?>
	
	
</head>

<body <?php body_class(); ?>>

	<div id="popupwarn" class="popup-warning">
		<div class="content">
			<a href="javascript: void(0);" class="close"></a>
			<h1><?php _e('If you choose new place, then your basket will be reseted!'); ?></h1>
			<h5><?php _e('You can order only one place at time.'); ?></h5>

			<a href="javascript: void(0);" class="action_continue"><!-- <img src="<?php echo get_stylesheet_directory_uri() . '/images/arrow_right.png'; ?>"/> --><div><?php _e('Reset basket'); ?></div></a>
			<a href="javascript: void(0);" class="action_close"><img src="<?php echo get_stylesheet_directory_uri() . '/images/arrow_left.png'; ?>"/> <div><?php _e('Back'); ?></div></a>

		</div>
	</div>
	
	<div id="marker" class="hidden">
		<?php echo get_template_directory_uri() . '/images/marker.png'; ?>
	</div>

	<div class="map-popup" style="display: none;">
		<div class="content">
			<a href="javascript: void(0);" class="close"></a>
			<div id="mapurl" class="hidden"><?php echo get_template_directory_uri() . '/images/'; ?></div>
			<img id="map" src="<?php echo get_template_directory_uri() . '/images/map.jpg'; ?>"/>
			<img id="maphover" src="<?php echo get_template_directory_uri() . '/images/map.jpg'; ?>"/>
			<img id="prices" src="<?php echo get_template_directory_uri() . '/images/prices_newyork.png'; ?>"/>
			<img id="pins" usemap="#locations" src="<?php echo get_template_directory_uri() . '/images/pins.png'; ?>"/>
			<?php
			$locations = array(
				'haabersti' => array(
					'file' => 'haabersti',
					'coords' => '284,849,289,835,299,839,310,820,347,804,354,789,358,751,458,642,467,647,511,623,456,575,408,619,324,564,186,459,147,429,134,431,153,491,119,542,80,561,112,594,143,570,235,604,253,629,237,682,276,740,210,811',
				),
				'kesklinn' => array(
					'file' => 'kesklinn',
					'coords' => '838,456,853,456,853,476,845,486,849,526,782,587,747,629,811,713,848,716,863,731,847,767,824,745,790,745,778,771,794,824,777,841,768,873,772,890,753,912,724,931,716,916,695,922,693,927,657,919,605,820,601,816,592,827,589,818,614,718,583,588,614,582,615,565,652,530,671,534,683,498,691,512,721,497,734,499,733,504,723,504,696,525,707,524,681,539,683,548,695,543,692,538,721,521,719,530,721,534,736,519,760,534,780,535,820,501',
				),
				'lasnamäe' => array(
					'file' => 'lasnamae',
					'coords' => '853,472,958,488,991,468,1075,469,1109,436,1109,458,1122,457,1131,515,1149,562,1172,583,1160,601,1012,654,1009,722,881,716,861,729,849,718,813,714,748,631,786,582,798,580,850,528,844,484',
				),
				'maardu' => array(
					'file' => 'maardu',
					'coords' => '1131,529,1197,506,1307,495,1317,480,1288,407,1281,328,1267,291,1186,241,1169,240,1144,223,1127,201,1110,215,1129,259,1179,297,1171,322,1131,364,1130,383,1110,387,1099,423,1120,511',
				),
				'mustamäe' => array(
					'file' => 'mustamae',
					'coords' => '345,818,394,818,413,828,450,823,461,831,519,818,531,803,533,768,545,745,532,724,439,675,361,746,351,769,353,797,342,809',
				),
				'nõmme' => array(
					'file' => 'nomme',
					'coords' => '267,1054,275,1046,309,1056,370,1038,398,996,431,984,505,1033,537,984,573,989,561,1020,730,1010,696,967,690,927,659,918,603,819,592,822,574,810,566,820,556,811,461,833,441,826,411,832,394,814,373,820,344,820,339,811,309,824,296,841,300,863,291,868,257,1031',
				),
				'peetri' => array(
					'file' => 'peetri',
					'coords' => '768,1063,779,1033,828,1024,848,980,940,926,813,744,780,744,766,776,784,826,767,843,756,899,714,931,702,914,680,928,717,1005,697,1014,715,1043,731,1042'
				),
				'pirita' => array(
					'file' => 'pirita',
					'coords' => '892,221,974,245,1028,246,1063,263,1063,298,1073,308,1079,308,1113,346,1123,346,1142,383,1109,401,1111,434,1087,469,987,469,950,492,855,473,853,456,838,457,879,387,910,329,913,280'
				),
				'viimsi' => array(
					'file' => 'viimsi',
					'coords' => '990,21,1015,28,1082,85,1119,144,1110,217,1120,214,1140,262,1190,296,1181,322,1140,361,1064,295,1066,263,1028,249,891,222,880,238,827,180,840,167,847,141,833,102,808,101,796,62,821,85,836,89,845,78,845,70,849,62,878,108,908,96,919,100,952,84'
				),
				'kristiine' => array(
					'file' => 'kristiine',
					'coords' => '512,817,574,813,588,765,576,766,600,708,571,606,569,584,519,610,502,611,498,624,492,622,487,634,473,632,463,646,445,639,426,671,524,722,533,743,523,766,520,798'
				),
				'põhja tallinn' => array(
					'file' => 'pohja_tallinn',
					'coords' => '484,612,532,611,578,587,611,582,615,564,653,528,669,531,674,504,658,508,629,482,603,469,589,486,577,476,563,446,535,454,517,466,530,444,535,444,564,416,587,356,558,340,537,288,527,321,500,320,484,292,474,312,489,349,505,355,507,375,497,388,483,413,425,423,401,400,363,382,360,402,412,462,430,489,459,495,467,505,456,572,473,592'
				)
			);
			?>


			<map name="locations">
				<?php foreach ($locations as $ID => $location) { ?>
					<area shape="poly" class="location" name="<?php echo $ID; ?>" file="<?php echo $location['file']; ?>" alt="" title="" coords="<?php echo $location['coords']; ?>" href="javascript:void(0);" target="">
					<img class="hidden" src="<?php echo get_template_directory_uri() . '/images/map_hovers/' . $location['file'] . '.png'; ?>">
				<?php } ?>
			</map>
		</div>
	</div>
		
	 <?php
        if (sizeof($woocommerce->cart->get_cart()) > 0) {
            foreach ($woocommerce->cart->get_cart() as $cart_item_key => $values) {
                $_product = $values['data'];
                if ($_product->exists() && $values['quantity'] > 0) {
                    ?>
                    <div class="hidden" id="product-categories"><?php
                        $terms = get_the_terms($_product->id, 'product_cat');
                        if ($terms) {
                            foreach ($terms as $term) {
                                if ($term->parent == 0) {
                                    $maincat = $term->name;
                                } else {
                                    $second = $term->name;
                                }
                            }

                            echo '<a>' . $maincat . '</a>';
                            echo '<a>' . $second . '</a>';
                        }
                        ?></div>
                    <?php
                }
            }
        } else {
            unset($woocommerce->session->pizza_type);
            unset($woocommerce->session->pizza_location);
        }
        ?>

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