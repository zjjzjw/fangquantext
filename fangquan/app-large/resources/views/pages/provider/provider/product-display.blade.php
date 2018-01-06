<?php
ufa()->extCss([
        '../lib/extend/font-awesome/css/font-awesome',
        'provider/provider/product-display',
]);
ufa()->extJs([
        '../lib/extend/jquery.scrollUp/jquery.scrollUp',
        'provider/provider/product-display',
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
                        @include('partials.provider.nav' ,  ['provider' => $provider ?? []])
                        <!--nav-tabs e-->

                            <!--tab-content s-->
                            <div class="tab-content">
                                <!--left s-->
                            @include('partials.provider.aside',['brand_sales' => $brand_sales ?? []])
                            <!--left e-->
                                <!--tab03 s-->
                                <div role="tabpanel" class="tab-pane tab-pane03 active" id="tab03">
                                    <div class="row">
                                        <!--right s-->
                                        <div class="col-xs-12 right">
                                            <div class="content">
                                                <!--form-horizontal s-->
                                                <div class="form-horizontal">
                                                    <!--form-group s-->
                                                    <div class="form-group">
                                                        <div class="group-box"><label
                                                                    class="col-xs-2 control-label">产品分类：</label>
                                                            <div class="col-xs-10 right">
                                                                <div class="right-box">
                                                                    <a
                                                                            @if(($appends['product_category_id'] ?? 0) == 0)
                                                                            class="active"
                                                                            @endif
                                                                            href="{{route('provider.provider.product-display',
                                                                                ['id' => $id , 'product_category_id' => 0 ])}}">全部
                                                                    </a>
                                                                    @foreach($categories as $category)
                                                                        <a
                                                                                @if(($appends['product_category_id'] ?? 0) ==$category['id'])
                                                                                class="active"
                                                                                @endif
                                                                                href="{{route('provider.provider.product-display',
                                                                                ['id' => $id , 'product_category_id' => $category['id']])}}">
                                                                            {{$category['name'] or ''}}
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--form-group e-->
                                                </div>
                                                <!--form-horizontal e-->
                                                <!--list-box s-->
                                                <div class="row">

                                                @if(!empty($products['items']))
                                                    <!--product-box s-->
                                                        @foreach($products['items'] ?? [] as $item)
                                                            <div class="col-xs-6">
                                                                <div class="product-box">
                                                                    <p class="product-pic">
                                                                        <img src="{{$item['logo_url'] or ''}}"/>
                                                                    </p>
                                                                    <p class="title">{{$item['name'] or ''}}</p>

                                                                    <p class="price">参考价：
                                                                        @if($item['retail_price']>0)
                                                                            {{$item['retail_price']  or 0 }}{{$item['price_unit'] or ''}}
                                                                        @else
                                                                            {{$item['engineering_price'] or 0}}{{$item['price_unit'] or ''}}
                                                                        @endif</p>

                                                                    <p class="type">
                                                                        产品型号：{{$item['product_model'] or ''}}</p>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                    <!--product-box e-->
                                                        <div class="col-xs-12">
                                                            <div id="page-nav">
                                                                @if(!$products['paginate']->isEmpty())
                                                                    {!! $products['paginate']->appends($appends)->render() !!}
                                                                @endif
                                                            </div>
                                                        </div>

                                                    @else
                                                        @include('common.no-data')
                                                    @endif
                                                </div>
                                                <!--list-box e-->
                                            </div>
                                        </div>
                                        <!--right e-->
                                    </div>
                                </div>
                                <!--tab03 e-->
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
