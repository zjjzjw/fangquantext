<div class="col-xs-12">
    <div class="top-box">
        <div class="pic-box"><a href="#"><img
                        src="{{$provider['logo_url'] or ''}}"/></a>
        </div>
        <div class="info">
            <p class="title">{{$provider['company_name'] or ''}}</p>
            <p class="tag"><span>{{$provider['brand_name'] or ''}}</span></p>
            <p class="about">
                            <span>
                            <i class="fa fa-map-marker"></i>
                                {{$provider['province']['name'] or ''}}，{{$provider['city']['name'] or ''}}
                            </span>
                <span>
                            主营产品：{{$provider['provider_main_category_name'] or ''}}
                            </span>
            </p>
        </div>
    </div>
</div>