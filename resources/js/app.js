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
 * If submit button is outside of form, trigger form submit
 */
$('.button-submit').on('click', function(e) {
    e.preventDefault();
    var form = $(this).data('target');
    $(form).trigger('submit');
});


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


});