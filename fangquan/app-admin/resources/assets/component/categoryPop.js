module.exports = (function ($) {
    function Category(options) {
        var defOpts = {
            idNames: '',
            popName: '',
            name: ''
        };
        this.opts = $.extend(defOpts, options);
        this.init();
        this.showLayer();
        this.selectedNav();
        this.confirmBtn();
    }

    //执行
    Category.prototype.init = function () {
        var self = this;
        $(document).on('click', '.three-level li', function () {
            //是否选中
            for (var i = 1; i <= $('.first-level li').length; i++) {
                var dom = $('.' + self.opts.name + ' .second-level:nth-child( ' + i + ')');
                if (dom.find('.type-detail').is(':checked')) {
                    $('.first-level li:nth-child( ' + i + ') a').css('color', '#45bd57');
                } else {
                    $('.first-level li:nth-child(' + i + ') a').css('color', '#636b6f');
                }
            }
        });

        //关闭按钮
        $('.cancel-pop').click(function () {
            self.opts.popName.closePop();
            $('body').css({'overflow': 'auto'});
        });
    };

    // 弹出层
    Category.prototype.showLayer = function () {
        var self = this;
        //品类
        $(this.opts.idNames).click(function () {
            var opt = {data: {}};
            self.opts.popName.showPop(opt);
            $('.' + self.opts.name).find('ul:first-child').show();
            $('body').css({'overflow': 'hidden'});

            $('.categories-box .first-level li').removeClass('active');
            $('.categories-box .first-level li:first-child').addClass('active');

            //是否选中
            for (var i = 1; i <= $('.first-level li').length; i++) {
                var dom = $('.' + self.opts.name + ' .second-level:nth-child( ' + i + ')');
                if (dom.find('.type-detail').is(':checked')) {
                    $('.first-level li:nth-child( ' + i + ') a').css('color', '#45bd57');
                } else {
                    $('.first-level li:nth-child(' + i + ') a').css('color', '#636b6f');
                }
            }

            $("." + self.opts.name + "").scrollTop(0);
            //移动到选中的位置
            self.movingPosition(0);
        });
    };

    //nav切换
    Category.prototype.selectedNav = function () {
        var self = this;
        $(document).on('click', '.categories-box .first-level li', function () {
            var type = $(this).data('type');
            $(this).addClass('active').siblings().removeClass('active');
            $('.' + self.opts.name + ' .second-level').hide();
            $('.' + self.opts.name + ' .second-level').each(function () {
                if ($(this).data('node') == type) {
                    $(this).show();
                }
            });

            $("." + self.opts.name + "").scrollTop(0);

            //是否选中
            var dom = $('.' + self.opts.name + ' .second-level:nth-child(' + (type + 1) + ')');
            if (dom.find('.type-detail').is(':checked')) {
                $('.first-level li:nth-child(' + (type + 1) + ') a').css('color', '#45bd57');
            } else {
                $('.first-level li:nth-child(' + (type + 1) + ') a').css('color', '#636b6f');
            }
            //移动到选中的位置
            self.movingPosition(type);
        });
    };

    //移动到选中的位置
    Category.prototype.movingPosition = function (type) {
        var self = this;
        //定位
        var obj = $('.categories-box .' + self.opts.name + ' .second-level:nth-child(' + (type + 1) + ') .three-level .type-detail');
        var check_id = [];
        var check_text = [];
        for (k in obj) {
            if (obj[k].checked) {
                check_id.push($(obj[k]).data('id'));
                check_text.push(obj[k].value);
            }
        }

        if (check_id[0]) {
            $('.' + self.opts.name).stop().animate({
                scrollTop: $('#' + self.opts.name + '_' + check_id[0]).offset().top - 275
            }, 500)
        }
    };

    //确认按钮 - 勾选值获取
    Category.prototype.confirmBtn = function () {
        var self = this;
        $('.' + self.opts.name + '-confirm').click(function () {
            var obj = $('.categories-box .' + self.opts.name + ' .three-level .type-detail');
            var check_id = [];
            var check_text = [];
            for (k in obj) {
                if (obj[k].checked) {
                    check_id.push($(obj[k]).data('id'));
                    check_text.push(obj[k].value);
                }
            }
            $(self.opts.idNames).text(check_text);
            self.opts.popName.closePop();
            $('.' + self.opts.name + '_ids').val(check_id);
        });
    };

    return Category;
})(jQuery);