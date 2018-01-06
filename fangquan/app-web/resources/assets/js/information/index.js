$(function () {
    var temp = require('../../component/temp');
    var service = require('../../service/exhibition/informationService');
    var page = 1;
    window.addEventListener("scroll", function(event) {
        var scrollTop = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
        if(document.documentElement.scrollHeight == document.documentElement.clientHeight + scrollTop ) {
            var opt = {data: {}};
            var $data_dom = $('.information-box');
            page = page + 1;
            service.lookMore({
                data: {page: page},
                sucFn: function (data, status, xhr) {
                    var tpl = temp('show_moreTpl', {
                        'data': data
                    });
                    $data_dom.append(tpl);
                },
                errFn: function (data, xhr, errorType, error) {
                }
            });
        }
    });
});