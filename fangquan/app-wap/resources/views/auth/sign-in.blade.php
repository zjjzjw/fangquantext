<?php App\Wap\Http\Controllers\Resource::addCSS(array('css/auth/sign-in')); ?>
<?php App\Wap\Http\Controllers\Resource::addJS(array('app/auth/sign-in')); ?>

@extends('layouts.master')
@section('content')
    <div class="register-box">
        <div class="img-box">
            <img src="/www/image/exhibition/auth/top-img.jpeg" alt="">
        </div>
        <div class="register-form">
            <form id="form" method="POST">
                <div class=" form-group special">
                    <img src="/www/image/exhibition/auth/icon-1.png" alt="">
                    <input type="text" name="phone" value="" maxlength="11"
                           placeholder="请输入手机号码"
                           data-pattern="^1\d{10}$"
                           data-required="true"
                           data-descriptions="phone"
                           data-describedby="phone-description"/>
                </div>
                <div id="phone-description" class="error-tip"></div>

                <div class=" form-group special">
                    <img src="/www/image/exhibition/auth/icon-2.png" alt="">
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
                    <input type="submit" class="btn" value="登录"/>
                </div>
            </form>
        </div>
    </div>
    {{--loading--}}
    @include('common.loading-pop')
@endsection