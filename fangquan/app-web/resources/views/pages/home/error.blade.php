<?php
ufa()->extCss([
        'home/error'
]);
ufa()->extJs([
        'home/error'
]);
?>
@extends('layouts.master')
@section('master.content')
    <div class="wrapper-box">
        @include('partials.exhibition.header')
        <div class="content-box">
            <img src="/www/images/exhibition/error.png" alt="">
            @if (count($errors) > 0)
                <p class="error-alert">
                    @foreach ($errors->all() as $key => $error)
                        {{ $error }} </br>
                    @endforeach
                </p>
            @else
                <p class="error-alert">
                    页面维护中！
                </p>
            @endif
        </div>
    </div>
    @include('partials.exhibition.friendly-link')
@endsection