$(function () {
    var Popup = require('../../../component/popup');
    var temp = require('../../../component/temp');
    var Area = require('../../../component/area');
    var Category = require('../../../component/categoryPop');
    var datetimepicker = require('../../../lib/datetimepicker/jquery.datetimepicker');
    var service = require('../../../service/developer/developerProjectService');
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

    $projectPop = new Popup({
        width: 940,
        height: 670,
        contentBg: '#fff',
        maskColor: '#000',
        maskOpacity: '0.6',
        content: $('#projectTpl').html()
    });

    $categoriesPop = new Popup({
        width: 940,
        height: 670,
        contentBg: '#fff',
        maskColor: '#000',
        maskOpacity: '0.6',
        content: $('#categoriesTpl').html()
    });

    //涉及产品分类 - 弹层
    var category = new Category({
        'idNames': '.product-pop .type-click',
        'popName': $categoriesPop,
        'name': 'product-categories'
    });

    //项目分类
    $('.project-categorys .type-click').click(function () {
        var opt = {data: {}};
        $projectPop.showPop(opt);
        $('body').css({'overflow': 'hidden'});
    });

    $('.cancel-top').click(function () {
        $projectPop.closePop();
        $('body').css({'overflow': 'auto'});
    });

    //产品勾选值获取
    $('#select-project').click(function () {
        var obj = $('.project-type-detail');
        var check_id = [];
        var check_text = [];
        for (k in obj) {
            if (obj[k].checked) {
                check_id.push($(obj[k]).data('id'));
                check_text.push(obj[k].value);
            }
        }
        $('.project-categorys .type-click').text(check_text);
        $projectPop.closePop();
        $('.project_category_ids').val(check_id);
    });

    $.validate({
        form: '#form',
        validateOnBlur: false,
        onSuccess: function ($form) {
            moreValidate();
            return false;
        }
    });

    //地址删选
    var area = new Area({'idNames': ['province_id', 'city_id'], 'data': $.params.areas});
    area.selectedId($.params.province_id, $.params.city_id);

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
        if (parseInt($.params.id) == 0) {
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
                        window.location.href = '/developer/' + $.params.developer_id + '/developer-project/index';
                    }
                },
                errFn: function (data, status, xhr) {
                    $loadingPop.closePop();
                    $('.text').html(showError(data));
                    $promptPop.showPop(opt);
                }
            });
        } else {
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
                        window.location.href = '/developer/' + $.params.developer_id + '/developer-project/index';
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
    var autoComplete = new Search({
        keyword: '#keyword',
        resources: service.getKeyword
    });

    autoComplete.on('search_box_selected', function (data, event) {
        renderInfo.call(this, data, event);
    });
    autoComplete.on('search_box_focus', function (data, event) {
        renderInfo.call(this, data, event);
    });

    function renderInfo(data, event) {
        var item = data.item;
        $('#centrally_purchases_id').val(item.id);
    }

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