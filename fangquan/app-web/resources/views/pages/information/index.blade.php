<?php
ufa()->extCss([
        'information/index'
]);
ufa()->extJs([
        'information/index'
]);
?>

@extends('layouts.master')
@section('master.content')
    @include('partials.developer.developer-header')
    <div class="information-list">
        @foreach($items as $item)
            <div class="information-box box-first">
                <div class="information-detail">
                    <div class="information-img">
                        <a href="{{route('information.infor-detail', ['id' => $item['id']])}}">
                            <img src="{{$item['image_url'] or ''}}?imageView2/1/w/190/w/130" alt="">
                        </a>
                    </div>
                    <div class="information-title">
                        <a href="{{route('information.infor-detail', ['id' =>  $item['id'] ])}}">
                            <p class="title">{{$item['title'] or ''}}</p>
                        </a>
                        <p class="time">{{$item['publish_at_str'] or ''}}</p>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        @endforeach

    </div>
    @include('common.loading-pop')

    <script type="text/html" id="show_moreTpl">
        <% for ( var k = 0; k < data.items.length; k++ ) { %>
        <div class="information-detail">
            <div class="information-img">
                <a href="/information/detail/<%=data.items[k].id%>"">
                        <img src="<%=data.items[k].thumbnail_images[0].url%>" alt="">
                    </a>
                </div>

                <div class="information-title">
                  <a  href="/information/detail/<%=data.items[k].id%>">
                        <p class="title"><%=data.items[k].title%></p>
                    </a>
                    <p class="time"><%=data.items[k].publish_at%></p>
                </div>
            </div>
            <div class="clear"></div>
        <% } %>
    </script>
@endsection