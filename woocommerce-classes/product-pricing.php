<?php


class ProductPricing
{
	public function __construct()
	{
		add_action('init', [$this, 'init_run']);

	}

	public function init_run()
	{
		add_filter('woocommerce_product_data_tabs', [$this, 'product_pricing_tabs']);
		add_filter('woocommerce_product_data_panels', [$this, 'action_woocommerce_product_data_panels']);

	}

	public function product_pricing_tabs($tabs)
	{

		$tabs['_pricing_new'] = array(
			'label' => __('Woocommerce Specific Pricing', 'flance-woo-pricing'),
			'target' => 'woo_pricing_tab',
			'class' => array('show_if_simple', 'show_if_variable'),
		);

		return $tabs;

	}

	public function action_woocommerce_product_data_panels($data)
	{
		global $post, $thepostid, $product_object;
		include FLANCE_WOO_PRICING_PATH . '/woocommerce-classes/includes/admin/meta-boxes/views/html-product-data-attributes.php';

	}

	/**
	 * Custom WooCommerce product fields
	 *
	 * @return array
	 */
	public function wc_custom_product_data_fields($custom_product_data_fields)
	{
		$get_all_users = [];

		foreach (get_users() as $user) {
			$get_all_users[$user->ID] = $user->display_name;
		}

		$custom_product_data_fields['woo_pricing_tab'] = array(
			array(
				'tab_name' => __('Woocommerce Specific Pricing', 'flance-woo-pricing'),
			),
			array(
				'id' => '_pricing_new',
				'type' => 'multiselect',
				'label' => __('Product specific price for users', 'flance-woo-pricing'),
				'target' => 'product_attributes',
				'description' => __('Product specific price for users.', 'flance-woo-pricing'),
				'desc_tip' => true,
				'options' => $get_all_users,
			)
		);

		return $custom_product_data_fields;
	}
}