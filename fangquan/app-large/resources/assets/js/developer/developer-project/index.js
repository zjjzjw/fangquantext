(function ($, Vue) {
    $.scrollUp({
        scrollSpeed: 200,
        scrollImg: true
    });

    $('.category').click(function () {
        var id = $(this).data('id');
        $('.category-box').hide();
        $('#show-category-box-' + id).show();
    });

    $('.area').click(function () {
        var id = $(this).data('id');
        $('.area-box').hide();
        $('#show-area-box-' + id).show();
    });

})(jQuery, Vue);
