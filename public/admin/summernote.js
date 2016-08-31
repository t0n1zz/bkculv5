$('#editor').summernote({
    minHeight: 300,
    maximumImageFileSize: 1242880,
    placeholder: 'Silahkan isi disini...',
    toolbar: [
        ['para',['style']],
        ['style', ['bold', 'italic', 'underline', 'hr']],
        ['font', ['strikethrough', 'superscript', 'subscript','clear']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol']],
        ['paragraph',['paragraph']],
        ['table',['table']],
        ['height', ['height']],
        ['insert',['link','picture','video']] ,
        ['misc',['fullscreen','codeview']],
        ['misc2',['undo','redo']]
    ],
    callbacks: {
        onPaste: function (e) {
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            e.preventDefault();
            document.execCommand('insertText', false, bufferText);
        }
    }
});