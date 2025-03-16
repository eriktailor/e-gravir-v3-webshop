/**
 * Import jQuery
 */
import $ from 'jquery';
window.$ = $;

/**
 * File imports
 */
import './_dropdown';


/**
 * Page loader fades out when page is loaded
 */
$(window).on('load', function () {
    $('#loader').fadeOut(300);
});

/**
 * Select inputs placeholder color fix
 */
$('select').each(function() {
    if ($(this).val()) {
        $(this).removeClass('text-gray-400');
    }
}).on('change', function() {
    $(this).removeClass('text-gray-400');
});
