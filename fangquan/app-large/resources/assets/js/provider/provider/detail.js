(function ($, Vue) {
    $.scrollUp({
        scrollSpeed: 200,
        scrollImg: true
    });

    var companyInfo = $('.company-info');
    companyInfo.selector = '.company-info';
    companyInfo.readmore(
        {
            collapsedHeight: 50,
            speed: 20
        });
})(jQuery, Vue);

