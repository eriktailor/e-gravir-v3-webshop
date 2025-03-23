/**
 * Import local components
 */
import initDropdown from './_dropdown';
import initVariation from './_variation';
import initTooltip from './_tooltip';
import initOffcanvas from './_offcanvas';
import initCheckout from './_checkout';
import initModal from './_modal';

/**
 * Initialize local components
 */
initDropdown();
initVariation();
initTooltip();
initOffcanvas();
initCheckout();
initModal();

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
 * Ajax initialize
 */
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});





});