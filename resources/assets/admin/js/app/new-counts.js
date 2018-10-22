$(document).on('click', '.js_update-count-click', updateCounts);

function updateCounts() {
    $.get('/admin/new-counts', (response) => {
        $.each(response, function (key, item) {
            let type = item.type;
            let count = item.count;
            let selector = `.js_new__${key}-count`;

            let $badge = $(selector);
            if (!$badge.data('cloned')) {
                let dataType = $badge.data('type');
                if (dataType) {
                    $badge.removeClass(`badge-${dataType}`);
                }
                if (type) {
                    $badge.data('type', type);
                    $badge.addClass(`badge-${type}`);
                }
                $badge.text(count ? count : '');

                let $dropdownMenu = $badge.closest('.dropdown-menu');
                if ($dropdownMenu.length) {
                    let $navLink = $dropdownMenu.closest('.dropdown').find('.nav-link');
                    $navLink.remove(selector);
                    $navLink.append($badge.clone().data('cloned', true));
                }
            }
        })
    })
}

updateCounts();

window.updateCounts = updateCounts;

setInterval(() => updateCounts(), 30000)