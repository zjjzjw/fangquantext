<?php
ufa()->extCss([
        'information/particulars'
]);
ufa()->extJs([
        'information/particulars'
]);
?>

@extends('layouts.master')
@section('master.content')
    <div class="wrapper-box">
        @include('partials.developer.developer-home-header')
        <div class="detail-box">
            <div class="detail-content">
                <p class="title">{{$title or ''}}</p>
                <p class="time">
                    <span>{{$publish_at or ''}}  </span>编辑：<span>{{empty($author) ? '房圈网': $author}}</span></p>
                <div class="content-list">
                    {!! $content or '' !!}
                </div>
            </div>
        </div>
    </div>
@endsection