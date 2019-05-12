require('froala-editor/js/froala_editor.pkgd.min');
require('froala-editor/js/third_party/embedly.min');
require('froala-editor/js/languages/ru');


$(document).ready(function() {

    // $(document).on('click', '.nav-link', toggleActive)
    //
    // function toggleActive() {
    //     $('.nav-link').removeClass('active')
    //     $(this).addClass('active')
    // }

    let $modalRelatedTargets = [];
    $('#modal').on('show.bs.modal', function (e) {
        let $button = $(e.relatedTarget)
        $modalRelatedTargets.push($button)
        let url = $button.data('url')
        $.get(url, (response) => {
            let $popup = $(this).find('.modal-content')
            $popup.html(response.html)
            window.init()
        })
    })
    $(document).on('hidden.bs.modal', function (e) {
        if($modalRelatedTargets) $modalRelatedTargets = $modalRelatedTargets.slice(0, -1);
        let $modal = $(this)
        if($modal.attr('id') == 'modal') {
            $modal.find('.modal-content').html('')
        }
    });

    $(document).on('form-ajax-success', function(e, data, isModal) {
        let entity = data.entity
        if(isModal && $modalRelatedTargets.length) {
            let $modalRelatedTarget = $modalRelatedTargets[0];
            if($modalRelatedTarget.hasClass('js-input-wysiwyg__extended-button')) {
                let $input = $modalRelatedTarget.closest('.js-form__wrapper').find('.js-input-wysiwyg');
                insertWysiwygEntity($input, entity, data.id);
            }
        }
    })

    function insertWysiwygEntity($wysiwyg, entity, id) {
        let string = '$' + entity + '-' + id;
        $wysiwyg.froalaEditor('html.insert', '<p>' + string + '</p>', true);
    }

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
            let $input = $(this);
            $input.froalaEditor({
                language: 'ru',
                iconsTemplate: 'font_awesome_5',
                theme: 'gray',
                imageManager: false,
                pluginsEnabled: [
                    'align', 'charCounter', 'codeBeautifier', 'codeView', 'colors', 'draggable', 'emoticons', 'entities', 'file', 'fontFamily', 'fontSize', 'fullscreen', 'image', 'inlineStyle', 'lineBreaker', 'link', 'lists', 'paragraphFormat', 'paragraphStyle', 'quote', 'save', 'table', 'url', 'video', 'embedly', 'wordPaste',
                ],
                requestHeaders: {
                    'X-CSRF-TOKEN': token.content,
                },
                imageUploadURL: '/admin/upload/froala-images',
                videoUpload: false,
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
                    'insertLink', 'insertImage', 'insertVideo', 'embedly',  'insertTable',
                    '|',
                    'insertHR', 'selectAll', 'clearFormatting',
                    '|',
                    'undo', 'redo'
                ],
            });
        });
        


        window.selectize()
        window.initSlug()
    }

    window.init = init;
    window.init()
});