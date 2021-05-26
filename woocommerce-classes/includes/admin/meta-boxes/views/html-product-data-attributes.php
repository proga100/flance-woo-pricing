<?php
if (!defined('ABSPATH')) {
	exit;
}
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
    <div class="toolbar">
		<span class="expand-close">
			<a href="#" class="expand_all"><?php esc_html_e('Expand', 'woocommerce'); ?></a> / <a href="#"
                                                                                                  class="close_all"><?php esc_html_e('Close', 'woocommerce'); ?></a>
		</span>
        <button type="button"
                class="button save_attributes button-primary"><?php esc_html_e('Save Prices', 'woocommerce'); ?></button>
    </div>

</div>

<script>
    jQuery(document).ready()
    {
        jQuery(".product_attributes_price").on("click", ".remove_row", function ($) {
            var t;

            function r() {
               jQuery(".product_attributes .woocommerce_attribute").each(function (t, e) {
                    jQuery(".attribute_position", e).val(parseInt(jQuery(e).index(".product_attributes .woocommerce_attribute"), 10))
                })
            }

            return window.confirm('Remove this price') && ((t = jQuery(this).parent().parent()).is(".taxonomy") ? (t.find("select, input[type=text]").val(""), t.hide(), jQuery("select.attribute_taxonomy").find('option[value="' + t.data("taxonomy") + '"]').removeAttr("disabled")) : (t.find("select, input[type=text]").val(""), t.hide(), r())), !1
        })
    }
</script>
