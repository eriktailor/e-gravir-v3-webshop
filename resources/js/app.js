/**
 * Import jQuery
 */
import $ from 'jquery';
window.$ = $;

/**
 * Import local components
 */
import initDropdown from './_dropdown';

/**
 * Initialize local components
 */
initDropdown();

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

/**
 * Navbar toggle nav menu
 */
$('.navbar-toggle').on('click', function() {
    $(this).closest('.navbar').find('.navbar-menu').slideToggle(300);
});