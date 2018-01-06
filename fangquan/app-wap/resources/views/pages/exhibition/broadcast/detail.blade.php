<?php App\Wap\Http\Controllers\Resource::addCSS(array('css/exhibition/broadcast/detail')); ?>
<?php App\Wap\Http\Controllers\Resource::addJS(array('app/exhibition/broadcast/detail')); ?>
@extends('layouts.master')
@section('content')
    @include('partials.exhibition-h5.developer.developer-header')

    <div class="broadcast">
        <iframe id="iframe" src="http://shangzhibo.tv/watch/3029616?player"
                style="overflow:hidden;" frameborder="0" scrolling="no"
                allowFullScreen>
        </iframe>
    </div>

    <div class="support-box">
        <ul>
            <li class="special-support">
                <a href="JavaScript:void(0);"><img src="/www/image/exhibition/exhibition-h5/WechatIMG133.jpeg"
                                                   alt=""></a>
                <p>主办单位：中国建材市场协会工程招标采购分会</p>
            </li>
            <li>
                <a href="JavaScript:void(0);"><img src="/www/image/exhibition/exhibition-h5/WechatIMG135.jpeg"
                                                   alt=""></a>
                <p>协办单位：<br>上海绘房信息科技有限公司</p>
            </li>
            <li class="special-support" style="display: none">
                <a href="JavaScript:void(0);"><img src="/www/image/exhibition/exhibition-h5/WechatIMG134.jpeg"
                                                   alt=""></a>
                <p>承办单位：<br>上海檐宇信息咨询有限公司</p>
            </li>
            <li>
                <a href="JavaScript:void(0);"><img src="/www/image/exhibition/exhibition-h5/WechatIMG136.jpeg"
                                                   alt=""></a>
                <p>全程战略合作：<br>方太集团</p>
            </li>
        </ul>

    </div>

    <div class="clear"></div>

    @include('partials.exhibition-h5.developer.developer-footer')
@endsection

