/**
 * FUNCTIONS: Product Variation
 * -----------------------------------------------------------------------------------
 */

export default function initVariation() {

    let variationIndex = $('.variation-item').length;

    /**
     * Insert product variation item
     */
    $('#addVariation').on('click', function (e) {
        e.preventDefault();

        $.get('/admin/products/variation-item', { index: variationIndex }, function (data) {
            $('#variationsWrapper').append(data);
            variationIndex++;
        });
    });

    /**
     * Remove entire variation item
     */
    $(document).on('click', '.remove-variation', function () {
        $(this).closest('.variation-item').remove();
    });

    /**
     * Remove a row from variation item
     */
    $(document).on('click', '.remove-value-row', function () {
        $(this).closest('.variation-value-row').remove();
    });

    /**
     * Add a new row dynamically with ajax
     */
    $(document).on('input', '.variation-value-input', function () {
        let row = $(this).closest('.variation-value-row');
        let container = $(this).closest('.variation-values');
        let index = container.data('index');
        let lastRow = container.find('.variation-value-row:last-child');

        if ($(this).val().length > 0 && row.is(lastRow)) {
            let valueIndex = container.find('.variation-value-row').length;
            
            $.get('/admin/products/variation-row', { variationIndex: index, valueIndex: valueIndex }, function (data) {
                container.append(data);
            });
        }
    });

}