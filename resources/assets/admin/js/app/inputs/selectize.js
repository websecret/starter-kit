require('selectize');

$(document).on('multiple-added', '.js-multiple__row', function() {
    init($(this));
});

function init ($wrapper = null) {
    if ($wrapper == null) {
        $wrapper = $(document);
    }
    $wrapper.find('.js-input-selectize').each(function () {
        let $input = $(this);
        if ($input.parents('.js-multiple__row--clone').length > 0) {
            return
        }
        let options = {
            delimiter: ',',
            persist: false,
        };
        let link = $input.data('ajax-link');
        if (link) {
            options = {
                ...options,
                valueField: 'key',
                labelField: 'value',
                searchField: 'value',
                load: function (query, callback) {
                    if (!query.length) return callback();
                    $.get(link + '?q=' + query, function (result) {
                        callback(result.slice(0, 20));
                    });
                },
            }
        }
        $input.selectize(options);
    });
};

window.selectize = init;