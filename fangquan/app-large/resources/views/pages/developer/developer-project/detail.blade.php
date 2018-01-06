<?php
ufa()->extCss([
    '../lib/extend/font-awesome/css/font-awesome',
    'developer/developer-project/detail',
]);
ufa()->extJs([
    '../lib/extend/jquery.scrollUp/jquery.scrollUp',
    'developer/developer-project/detail',
]);
?>

@extends('layouts.master')
@section('master.content')
    <div class="page-01-sub-detail">
    @include('partials.header')
    <!--section s-->
        <section class="section03">
            <div class="container">
                @if(false)
                    <div class="row">
                        <!--left s-->
                        <div class="col-xs-9 left">
                            <div class="content-box">
                                <!--title s-->
                                <div class="title">
                                    {{$project['name'] or ''}}
                                </div>
                                <!--title e-->

                                <!--content s-->
                                <div class="content">
                                    <p>采购需求</p>
                                    <!--table s-->
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <tbody>
                                            <tr>
                                                <td>项目名称</td>
                                                <td>{{$project['name'] or ''}}</td>
                                            </tr>
                                            <tr>
                                                <td>项目概况</td>
                                                <td>{{$project['summary'] or ''}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--table e-->
                                </div>
                                <!--content e-->

                                <!--content s-->
                                <div class="content"><p>项目信息</p>                                <!--table s-->
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <tbody>
                                            <tr>
                                                <td>项目类型</td>
                                                <td>{{$project['project_category_type_names'] or ''}}</td>
                                                <td>发布时间</td>
                                                <td>{{$project['publish_at'] or ''}}</td>
                                            </tr>
                                            <tr>
                                                <td>招标类型</td>
                                                <td>{{$project['developer_project_bidding_type_name'] or ''}}</td>
                                                <td>项目区域</td>
                                                <td>{{$project['area'] or ''}}</td>
                                            </tr>
                                            <tr>
                                                <td>招标品类</td>
                                                <td colspan="3">
                                                    {{$project['project_category_names'] or ''}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>建筑面积</td>
                                                <td colspan="3">{{$project['floor_space'] or ''}}平方米</td>
                                            </tr>
                                            <tr>
                                                <td>地址</td>
                                                <td colspan="3">
                                                    {{$project['address'] or  ''}}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--table e-->
                                </div>
                                <!--content e-->
                            </div>
                        </div>
                        <!--left e-->

                        <!--right s-->
                        <div class="col-xs-3 right">
                            <div class="content-box">
                                <!--aside-box s-->
                                <div class="aside-box">
                                    <p class="pic-box"><img
                                                src="{{$project['developer_info']['developer_logo_url'] or ''}}"/></p>
                                    <p>{{$project['developer_info']['name'] or ''}}</p>
                                </div>                            <!--aside-box e-->
                            </div>

                            <div class="content-box">
                                <!--aside-box s-->
                                <div class="aside-box">
                                    <p class="title">联系方式</p>
                                    <p><span>联系人：</span>{{$project['contacts'] or ''}}</p>
                                    <p><span>联系电话：</span>{{$project['contacts_phone'] or ''}}</p>
                                    <p><span>公司地址：</span>{{$project['contacts_address'] or ''}}</p>
                                    <p><span>邮箱：</span>{{$project['contacts_email'] or ''}}</p>
                                </div>
                                <!--aside-box e-->
                            </div>
                        </div>
                        <!--right e-->
                    </div>
                @else
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="no-permission">
                                <p>会员特享频道，若想了解详情，请扫二维码进入"招采智库"！</p>
                                <p>
                                    <img src="/www/images/developer/qr_code.jpg" alt="">
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
        <!--section e-->
        @include('partials.footer')
    </div>

@endsection