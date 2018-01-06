<?php
ufa()->extCss([
        'personal/main/index'
]);
ufa()->extJs([
        'personal/main/index'
]);
?>
@extends('layouts.master')
@section('master.content')
    <div class="wrapper-box">
        @include('partials.personal.personal-main-header')
        <div class="content-box">
            {{--账户 -s--}}
            <div class="part-one">
                {{--完善个人资料 -s--}}
                <div class="improving-information">
                    <div class="user-name">
                        <span>majing</span>
                        <em>0级</em>
                        <a href="">
                            完善个人资料
                        </a>
                    </div>
                    <p>
                        <span>姓名：</span>
                        <span>majing</span>
                    </p>

                    <p>
                        <span>公司名称：</span>
                        <span>majing</span>
                    </p>
                    <p>
                        <span>用户类型：</span>
                        <span>majing</span>
                    </p>
                    <p>
                        <span>所选品类：</span>
                        <span>majing</span>
                    </p>

                </div>
                <div class="my-account">
                    <h3>我的账户</h3>
                    <ul>
                        <li>
                            <a href="{{route('personal.main.improve-information')}}">
                                <img src="/www/images/personal/01.png" alt="">
                                <span>完善个人资料</span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="/www/images/personal/02.png" alt="">
                                <span>账户安全</span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="/www/images/personal/03.png" alt="">
                                <span>我的收藏</span>
                            </a>
                        </li>
                        <li>
                            <a href="">
                                <img src="/www/images/personal/04.png" alt="">
                                <span>我的数据</span>
                            </a>
                        </li>
                    </ul>
                </div>
                {{--完善个人资料 -e--}}
            </div>
            {{--账户-e--}}

            {{--nav -s--}}
            <div class="part-two">
                <ul>
                    <li>
                        <a href="{{route('developer.centrally-purchase.index')}}">
                            <img src="/www/images/personal/05.png" alt="">
                            <p>战略招采节点</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('developer.centrally-purchase.developer')}}">
                            <img src="/www/images/personal/06.png" alt="">
                            <p>战略招采专区</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('developer.cooperation.cooperation')}}">
                            <img src="/www/images/personal/07.png" alt="">
                            <p>主流供应商品牌</p>
                            <p>合作开发商名录</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('developer.cooperation.strategy-chart')}}">
                            <img src="/www/images/personal/08.png" alt="">
                            <p>主流开发商战略集采一览表</p>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('developer.project-list')}}">
                            <img src="/www/images/personal/09.png" alt="">
                            <p>非战略集采项目库</p>
                        </a>
                    </li>
                </ul>
            </div>
            {{--nav -e--}}

            {{--会员服务 -s--}}
            <div class="part-three">
                <h3>会员服务</h3>
                <ul>
                    <li>
                        <img src="/www/images/personal/vip.png" alt="">
                        <div class="vip-box">
                            <p>非收费用户</p>
                            <p>完善用户资料库，便于开发商定向检索，实现高效对接</p>
                            <a href="">联系我们</a>
                        </div>
                    </li>
                    <li>
                        <img src="/www/images/personal/vip3.png" alt="">
                        <div class="vip-box">
                            <p>年费制</p>
                            <p>尽享全国主流开发商集采信息，读览海量精准项目数据</p>
                            <a href="">联系我们</a>
                        </div>
                    </li>
                    <li>
                        <img src="/www/images/personal/vip2.png" alt="">
                        <div class="vip-box">
                            <p>定制服务</p>
                            <p>根据客户需求，提供定制化咨询服务，输出解决方案</p>
                            <a href="">联系我们</a>
                        </div>
                    </li>
                </ul>
            </div>
            {{--会员服务 -e--}}
        </div>
    </div>
@endsection