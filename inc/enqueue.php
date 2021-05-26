<?php
function admin_enqueue_css_and_js()
{
	wp_enqueue_script( 'fl_pricing_script', FLANCE_WOO_PRICING_URL . 'assets/pricing.js', array('jquery'), time() , true);
	wp_enqueue_style('fl_pricing', FLANCE_WOO_PRICING_URL . 'assets/pricing.css', time());
}

add_action('admin_enqueue_scripts', 'admin_enqueue_css_and_js');