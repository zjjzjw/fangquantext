<?php
$route_name = request()->route()->getName();
?>
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation"
        @if($route_name == 'provider.provider.detail') class="active" @endif >
        <a href="{{route('provider.provider.detail', ['id' => $provider['id']])}}">企业信息</a>
    </li>
    <li role="presentation"
        @if($route_name == 'provider.provider.engineer-case') class="active" @endif
    >
        <a href="{{route('provider.provider.engineer-case', ['id' => $provider['id']])}}">工程案例</a>
    </li>
    <li role="presentation"
        @if($route_name == 'provider.provider.product-display') class="active" @endif >
        <a href="{{route('provider.provider.product-display', ['id' => $provider['id']])}}">产品展示</a>
    </li>
    <li role="presentation"
        @if($route_name == 'provider.provider.service-network') class="active" @endif >
        <a href="{{route('provider.provider.service-network', ['id' => $provider['id']])}}">服务网点</a>
    </li>

</ul>