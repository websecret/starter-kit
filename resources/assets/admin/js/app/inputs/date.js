require('bootstrap-datepicker');
require('bootstrap-datepicker/js/locales/bootstrap-datepicker.ru');

$('.js-input-date').each(function () {
    let $date = $(this);
    $date.datepicker({
        format: $date.data('date-format'),
        todayHighlight: true,
        language: 'ru',
    });
});