<?php App\Wap\Http\Controllers\Resource::addCSS(array('css/exhibition/developer-project/list')); ?>
<?php App\Wap\Http\Controllers\Resource::addJS(array('app/exhibition/developer-project/list')); ?>

<?php
App\Wap\Http\Controllers\Resource::addParam(array(
        'pageInfo' => $appends ?? [],
));
?>

@extends('layouts.master')
@section('content')
    <div class="search-box">
        <input type="text" name="keyword" placeholder="开发商名、项目名" value="{{$appends['keyword'] ?? ''}}" class="keyword">
    </div>
    <div id="menu" class="menu">
        <div id="menuinfo">
            <div class="menunav" id="menunav">
                <p id="place" class="menunav-row">
                    <span class="parentup" data-type="0">所在地</span>
                </p>
                <p id="mass" class="menunav-row">
                    <span class="parentup" data-type="1">招标类型</span>
                </p>
                <p id="select" class="menunav-row">
                    <span class="parentup" data-type="2">招标品类</span>
                </p>
            </div>
        </div>
    </div>
    <div class="optionlist" id="optionlist" style="display: none;">
        {{--所在地--}}
        <div class="rsswitchinfo menunav-info moreinfo" id="rsswitchinfo">
            <!--区域-->
            <div class="regioninfo auto-scoll" id="regioninfo">
                <ul class="regionlist" id="regionlist">
                    <li class="region-item">
                        <a data-id="0"
                           href="{{route('exhibition.developer-project.list',array_merge($appends, ['province_id' => 0 ]))}}"
                           @if(($appends['province_id'] ?? 0) == 0) class="active" @endif>全国</a>
                    </li>
                    @foreach(($area ?? []) as $area_info)
                        <li class="region-item special-li">
                            <a @if(($appends['china_area_id'] ?? 0) == $area_info['id']) class="active"
                               @endif data-id="{{$area_info['id']}}" href="#">{{$area_info['name']}}</a>
                            <!--省份-->
                            <div class="province-info" id="blockinfo-{{$area_info['id']}}" style="display: none;">
                                <div class="province-list auto-scoll">
                                    @foreach(($area_info['provinces'] ?? []) as $province)
                                        <a @if(($appends['province_id'] ?? 0) == $province['id']) class="active"
                                           @endif href="{{route('exhibition.developer-project.list',array_merge($appends, ['province_id' => $province['id']]))}}"
                                           data-id="{{$province['id']}}">{{$province['name']}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        {{--招标类型--}}
        <div class="mass menunav-info" id="typeinfo" style="display: none;">
            <div class="typelist auto-scoll">
                <a href="{{route('exhibition.developer-project.list',array_merge($appends, ['bidding_type' =>0]))}}"
                   @if(($appends['bidding_type'] ?? 0) == 0) class="active" @endif
                   data-id="0">全部</a>
                @foreach(($bidding_types ?? []) as $key => $bidding_type)
                    <a href="{{route('exhibition.developer-project.list',array_merge($appends, ['bidding_type' => $key]))}}"
                       @if(($appends['bidding_type'] ?? 0) == $key) class="active" @endif
                       data-id="{{$key}}">{{$bidding_type}}</a>
                @endforeach
            </div>
        </div>
        {{--招标品类--}}
        <div class="mass menunav-info" id="categoryinfo" style="display: none;">
            <div class="categorylist auto-scoll">
                <a @if(($appends['project_first_category_id'] ?? 0) == 0) class="active" @endif
                href="{{route('exhibition.developer-project.list',array_merge($appends, ['project_first_category_id' => 0]))}}"
                   data-id="0">全部</a>
                @foreach(($project_categorys ?? []) as $k => $project_category)
                    <a @if(($appends['project_first_category_id'] ?? 0) == $k) class="active" @endif
                    href="{{route('exhibition.developer-project.list',array_merge($appends, ['project_first_category_id' => $k]))}}"
                       data-id="{{$k}}">{{$project_category}}</a>
                @endforeach
            </div>
        </div>
    </div>
    <div id="dialog" style="display: none;"></div>

    <div class="list-box">
        <div class="list-content">
            <ul class="common-list">
                @if(!empty($items))
                    @foreach(($items ?? []) as $key =>$item)
                        <li>
                            <a href="javascript:void(0);">
                                <p class="title" title="{{$item['name'] or ''}}">{{$item['name'] or ''}}</p>
                                <img src="{{$item['logo_url'] or ''}}" alt="">
                                <div class="list-detail">
                                    <p title="{{$item['developer_name'] or ""}}">{{$item['developer_name'] or ""}}</p>
                                    <p>建筑面积：{{$item['floor_space'] or ""}}m²</p>
                                    <p>项目类型：{{$item['project_category_name'] or ""}}</p>
                                </div>
                                <p class="time"><span>{{$item['time'] or ""}}</span><span><img
                                                src="/www/image/exhibition/exhibition-h5/adress.png"
                                                alt="">{{$item['city_name'] or ""}}</span></p>
                            </a>
                        </li>
                    @endforeach
                @else
                    <div class="content-empty">
                        <img src="/www/image/exhibition/exhibition-h5/content-empty.png" alt="">
                        <p>暂无数据</p>
                    </div>
                @endif
            </ul>
            <div class="clear"></div>
        </div>
    </div>

    <!--下拉分页模板-->
    <script type="text/html" id="common_list_tpl">
        <% for ( var i = 0; i < names.length; i++ ) { %>
        <li>
            <a href="javascript:void(0);">
                <p class="title" title="<%=names[i].name%>"><%=names[i].name%></p>
                <img src="<%=names[i].logo_url%>" alt="">
                <div class="list-detail">
                    <p title="<%=names[i].developer_name%>"><%=names[i].developer_name%></p>
                    <p>建筑面积：<%=names[i].floor_space%>m²</p>
                    <p>项目类型：<%=names[i].project_category_name%></p>
                </div>
                <p class="time"><span><%=names[i].time%></span><span><img
                                src="/www/image/exhibition/exhibition-h5/adress.png"
                                alt=""><%=names[i].city_name%></span></p>
            </a>
        </li>
        <% } %>
    </script>
@endsection


