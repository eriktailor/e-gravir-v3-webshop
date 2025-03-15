/**
 * Import jQuery
 */
import $ from 'jquery';
window.$ = $;



/**
 * Page loader fade out when content gets loaded completely
 */
$(window).on('load', function () {
    $('#loader').fadeOut(300);
});