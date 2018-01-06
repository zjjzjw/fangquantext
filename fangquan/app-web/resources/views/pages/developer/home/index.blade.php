<?php
ufa()->extCss([
        'developer/home/index'
]);
ufa()->extJs([
        'developer/home/index'
]);

?>
@extends('layouts.master')
@section('master.content')
    <div class="wrapper-box">
        @include('partials.developer.developer-home-header')
        @include('auth.login-swiper')
        <div class="content-box">
            {{--资讯 -s--}}
            <div class="information-box">
                <h3>
                    <ul>
                        @foreach($counts as $count)
                            <li>{{$count or  ''}}</li>
                        @endforeach
                        <span>开发商的坚持选择</span>
                    </ul>

                    <a href="">更多 ></a>
                </h3>
                <ul class="list-content">
                    @foreach($informations as $information)
                        <li>
                            <a href="{{route('information.particulars', ['id' => $information['id']])}}">
                                <span class="title">{{$information['title'] or ''}}</span>
                            </a>
                            <span class="time">{{$information['publish_at'] or ''}}</span>
                        </li>
                    @endforeach
                </ul>
                <ul class="entrance-content">
                    <li>
                        <img src="/www/images/developer/home/top100-developers.png" alt="百强开发商项目">
                        <p class="title">百强开发商项目</p>
                        <p class="desc">为您提供全国100强开发商的优质项目</p>
                    </li>
                    <li>
                        <img src="/www/images/developer/home/raising-bid.png" alt="提示项目中标率">
                        <p class="title">提示项目中标率</p>
                        <p class="desc">帮您全面了解自己及和竞争对手的优劣势，提升招标投标的成功率</p>
                    </li>
                    <li>
                        <img src="/www/images/developer/home/optimal-product.png" alt="必选最优产品">
                        <p class="title">必选最优产品</p>
                        <p class="desc">帮您对比不同品牌的产品和国标参数，选出最优产品</p>
                    </li>
                </ul>
            </div>
            {{--资讯 -e--}}

            {{--知名客户 s--}}
            <div class="logo-box">
                <h3>知名客户</h3>
                <ul>
                    @foreach($providers as $provider)
                        <li>
                            <a href="javascript:void(0);">
                                <img src="{{$provider['logo_url'] or ''}}" alt="">
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{--知名客户 e--}}

            {{--合作伙伴 -s--}}
            <div class="logo-box">
                <h3>合作伙伴</h3>
                <ul>
                    @foreach($developers as $developer)
                        <li>
                            <a href="">
                                <img src="{{$developer['logo_url'] or ''}}" alt="">
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{--合作伙伴 -e--}}
        </div>
    </div>
@endsection