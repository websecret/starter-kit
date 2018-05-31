$(document).ready(function() {

    $(document).on('click', '.nav-link', toggleActive)

    function toggleActive() {
        $('.nav-link').removeClass('active')
        $(this).addClass('active')
    }

    function init() {

        const DIV_CARD = 'div.card';

        $('[data-toggle="tooltip"]').tooltip();

        $('[data-toggle="popover"]').popover({
            html: true
        });

        $('[data-toggle="card-remove"]').on('click', function(e) {
            let $card = $(this).closest(DIV_CARD);
            $card.remove();
            e.preventDefault();
            return false;
        });

        $('[data-toggle="card-collapse"]').on('click', function(e) {
            let $card = $(this).closest(DIV_CARD);
            $card.toggleClass('card-collapsed');
            e.preventDefault();
            return false;
        });

        $('[data-toggle="card-fullscreen"]').on('click', function(e) {
            let $card = $(this).closest(DIV_CARD);
            $card.toggleClass('card-fullscreen').removeClass('card-collapsed');
            e.preventDefault();
            return false;
        });
    }

    window.init = init;
    window.init()
});