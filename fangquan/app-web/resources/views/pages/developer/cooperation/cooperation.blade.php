<?php
ufa()->extCss([
    'developer/cooperation/cooperation'
]);
ufa()->extJs([
    'developer/cooperation/cooperation'
]);
?>
@extends('layouts.master')
@section('master.content')
    @include('partials.developer.developer-header')
    <div class="index-header">
        <div class="header-box">
            <p>您已选品类：<span>地板，油烟机</span><span>（可添加品类哦！）</span></p>
            <a>导出</a>
        </div>
    </div>
    <div class="main-content">
        <table class="table" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th width="10%">开发商\供应商</th>
                @foreach(($developer_list ?? []) as $developer)
                    <th width="5%">{{$developer['name'] or ''}}</th>
                @endforeach
                {{--<th width="5%">老板</th>
                <th width="5%">方太</th>
                <th width="5%">老板</th>
                <th width="5%">方太</th>
                <th width="5%">老板</th>
                <th width="5%">方太</th>
                <th width="5%">方太</th>
                <th width="5%">老板</th>
                <th width="5%">方太</th>
                <th width="5%">老板</th>
                <th width="5%">方太</th>
                <th width="5%">方太</th>
                <th width="5%">老板</th>--}}
            </tr>
            </thead>
            <tbody>
            @foreach(($provider_list ?? []) as $provider)
            <tr>
                <th>{{$provider['company_name'] or ''}}</th>
                @foreach(($provider['relations'] ?? []) as $relation)
                <td>@if($relation['is_relation'])√@else @endif</td>
                @endforeach
                {{--<td>√</td>
                <td>√</td>
                <td>√</td>
                <td>√</td>
                <td>√</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>--}}
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection