$(document).ready(function () {
    $('.tags-tab > a').click(function (event) {
        event.preventDefault();
        //todo: fix href location after setting up url manager rules [@tooleks]
        window.location.href = '/article/tag?tag=' + $(this).text().replace('#', '');
    });
});
