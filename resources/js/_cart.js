export default function initCart() {

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
     * Open cart sidebar function
     */
    function openCartSidebar() {
        $('body').addClass('overflow-hidden');
        $('#sideCart').removeClass('invisible opacity-0').addClass('opacity-100');
        $('#cartBackdrop').removeClass('opacity-0').addClass('opacity-100');
        $('#cartPanel').removeClass('translate-x-full').addClass('translate-x-0');
    }

    /**
     * Close cart sidebar function
     */
    function closeCartSidebar() {
        $('body').removeClass('overflow-hidden');
        $('#cartBackdrop').removeClass('opacity-100').addClass('opacity-0');
        $('#cartPanel').removeClass('translate-x-0').addClass('translate-x-full');
        setTimeout(() => {
            $('#sideCart').removeClass('opacity-100').addClass('opacity-0 invisible');
        }, 300);
    }

    /**
     * Cart button clicked, open sidebar
     */
    $('#cartToggle').on('click', function() {
        openCartSidebar();
    });

    /**
     * Cart close button or backdrop clicked
     */
    $(document).on('click', '#cartBackdrop, .close-cart', function() {
        closeCartSidebar();
    });

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
