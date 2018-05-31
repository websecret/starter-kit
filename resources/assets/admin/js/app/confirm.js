$(document).on('click', '.js-confirm-delete', function(e) {
    e.preventDefault();
    let $link = $(this).attr('href');
    bootbox.confirm({
        message: "Вы действительно хотитите удалить?",
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
            if(result) {
                window.location.href = $link;
            }
        }
    });
});