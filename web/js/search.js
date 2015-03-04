$("#search-form").submit(function () {
    $.ajax({
        url: $(this).prop('action'),
        data: $(this).serialize(),
        success: function (data) {
            $('.content').html(data);
            $('html').animate({ scrollTop: 0 }, 'fast');
        }
    });

    return false;
});