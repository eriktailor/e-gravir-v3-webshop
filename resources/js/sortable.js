import Sortable from 'sortablejs';
import $ from 'jquery';

document.addEventListener('DOMContentLoaded', () => {
    const el = document.querySelector('.categories-list');

    if (el) {
        Sortable.create(el, {
            handle: '.grip-handle',
            animation: 150,
            onEnd: function (evt) {
                let order = [];
                $('.categories-list > div').each(function () {
                    order.push($(this).data('id'));
                });

                $.ajax({
                    url: '/admin/categories/reorder',
                    method: 'POST',
                    data: {
                        order: order,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        console.log('Order updated', res);
                    }
                });
            }
        });
    }
});
