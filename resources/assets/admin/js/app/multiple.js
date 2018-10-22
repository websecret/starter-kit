$(document).on('click', '.js-multiple__remove', handleMultipleRemoveClick);
$(document).on('click', '.js-multiple__add', handleMultipleAddClick);

function handleMultipleRemoveClick(e) {
    e.preventDefault();
    let $row = $(this).closest('.js-multiple__row');
    let $wrapper = $(this).closest('.js-multiple');
    $row.remove();
    setMultipleNames($wrapper);
    $wrapper.trigger('multiple-changed', false);
    $wrapper.trigger('multiple-removed');
}

function handleMultipleAddClick(e) {
    e.preventDefault();
    let $wrapper = $(this).closest('.js-multiple');
    let $clone = $wrapper.find('.js-multiple__row--clone');
    let $new = $clone.clone();
    $new.find(':input').prop('disabled', false);
    $new.removeClass('js-multiple__row--clone');
    $new.insertBefore($clone);
    setMultipleNames($wrapper);
    $new.trigger('multiple-changed', true);
    $new.trigger('multiple-added');
}

function setMultipleNames($wrapper) {
    $wrapper.find('.js-multiple__row:not(".js-multiple__row--clone")').each(function (key, row) {
        let $row = $(this);
        let $radio = $row.find('.js-multiple__input-radio');
        if ($radio.length) {
            $radio.val(key);
            if (!$wrapper.find('.js-multiple__row:not(".js-multiple__row--clone") .js-multiple__input-radio:checked').length && key == 0) {
                $radio.prop('checked', true);
            }
        }
        $row.find(':input').each(function () {
            let $input = $(this);
            if ($input.data('name-before') || $input.data('name-after')) {
                let name = '';
                if ($input.data('name-before')) {
                    name = $input.data('name-before') + name;
                }
                name = name + '[' + key + ']';
                if ($input.data('name-after')) {
                    name = name + $input.data('name-after');
                }
                $input.attr('name', name);
            }
        });
    })
}

$('.js-multiple').each(function () {
    setMultipleNames($(this));
});