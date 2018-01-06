<?php
ufa()->extCss([
        '../lib/extend/font-awesome/css/font-awesome',
        'developer/developer/index',
]);
ufa()->extJs([
        '../lib/extend/jquery.scrollUp/jquery.scrollUp',
        'developer/developer/index',
]);
?>

@extends('layouts.master')
@section('master.content')
    <div class="page-01">
        <!--header s-->
    @include('partials.header')
    <!--section s-->
        <section class="section02">
            <div class="container">
                <div class="row">
                    <!-- content-box s -->
                    <div class="content-box">
                        <div class="col-xs-12">
                            <!--list-box s-->
                            <div class="list-box">
                                <div class="row">
                                    @if(!empty($items))
                                        @foreach($items ?? [] as $item)
                                            <div class="col-xs-2 item">
                                                <div class="item-box">
                                                    <a href="{{route('developer.developer-project.index', ['developer_id' => $item['id']])}}">
                                                        <img src="{{$item['logo_url'] or ''}}"/>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach

                                    <!--page-nav s-->
                                        <div class="col-xs-12">
                                            <div id="page-nav">
                                                @if(!$paginate->isEmpty())
                                                    {!! $paginate->appends($appends)->render() !!}
                                                @endif
                                            </div>
                                        </div>
                                        <!--page-nav e-->
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

        @include('partials.footer')
    </div>

@endsection