<?php
ufa()->extCss([
        '../lib/extend/font-awesome/css/font-awesome',
        'provider/provider/second',
]);
ufa()->extJs([
        '../lib/extend/jquery.scrollUp/jquery.scrollUp',
        'provider/provider/second',
]);
?>

@extends('layouts.master')
@section('master.content')
    <div class="page-02">
    @include('partials.header')
    <!--section s-->
        <section class="section02">
            <div class="container">
                <div class="row">                    <!-- content-box s -->
                    <div class="content-box">
                        <div class="col-xs-12">                            <!--type-box s-->
                            <div class="type-list">
                                <ul>
                                    @foreach($second_categories as $category)
                                        <li>
                                            <a
                                                    class="@if(($second_level ?? 0) == $category['id'])
                                                            windows active
                                                            @else
                                                            windows
                                                            @endif"
                                                    href="{{route('provider.provider.second',
                                            ['parent_id' => $parent_id ?? 0, 'second_level' => $category['id'] ?? 0])}}"
                                            >
                                                <img src="{{$category['logo_url'] or  ''}}"/>
                                                <span>{{$category['name'] or ''}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!--type-box e-->

                            <!--list-box s-->
                            <div class="list-box">
                                <div class="row" id="proder">
                                    @if(!empty($providers))
                                        @foreach($providers as $provider)
                                            <div class="col-xs-2 item">
                                                <div class="item-box">
                                                    <a href="{{route('provider.provider.detail',['id' => $provider['id']])}}"><img
                                                                src="{{$provider['logo_url'] or ''}}"></a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        @include('common.no-data')
                                    @endif
                                </div>
                            </div>
                            <!--list-box e-->
                        </div>
                    </div>
                    <!-- content-box e -->
                </div>
            </div>
        </section>
        <!--section e-->
        @include('partials.footer')
    </div>

@endsection
