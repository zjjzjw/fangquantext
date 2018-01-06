<?php
ufa()->extCss([
    'developer/developer-partnership/index'
]);
ufa()->extJs([
    'developer/developer-partnership/index',
]);
?>
@extends('layouts.master')
@section('master.content')

    <div class="wrapper-box">
        <div class="content-box">
            <div class="button-box">
                <div class="add-btn">
                    <a href="{{route('developer.developer-partnership.edit',['id'=>0, 'developer_id' => 1])}}">+合作关系</a>
                </div>
            </div>

            

            <div class="table-box">
                <table class="table" cellspacing="0" cellpadding="0">
                    <thead>
                    <tr>
                        <th width="5%">编号</th>
                        <th width="85%">合作关系</th>
                        <th width="10%">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i=0;
                    ?>
                    @foreach($items as $item)
                        <?php
                        $i++;
                        ?>
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$item['developer_info']['name'] or []}}采购了{{$item['provider_info']['company_name'] or ''}} 的{{$item['category_names'] or ''}}</td>
                            <td>
                                <a class="icon-edit" title="编辑"
                                   href="{{route('developer.developer-partnership.edit',['id'=>$item['id']])}}">
                                    <i class="iconfont">&#xe626;</i>
                                </a>
                                <a data-id="{{$item['id']}}" title="删除" class="delete">
                                    <i class="iconfont">&#xe601;</i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{--分页--}}
            @if(!$paginate->isEmpty())
                <div class="patials-paging">
                    {!! $paginate->render() !!}
                </div>
            @endif
        </div>
    </div>

    @include('common.prompt-pop',['type'=>1])
    @include('common.confirm-pop' ,['type' => 2,'confirm_text' => "这条数据"])
@endsection