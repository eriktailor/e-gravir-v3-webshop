/**
 * COMPONENT: Cart
 * -----------------------------------------------------------------------------------
 */
import initDropdown from './_dropdown';

export default function initCart() {

    /**
     * Item added to cart
     */
    $('.add-to-cart-btn').on('click', function(e) {
        e.preventDefault();

        

        const productId = $(this).data('id');
        const btn = $(this);
        btn.prop('disabled', true).text('Hozzáadás...');

        $.post("/webshop/cart/add/" + productId, { quantity: 1 })
            .done(function(response) {
                $('#miniCart').load(location.href + ' #miniCart > *', function() {
                    initDropdown(); // újraindítjuk a dropdown eventeket
                    $('#miniCart .dropdown-toggle').trigger('click'); // nyitjuk a cartot
                });
            })
            .fail(function() {
                alert('Hiba történt a kosárhoz adás során.');
            })
            .always(function() {
                btn.prop('disabled', false).text('Kosárba teszem');
            });
        
        
    });

}
