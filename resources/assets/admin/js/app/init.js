require('froala-editor/js/froala_editor.pkgd.min');
require('froala-editor/js/languages/ru');

require('selectize')


$(document).ready(function() {

    // $(document).on('click', '.nav-link', toggleActive)
    //
    // function toggleActive() {
    //     $('.nav-link').removeClass('active')
    //     $(this).addClass('active')
    // }

    function init() {

        const DIV_CARD = 'div.card';

        $('.tooltip').remove()
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

        $('.js-input-selectize').selectize({
            delimiter: ',',
            persist: false
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

        $('.js-input-wysiwyg').each(function () {
            $(this).froalaEditor({
                language: 'ru',
                theme: 'gray',
                imageManager: false,
                pluginsEnabled: [
                    'align', 'charCounter', 'codeBeautifier', 'codeView', 'colors', 'draggable', 'emoticons', 'entities', 'file', 'fontFamily', 'fontSize', 'fullscreen', 'image', 'inlineStyle', 'lineBreaker', 'link', 'lists', 'paragraphFormat', 'paragraphStyle', 'quote', 'save', 'table', 'url', 'video', 'wordPaste',
                ],
                requestHeaders: {
                    'X-CSRF-TOKEN': token.content,
                },
                toolbarButtons: [
                    'fullscreen',
                    '|',
                    'html',
                    '|',
                    'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript',
                    '|',
                    'fontSize', 'color',
                    '|',
                    'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote',
                    '|',
                    'insertLink', 'insertImage', 'insertTable',
                    '|',
                    'insertHR', 'selectAll', 'clearFormatting',
                    '|',
                    'undo', 'redo'
                ],
            });
        });
    }

    window.init = init;
    window.init()
});