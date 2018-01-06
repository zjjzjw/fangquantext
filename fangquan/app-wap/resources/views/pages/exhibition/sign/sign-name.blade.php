<?php App\Wap\Http\Controllers\Resource::addCSS(array('css/exhibition/sign/sign-name')); ?>
<?php App\Wap\Http\Controllers\Resource::addJS(array('app/exhibition/sign/sign-name')); ?>

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

                <span class="error-message"></span>
                <div class="btn-box">
                    <input type="hidden" name="id" value="0">
                    <input type="submit" class="btn" value="完成"/>
                </div>
            </form>
        </div>
    </div>
    {{--loading--}}
    @include('common.loading-pop')
@endsection