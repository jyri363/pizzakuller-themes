<?php

add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);
function custom_variation_price( $price, $product ) {
$price = '';
if ( !$product->min_variation_price || $product->min_variation_price !== $product->max_variation_price ) $price .= '<p style="margin-bottom: -10px !important; padding: 0 !important;"><span class="from" style="color: #000;">' . _x('From', 'min_price', 'woocommerce') . ' </span></p>';
$price .= woocommerce_price($product->min_variation_price);
return $price;
}

// Display 24 products per page. Goes in functions.php
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 24;' ), 24 );
?>