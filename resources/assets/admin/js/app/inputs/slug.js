let slug = require('slug');

$('.js-input-slug__field').each(function () {
    let $slug = $(this);
    let inputs = $slug.data('slug-from');
    for (let input of inputs) {
        let inputSelector = getInputSelector(input);
        let $form = $slug.closest('.js-form');
        $form.on('input', inputSelector, function () {
            generateSlug($slug);
        })
    }
});

$(document).on('click', '.js-input-slug__toggle', function (e) {
    e.preventDefault();
    let $button = $(this);
    let $wrapper = $button.closest('.js-input-slug');
    let $input = $wrapper.find('.js-input-slug__field');
    let isLocked = isInputLocked($input);
    let $icon = $wrapper.find('.js-input-slug__toggle-icon');
    if(isLocked) {
        $button.removeClass($button.data('unlock-class')).addClass($button.data('lock-class'));
        $icon.removeClass($icon.data('unlock-class')).addClass($icon.data('lock-class'));
    } else {
        $button.removeClass($button.data('lock-class')).addClass($button.data('unlock-class'));
        $icon.removeClass($icon.data('lock-class')).addClass($icon.data('unlock-class'));
    }
});

function getInputSelector(input) {
    return ':input[name="' + input + '"]:visible, :input[data-name="' + input + '"]:visible';
}

function generateSlug($slug, separator = '-') {
    let isLocked = isInputLocked($slug);
    if(isLocked) return;
    let $form = $slug.closest('.js-form');
    let inputs = $slug.data('slug-from');
    let slugString = '';
    for (let input of inputs) {
        let inputSelector = getInputSelector(input);
        let value = $form.find(inputSelector).val();
        if (value !== '') {
            slugString += value + separator;
        }
    }
    slugString = slugString.split(separator).filter(_ => _ !== '').join(separator);
    $slug.val(slug(slugString, {
        lower: true,
        replacement: separator,
    }));
}

function isInputLocked($input) {
    let $wrapper = $input.closest('.js-input-slug');
    let $button = $wrapper.find('.js-input-slug__toggle');
    if($button.hasClass($button.data('unlock-class'))) {
        return true;
    }
    return false;
}