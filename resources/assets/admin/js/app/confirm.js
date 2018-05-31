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

let PJAX_CONTAINER = '#pjax-container'

$(document).pjax('.pjax', PJAX_CONTAINER, {fragment: '#pjax-container', timeout: 5000});

$(PJAX_CONTAINER).on('pjax:beforeSend', () => {
    $('.wrapper-spinner').show();
})

$(PJAX_CONTAINER).on('pjax:complete', () => {
    $('.wrapper-spinner').hide();
    // init();

})