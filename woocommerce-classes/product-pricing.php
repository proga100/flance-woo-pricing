<?php


class ProductPricing
{
	public function __construct()
	{
		add_action('init', [$this, 'init_run']);
		add_action("wp_ajax_stm_user_save_price", [$this, "stm_user_save_price"]);
		add_action("wp_ajax_nopriv_stm_user_save_price", [$this, "stm_user_save_price"]);

		add_action('save_post', [$this, 'save_post_callback']);

		add_filter('woocommerce_product_get_regular_price', array($this, 'user_specific_price'), 99);
		add_filter('woocommerce_product_get_price', array($this, 'user_specific_price'), 99);

		add_filter('woocommerce_add_cart_item', [$this, 'set_custom_cart_item_prices'], 20, 2);
		add_filter('woocommerce_get_cart_item_from_session', [$this, 'set_custom_cart_item_prices_from_session'], 20, 3);

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

	public function set_custom_cart_item_prices($cart_data, $cart_item_key)
	{
		// Price calculation
		$price = $cart_data['data']->get_price();
		$post_id = $cart_data['data']->get_id();
		$new_price = $this->get_user_specific_price($price, $post_id);

		// Set and register the new calculated price
		$cart_data['data']->set_price($new_price);
		$cart_data['new_price'] = $new_price;

		return $cart_data;
	}


	public function set_custom_cart_item_prices_from_session($session_data, $values, $key)
	{
		if (!isset($session_data['new_price']) || empty ($session_data['new_price']))
			return $session_data;

		// Get the new calculated price and update cart session item price
		$session_data['data']->set_price($session_data['new_price']);

		return $session_data;
	}

	public function stm_user_save_price()
	{

		if (!wp_verify_nonce($_REQUEST['nonce'], "stm_user_save_price")) {
			exit("No naughty business please");
		}
		$post_id = (int)($_GET['post_id']);

		$user_prices = $_POST['user_prices'];

		if (update_post_meta($post_id, 'user_prices', $user_prices)) {
			$messages = __('Successfully Prices updated', 'flance-woo-pricing');
		} else {
			$messages = __('Successfully Prices updated', 'flance-woo-pricing');
		}

		wp_send_json(['messages' => $messages, 'user_prices' => $user_prices]);
	}

	public function save_post_callback($post_id)
	{
		global $post;
		if (!empty($post->post_type)) {
			if ($post->post_type != 'product') {
				return;
			}
			$user_prices = ($_POST['user_specific_price']) ? $_POST['user_specific_price'] : null;

			update_post_meta($post_id, 'user_prices', $user_prices);
		}

	}

	public function user_specific_price($price)
	{
		global $post, $woocommerce;
		if (is_shop() || is_product_category() || is_product_tag() || is_product()) {
			$post_id = $post->ID;
			$price = $this->get_user_specific_price($price, $post_id);
		}
		return $price;
	}

	public function get_user_specific_price($price, $post_id)
	{
		if (is_user_logged_in() && !is_admin() && !empty($post_id)):
			$user = wp_get_current_user();
			$user_id = $user->ID;
			$saved_users = (get_post_meta($post_id, 'user_prices', true)) ? get_post_meta($post_id, 'user_prices', true) : [];

			if (in_array($user_id, array_keys($saved_users))) {
				$price = (!empty($saved_users[$user_id])) ? $saved_users[$user_id] : $price;
			}
		endif;
		return $price;
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