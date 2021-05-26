<?php
if (!defined('ABSPATH')) {
	exit;
}

$user_data = get_user_by('id', $user_id);

?>
<div data-taxonomy="<?php echo esc_attr($user_id); ?>"
     class="woocommerce_attribute wc-metabox postbox closed "
     rel="<?php echo esc_attr($user_id); ?>">
    <h3>
        <a href="#" class="remove_row delete"><?php esc_html_e('Remove', 'woocommerce'); ?></a>
        <div class="handlediv" title="<?php esc_attr_e('Click to toggle', 'woocommerce'); ?>"></div>
        <div class="inlrow">
            <div class="attribute_name user_name"><?php echo wc_attribute_label($user_data->display_name); ?></div>
            <div class="attribute_name user_price"><?php
                echo get_woocommerce_currency_symbol();
                echo wc_attribute_label($price); ?></div>
        </div>

    </h3>
    <div class="woocommerce_attribute_data wc-metabox-content hidden">
        <table cellpadding="0" cellspacing="0">
            <tbody>
            <tr>
                <td class="attribute_name">
                    <label><?php esc_html_e('Name', 'woocommerce'); ?>:</label>
                    <strong><?php echo wc_attribute_label($user_data->display_name); ?></strong>
                    <input type="hidden" name="user_ids[<?php echo esc_attr($user_id); ?>]"
                           value="<?php echo esc_attr($user_id); ?>"/>
                </td>
                <td rowspan="3">
                    <label>
                        <?php echo get_woocommerce_currency_symbol(); ?>

                        <?php esc_html_e('Price', 'woocommerce'); ?>:</label>
                    <input type="text" name="user_specific_price[<?php echo esc_attr($user_id); ?>]"
                           class="attribute_position_price" value="<?php echo esc_attr($price); ?>"/>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

