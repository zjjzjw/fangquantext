<?php
ufa()->extCss([
    'developer/project-list'
]);
ufa()->extJs([
    'developer/project-list'
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
                    <p style="width:29%;">项目名称</p>
                    <p style="width:29%;">开发商</p>
                    <p style="width:30%;">发布时间</p>
                    <p style="width:10%;">地点</p>
                </a>
            </li>
            @foreach(($items ?? []) as $item)
            <li class="special-li">
                <p class="unchecked special-p" style="width:4%;" data-id="{{$item['id'] or ''}}"></p>
                <a href="{{route('developer.project-detail',['id'=>$item['id']])}}">
                    <p style="width:29%;">{{$item['name'] or ''}}</p>
                    <p style="width:29%;">{{$item['developer_name'] or ''}}</p>
                    <p style="width:30%;">{{$item['time'] or ''}}</p>
                    <p style="width:10%;">{{$item['city']['name'] or ''}}</p>
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