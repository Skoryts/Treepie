$("#search-form").submit(function () {
    $.ajax({
        url: $(this).prop('action'),
        data: $(this).serialize(),
        success: function (data) {
            $('.content').html(data);
            //todo: animate not working in Chromium (Version 40.0.2214.111 Ubuntu 14.04 (64-bit)) ?!! [@tooleks]
            $('html').animate({ scrollTop: 0 }, 'fast');
        }
    });

    return false;
});