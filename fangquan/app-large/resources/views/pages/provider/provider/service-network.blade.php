<?php
ufa()->extCss([
        '../lib/extend/font-awesome/css/font-awesome',
        'provider/provider/detail',
]);
ufa()->extJs([
        '../lib/extend/jquery.scrollUp/jquery.scrollUp',
        'provider/provider/detail',
]);
?>
@extends('layouts.master')
@section('master.content')
    <div class="page-02-sub">
        <!--header s-->
    @include('partials.header')
    <!--header e-->

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
                                <!--tab04 s-->
                                <div role="tabpanel" class="tab-pane tab-pane04 active">
                                    <div class="row">
                                        <!--right s-->
                                        <div class="col-xs-12 right">
                                            <div class="content">
                                                @if(!empty($brand_service))
                                                    @if(!empty($brand_service['files']))
                                                        <div class="item-pic">
                                                            @foreach($brand_service['files'] as $file)
                                                                <img src="{{$file['url'] or  ''}}"/>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    <p>服务模式：<span>{{$brand_service['service_model_name'] or ''}}</span>
                                                    </p>
                                                    <p>供货周期：<span>{{$brand_service['supply_cycle'] or  ''}}</span></p>
                                                    <p>质保期限：<span>{{$brand_service['warranty_range'] or  ''}}</span></p>
                                                @else
                                                    @include('common.no-data')
                                                @endif
                                            </div>
                                        </div>

                                        <!--right e-->
                                    </div>
                                </div>
                                <!--tab04 e-->
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
