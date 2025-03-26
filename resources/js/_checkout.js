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

    /**
     * Customize products in cart with customize form
     */
    $('.openCustomizer').on('click', function (e) {
        const itemId = $(this).data('id');
        const custom = $(this).data('customizations') || {};
    
        $('#customizeCartItemId').val(itemId);
        $('input[name="front_text"]').val(custom.front_text || '');
        $('input[name="back_text"]').val(custom.back_text || '');
        $('input[name="inner_text"]').val(custom.inner_text || '');
        
        $('input[name="engrave_second_page"]').prop('checked', !!custom.engrave_second_page);
        $('input[name="engrave_third_page"]').prop('checked', !!custom.engrave_third_page);
    
        // Optional: show/hide panels if checked
    });
    

}