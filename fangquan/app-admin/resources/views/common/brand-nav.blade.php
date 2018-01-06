<?php
$menus = [
        '基本信息'     => [
                'brand.edit'
        ],
        '工程案例'     => [
                'brand.brand-sign.index',
                'brand.brand-sign.edit'
        ],
        '企业资质文件'     => [
                'brand.brand-certificate.index',
                'brand.brand-certificate.edit'
        ],
        '生产基地'     => [
                'brand.brand-factory.index',
                'brand.brand-factory.edit'
        ],
        '区域对接人'    => [
                'brand.brand-sales.index',
                'brand.brand-sales.edit'
        ],
        '战略合作客户'   => [
                'brand.cooperation.index',
                'brand.cooperation.edit'
        ],
        '财务审计报告'    => [
                'brand.sale-channel.index',
                'brand.sale-channel.edit',
                'brand.sale-channel.modify'
        ],
        '补充资料'     => [
                'brand.supplementary.index',
                'brand.supplementary.edit'
        ]
];
$url_name = request()->route()->getName();

?>

<nav class="navigation-bar">
    <a href="{{route('brand.edit',['id'=> $brand_id ?? 0])}}"
       @if($url_name == 'brand.edit') class="active" @endif>
        <img src="/www/images/press.png" alt="">基本信息<span>*必填</span></a>

    <a href="{{route('brand.cooperation.index', ['brand_id'=> $brand_id ?? 0])}}"
       @if($url_name == 'brand.cooperation.index') class="active" @endif>
        @if(!empty($brand_progress['brand_cooperation'])) <img src="/www/images/press.png" alt=""> @endif 战略合作客户<span>*必填</span></a>

    <a href="{{route('brand.brand-sales.index',['brand_id'=> $brand_id ?? 0])}}"
       @if(in_array($url_name,$menus['区域对接人']) ) class="active" @endif>
        @if(!empty($brand_progress['brand_sale'])) <img src="/www/images/press.png" alt=""> @endif 区域对接人<span>*必填</span></a>

    <a href="{{route('brand.brand-sign.index', ['brand_id'=> $brand_id ?? 0])}}"
       @if(in_array($url_name,$menus['工程案例']) ) class="active" @endif>
        @if(!empty($brand_progress['brand_sign_list'])) <img src="/www/images/press.png" alt=""> @endif 工程案例<span>*必填</span></a>

    <a href="{{route('brand.brand-service.edit',['brand_id'=> $brand_id ?? 0])}}"
       @if($url_name == 'brand.brand-service.edit') class="active" @endif>
        @if(!empty($brand_progress['brand_service'])) <img src="/www/images/press.png" alt=""> @endif 服务体系</a>

    <a href="{{route('brand.brand-certificate.index',['brand_id'=> $brand_id ?? 0])}}"
       @if(in_array($url_name,$menus['企业资质文件']) ) class="active" @endif>
        @if(!empty($brand_progress['brand_certificate'])) <img src="/www/images/press.png" alt=""> @endif 企业资质文件</a>

    <a href="{{route('brand.brand-factory.index',['brand_id'=> $brand_id ?? 0])}}"
       @if(in_array($url_name,$menus['生产基地']) ) class="active" @endif>
        @if(!empty($brand_progress['brand_factory']))<img src="/www/images/press.png" alt=""> @endif 生产基地</a>

    <a href="{{route('brand.sale-channel.modify',['brand_id'=> $brand_id ?? 0])}}"
       @if(in_array($url_name,$menus['财务审计报告']) ) class="active" @endif>
        @if(!empty($brand_progress['brand_sale_channel']))<img src="/www/images/press.png" alt=""> @endif 财务审计报告</a>

    <a href="{{route('brand.supplementary.index',['brand_id'=> $brand_id ?? 0])}}"
       @if(in_array($url_name,$menus['补充资料']) ) class="active" @endif>
        @if(!empty($brand_progress['brand_supplementary'])) <img src="/www/images/press.png" alt=""> @endif 补充资料</a>
</nav>