require('tempusdominus-bootstrap-4');

$(document).on('multiple-added', '.js-multiple__row', function() {
    init($(this));
});

let init = ($wrapper = null) => {
    if($wrapper == null) {
        $wrapper = $(document);
    }
    $wrapper.find('.js-input-datetime').each(function () {
        let $wrapper = $(this);
        let id = $wrapper.attr('id') + _.random(100000, 999999, false);
        let $input = $wrapper.find('.js-form__input');
        let $append = $wrapper.find('.input-group-append');
        $wrapper.attr('id', id);
        $input.data('target', '#' + id);
        $append.data('target', '#' + id);
        $wrapper.datetimepicker({
            format: $input.data('date-time-format'),
            locale: 'ru',
        });
    });
};

init();
