let PJAX_CONTAINER = '#pjax-container'

$(document).pjax('.pjax', PJAX_CONTAINER + ',.breadcrumb a', {fragment: '#pjax-container', timeout: 5000});

$(PJAX_CONTAINER).on('pjax:beforeSend', () => {
    // $('.wrapper-spinner').show();
})

$(PJAX_CONTAINER).on('pjax:complete', () => {
    // $('.wrapper-spinner').hide();
    window.init()
})