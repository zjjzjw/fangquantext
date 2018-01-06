<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="mobile-agent" content="format=html5;url={!!$meta_url or ''!!}">
    <meta id="viewport" name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>{!! $meta_title or '上海绘房信息科技有限公司' !!}</title>
    <meta name="Keywords" content="{!!$meta_keyword or ''!!}"/>
    <meta name="Description" content="{!!$meta_description or ''!!}"/>
    <link rel="shortcut icon" href="/favicon.ico"/>
    @include('resources.styles')
</head>


<body>
@section('master.main')
    @yield('master.content')
@show
@include('resources.scripts')
</html>
