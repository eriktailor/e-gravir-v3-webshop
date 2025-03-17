/**
 * FUNCTIONS: Product Variation
 * -----------------------------------------------------------------------------------
 */

export default function initVariation() {

    let variationIndex = $('#variationsWrapper .variation-item').length;

    /**
     * Insert product variation items
     */
    $('#addVariation').on('click', function(e) {
        e.preventDefault();

        $.ajax({
            url: '/admin/products/variation-item',
            data: { index: variationIndex },
            success: function (response) {
                $('#variationsWrapper').append(response);
                variationIndex++;
            },
            error: function () {
                console.log('Nem sikerült variációt betölteni.');
            }
        });
    });

}