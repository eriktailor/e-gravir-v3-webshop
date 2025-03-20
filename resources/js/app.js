/**
 * Import jQuery
 */
import $ from 'jquery';
window.$ = $;

/**
 * Import local components
 */
import initDropdown from './_dropdown';
import initVariation from './_variation';
import initTooltip from './_tooltip';

/**
 * Initialize local components
 */
initDropdown();
initVariation();
initTooltip();

$(document).ready(function() {

/**
 * Page loader fades out when page is loaded
 */
$(window).on('load', function () {
    $('#loader').fadeOut(300);
});

/**
 * Navbar toggle nav menu
 */
$('.navbar-toggle').on('click', function() {
    $(this).closest('.navbar').find('.navbar-menu').slideToggle(300);
});

/**
 * If submit button is outside of form, trigger form submit
 */
$('.button-submit').on('click', function(e) {
    e.preventDefault();
    var form = $(this).data('target');
    $(form).trigger('submit');
});

/**
 * Display topbar and hide it later, if have success or error message in session
 */
if ($('#topBar').children().length) {
    setTimeout(function(){
        $('#topBar').slideDown(300);
    }, 100);

    setTimeout(function(){
        $('#topBar').slideUp(500);
    }, 10000);
}


});