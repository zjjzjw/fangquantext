<?php App\Wap\Http\Controllers\Resource::addCSS(array('css/exhibition/sign/sign-success')); ?>
<?php App\Wap\Http\Controllers\Resource::addJS(array('app/exhibition/sign/sign-success')); ?>
@extends('layouts.master')
@section('content')
    <div class="register-box">
        <div class="register-form">
            <p>签到成功！</p>
            <ul>
                @foreach($items ?? [] as $item)
                    <li>
                        <em class="@if(($item['crowd'] ?? 0) == 1)
                                crowd-type1
                                @elseif(($item['crowd'] ?? 0)  == 2)
                                crowd-type2
                                @elseif(($item['crowd'] ?? 0)  == 3)
                                crowd-type3
                                @elseif(($item['crowd'] ?? 0)  == 4)
                                crowd-type4
                                @elseif(($item['crowd'] ?? 0)  == 5)
                                crowd-type5
                                @elseif(($item['crowd'] ?? 0)  == 6)
                                crowd-type6
                                @endif">
                        </em>
                        <div>
                            <label>姓名：</label>
                            <span>{{$item['name'] ?? ''}}</span>
                        </div>
                        <div>
                            <label>公司：</label>
                            <span>{{$item['company_name'] ?? ''}}</span>
                        </div>
                    </li>
                @endforeach
            </ul>
            <p>欢迎进入2017首届房地产全产业链B2B创新采购展</p>
            <div class="btn-box">
                <div class="btn">返回</div>
            </div>
        </div>
    </div>
@endsection