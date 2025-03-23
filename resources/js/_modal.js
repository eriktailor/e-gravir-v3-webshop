/**
 * COMPONENT: Modal
 * -----------------------------------------------------------------------------------
 */

export default function initModal() {

    /**
     * Open modal on trigger click
     */
    $(document).on('click', '.modal-toggle', function(e) {
        e.preventDefault();

        const id = $(this).attr('href');
        const $modal = $(id);
        const $panel = $modal.find('.modal-panel');
        const $backdrop = $modal.find('.modal-backdrop');

        $('.modal').not($modal).addClass('invisible').removeClass('opacity-100');
        $modal.removeClass('invisible');

        setTimeout(() => {
            $('body').addClass('overflow-hidden');
            $modal.addClass('opacity-100');
            $backdrop.addClass('opacity-100');
            $panel.removeClass('scale-75').addClass('scale-100');
        }, 10);
    });

    /**
     * Close modal on close button click
     */
    $(document).on('click', '.close-modal', function() {
        const $modal = $(this).closest('.modal');
        closeModal($modal);
    });

    /**
     * Close modal when clicking outside the modal-window
     */
    $(document).on('click', function(e) {
        const $modal = $('.modal.opacity-100');

        if ($modal.length && !$(e.target).closest('.modal-panel, .modal-toggle').length) {
            closeModal($modal);
        }
    });

    /**
     * Function to close the modal
     */
    function closeModal($modal) {
        const $panel = $modal.find('.modal-panel');
        const $backdrop = $modal.find('.modal-backdrop');

        $('body').removeClass('overflow-hidden');
        $modal.removeClass('opacity-100');
        $backdrop.removeClass('opacity-100');
        $panel.removeClass('scale-100').addClass('scale-75');

        setTimeout(() => {
            $modal.addClass('invisible');
        }, 300); // Match transition
    }

    
}