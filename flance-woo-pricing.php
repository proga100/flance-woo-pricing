<?php
/**
Plugin Name: Woocommerce Product Specific Pricing and Discounts
Plugin URI: flance.info
Description: Woocommerce Product Specific Pricing and Discounts
Author: flance.info
Author URI: flance.info
Text Domain: flance-woo-pricing
Version: 1.0
*/

if( !defined( 'ABSPATH' ) ) exit; //Exit if accessed directly
if ( ! function_exists( 'woothemes_queue_update' ) ) {
	require_once( plugin_dir_path( __FILE__ ) . 'woo-includes/woo-functions.php' );
}
define( 'FLANCE_WOO_PRICING', '1.0.0' );
define( 'FLANCE_WOO_PRICING_DB_VERSION', '1.0.0' );
define( 'FLANCE_WOO_PRICING_FILE', __FILE__ );
define( 'FLANCE_WOO_PRICING_PATH', dirname( FLANCE_WOO_PRICING_FILE ) );
define( 'FLANCE_WOO_PRICING_URL', plugin_dir_url( FLANCE_WOO_PRICING_FILE ) );

if ( ! is_textdomain_loaded( 'flance-woo-pricing' ) ) {
    load_plugin_textdomain(
        'flance-woo-pricing',
        false,
        'flance-woo-pricing/languages'
    );
}
if ( ! is_woocommerce_active() ) {
	return;
}

require_once FLANCE_WOO_PRICING_PATH. '/inc/autoload.php';


