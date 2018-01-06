<?php
ufa()->extCss([
        'developer/centrally-purchase/detail'
]);
ufa()->extJs([
        'developer/centrally-purchase/detail'
]);
?>

@extends('layouts.master')
@section('master.content')
    @include('partials.developer.developer-header')
    <div class="index-header">
        <div class="header-box">
            <p>{{$content or ''}}</p>
            <a><img src="/www/images/developer/uncollect.png" alt="">加入收藏</a>
        </div>
    </div>
    <div class="main-content">
        <div class="box-left">
            <p>项目信息</p>
            <div class="project-detail">
                <p>项目覆盖地点：<span>{{$area or ''}}</span></p>
                <p>启动时间：<span>{{$start_up_time_str or ''}}</span></p>
            </div>
            <p>联系人信息</p>
            <div class="project-detail">
                <p>联系人：<span>{{$contact or ''}}</span></p>
                <p>联系人职位：<span>{{$contacts_phone or ''}}</span></p>
                <p>联系人电话：<span>{{$contacts_position or  ''}}</span></p>
            </div>
        </div>
        <div class="box-right">
            <img src="{{$developer_info['image_url'] or ''}}" alt="">
            <p>{{$developer_info['name'] or ''}}</p>
        </div>
    </div>
@endsection