$(document).on('change', '.js-files__input', handleFileInputChange);
$(document).on('click', '.js-file__remove', handleFileRemoveClick);

function handleFileInputChange() {
    let $input = $(this);
    let input = this;
    if (input.files && input.files[0]) {
        let $wrapper = $input.closest('.js-files__wrapper');

        $input.attr('disabled', true);
        $wrapper.addClass('js-files__wrapper--loading');

        let formData = new FormData();
        $.each(input.files, function (i, file) {
            formData.append('files[]', file);
        });
        $.post({
            url: '/admin/upload/files',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success: function (data) {
                if (data.result != 'success') {
                    toastr["error"](data.message || 'Не удалось загрузить файлы');
                } else {
                    let isMultiple = $wrapper.data('files-is-multiple');
                    let $clone = $wrapper.find('.js-file--clone');
                    let files = data.files;
                    if(!isMultiple) {
                        files = [files[0]];
                        $wrapper.find('.js-file').not('.js-file--clone').remove();
                    }
                    $.each(files, function (i, file) {
                        let $file = $clone.clone();
                        $file.find(':input').prop('disabled', false);
                        $file.find('.js-file__path').val(file.path);
                        $file.find('.js-file__name').val(file.name);
                        $file.insertBefore($clone);
                        $file.removeClass('js-file--clone');
                    });
                    setFilesNames($wrapper);
                }
                $input.val(null);
                $input.attr('disabled', false);
                $wrapper.removeClass('js-files__wrapper--loading');
            },
            error: function () {
                toastr["error"]('Не удалось загрузить файлы');
                $input.val(null);
                $input.attr('disabled', false);
                $input.removeClass('js-files__wrapper--loading');
            }
        });
    }
}

function handleFileRemoveClick(e) {
    e.preventDefault();
    let $wrapper = $(this).closest('.js-files__wrapper');
    $(this).closest('.js-file').remove();
    setFilesNames($wrapper);
}

function setFilesNames($wrapper) {
    let $files = $wrapper.find('.js-file').not('.js-file--clone');
    $files.each(function (i, $file) {
        $(this).find(':input').each(function() {
            let $input = $(this);
            let dataNameBefore = $input.data('name-before');
            let dataNameAfter = $input.data('name-after');
            if(dataNameBefore || dataNameAfter) {
                $input.attr('name', (dataNameBefore ? dataNameBefore : '') + '[' + i + ']' + (dataNameAfter ? dataNameAfter : ''));
            }
        });
    });
}