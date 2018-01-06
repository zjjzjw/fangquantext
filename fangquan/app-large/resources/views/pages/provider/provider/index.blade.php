<?php
ufa()->extCss([
        '../lib/extend/font-awesome/css/font-awesome',
        'provider/provider/index',
]);
ufa()->extJs([
        '../lib/extend/jquery.scrollUp/jquery.scrollUp',
        'provider/provider/index',
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
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="{{route('provider.provider.second', ['parent_id' => $category['id']])}}"
                                               class="windows">
                                                <img src="{{$category['logo_url'] or ''}}"/>
                                                <span>{{$category['name'] or ''}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!--type-box e-->
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
