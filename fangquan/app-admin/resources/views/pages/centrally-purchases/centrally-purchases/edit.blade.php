<?php
ufa()->extCss([
    '../lib/autocomplete/autocomplete',
    '../lib/datetimepicker/jquery.datetimepicker',
    'centrally-purchases/centrally-purchases/edit',
]);
ufa()->extJs([
    '../lib/autocomplete/autocomplete',
    '../lib/datetimepicker/jquery.datetimepicker',
    '../lib/jquery-form-validator/jquery.form-validator',
    'centrally-purchases/centrally-purchases/edit'
]);
ufa()->addParam(
    [
        'id'          => $id ?? 0,
        'areas'       => $areas ?? [],
        'province_id' => $province_id ?? 0,
        'city_id'     => $city_id ?? 0,
        'developer_id'     => $developer_id ?? 0,
    ]
);
?>


@extends('layouts.master')
@section('master.content')
    <div class="wrapper-box">
        <div class="content-box">
            <div class="button-box">
                @if(empty($id))
                    <p class="top-title">集采信息添加</p>
                @else
                    <p class="top-title">集采信息编辑</p>
                @endif
            </div>
            <form id="form" onsubmit="return false">
                <aside>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">所属开发商：</label>
                        </div>
                        <div class="small-14 columns">
                            <input type="text" name="developer_id" class="developer" id="keyword" value="{{$developer_info['name'] or ''}}" placeholder="请输入开发商名称（下拉联想选择项）"
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
                            <label class="text-right">招标内容：</label>
                        </div>
                        <div class="small-14 columns">
                            <input type="text" name="content" value="{{$content ?? ''}}" placeholder="请输入招标内容"
                                   data-validation="required length"
                                   data-validation-length="max50"
                                   data-validation-error-msg="请输入招标内容"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">招标期限：</label>
                        </div>
                        <div class="small-14 columns">
                            <input type="text" name="bidding_node" value="{{$bidding_node ?? ''}}" placeholder="请输入招标期限"
                                   data-validation="required length"
                                   data-validation-length="max50"
                                   data-validation-error-msg="请输入招标期限"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">省份：</label>
                        </div>
                        <div class="small-14 columns">
                            <select name="province_id" id="province_id">

                                <option value="">--请选择--</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">城市：</label>
                        </div>
                        <div class="small-14 columns">
                            <select name="city_id" id="city_id">
                                <option value="">--请选择--</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">招标地址：</label>
                        </div>
                        <div class="small-14 columns">
                            <input type="text" name="address" value="{{$address ?? ''}}" placeholder="请输入招标地址"
                                   data-validation="required length"
                                   data-validation-length="max50"
                                   data-validation-error-msg="请输入招标地址"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">项目数：</label>
                        </div>
                        <div class="small-14 columns">
                            <input type="text" name="p_nums" value="{{$p_nums ?? ''}}" placeholder="请输入项目数"
                                   data-validation="number required length"
                                   data-validation-allowing="float"
                                   data-validation-length="max11"
                                   data-validation-error-msg="请输入项目数"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">覆盖地址：</label>
                        </div>
                        <div class="small-14 columns">
                            <input type="text" name="area" value="{{$area ?? ''}}" placeholder="请输入覆盖地址"
                                   data-validation="required length"
                                   data-validation-length="max50"
                                   data-validation-error-msg="请输入覆盖地址"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">启动时间：</label>
                        </div>
                        <div class="small-14 columns">
                            <input type="text" name="start_up_time" value="{{$start_up_time ?? ''}}" placeholder="请输入启动时间" class="date"
                                   data-validation="required"
                                   data-validation-error-msg="请输入启动时间"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">联系人：</label>
                        </div>
                        <div class="small-14 columns">
                            <input type="text" name="contact" value="{{$contact ?? ''}}" placeholder="请输入联系人"
                                   data-validation="required length"
                                   data-validation-length="max50"
                                   data-validation-error-msg="请输入联系人"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">职务：</label>
                        </div>
                        <div class="small-14 columns">
                            <input type="text" name="contacts_position" value="{{$contacts_position ?? ''}}" placeholder="请输入职务"
                                   data-validation="required length"
                                   data-validation-length="max50"
                                   data-validation-error-msg="请输入职务"/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="small-8 columns text-right">
                            <label class="text-right">联系方式：</label>
                        </div>
                        <div class="small-14 columns">
                            <input type="text" name="contacts_phone" value="{{$contacts_phone ?? ''}}" placeholder="请输入联系方式" maxlength="11"
                                   data-validation="required length"
                                   data-validation-length="max11"
                                   data-validation-error-msg="请输入联系方式"/>
                        </div>
                    </div>


                </aside>

                <div class="text-center">
                    <input type="submit" class="button save" value="保存">
                    <input type="hidden" name="id" value="{{$id ?? 0}}">
                    <input type="hidden" name="created_user_id" value="{{$user_info['id'] ?? 0}}">
                    <a class="button clone" href="javascript:history.back()">取消</a>
                </div>
            </form>
        </div>
    </div>
    @include('common.success-pop')
    @include('common.loading-pop')
    @include('common.prompt-pop',['type'=>1])
@endsection