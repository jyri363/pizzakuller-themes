<?php
//=======================
	global $sliders_options_db_version;
	$sliders_options_db_version = "1.0";

	function sliders_options_db_install() {
		global $wpdb;
		global $sliders_options_db_version;

		$table_name = $wpdb->prefix . "sliders_options";

		$sql = "CREATE TABLE $table_name (
			id int(4) NOT NULL AUTO_INCREMENT,
			product_id int(9),
			position int(4),
			slider int(4),
			UNIQUE KEY id (id)
		);";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		add_option("sliders_options_db_version", $sliders_options_db_version);
	}

	function sliders_options_db_check() {
		global $sliders_options_db_version;
		if (get_site_option('sliders_options_db_version') != $sliders_options_db_version) {
			sliders_options_db_install();
		}
	}

	register_activation_hook(__FILE__,'sliders_options_install');
	add_action('after_switch_theme', 'sliders_options_db_check');

	//================================= Custom Butons
	function register_post_assets(){
		add_meta_box('sliders-options', 'Sliders Options', 'add_sliders_options_meta_box', 'product', 'advanced', 'high');
		add_meta_box('sliders-options', 'Sliders Options', 'add_sliders_options_meta_box', 'post', 'advanced', 'high');
	}
	add_action('admin_init', 'register_post_assets', 1);

	function add_sliders_options_meta_box($post){
		$front_slider = get_post_meta($post->ID, '_front-slider-checkbox', true);
		$front_slider_input = get_post_meta($post->ID, '_front-slider-input', true);
		$daymeals_slider = get_post_meta($post->ID, '_daymeals-slider-checkbox', true);
		$daymeals_slider_input = get_post_meta($post->ID, '_daymeals-slider-input', true);
		?>
		<div style='padding-bottom: 10px; margin-bottom: 10px; border-bottom: 1px solid #ccc;'>
			<label style='width: 150px;margin-right: 50px; display: inline-block;'>
				<input type='checkbox' name='_front-slider-checkbox' id='front-slider-checkbox' value='1' <?php checked(1, $front_slider); ?> />
				Front Slider
			</label>
			<input name='_front-slider-input' id='front-slider-input' placeholder='Slider Image Url' style='width: 200px' value='<?php echo $front_slider_input; ?>' /> 
		</div>
		<label style='width: 150px;margin-right: 50px; display: inline-block;'>
				<input type='checkbox' name='_daymeals-slider-checkbox' id='daymeals-slider-checkbox' value='1' <?php checked(1, $daymeals_slider); ?> />
				Meal of the Day Slider
		</label>
		<input name='_daymeals-slider-input' id='daymeals-slider-input' placeholder='Slider Image Url' style='width: 200px' value='<?php echo $daymeals_slider_input; ?>'/>
	<?php
	}

	function sliders_options_insert_data(){
		global $wpdb, $post;

		if(('post' != get_post_type()) && ('product' != get_post_type()) ) {
			return;
		}

		$table_name = $wpdb->prefix . "sliders_options";
		$post_id = $post->ID;
		//$rows_affected = $wpdb->insert( $table_name, array( 'product_id' => $post->ID, 'position' => '2', 'slider' => '2' ) );

		//====== Inser and Update Custom table Sliders_options
		if (isset($_REQUEST['_front-slider-checkbox'])) {
			$myrow = $wpdb->get_var( "SELECT COUNT(*) FROM ". $table_name ." WHERE PRODUCT_ID = ". $post_id ." AND SLIDER = '1'");
			if ($myrow == 0)
				$wpdb->insert( $table_name, array( 'product_id' => $post->ID, 'slider' => '1' ) );
		}else {
			$wpdb->query( 
				$wpdb->prepare( 
					"
					DELETE FROM ". $table_name ."
					WHERE product_id = %d
					AND slider = '1'
					" ,
					$post_id
					)
			);
		}
		//Check second Slider
		if (isset($_REQUEST['_daymeals-slider-checkbox'])) {
			$myrow = $wpdb->get_var( "SELECT COUNT(*) FROM ". $table_name ." WHERE PRODUCT_ID = ". $post_id ." AND SLIDER = '2'");
			if ($myrow == 0)
				$wpdb->insert( $table_name, array( 'product_id' => $post->ID, 'slider' => '2' ) );
		}else {
			$wpdb->query( 
				$wpdb->prepare( 
					"
					DELETE FROM ". $table_name ."
					WHERE product_id = %d
					AND slider = '2'
					" ,
					$post_id
				)
			);
		}

		update_post_meta($post_id, '_front-slider-checkbox', esc_attr($_REQUEST['_front-slider-checkbox'])); 
		update_post_meta($post_id, '_front-slider-input', esc_attr($_REQUEST['_front-slider-input'])); 
		update_post_meta($post_id, '_daymeals-slider-checkbox', esc_attr($_REQUEST['_daymeals-slider-checkbox'])); 
		update_post_meta($post_id, '_daymeals-slider-input', esc_attr($_REQUEST['_daymeals-slider-input'])); 
	}
	add_action('post_updated', 'sliders_options_insert_data');



	// This tells WordPress to call the function named "setup_theme_admin_menus"  
	// when it's time to create the menu pages.  
	add_action("admin_menu", "setup_theme_admin_menus");
	
	function setup_theme_admin_menus() {  
		add_submenu_page('themes.php',  
			'Sliders Items Position', 'Sliders Items Position', 'manage_options',  
			'sliders-options-elements', 'theme_front_page_settings');  
	}
	function theme_front_page_settings() {
	?>
	<div class="wrap">
		<?php screen_icon('themes'); ?> <h2>Sliders Options</h2>

		<?php
			//==PRINT FRONT SLIDER
			global $wpdb, $post;			
			$table_name = $wpdb->prefix . "sliders_options";
			$args = "SELECT * FROM ". $table_name ." WHERE slider = 1 ORDER BY `position`";
			$front_slider_result = $wpdb->get_results($args);
		?>
		<?php if ($front_slider_result) : ?>
		<div style="margin: 20px 30px 0 0; width: 430px; float: left;">
			<div class="sidebar-name">
				<h3>Front Slider</h3>
			</div>
			<ul id="front-slider" class="ui-draggable ui-sortable" style="padding: 10px 9px; border: 1px solid #ccc; margin-top: 0;">
				<?php foreach ( $front_slider_result as $slider ) : ?>
					<?php $slider_post = get_post($slider->product_id); ?>
					<li id="<?php echo $slider->id; ?>">
						<dl class="menu-item-bar">
							<dt class="menu-item-handle" style="padding: 5px 5px 3px 5px; line-height: normal;"> 
								<span style="vertical-align: middle; display: inline-block; margin-right: 10px;"><?php echo get_the_post_thumbnail($slider->product_id, 'thumbnail'); ?></span>
								<span style="vertical-align: middle; display: inline-block; width: 300px;" class='name'><span style="color: #999; font-size: 10px; width: 40px; display: inline-block;">id-<?php echo $slider->product_id."</span>".$slider_post->post_title; ?></span>
								<a title="<?php echo $slider->id. "," . $slider->product_id;?>" class="del-slide" style="vertical-align: middle; text-align: right; cursor: pointer;">Delete</a>
							</dt>
						</dl>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif; ?>

		<?php
			//==PRINT Meals Slider
			global $wpdb, $post;
			$table_name = $wpdb->prefix . "sliders_options";
			$args = "SELECT * FROM ". $table_name ." WHERE slider = 2 ORDER BY `position`";
			$front_meals_slider = $wpdb->get_results($args);
		?>

		<?php if ($front_meals_slider) : ?>
		<div style="margin: 20px 0 0 0; width: 430px; float: left;">
			<div class="sidebar-name">
				<h3>Meals of the Day Slider</h3>
			</div>
			<ul id="day-meals-slider" class="ui-draggable ui-sortable" style="padding: 10px 9px; border: 1px solid #ccc; margin-top: 0;">
				<?php foreach ( $front_meals_slider as $slider ) : ?>
					<?php $slider_post = get_post($slider->product_id); ?>
					<li id="<?php echo $slider->id; ?>">
						<dl class="menu-item-bar">
							<dt class="menu-item-handle" style="padding: 5px 5px 3px 5px; line-height: normal;"> 
								<span style="vertical-align: middle; display: inline-block; margin-right: 10px;"><?php echo get_the_post_thumbnail($slider->product_id, 'thumbnail'); ?></span>
								<span style="vertical-align: middle; display: inline-block; width: 300px;" class='name'><span style="color: #999; font-size: 10px; width: 40px; display: inline-block;">id-<?php echo $slider->product_id."</span>".$slider_post->post_title; ?></span>
								<a title="<?php echo $slider->id. "," . $slider->product_id;?>" class="del-slide" style="vertical-align: middle; text-align: right; cursor: pointer;">Delete</a>
							</dt>
						</dl>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php endif ?>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				jQuery('#front-slider').sortable({
					update: function(event, ui) {
						var newOrder = $(this).sortable('toArray').toString();
						$.post('<?php echo admin_url('admin-ajax.php'); ?>', {action:'saveSliderOrder', order:newOrder,slider: 1});
					}
				});
				jQuery('#day-meals-slider').sortable({
					update: function(event, ui) {
						var newOrder = $(this).sortable('toArray').toString();
						$.post('<?php echo admin_url('admin-ajax.php'); ?>', {action:'saveSliderOrder', order:newOrder,slider: 2});
					}
				});
				//delete function
				jQuery('#front-slider .del-slide').click(function() {
					var slide_id = $(this).attr('title');
					answer = confirm('Delete slide?');
					if(answer)
						$.post('<?php echo admin_url('admin-ajax.php'); ?>', {action: 'deleteSlide', id: slide_id, slider: 1}).done(function() {
							$('li#'+slide_id).fadeOut();
						});
				});
				jQuery('#day-meals-slider .del-slide').click(function() {
					var slide_id = $(this).attr('title');
					answer = confirm('Delete slide?');
					if(answer)
						$.post('<?php echo admin_url('admin-ajax.php'); ?>', {action: 'deleteSlide', id: slide_id, slider: 2}).done(function() {
							$('li#'+slide_id).fadeOut();
						});
				});
			});
		</script>
	</div>
<?php 
	wp_enqueue_script( 'wp-ajax-response');
	wp_enqueue_script( 'jquery-ui-core');
	wp_enqueue_script( 'jquery-ui-sortable');
	wp_enqueue_script( 'media' );
}
	// =================================== AJAX FUNCTIONS
	function save_slider_order(){
		global $wpdb, $post;
		$table_name = $wpdb->prefix . "sliders_options";
		$slider = $_POST['slider'];
		$order = explode(',' , $_POST['order']);

		foreach ($order as $key => $value) {
			$wpdb->query(
				"
				UPDATE $table_name 
				SET position = ($key+1)
				WHERE ID = $value 
					AND slider = $slider
				"
			);
		}
	}
	function delete_slide(){
		global $wpdb, $post;
		$table_name = $wpdb->prefix . "sliders_options";
		$slider = $_POST['slider'];
		$id = explode(',' , $_POST['id']); // [0] - Custom table row ID  [1] - Prodict ID

		$wpdb->query(
			"
			DELETE FROM ". $table_name ."
			WHERE id = ". $id[0] ."
			"
		);

		if($slider == 1) {
			update_post_meta($id[1], '_front-slider-checkbox', null); echo '1';
		}else{
			update_post_meta($id[1], '_daymeals-slider-checkbox', null); echo '2';
		}
	}
	add_action('wp_ajax_saveSliderOrder', 'save_slider_order');
	add_action('wp_ajax_deleteSlide', 'delete_slide');
?>