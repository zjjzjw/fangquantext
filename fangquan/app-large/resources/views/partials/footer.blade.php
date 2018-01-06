{{--<footer>--}}
{{--<div class="container">--}}
{{--<div class="row">--}}
{{--<p class="copyright">Copyright © 2017--}}
{{--<a href="#">yousite.com</a> All Rights Reserved.</p>--}}
{{--</div>--}}
{{--</div>--}}
{{--</footer>--}}
<?php
$route_name = request()->route()->getName();
?>

<a id="refresh" href="javascript:location.reload() ;" style="position: fixed; z-index: 2147483647; display: block;">
    <i class="fa fa-refresh"></i>
</a>

@if($route_name != 'home.index')
    <a id="pre-page" href="javascript:window.history.back();"
       style="position: fixed; z-index: 2147483647; display: block;">
        <i class="fa fa-chevron-left"></i>
    </a>
@endif

<a id="next-page" href="javascript:window.history.forward();"
   style="position: fixed; z-index: 2147483647; display: block;">
    <i class="fa fa-chevron-right"></i>
</a>

<a id="backHome" href="{{route('home.index',['p' => $p ?? 0])}}"
   style="position: fixed; z-index: 2147483647; display: block;">
    <i class="fa fa-home"></i>
</a>

<a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647; display: block;">
    <i class="fa fa-arrow-up"></i>
</a>