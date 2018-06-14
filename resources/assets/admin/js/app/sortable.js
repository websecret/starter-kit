import Sortable from 'sortablejs';
require('jquery-sortable');

$('.js-sortable').each(function () {
    let $sortable = $(this);
    $sortable.sortable({
        handle: '.js-sortable__handle',
        itemSelector: '.js-sortable__item',
        placeholder: '<li class="order__item-placeholder">',
        onDrop: function ($item, container, _super) {
            let $container = $item.closest('.js-sortable');
            let data = $container.sortable("serialize").get()[0];
            data = prepareChildren(data);
            $.post($container.data('link'), {
                data
            }, function(result) {
                if (result.message) {
                    toastr.success(result.message);
                } else {
                    toastr.success('Порядок успешно обновлен');
                }
                _super($item, container);
            });
        }
    });
});

function prepareChildren(data) {
    for(let i in data) {
        let item = data[i];
        if(item.children) {
            data[i]['children'] = prepareChildren(item.children[0]);
        }
    }
    return data;
}

// $('.js-sortable').each(function () {
//     let $sortable = $(this);
//     Sortable.create($sortable.find('ul')[0], {
//         group: 'sort',
//         animation: 150,
//         draggable: 'li',
//         onSort: function (e) {
//             let order = this.toArray();
//             console.log(order);
//             /*$.post($this.data('url'), {
//                 order,
//             }, function (result) {
//                 if (result.result == 'success') {
//                     toastr["success"](result.message ? result.message : 'Данные успешно сохранены');
//                 }
//             })*/
//         },
//     });
// });