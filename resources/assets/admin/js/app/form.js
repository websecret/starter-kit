require('jquery-form')

$(document).on('submit', '.js-form', submitFormAjax);

const CLASS_WRAP = 'js-form__wrapper'
const CLASS_INPUT = 'js-form__input'
const CLASS_INPUT_ERROR = 'js-form__input-error'
const CLASS_HAS_ERROR = 'is-invalid'
const BTN_LOADING = 'btn-loading'

function submitFormAjax(e) {
    e.preventDefault()
    let $form = $(this)
    $form.find(`.${CLASS_INPUT}`).removeClass(CLASS_HAS_ERROR)
    $form.find(`.${CLASS_INPUT_ERROR}`).html('')
    let $button = $form.find('button[type=submit]')
    $button.addClass(BTN_LOADING).attr('disabled', true)
    $form.ajaxSubmit({
        success: function (data) {
            $button.removeClass(BTN_LOADING).attr('disabled', false)

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
            $button.removeClass(BTN_LOADING).attr('disabled', false)

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
        if (!$input.length) {
            $input = $form.find(':input[name="' + input + '[]"]');
        }
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
            if ($input.attr('type') !== 'checkbox') {
                $input.addClass(CLASS_HAS_ERROR);
            }
            $errorBlock.show().html(text);
        } else {
            toastr.error(text);
        }
    });
    toastr.error('Ошибка сохранения данных');
}
