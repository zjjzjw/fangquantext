<?php
ufa()->extCss([
    '../lib/autocomplete/autocomplete',
    '../lib/datetimepicker/jquery.datetimepicker',
    'developer/developer-partnership/edit',
]);
ufa()->extJs([
    '../lib/autocomplete/autocomplete',
    '../lib/datetimepicker/jquery.datetimepicker',
    '../lib/jquery-form-validator/jquery.form-validator',
    'developer/developer-partnership/edit'
]);
ufa()->addParam(
    [
        'id'           => $id ?? 0,
        'developer_id' => $developer_id ?? 0,
    ]
);
?>

@extends('layouts.master')
@section('master.content')
    <div class="wrapper-box">
        <div class="content-box">
            <div class="button-box">
                @if(empty($id))
                    <p class="top-title">合作关系添加</p>
                @else
                    <p class="top-title">合作关系编辑</p>
                @endif
            </div>
            <form id="form" onsubmit="return false">
                <aside>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">所属开发商：</label>
                        </div>
                        <div class="small-14 columns">
                            <input type="text" name="developer_id" class="developer" id="developer-association"
                                   value="{{$developer_info['name'] or ''}}" placeholder="请输入开发商名称（下拉联想选择项）"
                                   data-validation="required length"
                                   data-validation-length="max50"
                                   data-validation-error-msg="请输入开发商"/>
                            <input type="hidden" id="developer_id" name="developer_id" value="{{$developer_id or ''}}">
                            <div class="content-wrap-second"></div>
                            <p class="error-tip-loupan error-tip" style="display: none;">请输入项目名称（下拉联想选择项）</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">所属供应商：</label>
                        </div>
                        <div class="small-14 columns">
                            <input type="text" name="provider_id" class="provider" id="provider-association"
                                   value="{{$provider_info['company_name'] or ''}}" placeholder="请输入供应商名称（下拉联想选择项）"
                                   data-validation="required length"
                                   data-validation-length="max50"
                                   data-validation-error-msg="请输入供应商"/>
                            <input type="hidden" id="provider_id" name="provider_id" value="{{$provider_id or ''}}">
                            <div class="content-wrap-second"></div>
                            <p class="error-tip-loupan error-tip" style="display: none;">请输入项目名称（下拉联想选择项）</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">签订时间：</label>
                        </div>
                        <div class="small-14 columns">
                            <input type="text" name="time" value="{{$time or ''}}"
                                   placeholder="请输入签订时间" class="date"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">地址：</label>
                        </div>
                        <div class="small-14 columns">
                            <input type="text" name="address" value="{{$address or ''}}" placeholder="请输入地址"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">采购品类：</label>
                        </div>
                        <div class="small-14 columns purchase-category">
                            <div class="textarea-select type-click" contenteditable="true">
                                @if(!empty($category_names))
                                    {{$category_names or ''}}
                                @else
                                    请选择采购品类
                                @endif
                            </div>
                            <input class="product_category_ids" type="hidden" name="developer_partnership_category"
                                   value="{{implode(',', $developer_partnership_category ?? [])}}"/>
                            <p class="error-category_ids error-tip" style="display: none;">请至少选择一项</p>
                        </div>
                    </div>

                </aside>

                <div class="text-center">
                    <input type="submit" class="button save" value="保存">
                    <input type="hidden" name="id" value="{{$id ?? 0}}">
                    <a class="button clone" href="javascript:history.back()">取消</a>
                </div>
            </form>
        </div>
    </div>
    @include('common.success-pop')
    @include('common.loading-pop')
    @include('common.prompt-pop',['type'=>1])
    @include('common.select-product-pop',['product_categories' => $main_category ?? [],
     'product_category_ids' => $developer_partnership_category ?? [],])
@endsection