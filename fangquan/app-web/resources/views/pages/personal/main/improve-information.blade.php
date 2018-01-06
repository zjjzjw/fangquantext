<?php
ufa()->extCss([
    'personal/main/improve-information'
]);
ufa()->extJs([
    '../lib/jquery-form-validator/jquery.form-validator',
    'personal/main/improve-information'
]);
ufa()->addParam(
    [
        'id'          => $id ?? 0,
        'areas'       => $areas ?? [],
        'province_id' => $province_id ?? 0,
        'city_id'     => $city_id ?? 0,
    ]
);
?>
@extends('layouts.master')
@section('master.content')
    <div class="wrapper-box">
        @include('partials.personal.personal-main-header')
        <div class="title">
            <h3>手机验证修改</h3>
        </div>
        <div class="content-box">
            {{--我的账户 -s--}}
            <div class="part-one">
                <h3 class="my-account">
                    <span>我的账户</span>
                    【<a href="{{route('personal.main')}}">回到账户中心首页</a>】
                </h3>
                <ul>
                    <li>
                        <a href="">
                            <img src="/www/images/personal/01.png" alt="">
                            <span>完善个人资料</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="/www/images/personal/02.png" alt="">
                            <span>账户安全</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="/www/images/personal/03.png" alt="">
                            <span>我的收藏</span>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img src="/www/images/personal/04.png" alt="">
                            <span>我的数据</span>
                        </a>
                    </li>
                </ul>
            </div>
            {{--我的账户-e--}}

            {{--基本信息 -s--}}
            <div class="part-two">
                <form class="form-horizontal" onsubmit="return false">
                    <h3>基本信息</h3>
                    <div class="input-group">
                        <label>真实姓名</label>
                        <div>
                            <input type="text" name=""
                                   data-validation="required length"
                                   data-validation-length="max50"
                                   data-validation-error-msg="请输入真实姓名"/>
                        </div>
                    </div>
                    <div class="input-group">
                        <label>昵称</label>
                        <div>
                            <input type="text" name=""
                                   data-validation="length"
                                   data-validation-length="max50"
                                   data-validation-error-msg="请输入昵称"/>
                        </div>
                    </div>
                    <div class="input-group">
                        <label>称谓</label>
                        <div class="multiple">
                            <input id="appellation_1" name="appellation" type="radio" value="">
                            <label for="appellation_1">女士</label>
                        </div>
                        <div class="multiple">
                            <input id="appellation_2" name="appellation" type="radio" value="">
                            <label for="appellation_2">先生</label>
                        </div>
                    </div>
                    <div class="input-group">
                        <label>手机号</label>
                        <div class="exposes">
                            <span>17135502300</span>
                            <a href="JavaScript:;">修改验证</a>
                        </div>
                    </div>
                    <div class="input-group">
                        <label>邮箱</label>
                        <div class="exposes">
                            <span>1686692766@qq.com</span>
                            <a href="JavaScript:;">修改验证</a>
                        </div>
                    </div>
                    <div class="input-group">
                        <label>QQ</label>
                        <div>
                            <input type="text" name=""
                                   data-validation="length"
                                   data-validation-length="max50"
                                   data-validation-error-msg="请输入QQ"/>
                        </div>
                    </div>
                    <div class="input-group">
                        <label>职务</label>
                        <div>
                            <input type="text" name=""
                                   data-validation="required length"
                                   data-validation-length="max50"
                                   data-validation-error-msg="请输入职务"/>
                        </div>
                    </div>
                    <h3>公司信息</h3>
                    <div class="input-group">
                        <label>公司</label>
                        <div>
                            <input type="text" name=""
                                   data-validation="required length"
                                   data-validation-length="max50"
                                   data-validation-error-msg="请输入公司"/>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>公司性质</label>
                        <div>
                            <input type="text" name=""
                                   data-validation="required length"
                                   data-validation-length="max50"
                                   data-validation-error-msg="请输入公司性质"/>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>公司所在地</label>

                        <div class="inline-areas">
                            <select name="province_id" id="province_id"
                                    data-validation="required"
                                    data-validation-error-msg="请选择省份"></select>

                        </div>
                        <div class="inline-areas">
                            <select name="city_id" id="city_id"
                                    data-validation="required"
                                    data-validation-error-msg="请选择城市"></select>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>地址</label>
                        <div>
                            <input type="text" name=""
                                   data-validation="required length"
                                   data-validation-length="max50"
                                   data-validation-error-msg="请输入地址"/>
                        </div>
                    </div>

                    <div class="input-group">
                        <label>所选品类</label>
                        <div>
                            <input type="text" name=""
                                   data-validation="required length"
                                   data-validation-length="max50"
                                   data-validation-error-msg="请输入所选品类"/>
                        </div>
                    </div>
                    <h3>上传头像</h3>
                    <div class="input-group">
                        <div class="img-box">
                            @include('common.add-picture', [
                                    'single' => true,
                                    'tips' => '上传头像',
                                    'name' => 'patent_image',
                                    'images' => $patent_image ?? [],
                               ])
                        </div>
                    </div>
                    <div class="input-group">
                        <input type="submit" class="button save" value="提交">
                    </div>
                </form>
            </div>
            {{--基本信息-e--}}
        </div>
    </div>
@endsection