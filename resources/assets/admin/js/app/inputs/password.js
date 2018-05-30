$(document).on('click', '.js-input-password__toggle', function() {
    let $toggle = $(this);
    let $wrapper = $toggle.closest('.js-input-password');
    let $icon = $wrapper.find('.js-input-password__toggle-icon');
    let $input = $wrapper.find('.js-input-password__field');
    let showClass = $icon.data('show-class');
    let hideClass = $icon.data('hide-class');
    let isShown = $icon.hasClass(hideClass);
    if(isShown) {
        $icon.addClass(showClass);
        $icon.removeClass(hideClass);
        $input.attr('type', 'password');
    } else {
        $icon.addClass(hideClass);
        $icon.removeClass(showClass);
        $input.attr('type', 'text');
    }
});

$(document).on('click', '.js-input-password__generate', function() {
    let $wrapper = $(this).closest('.js-input-password');
    let $input = $wrapper.find('.js-input-password__field');
    let password = generateRandomString(16);
    $input.val(password);
});