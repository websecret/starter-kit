$(document).on('click', '.js-confirm-delete', function (e) {
    e.preventDefault();
    let $link = $(this);
    let message = $(this).data('question') || 'Вы действительно хотите удалить?';
    let textSuccess = $(this).data('success') || 'Удаление прошло успешно';
    let textError = $(this).data('error') || 'Ошибка';
    let wrap = $(this).data('wrap') || 'tr'
    let url = $(this).attr('href')
    bootbox.confirm({
        message: message,
        backdrop: true,
        buttons: {
            cancel: {
                label: '<i class="fe fe-x"></i> Отмена'
            },
            confirm: {
                label: '<i class="fe fe-check"></i> Удалить',
                className: "btn-danger",
            }
        },
        callback: function (result) {
            if (result) {
                axios
                    .get(url)
                    .then(data => {
                        if (data.data.result == 'success') {
                            $link.closest(wrap).remove();
                            if (data.data.message) {
                                textSuccess = data.data.message
                            }
                            toastr.success(textSuccess);
                        } else {
                            toastr.error(textError);
                        }
                    })
            }
        }
    });
});