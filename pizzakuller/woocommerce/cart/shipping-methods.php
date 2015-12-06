<?php

/**
 * Shipping Methods Display
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
global $woocommerce;

// If at least one shipping method is available
if ($available_methods) {

    // Prepare text labels with price for each shipping method
    foreach ($available_methods as $method) {
        if (!$method->label) {
            $method->full_label = __('Palun valige linnajagu', 'wc_pizzashipper');
        } else {
            if ($method->cost > 0) {
                $km = round($method->cost*0.20,2);
                $method->full_label = $method->label.' ' . woocommerce_price($method->cost+$km);
            } else {
                $method->full_label = $method->label.' tasuta';
            }
        }
        $method->full_label = apply_filters('woocommerce_cart_shipping_method_full_label', $method->full_label, $method);
    }

    // Print a single available shipping method as plain text
    if (1 === count($available_methods)) {

        echo wp_kses_post($method->full_label) . '<input type="hidden" name="shipping_method" id="shipping_method" value="' . esc_attr($method->id) . '" />';
        echo '<input type="hidden" name="pizza_location" id="pizza_location" value="' . esc_attr($method->id) . '" />';

        // Show select boxes for methods
    } elseif (get_option('woocommerce_shipping_method_format') == 'select') {

        echo '<select name="shipping_method" id="shipping_method">';

        foreach ($available_methods as $method)
            echo '<option value="' . esc_attr($method->id) . '" ' . selected($method->id, $woocommerce->session->chosen_shipping_method, false) . '>' . wp_kses_post($method->full_label) . '</option>';

        echo '</select>';

        // Show radio buttons for methods
    } else {

        echo '<ul id="shipping_method">';

        foreach ($available_methods as $method)
            echo '<li><input type="radio" name="shipping_method" id="shipping_method_' . sanitize_title($method->id) . '" value="' . esc_attr($method->id) . '" ' . checked($method->id, $woocommerce->session->chosen_shipping_method, false) . ' /> <label for="shipping_method_' . sanitize_title($method->id) . '">' . wp_kses_post($method->full_label) . '</label></li>';

        echo '</ul>';
    }

// No shipping methods are available
} else {

    if (!$woocommerce->customer->get_shipping_country() || !$woocommerce->customer->get_shipping_state() || !$woocommerce->customer->get_shipping_postcode()) {

        echo '<p>' . __('Palun valige linnajagu', 'woocommerce') . '</p>';
    } else {

        $customer_location = $woocommerce->countries->countries[$woocommerce->customer->get_shipping_country()];

        echo apply_filters('woocommerce_no_shipping_available_html', '<p>' .
                sprintf(__('Sorry, it seems that there are no available shipping methods for your location (%s).', 'woocommerce') . ' ' . __('If you require assistance or wish to make alternate arrangements please contact us.', 'woocommerce'), $customer_location) .
                '</p>'
        );
    }
}