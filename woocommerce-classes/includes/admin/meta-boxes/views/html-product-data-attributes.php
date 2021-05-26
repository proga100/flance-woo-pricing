<?php
if (!defined('ABSPATH')) {
	exit;
}

get_users
?>
<div id="woo_pricing_tab" class="panel wc-metaboxes-wrapper hidden">
    <div class="toolbar toolbar-top">


    </div>
    <div class="product_attributes_price wc-metaboxes">
		<?php
		$saved_users = ['56' => 8, '66' => 111];
		$i = -1;
		foreach ($saved_users as $user_id => $price) {
			$i++;
			$metabox_class = array();
			include __DIR__ . '/html-product-attribute.php';
		}
		?>
    </div>
    <div class="product_attributes_price wc-metaboxes">
        <div class="woocommerce_attribute_data wc-metabox-content">
            <table cellpadding="0" cellspacing="0">
                <tbody>
                <tr>
                    <td class="attribute_name">
                        <label><?php esc_html_e('Name', 'woocommerce'); ?>:</label>
                        <strong>ee</strong>
                        <input type="hidden" name="user_ids[<?php echo esc_attr($user_id); ?>]"
                               value="<?php echo esc_attr($user_id); ?>"/>
                    </td>
                    <td rowspan="3">
                        <label>
							<?php echo get_woocommerce_currency_symbol(); ?>

							<?php esc_html_e('Price', 'woocommerce'); ?>:</label>
                        <input type="text" name="user_specific_price[<?php echo esc_attr($user_id); ?>]"
                               class="attribute_position_price" value="<?php echo esc_attr($price); ?>"/>
                        <button class="button add_new_attribute">Add new</button>
                    </td>

                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>