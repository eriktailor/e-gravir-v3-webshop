/**
 * COMPONENT: Dropdown
 * -----------------------------------------------------------------------------------
 */

jQuery(document).ready(function($) {

    /**
     * Dropdown trigger click toggles dropdown menu
     */
    $('.dropdown-toggle').on('click', function(e) {
        e.stopPropagation();

        var $dropdown = $(this).closest('.dropdown');
        var $menu = $dropdown.find('.dropdown-menu');

        // Close other dropdowns
        $('.dropdown-menu').not($menu).removeClass('scale-100 opacity-100').addClass('hidden');
        $('.dropdown').not($dropdown).removeClass('dropdown-open');

        // Toggle current
        if ($menu.hasClass('hidden')) {
            $menu.removeClass('hidden');
            setTimeout(function() {
                $menu.addClass('scale-100 opacity-100');
                $dropdown.addClass('dropdown-open');
            }, 50);
        } else {
            $menu.removeClass('scale-100 opacity-100');
            setTimeout(function() {
                $menu.addClass('hidden');
                $dropdown.removeClass('dropdown-open');
            }, 50);
        }
    });
    
    /**
     * Dropdown close button click closes dropdown menu
     */
    $('.dropdown-close').on('click', function(e) {
        e.stopPropagation();
        var $dropdown = $(this).closest('.dropdown');
        var $menu = $dropdown.find('.dropdown-menu');

        $menu.removeClass('scale-100 opacity-100');
        setTimeout(function() {
            $menu.addClass('hidden');
            $dropdown.removeClass('dropdown-open');
        }, 50);
    });
    
    /**
     * Clicking outside of dropdown closes dropdown menu
     */
    $(document).on('click', function() {
        $('.dropdown-menu').removeClass('scale-100 opacity-100').addClass('hidden');
        $('.dropdown').removeClass('dropdown-open');
    });
    
    
});