$(document).ready(function () {
    $('#huabbbody').trumbowyg({
        btns: [
            ['viewHTML'],
            ['undo', 'redo'], // Only supported in Blink browsers
            ['formatting'],
            ['strong', 'em', 'del'],
            ['foreColor', 'backColor'],
            ['fontfamily'],
            ['fontsize'],
            ['superscript', 'subscript'],
            ['link'],
            ['emoji'],
            ['specialChars'],
            ['base64'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            ['horizontalRule'],
            ['removeformat'],
            ['fullscreen']
        ],
        plugins: {
            resizimg: {
                minSize: 64,
                step: 1,
            }
        },
        autogrow: true,
        svgPath: '/site/wysisygicon.svg',
        lang: 'ja'
    });
});