<?php
ufa()->extCss([
        '../lib/extend/font-awesome/css/font-awesome',
        'developer/developer-project/index',
]);
ufa()->extJs([
        '../lib/extend/jquery.scrollUp/jquery.scrollUp',
        'developer/developer-project/index',
]);
?>

@extends('layouts.master')
@section('master.content')
    <div class="page-03">
    @include('partials.header')
    <!--section s-->
        <section class="section02">
            <div class="container">
                <div class="row">
                    <!--form-horizontal s-->
                    <div class="form-horizontal">
                        <!--form-group s-->
                        <div class="form-group">
                            <div class="group-box">
                                <label class="col-xs-2 control-label">招标类型：</label>
                                <div class="col-xs-10 right">
                                    <div class="right-box">
                                        <a @if(($appends['bidding_type'] ?? 0)  == 0) class="active" @endif
                                        href="{{route('developer.developer-project.index', array_merge($appends , ['bidding_type' => 0]))}}">全部</a>
                                        @foreach($developer_project_bidding_types ?? [] as $key => $name)
                                            <a @if(($appends['bidding_type'] ?? 0)  == $key ) class="active" @endif
                                            href="{{route('developer.developer-project.index', array_merge($appends , ['bidding_type' => $key]))}}">
                                                {{$name or ''}}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--form-group e-->

                        <!--form-group s-->
                        <div class="form-group">
                            <div class="group-box">
                                <label class="col-xs-2 control-label">招标品类：</label>
                                <div class="col-xs-10 right">
                                    <div class="right-box">
                                        <a @if(($appends['project_category_parent_id'] ?? 0) == 0)
                                           class="active"
                                           @endif
                                           href="{{route('developer.developer-project.index', array_merge($appends , ['project_category_id' => 0]))}}">全部</a>

                                        @foreach($project_main_category as $category)
                                            <a @if( ($appends['project_category_parent_id'] ?? 0) == $category['id'])
                                               class="category active"
                                               @else
                                               class="category"
                                               @endif
                                               data-id="{{$category['id']}}"
                                               href="javascript:void(0);">
                                                {{$category['name'] or ''}}
                                            </a>
                                        @endforeach
                                    </div>

                                    @foreach($project_main_category as $category)
                                        <div class="show-box category-box"
                                             id="show-category-box-{{$category['id']}}"
                                             style="
                                             @if(($appends['project_category_parent_id'] ?? 0) == $category['id'])
                                                     display:block;
                                             @else
                                                     display: none
                                             @endif">
                                            @foreach($category['nodes'] ?? [] as $node)
                                                <a @if(($appends['project_category_id'] ?? 0) == $node['id'])
                                                   class="active"
                                                   @endif
                                                   href="{{route('developer.developer-project.index', array_merge($appends , ['project_category_id' => $node['id']]))}}">{{$node['name'] or ''}}</a>
                                            @endforeach
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                        <!--form-group e-->

                        <!--form-group s-->
                        <div class="form-group">
                            <div class="group-box">
                                <label class="col-xs-2 control-label">所在地：</label>
                                <div class="col-xs-10 right">
                                    <div class="right-box">
                                        <a
                                                @if(($appends['china_area_id'] ?? 0) == 0)
                                                class="area active"
                                                @endif
                                                href="{{route('developer.developer-project.index', array_merge($appends , ['province_id' => 0]))}}">
                                            全部
                                        </a>
                                        @foreach($china_areas as $china_area)
                                            <a
                                                    @if(($appends['china_area_id'] ?? 0) == $china_area['id'])
                                                    class="area active"
                                                    @else
                                                    class="area"
                                                    @endif
                                                    data-id="{{$china_area['id']}}"
                                                    href="javascript:void(0);">{{$china_area['name'] or ''}}
                                            </a>
                                        @endforeach
                                    </div>

                                    @foreach($china_areas as $china_area)
                                        @if(!empty($china_area['provinces']))
                                            <div class="show-box area-box"
                                                 style="
                                                 @if(($appends['china_area_id'] ?? 0) == $china_area['id'])
                                                         display:block;
                                                 @else
                                                         display: none;
                                                 @endif>"
                                                 id="show-area-box-{{$china_area['id']}}">
                                                @foreach(($china_area['provinces'] ?? []) as $province)
                                                    <a
                                                            @if(($appends['province_id'] ?? 0) == $province['id'])
                                                            class="active"
                                                            @endif
                                                            href="{{route('developer.developer-project.index', array_merge($appends , ['province_id' => $province['id']]))}}">
                                                        {{$province['name'] or ''}}
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    @endforeach


                                </div>
                            </div>
                        </div>
                        <!--form-group e-->
                    </div>
                    <!--form-horizontal e-->

                    <!--list-box s-->
                    <div class="list-box col-2">


                    @if(!empty($items))
                        <!--item-box s-->
                            @foreach($items ?? [] as $item)
                                <div class="col-xs-6">
                                    <div class="content-box">
                                        <a href="{{route('developer.developer-project.detail', ['id' => $item['id']])}}"
                                           class="btn-mask"></a>
                                        <a href="#" class="pic-box"><img src="{{$item['logo_url'] or ''}}"/></a>
                                        <div class="info">
                                            <p class="title">{{$item['name'] or ''}}</p>
                                            <p class="company">{{$item['developer_name'] or ''}}</p>
                                            <ul>
                                                <li>建筑面积：<span>{{$item['floor_space'] or ''}}平方米</span></li>
                                                <li>招标类型：<span>{{$item['bidding_type_name'] or ''}}</span></li>
                                                <li>项目类型：<span>{{$item['project_category_name'] or ''}}</span></li>
                                            </ul>
                                        </div>
                                        <div class="bottom">
                                            <p class="date">{{$item['time'] or ''}}</p>
                                            <p class="pull-right">
                                                <i class="fa fa-map-marker"></i> {{$item['city_name'] or ''}} </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-xs-12">
                                <div id="page-nav">
                                    @if(!$paginate->isEmpty())
                                        {!! $paginate->appends($appends)->render() !!}
                                    @endif
                                </div>
                            </div>
                    @else

                        @include('common.no-data')

                    @endif

                    <!--item-box e-->
                    </div>
                    <!--list-box e-->
                </div>
            </div>
        </section>
        <!--section e-->
        @include('partials.footer')
    </div>

@endsection