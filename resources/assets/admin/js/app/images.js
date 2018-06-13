$(document).on('change', '.js-images__input', handleImageInputChange);
$(document).on('click', '.js-image__remove', handleImageRemoveClick);

function handleImageInputChange() {
    let $input = $(this);
    let input = this;
    if (input.files && input.files[0]) {
        let $wrapper = $input.closest('.js-images__wrapper');

        $input.attr('disabled', true);
        $wrapper.addClass('js-images__wrapper--loading');

        let formData = new FormData();
        $.each(input.files, function (i, file) {
            formData.append('images[]', file);
        });
        $.post({
            url: '/admin/upload/images',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function (data) {
                if (data.result != 'success') {
                    toastr["error"](data.message || 'Не удалось загрузить избражения');
                } else {
                    let isMultiple = $wrapper.data('images-is-multiple');
                    let $clone = $wrapper.find('.js-image--clone');
                    let images = data.images;
                    if(!isMultiple) {
                        images = [images[0]];
                        $wrapper.find('.js-image').not('.js-image--clone').remove();
                    }
                    $.each(images, function (i, path) {
                        let $image = $clone.clone();
                        $image.find(':input').prop('disabled', false);
                        $image.find('.js-image__path').val(path);
                        $image.find('.js-image__img').attr('src', path);
                        $image.insertBefore($clone);
                        $image.removeClass('js-image--clone');
                    });
                    setMainImage($wrapper);
                }
                $input.val(null);
                $input.attr('disabled', false);
                $wrapper.removeClass('js-images__wrapper--loading');
            },
            error: function () {
                toastr["error"]('Не удалось загрузить избражения');
                $input.val(null);
                $input.attr('disabled', false);
                $input.removeClass('js-images__wrapper--loading');
            }
        });
    }
}

function handleImageRemoveClick(e) {
    e.preventDefault();
    let $wrapper = $(this).closest('.js-images__wrapper');
    $(this).closest('.js-image').remove();
    setMainImage($wrapper);
}

function setMainImage($wrapper) {
    let $images = $wrapper.find('.js-image').not('.js-image--clone');
    $images.each(function (i, $image) {
        $(this).find('.js-image__is-main').val(i);
        $(this).find(':input').each(function() {
            let $input = $(this);
            let dataNameBefore = $input.data('name-before');
            let dataNameAfter = $input.data('name-after');
            if(dataNameBefore || dataNameAfter) {
                $input.attr('name', (dataNameBefore ? dataNameBefore : '') + '[' + i + ']' + (dataNameAfter ? dataNameAfter : ''));
            }
        });
    });
    if (!$images.find('.js-image__is-main:checked').length) {
        $images.first().find('.js-image__label').click();
    }
}