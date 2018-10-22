$('.nav-tabs a').on('shown.bs.tab', function(){
    let url = $(this).data('url')
    let $current = $('.js-pjax--current-url')
    if (url && $current.length) {
        $current.attr('href', url)
    }
});