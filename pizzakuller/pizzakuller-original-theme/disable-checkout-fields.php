<?php
/*
Plugin Name: Aschroder Disable Checkout Fields
Plugin URI: http://woocommerce.com
Description: Everyone loves filling out forms on the internet. This plugin allows you to disable billing or shipping fields during Woocommerce checkout.
Version: 0.1
Author: Ashley Schroder
Author URI: http://aschroder.com
Requires at least: 3.1
Tested up to: 3.2

	Copyright: © 2012 Ashley Schroder
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

/**
 * Check if WooCommerce is active
 **/
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
	/**
	 * Localisation
	 **/
	load_plugin_textdomain('wc_disable_checkout_fields', false, dirname( plugin_basename( __FILE__ ) ) . '/');
	
	class woocommerce_disable_checkout_fields {
			
		var $update_billing;
		var $disabled_billing;
		var $disabled_shipping;
		var $update_shipping;

		public function __construct() { 

			// If you do not have shipping on checkout, then only billing will have an effect
			$this->disabled_shipping = array('shipping_last_name');
			$this->update_shipping = array();

			$this->disabled_billing = array('billing_last_name', 'billing_address_1', 'billing_address_2', 'billing_city', 
							'billing_postcode', 'billing_country', 'billing_state');
			$this->update_billing = array(
				'billing_first_name' 	=> array(
					'name'=>	'billing_first_name',
					'label'                 => __('Name','wc_disable_checkout_fields'),
					'placeholder'  		=> __('Name','wc_disable_checkout_fields'),
					'required'              => true,
					'class'                 => array('form-row-first')
					),
				'billing_company'         => array(
					'label'                 => __('Company','wc_disable_checkout_fields'),
					'placeholder'  		=> __('Company','wc_disable_checkout_fields'),
					'required'              => false,
					'class'                 => array('form-row-first')
					),
				'billing_email' 	=> array(
					'label'                 => __('Email','wc_disable_checkout_fields'),
					'placeholder'   	=> __('you@yourdomain.com','wc_disable_checkout_fields'),
					'required'              => true,
					'class'                 => array('form-row-first')
					),
				'billing_phone'         => array(
					'label'                 => __('Phone','wc_disable_checkout_fields'),
					'placeholder'   	=> __('Phone number','wc_disable_checkout_fields'),
					'required'              => true,
					'class'                 => array('form-row-first')
					)
				);

			// Filters for checkout actions
			add_filter( 'woocommerce_shipping_fields', array(&$this, 'filter_shipping'), 10, 1 );
			add_filter( 'woocommerce_billing_fields', array(&$this, 'filter_billing'), 10, 1 );
		} 
			
		// array_flip is a somewhat smelly way to make a normal array into an associative one
		function filter_shipping( $fields_array ) {
			$fields_array = array_replace($fields_array, $this->update_shipping);
			return array_diff_key($fields_array, array_flip($this->disabled_shipping));
		}

		function filter_billing( $fields_array ) {
			$fields_array = array_replace($fields_array, $this->update_billing);
			return array_diff_key($fields_array, array_flip($this->disabled_billing));
		}


	}
		
	$woocommerce_disable_checkout_fields = new woocommerce_disable_checkout_fields();
}
