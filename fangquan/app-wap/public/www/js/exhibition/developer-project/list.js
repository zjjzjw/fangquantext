define([
    'zepto',
    'page.params',
    'zepto.sp',
    'app/exhibition/developer-project/ui/ui.commonlist'
], function ($, params, sp, commonlist) {
    'use strict';

    //搜索框
    $(".keyword").keypress(function (event) {
        if (event.which == 13) {
            var searchContent = $('.keyword').val();
            window.location.href = '/exhibition/developer-project/list?keyword=' + searchContent;
        }
    });

    var List = function () {

        var self = this;
        self.pageInfo = params.pageInfo;//分页
        self.status = [0, 0, 0, 0];
        self.mask = $('.mask');
        self.init();
        self.bindEvent();
    };

    List.prototype.bindEvent = function () {
        var self = this;

        //筛选
        $('.parentup').on('click', function () {
            $(this).parent().addClass('special-img');
            $(this).parent().siblings().removeClass('special-img');
            if ($(this).hasClass('high')) {
                $('.parentup').removeClass('high');
                $('html,body').css('overflow', 'auto');
                $('.g-touchicon-l').addClass('revolve');
                $('#dialog').hide();
                $('.optionlist').hide();
            } else {
                $('html,body').css('overflow', 'hidden');
                $('.parentup').removeClass('high');
                $('.g-touchicon-l').addClass('revolve');
                $(this).addClass('high');
                $(this).next().removeClass('revolve');
                $(this).next().next().show();
                $('#dialog').show();
                $('.optionlist').show();
                //区分筛选条件
                var type = $(this).data('type');
                $('.menunav-info').eq(type).show().siblings().hide();
                $('.close-info').on('click', function () {
                    $('#closeInfo').show();
                });
                $('.principal').on('click', function () {
                    $('#principal').show();
                });
                $('.phase').on('click', function () {
                    $('#phase').show();
                });
            }
        });

        //点击灰色区域隐藏浮层
        $('#dialog').on('click', function () {
            $('.parentup').removeClass('high');
            $('.g-touchicon-l').addClass('revolve');
            $('.optionlist').hide();
            $(this).hide();
            $(".parentup").parent().removeClass('special-img');
            $('html,body').css('overflow', 'auto');
        });

        //所在地一级二级处理
        $('.region-item a').on('click', function () {
            var province_id;
            if ($(this).attr("href") == '#') {

                $('.region-item ').css('width', '50%');
                $(this).addClass('active').parent()
                    .siblings('li').find(' a').removeClass('active');

                province_id = $(this).data('id');
                $('.province-info').hide();
                $('#blockinfo-' + province_id).show();
                return false;
            }
            return true;
        });

        //分页
        sp.subscribe('waterfall_succ', function (data) {
            var qs = location.search,
                reg = /page=(\d+)/,
                result,
                page = data.current_page;

            if (!qs) {
                result = qs + '?page=' + self.pageInfo.current_page;
            } else if (reg.exec(qs) === null) {
                result = qs + '&page=' + self.pageInfo.current_page;
            } else {
                result = qs.replace(reg, 'page=' + self.pageInfo.current_page);
            }
        });
        self.waterfall = commonlist();
    };

    List.prototype.init = function () {
        var self = this;

    };
    new List();
});