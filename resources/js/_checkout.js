/**
 * PAGE: Checkout
 * -----------------------------------------------------------------------------------
 */

export default function initCheckout() {

    /**
     * Populate foxpost select dropdown with items
     */
    $.getJSON('https://cdn.foxpost.hu/foxplus.json', function(data) {

        // Sort by item.name alphabetically
        data.sort(function(a, b) {
            return a.name.localeCompare(b.name);
        });
        
        // Loop & append
        $.each(data, function(index, item) {
            $('#delivery_foxpost_box').append(
                $('<option>', {
                    value: item.place_id,
                    text: item.name + ' - ' + item.address
                })
            );
        });
    });

    /**
     * If foxpost delivery method gets selected, show the foxpost box selector field
     */
    $('input[name="delivery_method"]').on('change', function() {
        $('#foxpostBoxSelect, #takeOffAddress').slideUp(50);

        if ($(this).val() == 'foxpost') {
            $('#foxpostBoxSelect').slideDown(300);
        } 

        if ($(this).val() == 'szemelyes') {
            $('#takeOffAddress').slideDown(300);
        } 
    });

    let selectedProductId = null;

$(document).on('click', '.offcanvas-toggle', function () {
    selectedProductId = $(this).data('product-id');
    $('.button-submit[data-target="#productCustomizeForm"]').data('product-id', selectedProductId);
});

}