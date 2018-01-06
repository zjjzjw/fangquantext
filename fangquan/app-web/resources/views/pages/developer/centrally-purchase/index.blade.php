<?php
ufa()->extCss([
        'developer/centrally-purchase/index'
]);
ufa()->extJs([
        'developer/centrally-purchase/index'
]);
?>
@extends('layouts.master')
@section('master.content')
    @include('partials.developer.developer-header')
    <div class="index-header">
        <div class="header-box">
            <p>您已选品类：<span>地板，油烟机</span><span>（可添加品类哦！）</span></p>
            <a class="export-btn">导出</a>
        </div>
    </div>
    <div class="main-content">
        <ul class="content-ul">
            <li>
                <p style="width:4%;"></p>
                <a href="">
                    <p style="width:19%;">公司</p>
                    <p style="width:35%;">招标内容</p>
                    <p style="width:34%;">招标期限</p>
                    <p style="width:10%;">地点</p>
                </a>
            </li>
            @foreach($items as $item)
                <li class="special-li">
                    <p class="unchecked special-p" style="width:4%;" data-id="{{$item['id'] or ''}}"></p>
                    <a href="{{route('developer.centrally-purchase.detail',['id'=> $item['id']])}}">
                        <p style="width:19%;">{{$item['developer_info']['name'] or ''}}</p>
                        <p style="width:35%;">{{$item['content'] or ''}}</p>
                        <p style="width:34%;">{{$item['bidding_node'] or ''}}</p>
                        <p style="width:10%;">{{$item['city_name'] or ''}}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    @if(!$paginate->isEmpty())
        <div class="patials-paging">
            {!! $paginate->appends($appends)->render() !!}
        </div>
    @endif
@endsection