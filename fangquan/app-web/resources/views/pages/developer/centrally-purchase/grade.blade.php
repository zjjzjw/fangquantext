<?php
ufa()->extCss([
        'developer/detail'
]);
?>
@extends('layouts.master')
@section('master.content')
    @include('partials.developer.developer-header')
    <div class="index-header">
        <div class="header-box">
            <p>集采分级和项目分配原则</p>
        </div>
    </div>
    <div class="main-content">
        <div class="box-left">
            <p>分级原则</p>
            <div class="project-detail">
                <p>
                    @if(!empty($principles))
                        {{$principles or ''}}
                    @else
                        @include('common.no-data', ['title' => '暂无内容'])
                    @endif
                </p>
            </div>
            <p>分级项目落地政策</p>
            <div class="project-detail">
                <p>
                    @if(!empty($decision))
                        {{$decision or ''}}
                    @else
                        @include('common.no-data', ['title' => '暂无内容'])
                    @endif
                </p>
            </div>
        </div>
    </div>
@endsection