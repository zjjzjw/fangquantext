<?php App\Wap\Http\Controllers\Resource::addCSS(array('css/exhibition/sign/sign')); ?>
<?php App\Wap\Http\Controllers\Resource::addJS(array('app/exhibition/sign/sign')); ?>

@extends('layouts.master')
@section('content')
    <div class="register-box">
        <div class="register-form">

            <form id="form" method="POST">
                <div class="form-group special">
                    <span>姓名</span>
                    <input type="text" name="name" value="" maxlength="32" placeholder="请输入姓名"
                           data-required="true"
                           data-descriptions="name"
                           data-describedby="name-description"/>
                </div>
                <div id="name-description" class="error-tip"></div>

                <div class=" form-group special">
                    <span>电话</span>
                    <input type="text" name="phone" value="" maxlength="11"
                           placeholder="+86 请输入手机号码"
                           data-pattern="^1\d{10}$"
                           data-required="true"
                           data-descriptions="phone"
                           data-describedby="phone-description"/>
                </div>
                <div id="phone-description" class="error-tip"></div>

                <div class=" form-group special">
                    <input type="button" class="get-number" value="获取验证码"/>
                    <input type="text" name="ver_code" value="" maxlength="6"
                           placeholder="验证码"
                           data-validation-regexp="^\d{6}$"
                           data-required="true"
                           data-descriptions="ver_code"
                           data-describedby="ver_code-description"/>
                </div>
                <div id="ver_code-description" class="error-tip"></div>

                <div class="btn-box">
                    <input type="hidden" name="id" value="0">
                    <input type="hidden" name="type" value="4">
                    <input type="submit" class="btn" value="完成"/>
                </div>
            </form>
        </div>
    </div>
    {{--loading--}}
    @include('common.loading-pop')

    <script type="text/html" id="promptTpl">
        <div class="prompt-box">
            <div class="hint-title">提示</div>
            <div class="hint-content">
                <p class="text"></p>
            </div>
            <div class="hint-btn">
                <a href="javascript:void(0);" class="save" id="pop_close">确定</a>
            </div>
        </div>
    </script>
@endsection