<?php App\Wap\Http\Controllers\Resource::addCSS(array('css/exhibition/provider/case')); ?>
@extends('layouts.master')
@section('content')
    <div class="case-box">
        <p>工程案例</p>
        <div class="list-box">
            <ul>

                @if(!empty($provider_sign_list['items']))
                    @foreach(($provider_sign_list['items'] ?? []) as $key =>$item)
                <li>
                    <div class="list-detail">
                        <p>{{$item['loupan_name'] or ''}}</p>
                        <ul>
                            <li>开发商：{{$item['developer_names'] or ''}}</li>
                            <li>所在地：{{$item['city_name'] or ''}}</li>
                            <li>产品类别：{{$item['category_names'] or ''}}</li>
                            <li>产品型号：{{$item['product_model'] or ''}}</li>
                            <li>项目总金额：{{$item['brand_total_amount'] or ''}}万</li>
                            <li>合同签订时间：{{$item['order_sign_time'] or ''}}</li>
                        </ul>
                    </div>
                </li>
                    @endforeach
                    @else
                    <div class="content-empty">
                        <img src="/www/image/exhibition/exhibition-h5/content-empty.png" alt="">
                        <p>暂无数据</p>
                    </div>
                @endif


            </ul>
        </div>
    </div>
@endsection


