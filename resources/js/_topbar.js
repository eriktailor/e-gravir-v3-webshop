/**
 * COMPONENT: Topbar
 * -----------------------------------------------------------------------------------
 */

export function showTopbarMessage(message, type = 'success') {
    const colorClasses = {
        success: 'bg-green-100 text-green-600',
        error: 'bg-red-100 text-red-500',
    };

    const html = `
        <div class="${colorClasses[type]} py-2">
            <div class="container">
                <div class="text-center">
                    ${message}
                </div>
            </div>
        </div>
    `;

    const $topBar = $('#topBar');
    $topBar.html(html).hide().slideDown(300);

    setTimeout(() => {
        $topBar.slideUp(500);
    }, 10000);
}