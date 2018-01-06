<?php
ufa()->extCss([
    'auth/login-form'
]);
ufa()->extJs([
    'auth/login-form'
]);

?>
@extends('layouts.master')
@section('master.content')
    <div class="wrapper-box">
        @include('partials.developer.developer-home-header')
        @include('auth.login-swiper')
    </div>
@endsection