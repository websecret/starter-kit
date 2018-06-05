$(document).on('change', '.js-fast__input', function () {
    let $input = $(this);
    let type = $input.attr('type');
    let name = $input.attr('name');
    let value = $input.val();
    if (type == 'checkbox') {
        value = $input.prop('checked') ? 1 : 0;
    }
    let $wrapper = $input.closest('.js-fast__wrapper');
    let link = $wrapper.data('fast-link');
    $.post(link, {
        name,
        value,
    }, function(data) {
        if (data.message) {
            toastr.success(data.message);
        } else {
            toastr.success('Данные успешно обновлены');
        }
    });
});