<?php
ufa()->extCss([
        '../lib/extend/font-awesome/css/font-awesome',
        'home/index',
]);
ufa()->extJs([
        '../lib/extend/jquery.scrollUp/jquery.scrollUp',
        'home/index',
]);
?>

@extends('layouts.master')
@section('master.content')
    <div class="page-index">
    @include('partials.header')
    <!--section s-->
        <section class="section01">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="content-box">
                            <!-- left s -->
                            <div class="col-xs-8 left">
                                <div class="note-text">
                                    <p>友情提示：点击地图预览大图</p>
                                </div>
                                @for($i =1 ; $i <= 20; $i++)
                                    <?php $code = str_pad($i, 2, "0", STR_PAD_LEFT); ?>
                                    <div class="point-box point-box-{{$code}} @if($p != $i) hide @endif">
                                        <p>您当前的位置</p>
                                        <span class="corner"></span>
                                    </div>
                                @endfor
                                <a href="{{route('home.map')}}"> <img src="/www/images/map-pic.jpg"/></a>
                            </div>
                            <!-- left e -->

                            <!-- right s -->
                            <div class="col-xs-4 right">
                                <!--top s-->
                                <div class="t-box">
                                    <p class="title">展会介绍</p>
                                    <p class="summary">
                                        {!! $introduce['content'] !!}
                                    </p>
                                </div>
                                <!--top e-->

                                <!--bottom s
                                <div class="b-box">
                                    <p class="title">展会服务</p>
                                    <ul>
                                        <li>讨论区</li>
                                        <li>卫生间</li>
                                        <li>出口</li>
                                    </ul>
                                </div>
                                bottom e-->

                            </div>
                            <!-- right e -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--section e-->

        <!--section s-->
        <section class="section02">
            <div class="container">
                <div class="row">
                    <!-- left s -->
                    <div class="col-xs-6">
                        <div class="content-box">
                            <!--title s-->
                            <div class="title-box">
                                <p class="title"><img src="/www/images/home-icon-01.png"/>开发商</p>
                                <p class="btn-box">
                                    <a href="{{route('developer.developer.index')}}" class="btn btn-default btn-more">更多开发商</a>
                                    <a href="{{route('developer.developer-project.index')}}"
                                       class="btn btn-default btn-more">更多地产项目</a>
                                </p>
                            </div>
                            <!--title e-->

                            <!--list-box s-->
                            <div class="list-box">
                                <div class="row">

                                    @foreach(($developers ?? []) as $key=> $developer)

                                        <div class="col-xs-4 item">
                                            <div class="item-box">
                                                <a href="{{route('developer.developer-project.index', ['developer_id' => $developer['id']])}}">
                                                    <img src="{{$developer['logo_url'] or ''}}"/>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                            <!--list-box e-->
                        </div>
                    </div>
                    <!-- left e -->

                    <!-- right s -->
                    <div class="col-xs-6">
                        <div class="content-box">
                            <!--title s-->
                            <div class="title-box">
                                <p class="title"><img src="/www/images/home-icon-02.png"/>供应商</p>
                                <p class="btn-box">
                                    <a href="{{route('provider.provider.index')}}" class="btn btn-default btn-more">更多供应商</a>
                                </p>
                            </div>
                            <!--title e-->

                            <!--list-box s-->
                            <div class="list-box">
                                <div class="row">
                                    @foreach(($providers ?? []) as $key=> $provider)

                                        <div class="col-xs-4 item">
                                            <div class="item-box">
                                                <a href="{{route('provider.provider.detail',['id' => $provider['id']])}}"><img
                                                            src="{{$provider['logo_url'] or ''}}"></a>
                                            </div>
                                        </div>

                                    @endforeach

                                </div>
                            </div>
                            <!--list-box e-->
                        </div>
                    </div>
                    <!-- right e -->
                </div>
            </div>
        </section>
        <!--section e-->
        @include('partials.footer')
    </div>

@endsection