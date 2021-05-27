<?php
if (!defined('ABSPATH')) {
	exit;
}

wp_enqueue_script('fl_pricing_script', FLANCE_WOO_PRICING_URL . 'assets/pricing.js', array('jquery'), time(), true);
wp_enqueue_style('fl_pricing', FLANCE_WOO_PRICING_URL . 'assets/pricing.css', time());

global $post;
$post_id = $post->ID;
$saved_users = (get_post_meta($post_id, 'user_prices', true)) ? get_post_meta($post_id, 'user_prices', true) : [];

$get_all_users = [];
foreach (get_users() as $user) {
	$get_all_users[$user->ID] = $user->display_name;
}
$nonce = wp_create_nonce("stm_user_save_price");
$admin_url = admin_url('admin-ajax.php?action=stm_user_save_price&post_id=' . $post_id . '&nonce=' . $nonce);

$all_data = ["all_user" => $get_all_users, "selected_users" => $saved_users, 'admin_url' => $admin_url];
$all_data = json_encode($all_data);

wp_add_inline_script('fl_pricing_script', 'var all_users = ' . $all_data . ';', 'before');

?>
<div id="woo_pricing_tab" class="panel wc-metaboxes-wrapper hidden">
    <div class="product_attributes_price wc-metaboxes woocommerce_attribute_data_container">
        <div id="stm-error"></div>
		<?php

		$i = -1;
		foreach ($saved_users as $user_id => $price) {
			$i++;
			$metabox_class = array();
			include __DIR__ . '/html-product-attribute.php';
		}
		?>
    </div>
    <div class="price-add-container">
        <div class="woocommerce_attribute_data wc-metabox-content">
            <table cellpadding="0" cellspacing="0">
                <tbody>
                <tr>
                    <td class="attribute_name">
                        <label><?php esc_html_e('Name', 'woocommerce'); ?>:</label>
                        <strong>
                            <select id="user_id" class="user_id">
								<?php
								foreach ($get_all_users as $us_id => $get_all_user) {
									echo "<option value='$us_id'> $get_all_user </option>";
								}
								?>
                            </select>
                        </strong>
                    </td>
                    <td rowspan="3">
                        <label>
							<?php echo get_woocommerce_currency_symbol(); ?>
							<?php esc_html_e('Price', 'woocommerce'); ?>:</label>
                        <input type="text" class="attribute_position_price" id="user_price" value=""/>
                        <div class="button add_user_price" id="add_user_price">Add new</div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
		<?php
		if ($post_id): ?>
            <div class="button save_user_price" id="save_user_price">Save Prices</div>
            <div class="addstml stm_loader"></div>
            <div class="prices_save_error"></div>
		<?php endif; ?>
    </div>
</div>