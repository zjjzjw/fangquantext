$(function () {
    var Popup = require('../../../component/popup');
    var temp = require('../../../component/temp');
    var fileupload = require('../../../component/fileupload');
    var Area = require('../../../component/area');
    var service = require('../../../service/developer/developerService');
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

    function statInputNum(textArea, numItem) {
        var curLength;
        curLength = textArea.val().length;
        numItem.text(curLength);
        textArea.on('input propertychange', function () {
            var _value = $(this).val().replace(/\n/gi, "");
            numItem.text(_value.length);
        });
    }

    // 分级原则
    var textarea = $("#principles"),
        textArea = textarea.find("textarea"),
        totalNum = textarea.find(".number");
    statInputNum(textArea, totalNum);

    //分项目落地决策
    var textarea = $("#decision"),
        textArea = textarea.find("textarea"),
        totalNum = textarea.find(".number");
    statInputNum(textArea, totalNum);

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
                        window.location.href = '/developer/developer/index';
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
                        window.location.href = '/developer/developer/index';
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


    //上传缩略图
    fileupload({
        acceptFileTypes: ['plain', 'jp*g', 'png', 'gif', 'bmp'],
        dom: $('#addPicture-logo'),
        start: function (e, data) {
            var opt = {data: {}};
            $loadingPop.showPop(opt);
        },
        always: function (e, data, Errors) {
        },
        progress: function (e, data) {
            var loaded = e.delegatedEvent['loaded'];
            var total = e.delegatedEvent['total'];

            $('.upload-progress').html((Number(loaded / total * 100)).toFixed(2) + '%');
        },
        callback: function (result, data) {
            $loadingPop.closePop();
            var tempFiles = temp('files_tpl', {
                data: data,
                result: result,
                name: 'logo',
                single: true
            });

            $('.add-logo').before(tempFiles);
            $('.add-logo').css('border-color', '#d9d9d9');
            $('.add-logo').hide();

            //图片删除
            $('.picture-box-logo .show-item').on('click', '.delete', function () {
                $(this).parent('.show-item').remove();
                $('.add-logo').show();
            });
        }
    });

    //删除
    $('.picture-box-logo .show-item').on('click', '.delete', function () {
        $(this).parent('.show-item').remove();
        $('.add-logo').show();
    });

    //地址
    var area = new Area({'idNames': ['province_id', 'city_id'], 'data': $.params.areas});
    area.selectedId($.params.province_id, $.params.city_id);


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