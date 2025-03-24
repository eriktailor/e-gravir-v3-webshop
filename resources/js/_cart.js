/**
 * COMPONENT: Cart
 * -----------------------------------------------------------------------------------
 */

export default function initCart() {

    /**
     * Open cart sidebar function
     */
    function openCartSidebar() {
        const $sideCart = $('#sideCart');

        $('body').addClass('overflow-hidden');
        $sideCart.removeClass('invisible opacity-0').addClass('opacity-100');
        $sideCart.find('.offcanvas-backdrop').removeClass('opacity-0').addClass('opacity-100');
        $sideCart.find('.offcanvas-panel').removeClass('translate-x-full').addClass('translate-x-0');
    }

    /**
     * Reload cart partials function
     */
    function reloadCartContent(count = null) {
        $('#sideCart .cart-header').load(location.href + ' #sideCart .cart-header > *');
        $('#sideCart .cart-content').load(location.href + ' #sideCart .cart-content > *');
        $('#sideCart .cart-footer').load(location.href + ' #sideCart .cart-footer > *', function() {
            // If count not passed (initial load), read from data attribute
            let itemCount = count !== null 
                ? count 
                : parseInt($('#sideCart').data('cart-count'));
    
            if (itemCount === 0) {
                $('#sideCart .cart-footer').addClass('hidden');
            } else {
                $('#sideCart .cart-footer').removeClass('hidden');
            }
        });
    }

    /**
     * Add to cart button clicked
     */
    $('.add-to-cart-btn').on('click', function() {
        let productId = $(this).data('id');
        $.post('/webshop/cart/add/' + productId, function(response) {
            $('.cart-count').text(response.count);
            reloadCartContent(response.count); // pass count
            openCartSidebar();
        });
    });

    /**
     * Remove from cart button clicked
     */
    $(document).on('click', '.remove-cart-item', function() {
        let productId = $(this).data('id');
        $.post('/webshop/cart/remove/' + productId, function(response) {
            $('.cart-count').text(response.count);
            reloadCartContent(response.count); // pass count
        });
    });

    /**
     * Initially reload cart partials (passing null, no check needed here)
     */
    reloadCartContent();

}
