<?php App\Wap\Http\Controllers\Resource::addCSS(array('css/exhibition/provider/detail')); ?>
<?php App\Wap\Http\Controllers\Resource::addJS(array('app/exhibition/provider/detail')); ?>
@extends('layouts.master')
@section('content')
    <div class="provider-box">
        <div class="company-detail">
            <ul>
                <li>
                    <img src="{{$provider['logo_url'] or ""}}" alt="">
                    <div class="company-name">
                        <p>{{$provider['company_name'] or ""}}</p>
                        <p>{{$provider['brand_name'] or ""}}</p>
                        @if(!empty($provider['city']['name']))
                            <p class="city-name">
                                <img src="/www/image/exhibition/exhibition-h5/adress.png" alt="">
                                <span>{{$provider['city']['name'] or ""}}</span>
                            </p>
                        @endif
                    </div>
                </li>
                <li>
                    <div class="icon-box">
                        <img src="/www/image/exhibition/provider/WechatIMG13.png" alt=""><span>基本信息</span>
                    </div>
                    <p>
                        <span>公司名称：</span>
                        <span>{{$provider['company_name'] or ""}}</span>
                    </p>
                    <p>
                        <span>主营产品：</span>
                        <span>{{$provider['main_product_category'] or ""}}</span>
                    </p>
                    <p>
                        <span>成立时间：</span>
                        <span>{{$provider['founding_time'] or ""}}</span>
                    </p>
                    <p>
                        <span>经营地址：</span>
                        <span>{{$provider['operation_address'] or ""}}</span>
                    </p>
                </li>
                <li>
                    <p>企业简介：</p>
                    <div>
                        <span class="summary">{{$provider['summary'] or ""}}</span>
                        <a href="javascript:void(0);" class="open-all open-comm-desc" style="display: inline">查看全部</a>
                        <a href="javascript:void(0);" class="close-all close-comm-desc" style="display: inline">收起</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="business-information">

            <div class="icon-box">
                <img src="/www/image/exhibition/provider/WechatIMG14.png" alt=""><span>工商信息</span>
            </div>
            <table class="table">
                <tbody>
                <tr>
                    <td>法人代表</td>
                    <td>{{$provider['corp'] or ""}}</td>
                </tr>
                <tr>
                    <td>注册资本（{{$provider['registered_capital_unit'] or ""}}）</td>
                    <td>{{$provider['registered_capital'] or ""}}</td>
                </tr>
                <tr>
                    <td>注册时间</td>
                    <td>{{$provider['founding_time'] or ""}}</td>
                </tr>
                <tr>
                    <td>公司类型</td>
                    <td>{{$provider['company_type_name'] or ""}}</td>
                </tr>
                <tr>
                    <td>年营业额（万元）</td>
                    <td>{{$provider['turnover'] or ""}}</td>
                </tr>
                <tr>
                    <td>员工人数（人）</td>
                    <td>{{$provider['worker_count'] or ""}}</td>
                </tr>
                <tr>
                    <td>经营模式</td>
                    <td>{{$provider['provider_management_mode_names'] or ""}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <a href="{{route('exhibition.provider.honor', ['provider_id' => $provider['id']])}}">
            <div class="icon-box">
                <img src="/www/image/exhibition/provider/WechatIMG15.png" alt=""><span>企业荣誉</span>
            </div>
            <i>></i>
        </a>
        <a href="{{route('exhibition.provider.case', ['provider_id' => $provider['id']])}}">
            <div class="icon-box">
                <img src="/www/image/exhibition/provider/WechatIMG16.png" alt=""><span>工程案例</span>
            </div>
            <i>></i>
        </a>
        @if($brand_service)
            <div class="service-network">
                <div class="icon-box">
                    <img src="/www/image/exhibition/provider/WechatIMG63.png" alt=""><span>服务网点</span>
                </div>
                @if($brand_service['files'])
                    <div class="img-box">
                        <img src="{{$brand_service['files'][0]['url'] or ""}}">
                    </div>
                @endif
                <ul>
                    <li>服务模式：{{$brand_service['service_model_name'] or "" }}</li>
                    <li>供货周期：{{$brand_service['supply_cycle'] or ""}}</li>
                </ul>
            </div>
        @endif
    </div>
    @include('partials.exhibition-h5.developer.developer-footer')
@endsection


