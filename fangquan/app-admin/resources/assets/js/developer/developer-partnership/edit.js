$(function () {
    var Popup = require('../../../component/popup');
    var datetimepicker = require('../../../lib/datetimepicker/jquery.datetimepicker');
    var service = require('../../../service/developer/developerPartnershipService');
    var Search = require('./../../../component/search');

    $successPop = new Popup({
        width: 200,
        height: 150,
        contentBg: '#fff',
        maskColor: '#000',
        maskOpacity: '0.6',
        content: $('#successTpl').html()
    });
    $loadingPop = new Popup({
        width: 128,
        height: 128,
        contentBg: 'transparent',
        maskColor: '#000',
        maskOpacity: '0.6',
        content: $('#loadingTpl').html()
    });

    $promptPop = new Popup({
        width: 400,
        height: 225,
        contentBg: '#fff',
        maskColor: '#000',
        maskOpacity: '0.6',
        content: $('#promptTpl').html()
    });

    $.validate({
        form: '#form',
        validateOnBlur: false,
        onSuccess: function ($form) {
            moreValidate();
            return false;
        }
    });

    $productPop = new Popup({
        width: 940,
        height: 670,
        contentBg: '#fff',
        maskColor: '#000',
        maskOpacity: '0.6',
        content: $('#productTpl').html()
    });

    //产品分类
    $('.purchase-category .type-click').click(function () {
        var opt = {data: {}};
        $productPop.showPop(opt);
        $('body').css({'overflow': 'hidden'});
    });

    $('.cancel-top').click(function () {
        $productPop.closePop();
        $('body').css({'overflow': 'auto'});
    });
    //全选
    $(".all").click(function () {
        if ($(this).prop('checked')) {
            $(this).next().next().find('input').prop("checked", true);
        } else {
            $(this).next().next().find('input').prop("checked", false);
        }
    });
    //各选
    $(".type-detail").click(function () {
        if ($(this).parent().parent().parent().find('.all').prop('checked')) {
            $(this).parent().parent().parent().find('.all').prop("checked", false);
        }
    });
    //产品勾选值获取
    $('#select-confirm').click(function () {
        var obj = $('.type-detail');
        var check_id = [];
        var check_text = [];
        for (k in obj) {
            if (obj[k].checked) {
                check_id.push($(obj[k]).data('id'));
                check_text.push(obj[k].value);
            }
        }
        $('.purchase-category .type-click').text(check_text);
        $productPop.closePop();
        $('.product_category_ids').val(check_id);
    });

    //时间筛选
    $('.date').datetimepicker({
        timepicker: false,
        format: 'Y-m-d H:i:s',
        formatTime: 'H:i:s',
        formatDate: 'Y/m/d',
        closeOnDateSelect: true,
        scrollInput: false,
        lang: 'zh',
    });

    function moreValidate() {
        var product_category_ids = $('.product_category_ids').val();
        if (!product_category_ids) {
            $('.error-category_ids').show();
        } else if (parseInt($.params.id) == 0) {
            $('.error-category_ids').hide();
            var opt = {data: {}};
            service.store({
                data: $('#form').serialize(),
                params: $.params,
                beforeSend: function () {
                    $loadingPop.showPop(opt);
                },
                sucFn: function (data, status, xhr) {
                    $loadingPop.closePop();
                    $successPop.showPop(opt);
                    setTimeout(skipUpdate, 2000);

                    function skipUpdate() {
                        $successPop.closePop();
                        window.location.href = '/developer/developer-partnership/index';
                    }
                },
                errFn: function (data, status, xhr) {
                    $loadingPop.closePop();
                    $('.text').html(showError(data));
                    $promptPop.showPop(opt);
                }
            });
        } else {
            $('.error-category_ids').hide();
            var opt = {data: {}};
            service.update({
                data: $('#form').serialize(),
                params: $.params,
                beforeSend: function () {
                    $loadingPop.showPop(opt);
                },
                sucFn: function (data, status, xhr) {
                    $loadingPop.closePop();
                    $successPop.showPop(opt);
                    setTimeout(skipUpdate, 2000);

                    function skipUpdate() {
                        $successPop.closePop();
                        window.location.href = '/developer/developer-partnership/index';
                    }
                },
                errFn: function (data, status, xhr) {
                    $loadingPop.closePop();
                    $('.text').html(showError(data));
                    $promptPop.showPop(opt);
                }
            });
        }
    }

    $(document).on('click', '#pop_close', function () {
        $promptPop.closePop();
    });

    //开发商下拉功能
    $(document).on('click', '.developer', function () {
        var autoComplete = new Search({
            keyword: '#developer-association',
            resources: service.getDeveloperByKeyword
        });

        autoComplete.on('search_box_selected', function (data, event) {
            renderInfo.call(this, data, event);
        });
        autoComplete.on('search_box_focus', function (data, event) {
            renderInfo.call(this, data, event);
        });

        function renderInfo(data, event) {
            var item = data.item;
            $('#developer_id').val(item.id);
        }
    });

    $('.developer').blur(function () {
        var developer_id = $(this).next('#developer_id').val();
        if (!developer_id){
            $('.developer').val('');
        }
    });

    $('.provider').blur(function () {
        var provider_id = $(this).next('#provider_id').val();
        if (!provider_id){
            $('.provider').val('');
        }
    });

    //供应商下拉功能
    $(document).on('click', '.provider', function () {
        var autoComplete = new Search({
            keyword: '#provider-association',
            resources: service.getProviderByKeyword
        });

        autoComplete.on('search_box_selected', function (data, event) {
            renderInfo.call(this, data, event);
        });
        autoComplete.on('search_box_focus', function (data, event) {
            renderInfo.call(this, data, event);
        });

        function renderInfo(data, event) {
            var item = data.item;
            $('#provider_id').val(item.id);
        }
    });

    function showError(data) {
        var info = '';
        var messages = [];
        var i = 0;
        for (var key in data) {
            messages.push(++i + "、" + data[key][0]);
        }
        info = messages.join('</br>');
        return info;
    }
});