<?php
ufa()->extCss([
    'developer/developer/edit'
]);
ufa()->extJs([
    '../lib/jquery-form-validator/jquery.form-validator',
    '../lib/jquery-file-upload/js/vendor/jquery.ui.widget',
    '../lib/jquery-file-upload/js/jquery.fileupload',
    'developer/developer/edit'
]);

ufa()->addParam(
    [
        'id'          => $id ?? 0,
        'provider_id' => $provider_id ?? 0,
        'areas'       => $areas ?? [],
        'province_id' => $province_id ?? 0,
        'city_id'     => $city_id ?? 0,
    ]
);
?>


@extends('layouts.master')
@section('master.content')
    <div class="wrapper-box">
        {{--@include('provider.nav', ['provider_id' =>$provider_id ?? 0])--}}
        <div class="content-box">
            <div class="button-box">
                @if(empty($id))
                    <p class="top-title">开发商添加</p>
                @else
                    <p class="top-title">开发商编辑</p>
                @endif
            </div>
            <form id="form" onsubmit="return false">

                <aside>
                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">公司名称：</label>
                        </div>
                        <div class="small-14 columns">
                            <input type="text" name="name" value="{{$name or ''}}"
                                   data-validation="required length"
                                   data-validation-length="max255"
                                   data-validation-error-msg="请添加公司名称"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">logo：</label>
                        </div>
                        <div class="small-14 columns">
                            <div class="img-box">
                                @include('common.add-picture', [
                                        'single' => true,
                                        'tips' => '上传文件',
                                        'name' => 'logo',
                                        'images' => $thumbnail_images ?? [],
                                   ])
                                <p class="error-file error-tip" style="display: none;">请上传封面</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label for="right-label" class="text-right">开发商状态：</label>
                        </div>
                        <div class="small-14 columns">
                            <select name="status" class="options"
                                    data-validation="required length"
                                    data-validation-length="max50"
                                    data-validation-error-msg="请选开发商状态">
                                <option value="">--请选开发商状态--</option>
                                @foreach($developer_status as $key => $name)
                                    <option @if($key == ($status ?? 0)) selected
                                            @endif value="{{$key}}">{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">开发商排名：</label>
                        </div>
                        <div class="small-14 columns">
                            <input type="text" name="rank" value="{{$rank or ''}}"
                                   data-validation="required length"
                                   data-validation-length="max255"
                                   data-validation-error-msg="请添加开发商排名"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">开发商地点：</label>
                        </div>
                        <div class="small-14 columns">
                            <div class="inline-areas">
                                <select name="province_id" id="province_id" class="project_province"
                                        data-validation="required"
                                        data-validation-error-msg="请选择省份"></select>
                            </div>
                            <div class="inline-areas">
                                <select name="city_id" id="city_id" class="project_city"
                                        data-validation="required"
                                        data-validation-error-msg="请选择城市"></select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">开发商地址：</label>
                        </div>
                        <div class="small-14 columns">
                            <input type="text" name="developer_address" value="{{$developer_address or ''}}"
                                   data-validation="required length"
                                   data-validation-length="max255"
                                   data-validation-error-msg="请添加开发商地点"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">分级原则：</label>
                        </div>
                        <div class="small-14 columns">
                            <i class="textarea" id="principles">
                                <textarea name="principles"
                                          data-validation="required length"
                                          data-validation-length="max255"
                                          data-validation-error-msg="请添加分级原则">{{$principles or ''}}</textarea>
                                <span class="text"><var class="number"></var> 字</span>
                            </i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">分项目落地决策：</label>
                        </div>
                        <div class="small-14 columns">
                            <i class="textarea" id="decision">
                                <textarea name="decision"
                                          data-validation="required length"
                                          data-validation-length="max255"
                                          data-validation-error-msg="请添加分项目落地决策">{{$decision or ''}}</textarea>
                                <span class="text"><var class="number"></var> 字</span>
                            </i>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">产品类别：</label>
                        </div>
                        <div class="small-14 columns range">
                            @foreach(($categorys ?? []) as $category)
                                <div class="range-container">
                                    <p>{{$category['name']}}</p>
                                    <div class="range-item">
                                        @foreach(($category['nodes'] ?? []) as $node)
                                            <span>
                                            <input type="checkbox" id="category{{$node['id']}}"
                                                   name="developer_categorys[]"
                                                   value="{{$node['id']}}"
                                                   data-validation="checkbox_group"
                                                   data-validation-qty="min1"
                                                   data-validation-error-msg="请至少选择1项"
                                                   @if(in_array($node['id'], $developer_category ?? [])) checked @endif
                                            />
                                            <label for="category{{$node['id']}}">{{$node['name']}}</label>
                                        </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="hidden" name="id" value="{{$id ?? 0}}">
                        <input type="submit" class="button small-width save" value="保存">
                        <a class="button small-width clone" href="JavaScript:history.back();">返回</a>
                    </div>
                </aside>
            </form>
        </div>
    </div>
    @include('common.add-picture-item')
    @include('common.success-pop')
    @include('common.loading-pop')
    @include('common.prompt-pop',['type'=>1])
@endsection