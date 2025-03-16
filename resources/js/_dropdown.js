/**
 * COMPONENT: Dropdown
 * -----------------------------------------------------------------------------------
 */

jQuery(document).ready(function($) {

    /**
     * Dropdown trigger click toggles dropdown menu
     */
    $('.dropdown-toggle').on('click', function() {
        var dropdownMenu = $(this).closest('.dropdown').find('.dropdown-menu');
    
        dropdownMenu.toggleClass('hidden');
    
        setTimeout(function() {
            dropdownMenu.toggleClass('scale-100 opacity-100');
        }, 10);
    });
    
    /**
     * Dropdown close button click closes dropdown menu
     */
    $('.dropdown-close').on('click', function() {
        var dropdownMenu = $(this).closest('.dropdown').find('.dropdown-menu');
    
        dropdownMenu.removeClass('scale-100 opacity-100');
    
        setTimeout(function() {
            dropdownMenu.addClass('hidden');
        }, 10);
    });
    
    /**
     * Clicking outside of dropdown closes dropdown menu
     */
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.dropdown').length) {
            $('.dropdown-menu').removeClass('scale-100 opacity-100');
    
            setTimeout(function() {
                $('.dropdown-menu').addClass('hidden');
            }, 10);
        }
    });
    
    
});