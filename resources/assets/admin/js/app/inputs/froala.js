require('froala-editor/js/froala_editor.pkgd.min');
require('froala-editor/js/languages/ru');

$('.js-input__wysiwyg').each(function () {
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