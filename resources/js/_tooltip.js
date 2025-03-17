/**
 * COMPONENT: Tooltip
 * -----------------------------------------------------------------------------------
 */

export default function initTooltip() {

    /**
     * Tooltip trigger hover shows tooltip text
     */
    $('.tooltip-trigger').hover(
        function() {
            var tooltipText = $(this).siblings('.tooltip-text');

            tooltipText.removeClass('hidden');
            setTimeout(function() {
                tooltipText.addClass('opacity-100');
            }, 10);
        },
        function() {
            var tooltipText = $(this).siblings('.tooltip-text');

            tooltipText.removeClass('opacity-100');
            setTimeout(function() {
                tooltipText.addClass('hidden');
            }, 200);
        }
    );

    
}