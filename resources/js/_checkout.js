/**
 * PAGE: Checkout
 * -----------------------------------------------------------------------------------
 */

export default function initCheckout() {

$(document).ready(function() {

    /**
     * Populate foxpost select dropdown with items
     */
    $.getJSON('https://cdn.foxpost.hu/foxplus.json', function(data) {
        $.each(data, function(index, item) {
            $('#delivery_foxpost_box').append(
                $('<option>', {
                    value: item.place_id,
                    text: item.name + ' - ' + item.address
                })
            );
        });
    });

});

}