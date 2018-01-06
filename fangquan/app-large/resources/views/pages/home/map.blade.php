<?php
ufa()->extCss([
        '../lib/extend/font-awesome/css/font-awesome',
        'home/map',
]);
ufa()->extJs([
        '../lib/extend/jquery.scrollUp/jquery.scrollUp',
        'home/map',
]);
?>

@extends('layouts.master')
@section('master.content')
    <div class="container-fluid">
        <div class="map-marker">
            @for($i =1 ; $i <= 20; $i++)
                <?php $code = str_pad($i, 2, "0", STR_PAD_LEFT); ?>
                <div class="point-box point-box-{{$code}} @if($p != $i) hide @endif">
                    <p>您当前的位置</p>
                    <span class="corner"></span>
                </div>
            @endfor
            <img src="/www/images/map-pic-max.jpg"/>
        </div>
    </div>
    @include('partials.footer')
@endsection