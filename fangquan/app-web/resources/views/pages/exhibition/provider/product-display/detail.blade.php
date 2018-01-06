<?php
ufa()->extCss([
    'exhibition/provider/product-display/detail'
]);
ufa()->extJs([
    'exhibition/provider/product-display/detail'
]);
?>

@extends('layouts.master')
@section('master.content')
    @include('partials.exhibition.header')
    @include('partials.exhibition.provider.provider-header',['provider' => $provider, 'provider_id' => $provider['id']])
    <div class="provider-box">
        @include('partials.exhibition.provider.provider-left', ['provider' => $provider])
        <div class="provider-right">
            <div class="content-box">
                <div class="product-details">
                    @if($products)
                        <div class="img-box">
                            <img src="{{$products['logo_url'] or ''}}" alt="">
                        </div>
                        <div class="info-detail">
                            <p>{{$products['name']  or  ''}}</p>
                            <p>产品型号：<em>{{$products['product_model'] or ''}}</em></p>
                            参考价：
                                @if($products['retail_price']>0 )
                                    <em>{{$products['retail_price'] or ''}}</em>{{$products['price_unit'] or ''}}
                                    @else
                                    <em>{{$products['engineering_price'] or ''}}</em>{{$products['price_unit'] or ''}}

                                @endif
                            </p>
                        </div>
                    @else
                        @include('common.no-data', ['title' => '暂无数据'])
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection