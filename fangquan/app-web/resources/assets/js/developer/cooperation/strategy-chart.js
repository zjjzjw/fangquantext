$(function () {

    $(document).on('click', '.table tbody td', function () {
        $(this).find('ul').show().parent('td').siblings().find('ul').hide();
    });
});

