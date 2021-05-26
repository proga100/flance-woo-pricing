jQuery(document).ready()
{
    jQuery("body").on("click", '.product_attributes_price .remove_row', function ($) {
        var t;
 console.log('tddd et');
        function r() {
            jQuery(".product_attributes .woocommerce_attribute").each(function (t, e) {
                jQuery(".attribute_position", e).val(parseInt(jQuery(e).index(".product_attributes .woocommerce_attribute"), 10))
            })
        }

        return window.confirm('Remove this price') && ((t = jQuery(this).parent().parent()).is(".taxonomy") ? (t.find("select, input[type=text]").val(""), t.hide(), jQuery("select.attribute_taxonomy").find('option[value="' + t.data("taxonomy") + '"]').removeAttr("disabled")) : (t.find("select, input[type=text]").val(""), t.hide(), r())), !1
    })
}
