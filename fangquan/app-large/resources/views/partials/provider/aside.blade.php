<div class="aside-box">
    <p class="title">联系方式</p>
    @if($brand_sales)
        @foreach($brand_sales as $brand_sale)
            <div class="contact-list">
                <p><span>联系人：</span>{{$brand_sale['name'] or ''}}</p>
                <p><span>联系电话：</span>{{$brand_sale['telphone'] or ''}}</p>
                <p><span>职位：</span>{{$brand_sale['type_name'] or ''}}</p>
                <p><span>负责区域：</span>{{$brand_sale['sale_area_names'] or ''}}</p>
            </div>
        @endforeach
    @else
        暂无信息
    @endif
</div>