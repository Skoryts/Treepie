$(document).ready(function () {
    $("#article-uploadedfile").unbind('change').bind('change', function () {
        var form = $('#article-form');
        jQuery.ajax({
            url: form.data('action-upload-file'),
            type: 'post',
            data: new FormData(form[0]),
            processData: false,
            contentType: false,
            success: function (response) {
                $.pjax.reload({container: '#article-files-grid'});
            }
        });
    });
});