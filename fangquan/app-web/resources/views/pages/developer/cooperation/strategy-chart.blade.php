<?php
ufa()->extCss([
    'developer/cooperation/strategy-chart'
]);
ufa()->extJs([
    'developer/cooperation/strategy-chart'
]);
?>
@extends('layouts.master')
@section('master.content')
    @include('partials.developer.developer-header')
    <div class="index-header">
        <div class="header-box">
            <a>导出</a>
        </div>
    </div>
    <div class="main-content">
        <table class="table" cellspacing="0" cellpadding="0">
            <thead>
            <tr>
                <th width="10%">开发商\品类</th>
                <th width="10%">土建材料</th>
                <th width="10%">装饰材料</th>
                <th width="10%">机电设备</th>
                <th width="10%">电器</th>
                <th width="10%">室外景观</th>
                <th width="10%">装修设计</th>
                <th width="10%">其他</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>万科</th>
                <td class="navy-blue">
                    <ul>
                        <li>总包</li>
                        <li>监理</li>
                        <li>地勘</li>
                        <li>涂料</li>
                        <li>防水涂料</li>
                        <li>屋面瓦</li>
                        <li>单元门</li>
                    </ul>
                </td>
                <td class="blue">
                    <ul style="display: none;">
                        <li>1</li>
                    </ul>
                </td>
                <td>
                    <ul style="display: none;">
                        <li>2</li>
                    </ul>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>碧桂园</th>
                <td></td>
                <td></td>
                <td class="blue"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>碧桂园</th>
                <td></td>
                <td></td>
                <td class="blue"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>碧桂园</th>
                <td></td>
                <td></td>
                <td class="blue"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <th>碧桂园</th>
                <td></td>
                <td></td>
                <td class="blue"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>碧桂园</th>
                <td></td>
                <td></td>
                <td class="blue"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>碧桂园</th>
                <td></td>
                <td></td>
                <td class="blue"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>碧桂园</th>
                <td></td>
                <td></td>
                <td class="blue"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>碧桂园</th>
                <td></td>
                <td></td>
                <td class="blue"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>碧桂园</th>
                <td></td>
                <td></td>
                <td class="blue"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>碧桂园</th>
                <td></td>
                <td></td>
                <td class="blue"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <th>碧桂园</th>
                <td></td>
                <td></td>
                <td class="blue"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
        <div class="remarks">
            <p>备注：</p>
            <p>
                <span>若您想了解型号等进一步信息，请联系客服，电话：021-6161661</span>
                <span>该信息属于定制服务，仅对VIP会员开放</span>
            </p>
        </div>
    </div>
@endsection