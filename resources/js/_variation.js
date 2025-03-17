/**
 * FUNCTIONS: Product Variation
 * -----------------------------------------------------------------------------------
 */

export default function initVariation() {

    /**
     * Insert product variation item
     */
    $('#addVariation').on('click', function(e) {
        e.preventDefault();
        let index = $('.variation-item').length;
        
        $.get('/admin/products/variation-item', { index: index }, function(data) {
            $('#variationsWrapper').append(data);
        });
    });

    /**
     * Remove product variation item
     */
    $(document).on('click', '.remove-variation', function() {
        $(this).closest('.variation-item').remove();
    });

}