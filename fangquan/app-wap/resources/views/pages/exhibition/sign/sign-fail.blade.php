<?php App\Wap\Http\Controllers\Resource::addCSS(array('css/exhibition/sign/sign-fail')); ?>
<?php App\Wap\Http\Controllers\Resource::addJS(array('app/exhibition/sign/sign-fail')); ?>
@extends('layouts.master')
@section('content')
    <div class="register-box">
        <div class="register-form">
            <p>签到失败！</p>
            <p>对不起，您的信息未查到，如有需要请联系工作人员！</p>
            <div class="btn-box">
                <a href="JavaScript:history.back();" class="btn">返回</a>
            </div>
        </div>
    </div>
@endsection