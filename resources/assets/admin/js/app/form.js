require('jquery-form')

$(document).on('submit', '.js-form', submitFormAjax);

const CLASS_WRAP = 'js-form__wrapper'
const CLASS_INPUT_ERROR = 'js-form__input-error'
const CLASS_HAS_ERROR = 'is-invalid'

function submitFormAjax(e) {
    e.preventDefault();
    let $form = $(this);
    $form.find(`.${CLASS_WRAP}`).removeClass(CLASS_HAS_ERROR);
    $form.find(`.${CLASS_INPUT_ERROR}`).html('');
    $form.ajaxSubmit({
        success: function (data) {
            if (data.result != 'success') {
                handleFormAjaxError($form, data);
            } else {
                $form.trigger('form-ajax-success', [data]);
                if ($form.hasClass('js-form--redirect')) {
                    let redirectLink = data.link || data.redirect;
                    setTimeout(() => window.location.href = redirectLink, 2000);
                }
                if ($form.hasClass('js-form--back')) {
                    $('.js-back').click()
                }
                if (data.message) {
                    toastr.success(data.message);
                } else {
                    toastr.success('Данные успешно сохранены');
                }
            }
        },
        error: function (result) {
            if (result.status == 422) {
                handleFormAjaxError($form, result.responseJSON);
            }
        }
    });
}

function handleFormAjaxError($form, data) {
    $form.trigger('form-ajax-error', [data]);
    $.each(data.errors, function (input, errors) {
        let inputArray = input.split('.');
        let $input = $form.find(':input[name="' + input + '"]');
        if (!$input.length && inputArray.length == 1) {
            $input = $form.find(':input[name="' + inputArray[0] + '[]"]:eq(' + inputArray[1] + ')');
        }
        if (inputArray.length == 2) {
            $input = $form.find(`:input[name="${inputArray[0]}[${inputArray[1]}]"]`);
        }
        if (inputArray.length == 3) {
            $input = $form.find(`:input[name="${inputArray[0]}[${inputArray[1]}][${inputArray[2]}]"]`);
        }
        if (inputArray.length == 4) {
            $input = $form.find(`:input[name="${inputArray[0]}[${inputArray[1]}][${inputArray[2]}][${inputArray[3]}]"]`);
        }
        let text = '';
        $.each(errors, (i, error) => text += error + "<br>");
        if ($input.length) {
            let $wrapper = $input.closest(`.${CLASS_WRAP}`);
            let $errorBlock = $wrapper.find(`.${CLASS_INPUT_ERROR}`);
            $input.addClass(CLASS_HAS_ERROR);
            let $helpBlock = '<span class="help-block">' + text + '</span>';
            $errorBlock.html($helpBlock);
        } else {
            toastr.error(text);
        }
    });
    toastr.error('Ошибка сохранения данных');
}
