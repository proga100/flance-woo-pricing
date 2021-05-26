<?php
if (!defined('ABSPATH')) {
	exit;
}
$saved_users = ['56' => 8, '66' => 111];
$get_all_users = [];
foreach (get_users() as $user) {
	$get_all_users[$user->ID] = $user->display_name;
}
$all_data = ["all_user" => $get_all_users, "selected_users" => $saved_users];
$all_data = json_encode($all_data );


wp_add_inline_script('fl_pricing_script', 'var all_users = '.$all_data.';', 'before');

?>
<div id="woo_pricing_tab" class="panel wc-metaboxes-wrapper hidden">
    <div class="product_attributes_price wc-metaboxes woocommerce_attribute_data_container">
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
    </div>
</div>