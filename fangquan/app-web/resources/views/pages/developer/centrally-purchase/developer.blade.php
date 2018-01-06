<?php
ufa()->extCss([
        'developer/centrally-purchase/developer'
]);
ufa()->extJs([
        'developer/centrally-purchase/developer'
]);
?>
@extends('layouts.master')
@section('master.content')
    @include('partials.developer.developer-header')
    <div class="index-header">
        <div class="header-box">
            <span>所在地：</span>
            <ul>
                <li><a href="{{route('developer.centrally-purchase.developer',
                                array_merge($appends, ['city_id' => 0])
                        )}}" class="@if(($appends['city_id'] ?? 0) == 0)active @endif">全部</a></li>

                @foreach($cities as $city)
                    <li>
                        <a href="{{route('developer.centrally-purchase.developer',
                                array_merge($appends, ['city_id' => $city['id']])
                        )}}"
                           class="@if(($appends['city_id'] ?? 0) == $city['id']) active @endif">{{$city['name'] or ''}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="main-content">
        <ul class="content-ul">
            @if(!empty($items))
                @foreach($items as $item)
                    <li>
                        <a href="{{route('developer.centrally-purchase.developer-project',['id'=> $item['id']])}}"><img
                                    src="{{$item['logo_url'] or ''}}" alt=""></a>
                    </li>
                @endforeach
            @else
                @include('common.no-data', ['title' => '暂无数据'])
            @endif
        </ul>

        @if(!$paginate->isEmpty())
            <div class="patials-paging">
                {!! $paginate->appends($appends)->render() !!}
            </div>
        @endif

    </div>
@endsection