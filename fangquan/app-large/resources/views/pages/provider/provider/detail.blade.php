<?php
ufa()->extCss([
        '../lib/extend/font-awesome/css/font-awesome',
        'provider/provider/detail',
]);
ufa()->extJs([
        '../lib/extend/jquery.scrollUp/jquery.scrollUp',
        '../lib/extend/readmore/readmore',
        'provider/provider/detail',
]);
?>

@extends('layouts.master')
@section('master.content')
    <div class="page-02-sub">

    @include('partials.header')
    <!--section s-->
        <section class="section04">
            <div class="container">
                <div class="row">

                    <!--top s-->
                @include('partials.provider.header', ['provider' => $provider ?? []])
                <!--top e-->

                    <!--content s-->
                    <div class="content-box">
                        <div class="col-xs-12">
                            <!--nav-tabs s-->
                        @include('partials.provider.nav',['provider' => $provider ?? []])
                        <!--nav-tabs e-->

                            <!--tab-content s-->
                            <div class="tab-content">
                                <!--left s-->
                            @include('partials.provider.aside',['brand_sales' => $brand_sales ?? []])
                            <!--left e-->
                                <!--tab01 s-->
                                <div role="tabpanel" class="tab-pane tab-pane01 active" id="tab01">
                                    <div class="row">
                                        <!--right s-->
                                        <div class="col-xs-12 right">
                                            <div class="content">
                                                <!--item-box s-->
                                                <div class="item-box">
                                                    <p class="title">基本信息</p>
                                                    <ul>
                                                        <li>
                                                            <p>公司名称：</p>
                                                            <p>{{$provider['company_name'] or ''}}</p>
                                                        </li>
                                                        <li>
                                                            <p>主营产品：</p>
                                                            <p>
                                                                <span>{{$provider['provider_main_category_name'] or ''}}</span>
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <p>成立时间：</p>
                                                            <p>{{$provider['founding_time'] or ''}}年</p>
                                                        </li>
                                                        <li>
                                                            <p>经营地址：</p>
                                                            <p>{{$provider['operation_address'] or ''}}</p>
                                                        </li>
                                                        <li>
                                                            <p class="company-info">
                                                                <span>企业简介：</span>
                                                                {{$provider['summary'] or ''}}
                                                            </p>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!--item-box e-->

                                                <!--item-box s-->
                                                <div class="item-box">
                                                    <p class="title">工商信息</p>
                                                    <!--table s-->
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>法人代表</th>
                                                                <th>注册资本（{{$provider['registered_capital_unit']}}）</th>
                                                                <th>注册时间</th>
                                                                <th>公司类型</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>{{$provider['corp'] or ''}}</td>
                                                                <td>{{floatval($provider['registered_capital'])}}</td>
                                                                <td>{{$provider['founding_time']}}年</td>
                                                                <td>{{$provider['provider_company_type_name'] or ''}}</td>
                                                            </tr>
                                                            </tbody>
                                                            <thead>
                                                            <tr>
                                                                <th>年营业额（万元）</th>
                                                                <th>员工人数（人）</th>
                                                                <th>经营模式</th>
                                                                <th></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>{{$provider['turnover'] or ''}}</td>
                                                                <td>{{$provider['worker_count'] or ''}}</td>
                                                                <td> {{$provider['provider_management_type_name'] or ''}}</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--table e-->
                                                </div>
                                                <!--item-box e-->

                                                <!--item-box s-->
                                                <div class="item-box"><p class="title">企业荣誉</p>
                                                    <!--table s-->
                                                    <div class="item-pic">
                                                        @if(!empty($certificate_images))
                                                            @foreach($certificate_images ?? [] as $image_url)
                                                                <img src="{{$image_url}}">
                                                            @endforeach
                                                        @else
                                                            @include('common.no-data')
                                                        @endif
                                                    </div>
                                                    <!--table e-->
                                                </div>
                                                <!--item-box e-->
                                            </div>
                                        </div>
                                        <!--right e-->
                                    </div>
                                </div>
                                <!--tab01 e-->
                            </div>
                            <!--tab-content e-->
                        </div>
                    </div>
                    <!--content e-->
                </div>
            </div>
        </section>
        <!--section e-->
        @include('partials.footer')
    </div>

@endsection