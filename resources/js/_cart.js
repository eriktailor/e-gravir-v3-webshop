/**
 * COMPONENT: Dropdown
 * -----------------------------------------------------------------------------------
 */

export default function initDropdown() {
        
    /**
     * Cart button clicked, open the sidebar cart
     */
    $('#cartToggle').on('click', function() {
        $('body').addClass('overflow-hidden');

        // Make #sideCart visible
        $('#sideCart').removeClass('invisible opacity-0').addClass('opacity-100');

        // Animate backdrop fade-in
        $('#cartBackdrop').removeClass('opacity-0').addClass('opacity-100');

        // Animate cart panel slide-in
        $('#cartPanel').removeClass('translate-x-full').addClass('translate-x-0');
    });

    /**
     * Cart close button or outside clicked, hide the sidecart
     */
    $('#cartBackdrop, .close-cart').on('click', function() {
        $('body').removeClass('overflow-hidden');

        // Fade out backdrop
        $('#cartBackdrop').removeClass('opacity-100').addClass('opacity-0');

        // Slide out panel
        $('#cartPanel').removeClass('translate-x-0').addClass('translate-x-full');

        // After animation, hide entire aside
        setTimeout(() => {
            $('#sideCart').removeClass('opacity-100').addClass('opacity-0 invisible');
        }, 300); // Match duration!
    });

    /**
     * Add to cart button clicked
     */
    $('.add-to-cart-btn').on('click', function() {
        var productId = $(this).data('id');
    
        $.ajax({
            url: '/webshop/cart/add/' + productId,
            method: 'POST',
            success: function(response) {
                // Update cart count badge dynamically
                $('.cart-count').text(response.count);
                
                // Reload cart header
                $('#sideCart .cart-header').load(location.href + ' #sideCart .cart-header > *');

                // Reload cart content
                $('#sideCart .cart-content').load(location.href + ' #sideCart .cart-content > *');

                // Reload cart footer
                $('#sideCart .cart-footer').load(location.href + ' #sideCart .cart-footer > *', function() {
                    $('#sideCart .cart-footer').removeClass('hidden');
                });
    
                // OPEN CART SIDEBAR AFTER ADDING
                $('body').addClass('overflow-hidden');
                $('#sideCart').removeClass('invisible opacity-0').addClass('opacity-100');
                $('#cartBackdrop').removeClass('opacity-0').addClass('opacity-100');
                $('#cartPanel').removeClass('translate-x-full').addClass('translate-x-0');
            }
        });
    });

    /**
     * Remove from cart button clicked
     */
    $(document).on('click', '.remove-cart-item', function() {
        var productId = $(this).data('id');
        
        $.ajax({
            url: '/webshop/cart/remove/' + productId,
            method: 'POST',
            success: function(response) {
                $('.cart-count').text(response.count);
                
                // Reload cart header
                $('#sideCart .cart-header').load(location.href + ' #sideCart .cart-header > *');

                // Reload cart content
                $('#sideCart .cart-content').load(location.href + ' #sideCart .cart-content > *');
                
                // Reload footer
                $('#sideCart .cart-footer').load(location.href + ' #sideCart .cart-footer > *', function() {
                    // If cart is empty → hide footer
                    if (response.count === 0) {
                        $('#sideCart .cart-footer').addClass('hidden');
                    } else {
                        $('#sideCart .cart-footer').removeClass('hidden');
                    }
                });
            }
        });
    });

    /**
     * Reload sidebar cart content dynamically
     */
    $('#sideCart .cart-content').load(location.href + ' #sideCart .cart-content > *');

    /**
     * Reload sidebar cart content dynamically
     */
    $('#sideCart .cart-footer').load(location.href + ' #sideCart .cart-footer > *');

    // Reload cart header
    $('#sideCart .cart-header').load(location.href + ' #sideCart .cart-header > *');


}