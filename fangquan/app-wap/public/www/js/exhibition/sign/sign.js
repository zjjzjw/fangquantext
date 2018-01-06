define(['zepto', 'page.params', 'validate',
    'ui.popup', 'app/service/exhibition/sign/signService'
], function ($, params, mvalidate, Popup, service) {
    'use strict';


    var $loadingPop, $promptPop;

    $loadingPop = new Popup({
        width: 128,
        height: 128,
        contentBg: 'transparent',
        maskColor: '#000',
        maskOpacity: '0.6',
        content: $('#loadingTpl').html()
    });

    $promptPop = new Popup({
        width: 280,
        height: 150,
        contentBg: '#fff',
        maskColor: '#000',
        maskOpacity: '0.6',
        content: $('#promptTpl').html()
    });

    var phone;

    //获取验证码
    $('.get-number').click(function () {
        var opt = {data: {}};
        var data = {};
        phone = $('input[name="phone"]').val();
        var type = $('input[name="type"]').val();
        var error_message = $('.error-message').html();
        data.phone = phone;
        data.type = type;
        var self = $(this);
        var countdown = 60;
        var headler;
        if (phone.length) {
            self.attr("disabled", true);
            self.val(countdown + 's重新发送');
            countdown--;
            service.verifyCode({
                data: data,
                sucFn: function (data, status, xhr) {
                    self.attr("disabled", true);
                    self.val(countdown-- + 's重新发送');
                    headler = setInterval(function () {
                        if (countdown == 0) {
                            self.removeAttr("disabled");
                            self.val("获取验证码");
                            clearInterval(headler);
                        } else {
                            self.val(countdown + 's重新发送');
                            countdown--;
                        }
                    }, 1000);

                },
                errFn: function (data, status, xhr) {
                    self.val("获取验证码");
                    $('.hint-content .text').html(showError(data));
                    $promptPop.showPop();
                }
            });
        }
    });

    //完成签到
    $('#form').mvalidate({
        type: 2,
        onKeyup: true,
        sendForm: false,
        firstInvalidFocus: true,
        valid: function (event, options) {
            //点击提交按钮时, 表单通过验证触发函数
            $loadingPop.showPop();
            service.store(
                {
                    data: $('#form').serialize(),
                    sucFn: function (data, status, xhr) {
                        $loadingPop.closePop();
                        window.location.href = '/exhibition/sign/sign-success?user_id=' + data.id;
                    },
                    errFn: function (data, xhr, errorType, error) {
                        $loadingPop.closePop();
                        if (data.ver_code && data.ver_code[0] == '验证码错误') {
                            $('.hint-content .text').html('验证码输入错误');
                            $promptPop.showPop();
                        } else {
                            window.location.href = '/exhibition/sign/sign-fail';
                        }
                    }
                }
            );
            event.preventDefault();
        },
        invalid: function (event, status, options) {
            //点击提交按钮时,表单未通过验证触发函数
        },
        eachField: function (event, status, options) {
            //点击提交按钮时,表单每个输入域触发这个函数 this 执向当前表单输入域，是jquery对象
        },
        eachValidField: function (val) {
        },
        eachInvalidField: function (event, status, options) {
        },
        descriptions: {
            name: {
                required: '请输入姓名',
                valid: ''
            },
            phone: {
                required: '请输入电话',
                pattern: '请正确输入手机号码',
                valid: ''
            },
            ver_code: {
                required: '请输入验证码',
                valid: ''
            }
        }
    });

    $(document).on('click', '#pop_close', function () {
        $promptPop.closePop();
    });

    //权限信息数据处理
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
