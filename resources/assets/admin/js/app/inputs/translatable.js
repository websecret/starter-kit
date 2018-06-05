$(document).on('click', '.js-translatable__link', function (e) {
    e.preventDefault();
    let $link = $(this);
    let locale = $link.data('locale');
    let $wrapper = $link.closest('.js-translatable__wrapper');
    $wrapper.find('.js-translatable__input-wrapper').hide();
    $wrapper.find('.js-translatable__input-wrapper[data-locale=' + locale + ']').show();
    $wrapper.find('.js-translatable__link[data-locale=' + locale + ']').removeClass('badge-default').addClass('badge-dark');
    $wrapper.find('.js-translatable__link[data-locale=' + locale + ']').siblings().removeClass('badge-dark').addClass('badge-default');
});