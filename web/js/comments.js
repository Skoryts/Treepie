$('body').on('beforeSubmit', 'form#comment-form', function () {
    var form = $(this);
    if (form.find('.has-error').length) {
        return false;
    }

    $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        success: function (data) {
            $('.comments > ul').append(data);
        }
    });

    return false;
});