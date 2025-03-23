/**
 * COMPONENT: Toggle
 * -----------------------------------------------------------------------------------
 */

export default function initToggle() {

    /**
     * Dropdown trigger click toggles dropdown menu
     */
    $('.toggle').on('click', function(e) {
        e.stopPropagation();

        var target = $(this).data('target');
        $(target).slideToggle();
    });
    
}