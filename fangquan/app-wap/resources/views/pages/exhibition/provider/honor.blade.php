<?php App\Wap\Http\Controllers\Resource::addCSS(array('css/exhibition/provider/honor')); ?>
@extends('layouts.master')
@section('content')
    <div class="honor-box">
        <p>企业荣誉</p>
        <ul class="img-box">
            @if(!empty($certificate_images))
                @foreach(($certificate_images ?? []) as $key =>$item)
                    <li>
                        <img src={{$item or ""}}  alt="">
                    </li>
                @endforeach
            @else
                <div class="content-empty">
                    <img src="/www/image/exhibition/exhibition-h5/content-empty.png" alt="">
                    <p>暂无数据</p>
                </div>
            @endif
        </ul>
    </div>
@endsection


