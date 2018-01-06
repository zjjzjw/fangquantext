<?php
ufa()->extCss([
        'developer/centrally-purchase/developer-project'
]);
ufa()->extJs([
        'developer/centrally-purchase/developer-project'
]);
?>
@extends('layouts.master')
@section('master.content')
    @include('partials.developer.developer-header')
    <div class="index-header">
        <div class="header-box">
            <span>所在地：</span>
            <ul>
                <li><a href="{{route('developer.centrally-purchase.developer-project',
                array_merge($appends, ['province_id' => 0])
                )}}" class="@if(($appends['province_id'] ?? 0) == 0) active @endif">全部</a></li>
                @foreach($provinces as $province)
                    <li><a href="{{route('developer.centrally-purchase.developer-project',
                array_merge($appends, ['province_id' => $province['id']])
                )}}"
                           class="@if(($appends['province_id'] ?? 0) == $province['id']) active @endif">{{$province['name'] or ''}}</a>
                    </li>
                @endforeach
            </ul>
            <a href="{{route('developer.centrally-purchase.grade', ['id' => $id])}}">集采描述：集采分级和项目分配原则</a>
        </div>

        <div class="order-box">
            <ul>
                <li><a href="{{route('developer.centrally-purchase.developer-project',
                array_merge($appends, ['column' => 'developer_project.updated_at', 'sort' => 'desc'])
                )}}" class="@if(($appends['column'] ?? '') == 'developer_project.updated_at') active @endif">默认</a></li>
                <li><a href="{{route('developer.centrally-purchase.developer-project',
                array_merge($appends, ['column' => 'developer_project.time', 'sort' => 'desc'])
                )}}" class="@if(($appends['column'] ?? '') == 'developer_project.time') active @endif">发布时间</a>
                </li>
            </ul>
            <span>共{{$pager['total'] or  ''}}条记录</span>
        </div>
    </div>
    <div class="main-content">
        @if(!empty($items))
            <div class="box-left">
                <ul class="left-ul">
                    @foreach($items as $item)
                        <li>
                            <a href="{{route('developer.centrally-purchase.project-detail',['id'=> $item['id']])}}">
                                <div class="img-box">
                                    <img src="{{$item['logo_url'] or ''}}" alt="">
                                </div>
                                <div class="detail-box">
                                    <ul>
                                        <li>{{$item['name'] or ''}}</li>
                                        <li>
                                            招标类型：<span>{{empty($category_names) ? '未知': $category_names}}</span>
                                        </li>
                                        <li>
                                            项目阶段：<span>{{empty($project_stage_name) ? '未知': $project_stage_name}}</span>
                                        </li>
                                        <li>
                                            <div class="time">
                                                <img src="/www/images/developer/time.png"
                                                     alt=""><span>{{$item['time'] or ''}}</span>
                                            </div>

                                            <div class="address">
                                                <img src="/www/images/developer/address.png"
                                                     alt=""><span>{{$item['city_name'] or ''}}</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
                @if(!$paginate->isEmpty())
                    <div class="patials-paging">
                        {!! $paginate->appends($appends)->render() !!}
                    </div>
                @endif
            </div>
        @else
            @include('common.no-data', ['title' => '暂无数据'])
        @endif

        {{--<div class="box-right">--}}
        {{--<ul>--}}
        {{--<li>推荐项目</li>--}}
        {{--<li>--}}
        {{--<div class="logo-box">--}}
        {{--<img src="/www/images/developer/new-logo.png" alt="" alt="">--}}
        {{--</div>--}}
        {{--<div class="company-name">--}}
        {{--<span>北京天恒置业有限公司</span>--}}
        {{--</div>--}}
        {{--</li>--}}
        {{--<li><a href="">查看百强开发商</a></li>--}}
        {{--</ul>--}}
        {{--</div>--}}

    </div>
@endsection