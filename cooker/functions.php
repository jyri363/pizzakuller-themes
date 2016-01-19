<?php
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 970;

// Theme Setup
add_action( 'after_setup_theme', 'themeSetup' );
function themeSetup() {
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Add default posts and comments RSS feed links to <head>.
	if(function_exists('add_theme_support')) {
		add_theme_support('automatic-feed-links');
		add_theme_support('woocommerce');

		/*add_theme_support( 'custom-background', array(
			// Let WordPress know what our default background color is.
			// This is dependent on our current color scheme.
			'default-color' => '#EBCC96',
		) );*/
		//add_theme_support( 'custom-header' );
	}

	remove_action('woocommerce_pagination', 'woocommerce_pagination', 10);
	function woocommerce_pagination() {
		dsm_paging_nav();
	}
	add_action( 'woocommerce_pagination', 'woocommerce_pagination', 30);

//================================ Theme Options
if ( function_exists( 'ot_get_option') ) {
	include_once( 'theme-options.php' );
}

//================================= Set Thumbnails Sizes
	add_theme_support( 'post-thumbnails' );
	update_option( 'thumbnail_size_w', 46 );
	update_option( 'thumbnail_size_h', 46 );
	update_option( 'thumbnail_crop', 1 );
	update_option( 'medium_size_w', 322 );
	update_option( 'medium_size_h', 342 );
	update_option( 'medium_crop', 1 );
	update_option( 'large_size_w', 669 );
	update_option( 'large_size_h', 441 );
	update_option( 'large_crop', 1 );
	add_image_size('slider', 594, 427, 1);
	add_image_size('meals_of_the_day', 300, 160, 1);
    add_image_size('menu-card-thumb', 79, 76, 1);
			
	global $pagenow;
	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'cooker_woocommerce_image_dimensions', 1 );

	function cooker_woocommerce_image_dimensions() {
		$catalog = array(
			'width' 	=> '322',	// px
			'height'	=> '342',	// px
			'crop'		=> 1 		// true
		);

		$single = array(
			'width' 	=> '690',	// px
			'height'	=> '441',	// px
			'crop'		=> 1 		// true
		);

		$thumbnail = array(
			'width' 	=> '106',	// px
			'height'	=> '106',	// px
			'crop'		=> 1 		// true
		);

		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $single ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
	}
			
	//========================= Change Defaut Avatar
	add_filter( 'avatar_defaults', 'new_default_avatar' );

	function new_default_avatar ( $avatar_defaults ) {
		//Set the URL where the image file for your avatar is located
		$new_avatar_url = get_template_directory_uri()  . '/images/new_default_avatar.png';
		//Set the text that will appear to the right of your avatar in Settings>>Discussion
		$avatar_defaults[$new_avatar_url] = 'Cooker Avatar';
		return $avatar_defaults;
	}

	//========================= Register Menus
	register_nav_menu( 'topNav', 'Top Navigation' );
	register_nav_menu( 'mobileNav', 'Mobile Navigation' );

	//========================= Register Widget Area
	register_sidebar( array(
		'name' =>  'Search', 'cooker',
		'id' => 'search-product-ckrw',
		'description' =>  'This widget area is designed only for search widget' ,
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div style="display:none">',
		'after_title'   => '</div>'
	)); 
      register_sidebar( array(
        'name' =>  'Alammenüü New York', 'cooker',
		'id' => 'alam',
        'description' =>  'Alammenüüde jaoks' ,
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => ''
      ));
      register_sidebar( array(
        'name' =>  'Alammenüü Peetri', 'cooker',
		'id' => 'alam2',
        'description' =>  'Alammenüüde jaoks' ,
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => ''
      ));
      register_sidebar( array(
        'name' =>  'Avalehe tekstid', 'cooker',
		'id' => 'avalehetekstid',
        'description' =>  'Avalehe tekstid' ,
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '<h3 class="title-separator"><span class="title">',
        'after_title'   => '</span><span class="sep"></span></h3>'
      ));
      register_sidebar( array(
        'name' =>  'Avalehe slider', 'cooker',
		'id' => 'avaleheslider',
        'description' =>  'Avalehe slider' ,
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => ''
      ));
      register_sidebar( array(
        'name' =>  'Footeri uudiskirja moodul', 'cooker',
		'id' => 'footeriuudiskiri',
        'description' =>  'Siia lisada uudiskirja vorm' ,
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => ''
      ));
	register_sidebar( array(
		'name' => 'Main Menu Widget',
		'id' => 'main-menu-ckrw',
		'description' => 'Widgets in this area will be shown in the Header as a Main Navigation. Accept UL list.',
		'before_widget' => '',
		'after_widget'  => '<div id="lava-elm"></div>',
		'before_title'  => '<div style="display:none">',
		'after_title'   => '</div>'
	)); 
	register_sidebar( array(
		'name' => 'Front Page Sidebar',
		'id' => 'front-page-sidebar-ckrw',
		'description' =>  'Widgets in this area will be shown on the Front Page.',
		'before_widget' => '<div id="%1$s" class=" %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="title-separator"><span class="title">',
		'after_title'   => '</span><span class="sep"></span></h3>'
	));
	register_sidebar( array(
		'name' => 'Right Sidebar Cart',
		'id' => 'right-sidebar-cart-ckrw',
		'description' => 'This windget area is only for the cart',
		'before_widget' => '<div id="%1$s" class="right-content %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div style="display:none">',
		'after_title'   => '</div>'
	));
	register_sidebar( array(
		'name' => 'Right Sidebar Widgets',
		'id' => 'right-sidebar-widgets-ckrw',
		'description' => 'Widgets in this area will be shown in Sidebar. Just after the cart',
		'before_widget' => '<div id="%1$s" class="right-content %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4><span class="title">',
		'after_title'   => '</h4>'
	));
      register_sidebar( array(
        'name' => 'Parempoolsed moodulid NYP',
		'id' => 'right-sidebar-widgets-ckrw',
        'description' => 'Widgets in this area will be shown in Sidebar. Just after the cart',
        'before_widget' => '<div id="%1$s" class="right-content %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4><span class="title">',
        'after_title'   => '</h4>'
      ));
      register_sidebar( array(
        'name' => 'Parempoolsed moodulid Peetri Pizza',
		'id' => 'right-sidebar-widgets-ckrw2',
        'description' => 'Widgets in this area will be shown in Sidebar. Just after the cart',
        'before_widget' => '<div id="%1$s" class="right-content %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4><span class="title">',
        'after_title'   => '</h4>'
      ));
	register_sidebar( array(
		'name' => 'Footer List Widget',
		'id' => 'footer-list-ckrw',
		'description' => 'Widgets in this area will be shown in the Footer.',
		'before_widget' => '<div id="%1$s" class="links %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6>',
		'after_title'   => '</h6>'
	));

	//=================================

//====================================== Change comments template
	function mytheme_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		extract($args, EXTR_SKIP);
		
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}
		?>

		<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">

		<?php if ( 'div' != $args['style'] ) : ?>
			<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<?php endif; ?>
		<div class="comment-holder">
			<div class="avatar">
				<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, '81' ); ?>
			</div> 
			<div class="data"> 
				<div class="author">
					<?php printf('<cite class="fn">%s</cite>', get_comment_author_link()) ?>
					<time>
						<?php  printf('%1$s at %2$s', get_comment_date(),  get_comment_time()) ?>
					</time>
				</div>
				<?php if ($comment->comment_approved == '0') : ?>
				<em class="comment-awaiting-moderation"><?php echo 'Your comment is awaiting moderation.'; ?></em>
				<br />
				<?php endif; ?>
			 
				<?php comment_text() ?>
				
				<div class="reply">
				<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
				</div>
				<?php if ( 'div' != $args['style'] ) : ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	<?php
				}

		}
		//ThemeSetup END
		//============================================

		//================================= Change Comments lenght
			function custom_excerpt_length( $length ) {
				return 40;
			}
			add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
		//===================================== Theme Options
		load_template( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );

	add_action( 'after_setup_theme', 'cooker_theme_options' );
	add_filter( 'ot_theme_mode', '__return_true' );
	add_filter( 'ot_show_pages', '__return_false' );
	add_filter( 'ot_show_new_layout', '__return_false' );
	
	function cooker_theme_options() { 
		global $cooker_options, $social_links;
		if ( function_exists( 'ot_get_option') ) :
			$cooker_options['logo_image'] = ot_get_option( 'logo_image' );
			$cooker_options['logo_image'] = ot_get_option( 'logo_image' );
			$cooker_options['logo_offset_top'] = ot_get_option( 'logo_offset_top' );
			$cooker_options['logo_offset_left'] = ot_get_option( 'logo_offset_left' );

		if ($cooker_options['logo_image'] == "")
			$cooker_options['logo_image'] = get_template_directory_uri() ."/images/logo.png";

			$social_links = array();
		
		if(ot_get_option( 'facebook') != '')
			$social_links += array('facebook' => ot_get_option( 'facebook'));
			
		if (ot_get_option( 'twitter' ) != '')
			$social_links += array('twitter' => ot_get_option( 'twitter'));
			
		if (ot_get_option( 'gplus' ) != '')
			$social_links += array('gplus' => ot_get_option( 'gplus'));
			
		if (ot_get_option( 'dribbble' ) != '')
			$social_links += array('dribbble' => ot_get_option( 'dribbble'));
			
		if (ot_get_option( 'mySpace' ) != '')
			$social_links += array('mySpace' => ot_get_option( 'gplus'));
			
		if (ot_get_option( 'linkedin' ) != '')
			$social_links += array('LinkedIn' => ot_get_option( 'linkedin'));
			
		if (ot_get_option( 'flickr' ) != '')
			$social_links += array('flickr' => ot_get_option( 'flickr'));
			
		if (ot_get_option( 'reddit' ) != '')
			$social_links += array('reddit' => ot_get_option( 'reddit'));
			
		if (ot_get_option( 'youtube' ) != '')
			$social_links += array('youtube' => ot_get_option( 'youtube'));
			
		if (ot_get_option( 'vimeo' ) != '')
			$social_links += array('vimeo' => ot_get_option( 'vimeo'));
			
		if (ot_get_option( 'digg' ) != '')
			$social_links += array('digg' => ot_get_option( 'digg'));
			
		if (ot_get_option( 'evernote' ) != '')
			$social_links += array('evernote' => ot_get_option( 'evernote'));
			
		if (ot_get_option( 'pinterest' ) != '')
			$social_links += array('pinterest' => ot_get_option( 'pinterest'));
			
		if (ot_get_option( 'footer_copyright_text' ) != '')
			$cooker_options['footer_copyright_text'] =  ot_get_option('footer_copyright_text');

		if (ot_get_option( 'footer_author' ) != '')
			$cooker_options['footer_author'] =  ot_get_option('footer_author');

		//////////////////////////////////  
		endif; // end Option Tree Check
	}
	include 'shortcodes.php'; 
	
	//===================================== Including Style and JS files
		
		function theme_styles()  
		{
			// Register the style like this for a theme:
			// (First the unique name for the style (custom-style) then the src, 
			// then dependencies and ver no. and media type)
			wp_register_style( 'ckr-style', 
			get_template_directory_uri() . '/style.css', 
			array(), 
			wp_get_theme()->Version, 
			'all' );

			wp_register_style( 'ckr-theme-style', 
				get_template_directory_uri() . '/css/style.css', 
				array(), 
				wp_get_theme()->Version, 
				'all' );

			wp_register_style( 'ckr-theme-style-responsive', 
				get_template_directory_uri() . '/css/responsive.css', 
				array(), 
				wp_get_theme()->Version, 
				'all' );

			wp_enqueue_style( 'ckr-style');
			wp_enqueue_style('ckr-theme-style'  );
			wp_enqueue_style('ckr-theme-style-responsive'  );
		}
		add_action('wp_enqueue_scripts', 'theme_styles', 99);
		// Load JS
		function my_scripts_method() {
			wp_enqueue_script('jquery'); 

			wp_enqueue_script(
				'easing',
				get_template_directory_uri() . '/js/libs/jquery.easing.1.3.js',
				array('jquery'),
				wp_get_theme()->Version,
				true
			);
			wp_enqueue_script(
				'script',
				get_template_directory_uri() . '/js/script.js',
				array('jquery'),
				wp_get_theme()->Version,
				true
			);
			wp_enqueue_script(
				'jcarousel',
				get_template_directory_uri() . '/js/libs/jquery.jcarousel.min.js',
				array('jquery'),
				wp_get_theme()->Version,
				true
			);
		}
		add_action('wp_enqueue_scripts', 'my_scripts_method');
		
		//// ADMIN OPTIONS
		include('sliders-options.php');
		include('library/required-plugin.php');

		require get_template_directory() . '/functions/woo-menu-card.php';
		require get_template_directory() . '/functions/pagination.php';

		function paginationIssueHack($link) {
			return str_replace('#038;', '&', $link);
		}
		add_filter('paginate_links', 'paginationIssueHack');

		add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
		function jk_woocommerce_breadcrumbs() {
		    return array(
		            'delimiter'   => '',
		            'wrap_before' => '<nav class="woocommerce-breadcrumb breadcrumbs" itemprop="breadcrumb"><ul>',
		            'wrap_after'  => '</ul></nav>',
		            'before'      => '<li>',
		            'after'       => '</li>',
		            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
		        );
		}

add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);
function custom_variation_price( $price, $product ) {
$price = '';
if ( !$product->min_variation_price || $product->min_variation_price !== $product->max_variation_price ) $price .= '<p style="margin-bottom: -10px !important; padding: 0 !important;"><span class="from" style="color: #000;">' . _x('From', 'min_price', 'woocommerce') . ' </span></p>';
$price .= woocommerce_price($product->min_variation_price);
return $price;
}

add_filter( 'woocommerce_gforms_strip_meta_html', 'configure_woocommerce_gforms_strip_meta_html' );
function configure_woocommerce_gforms_strip_meta_html( $strip_html ) {
    $strip_html = false;
    return $strip_html;
}

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title',5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price',10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt',20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart',30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta',40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing',50);

add_action('woocommerce_single_product_summary_top', 'woocommerce_template_single_title',5);
add_action('woocommerce_single_product_summary_top', 'woocommerce_template_single_price',20);
add_action('woocommerce_single_product_summary_top', 'woocommerce_template_single_excerpt',30);
add_action('woocommerce_single_product_summary_top', 'woocommerce_template_single_meta',40);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart',10);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing',50);


function woo_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 3;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
  function jk_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 3; // arranged in 2 columns
	return $args;
}

/* MY FUNCTIONS */

// Place the following code in your theme's functions.php file to add the payment type to all emails
add_action( 'woocommerce_email_order_meta', 'wc_add_payment_type_to_emails', 15, 2 );
function wc_add_payment_type_to_emails( $order, $is_admin_email ) {
    echo '<p style="display:inline"><strong>' . _e('[:et]Makseviis: [:en]Payment type: [:ru]Вид оплаты: ') . '</strong>' . $order->payment_method_title . '</p>';
}
add_filter('woocommerce_available_variation', function ($value, $object = null, $variation = null) {
    if ($value['price_html'] == '') {
      $value['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
    }
    return $value;
  }, 10, 3);
/**
 * Add store location select dropdown in checkout page
 **/
add_filter( 'woocommerce_checkout_fields' , 'custom_store_pickup_field');
 
function custom_store_pickup_field( $fields ) {
      $fields['shipping']['store_pickup'] = array(
     'type'     => 'select',
            'options'  => array(
        'option_1' => 'Option 1 text',
                'option_2' => 'Option 2 text',
        'option_3' => 'Option 2 text'
        ),
     'label'     => __('Store Pick Up Location', 'woocommerce'),
    'required'  => false,
    'class'     => array('store-pickup form-row-wide'),
    'clear'     => true
     );
 
     return $fields;
}
/**
 * Update the order meta with store location pickup value
 **/
add_action( 'woocommerce_checkout_update_order_meta', 'store_pickup_field_update_order_meta' );
function store_pickup_field_update_order_meta( $order_id ) {
                if ( $_POST[ 'store_pickup' ] )
                                update_post_meta( $order_id, 'Store PickUp Location', esc_attr( $_POST[ 'store_pickup' ] ) );
}
/*$type = $woocommerce->session->pizza_type;
if ($type == 'peetri'){
add_action( 'woocommerce_flat_rate_shipping_add_rate', 'add_another_custom_flat_rate', 10, 2 );

function add_another_custom_flat_rate( $method, $rate ) {
	$new_rate          = $rate;
	$new_rate['id']    .= ':' . 'custom_rate_name'; // Append a custom ID
	$new_rate['label'] = 'New York Pizza'; // Rename to 'Rushed Shipping'
	$new_rate['cost']  += 2; // Add $2 to the cost
	
	// Add it to WC
	$method->add_rate( $new_rate );
}
*/

function show_array($array, $level, $sub){
    if (is_array($array) == 1){          // check if input is an array
       foreach($array as $key_val => $value) {
           $offset = "";
           if (is_array($value) == 1){   // array is multidimensional
           echo "<tr>";
           $offset = do_offset($level);
           echo $offset . "<td>" . $key_val . "</td>";
           show_array($value, $level+1, 1);
           }
           else{                        // (sub)array is not multidim
           if ($sub != 1){          // first entry for subarray
               echo "<tr nosub>";
               $offset = do_offset($level);
           }
           $sub = 0;
           echo $offset . "<td main ".$sub." width=\"120\">" . $key_val . 
               "</td><td width=\"120\">" . $value . "</td>"; 
           echo "</tr>\n";
           }
       } //foreach $array
    }  
    else{ // argument $array is not an array
        return;
    }
}

function html_show_array($array){
  echo "<table cellspacing=\"0\" border=\"2\">\n";
  show_array($array, 1, 0);
  echo "</table>\n";
}
?>

