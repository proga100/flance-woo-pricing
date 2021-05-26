jQuery(document).ready()
{

    var get_all_users = all_users.all_user;
    var selected_users = all_users.selected_users;

    jQuery("body").on("click", '.product_attributes_price .remove_row', function ($) {
        var t;

        function r() {
            jQuery(".product_attributes .woocommerce_attribute").each(function (t, e) {
                jQuery(".attribute_position", e).val(parseInt(jQuery(e).index(".product_attributes .woocommerce_attribute"), 10))
            })
        }

        return window.confirm('Remove this price') && ((t = jQuery(this).parent().parent()).is(".taxonomy") ? (t.find("select, input[type=text]").val(""), t.hide(), jQuery("select.attribute_taxonomy").find('option[value="' + t.data("taxonomy") + '"]').removeAttr("disabled")) : (t.find("select, input[type=text]").val(""), t.hide(), r())), !1
    })

    function h3_html_render(user_id, user_name, user_price) {
        return `
        <div data-taxonomy_user_id="` + user_id + `>"  
        class="woocommerce_attribute wc-metabox postbox closed "
             rel="` + user_id + `"
             id="fl_user_id_` + user_id + `">
        <h3>
        <a href="#" class="remove_row delete">Remove</a>
        <div class="handlediv" title="Click to toggle"></div>
        <div class="inlrow">
            <div class="attribute_name user_name">` + user_name + `</div>
            <div class="attribute_name user_price user_price_` + user_id + `">$ ` + user_price + ` </div>
        </div>
    </h3>`
    }

    function disable_option() {
        jQuery.each(selected_users, function (key, value) {
            //   jQuery('select#user_id option[value="' + key + '"]').attr('disabled', 'disabled');
        });
    }

    disable_option();

    function change_user_price(user_id) {
        console.log(user_id);
        let value = jQuery('#user_specific_price_' + user_id).val();
        jQuery('.user_price_' + user_id).text('$ ' + value);
    }

    function add_user_price() {
        let user_id = jQuery("#user_id option:selected").val();
        let user_name = jQuery("#user_id option:selected").text();
        let user_price = jQuery("#user_price").val();

        let html = h3_html_render(user_id, user_name, user_price);
        html += `<div <div class="woocommerce_attribute_data wc-metabox-content hidden">
        <table cellpadding="0" cellspacing="0"> <tbody> `;
        html += ' <tr>    <td class="attribute_name">    <label><strong>Name:</strong></label>';
        html += '    <strong>' + user_name + '</strong> <input type="hidden" name="user_ids[' + user_id + ']"   value="' + user_id + '"/>';
        html += ' </td>   <td rowspan="3">';
        html += '  <label><strong>$ Price</strong> </label>';
        html += ` <input type="text" name="user_specific_price[` + user_id + `]" id="user_specific_price_` + user_id + `"  class="attribute_position_price"
                    value="` + user_price + ` "
                    onchange="change_user_price(` + user_id + `)"
                    />  </td></tr> </tbody> </table></div>`;
        html += '</div>';
        selected_users[user_id] = user_name;
        disable_option();
        let remove_el = '.woocommerce_attribute_data_container #fl_user_id_' + user_id;
        jQuery(remove_el).remove();
        jQuery(".woocommerce_attribute_data_container").append(html);
    }

    jQuery("body").on("click", '.add_user_price', function (e) {
        add_user_price();
    });


}
