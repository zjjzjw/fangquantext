<?php $route_name = request()->route()->getName(); ?>
<div id="developer-header" class="developer-header">
    <div class="public-header">
        <div class="logo">
            <a href="/"><img src="/www/images/developer/new-logo.png" alt=""></a>
        </div>
        <div class="supplice">
            <a href="{{route('developer.home')}}"
               class="@if($route_name == 'developer.home') active @endif">首页</a>

            <a href="{{route('developer.centrally-purchase.index')}}"
               class="@if(in_array($route_name,
               ['developer.centrally-purchase.index', 'developer.centrally-purchase.detail'])) active @endif">战略招采节点</a>

            <a href="{{route('developer.centrally-purchase.developer')}}"
               class="@if(in_array($route_name ,['developer.centrally-purchase.developer'
               ,'developer.centrally-purchase.developer-project'
               ,'developer.centrally-purchase.grade'
               ,'developer.centrally-purchase.project-detail'])) active @endif">战略集采专区</a>

            <a href="{{route('developer.cooperation.cooperation')}}"
               class="@if($route_name == 'developer.cooperation.cooperation') active @endif">合作开发商名录</a>

            <a href="{{route('developer.cooperation.strategy-chart')}}"
               class="@if($route_name == 'developer.cooperation.strategy-chart') active @endif">战略集采一览表</a>

            <a href="{{route('developer.project-list')}}"
               class="@if($route_name == 'developer.project-list') active @endif">非战略集采项目信息</a>

            <a href="{{route('information.index')}}"
               class="@if(in_array($route_name, ['information.index','information.infor-detail'])) active @endif">行业资讯</a>
        </div>

        <div class="login">
            @if(!empty($basic_data['user_info']['avatar_url']))
                <a href=""><img src="{{$basic_data['user_info']['avatar_url'] or ''}}" alt=""></a>
            @endif
            <a href="">Hi, {{$basic_data['user_info']['account'] or ''}}</a>
            <a href="{{route('logout')}}">退出</a>
        </div>
    </div>
</div>