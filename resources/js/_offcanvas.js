/**
 * COMPONENT: Offcanvas
 * -----------------------------------------------------------------------------------
 */

export default function initOffcanvas() {

    /**
     * Open offcanvas sidebar function
     */
    function openOffcanvas(id) {
        const $offcanvas = $(id);

        $('body').addClass('overflow-hidden');
        $offcanvas.removeClass('invisible opacity-0').addClass('opacity-100');
        $offcanvas.find('.offcanvas-backdrop').removeClass('opacity-0').addClass('opacity-100');
        $offcanvas.find('.offcanvas-panel').removeClass('translate-x-full').addClass('translate-x-0');
    }

    /**
     * Close cart sidebar function
     */
    function closeOffcanvas(id) {
        const $el = $(id);

        $('body').removeClass('overflow-hidden');
        $el.find('.offcanvas-backdrop').removeClass('opacity-100').addClass('opacity-0');
        $el.find('.offcanvas-panel').removeClass('translate-x-0').addClass('translate-x-full');
        setTimeout(() => {
            $el.removeClass('opacity-100').addClass('opacity-0 invisible');
        }, 300);
    }

    /**
     * Opener clicked
     */
    $(document).on('click', '.offcanvas-toggle', function(e) {
        e.preventDefault();
        const id = $(this).attr('href');
        openOffcanvas(id);
    });

    /**
     * Cart close button or backdrop clicked
     */
    $(document).on('click', '.offcanvas-backdrop, .offcanvas-close', function() {
        const $offcanvas = $(this).closest('.offcanvas');
        closeOffcanvas($offcanvas);
    });

}
