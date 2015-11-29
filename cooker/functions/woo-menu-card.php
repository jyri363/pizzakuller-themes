<?php

//List all products for a category
function dsm_get_products_for_category ($cat) {
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => -1,
		'orderby' => 'name',
		'order' => 'ASC',
		'tax_query'     => array(
			array(
				'taxonomy'  => 'product_cat',
				'field'     => 'id',
				'terms'     => $cat
			)
		)
	);

	$dsm_loop = new WP_Query( $args );


	while ( $dsm_loop->have_posts() ) : $dsm_loop->the_post();
		global $product;

		$out .= '<li class="item">';
			$out .= "<a href='". get_permalink( $dsm_loop->post->ID ). "' >";

				if(has_post_thumbnail($dsm_loop->post->ID)){
					$out .= '<span class="img-holder">' . get_the_post_thumbnail($dsm_loop->post->ID ,"menu-card-thumb") . '</span>';
				}

				$out .= '<div class="description-holder">';
					$out .= '<h3 class="title">' . get_the_title() . '</h3>';
					$out .= '<span class="description">' . get_the_excerpt() . '</span>';
					$out .= '<span class="price">' . $product->get_price_html() . '</span>';
				$out .= '</div>';
			$out .= '</a>';
		$out .= '</li>';
	endwhile;

	return $out;
}

//Get Tree Category Object. Works with get_categories
function dsm_get_tree_cats ($categories) {
	global $cats_by_parent;

	$cats_by_parent = array();
	foreach ($categories as $cat)
	{
		$parent_id = $cat->category_parent;
		if (!array_key_exists($parent_id, $cats_by_parent))
		{
			$cats_by_parent[$parent_id] = array();
		}
		$cats_by_parent[$parent_id][] = $cat;
	}

	// Then build a hierarchical tree
	$cat_tree = array();
	$add_cats_to_bag = function (&$child_bag, &$children) use ( &$add_cats_to_bag ) {
		global $cats_by_parent;
		foreach ($children as $child_cat)
		{
			$child_id = $child_cat->cat_ID;
			if (array_key_exists($child_id, $cats_by_parent))
			{
				$child_cat->children = array();
				$add_cats_to_bag($child_cat->children, $cats_by_parent[$child_id]);
			}
			$child_bag[$child_id] = $child_cat;
		}
	};
	$add_cats_to_bag($cat_tree, $cats_by_parent[0]);

	return $cat_tree;
}

// Menu Card Navigation
function dsm_get_menu_cats_list_nav ($categories) {
	$cats_tree = dsm_get_tree_cats($categories);

	function recurse_tree($cats_tree) {
		$out = '<li><a data-catId="-1">'. __('All', 'cooker-ln') .'</a>';
		foreach($cats_tree as $c):
			$out .= '<li>';
			$out .= "<a data-catId='$c->term_id'>" . $c->name . '</a>';
			if(isset($c->children)){
				$out .= '<ul>' . recurse_tree($c->children) . '</ul>';
			}
			$out .= '</li>';
		endforeach;

		return $out;
	}

	return '<ul class="dsm-menu-card-nav">' . recurse_tree($cats_tree) . '</ul>';
}

// Menu Card Content
function dsm_get_menu_card ($categories) {
	$cats_tree = dsm_get_tree_cats($categories);
	function menu_card_recurse_tree($cats_tree, $child = false) {
		if(!$child){
			$main_cats_count = count($cats_tree);
			$out = '<ul class="dsm-menu-card">';
		}else{
			$out = '<ul class="dsm-menu-card-cat-child">';
		}

		$counter = 0;
		foreach($cats_tree as $c):
			$counter++;
		
			//Split in half
			if (floor(($main_cats_count) / 2) == ($counter - 1)  && !$child ){
				$out .= '</ul><ul class="dsm-menu-card">';
			}

			// Check if Categories are ODD or EVEN; true = odd
			if ( $main_cats_count & 1 && $counter == $main_cats_count && !$child ) {
				//print the last category separate
				$out .= '</ul><ul class="dsm-menu-card last-odd-cat">';
			}

			$out .= "<li data-catID='$c->term_id'>";
			$out .= '<h3 class="cat-title"><span>'. $c->name .'</span></h3>';
			$out .= '<ul class="category-products">';
				$out .= dsm_get_products_for_category($c->term_id);
				if(isset($c->children)){
					$out .=  '<li class="sub-category">';
					$out .=  menu_card_recurse_tree($c->children, true);
					$out .=  '</li>';
				}
			$out .= '</ul>';

			$out .= '</li>';
		endforeach;
		$out .= '</ul>';

		return  $out;
	}

	return  '<div class="dsm-menu-card-wrapper">' .menu_card_recurse_tree($cats_tree) . '</div>';
}