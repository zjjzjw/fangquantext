<?php
ufa()->extCss([
        '../lib/extend/font-awesome/css/font-awesome',
        'provider/provider/engineer-case',
]);
ufa()->extJs([
        '../lib/extend/jquery.scrollUp/jquery.scrollUp',
        'provider/provider/engineer-case',
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
                                <!--tab02 s-->
                                <div role="tabpanel" class="tab-pane tab-pane02 active" id="tab02">
                                    <div class="row">
                                        <!--right s-->
                                        <div class="col-xs-12 right">
                                            <div class="content"><p class="title">工程案例</p>
                                            @if(!empty($provider_sign_list['items']))
                                                <!--col s-->
                                                    @foreach($provider_sign_list['items'] as $item)
                                                        <div class="col-xs-6">
                                                            <div class="col-box">
                                                                <p class="sub-title">{{$item['loupan_name'] or ''}}</p>
                                                                <ul>
                                                                    <li><span>开发商：</span>
                                                                        <span>{{$item['developer_names'] or ''}}</span>
                                                                    </li>
                                                                    <li><span>所在地：</span>
                                                                        <span>{{$item['city_name'] or ''}}</span>
                                                                    </li>
                                                                    <li><span>产品类别：</span>
                                                                        <span>{{$item['category_names'] or ''}}</span>
                                                                    </li>
                                                                    <li><span>产品型号：</span>
                                                                        <span>{{$item['product_model'] or ''}}</span>
                                                                    </li>
                                                                    <li><span>项目总金额：</span>
                                                                        <span>{{intval($item['brand_total_amount'])}}
                                                                            万元</span>
                                                                    </li>
                                                                    <li><span>合同签订时间：</span>
                                                                        <span>{{$item['order_sign_time'] or ''}}</span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                <!--col e-->
                                                    <div class="col-xs-12">
                                                        <div id="page-nav">
                                                            @if(!$provider_sign_list['paginate']->isEmpty())
                                                                {!! $provider_sign_list['paginate']->appends($appends)->render() !!}
                                                            @endif
                                                        </div>
                                                    </div>
                                                @else
                                                    @include('common.no-data')
                                                @endif
                                            </div>

                                        </div>
                                        <!--right e-->
                                    </div>
                                </div>
                                <!--tab02 e-->
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
