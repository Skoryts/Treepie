$("#search-form").submit(function () {
    $.ajax({
        url: $(this).prop('action'),
        data: $(this).serialize(),
        success: function (data) {
            $('main').html(data);
            $('html').animate({ scrollTop: 0 }, 'fast');
            //todo: add action to close the sidebar  [@tooleks]
        }
    });

    return false;
});
