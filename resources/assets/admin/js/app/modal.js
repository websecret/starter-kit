$('#modal').on('show.bs.modal', function (e) {
    let $button = $(e.relatedTarget)
    let url = $button.data('url')
    $.get(url, (response) => {
        let $popup = $(this).find('.modal-content')
        $popup.html(response.html)
        window.init()
    })
})

$(document).on('hidden.bs.modal', function (e) {
    let $modal = $(this)
    if($modal.attr('id') == 'modal') {
        $modal.find('.modal-content').html('')
    }
});