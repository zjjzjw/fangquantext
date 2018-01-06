{{--轮播图 -s--}}
<div class="carousel-figure">
    <div class="swiper-container">
        <ul class="swiper-wrapper">
            @foreach($banners['all_images'] as $banner)
                <li class="swiper-slide">
                    <a href="{{$banner['web_url'] or ''}}">
                        <img src="{{$banner['url'] or ''}}">
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="login-form">
        <form id="form" method="POST" action="{{route('post.login')}}" class="login-wrapper">
            <h3>登录账户 | LOGIN</h3>
            <div class="form-group">
                <label>
                    <i class="iconfont">&#xe663;</i>
                </label>
                <div>
                    <input style="display:none">
                    <input type="text" name="account" value="{{old('account')}}" maxlength="32"
                           autocomplete="off"
                           placeholder="请输入用户名或者手机号"
                           data-validation="required length"
                           data-validation-length="max32"
                           data-validation-error-msg="请输入用户名或者手机号"/>
                </div>
            </div>
            <div class="form-group">
                <label>
                    <i class="iconfont">&#xe637;</i>
                </label>
                <div>
                    <input type="password" name="password" value=""
                           autocomplete="off"
                           placeholder="请输入密码"
                           data-validation="required"
                           data-validation-error-msg="请输入密码"/>
                </div>
            </div>
            <a href="" class="forget-password">忘记登录密码？</a>

            <div class="form-group">
                <input name="_token" type="hidden" value="{{csrf_token()}}">
                <input type="submit" class="btn" value="登录">
            </div>
            <a href="" class="registration">还不是会员，<span>免费注册</span></a>
            <div class="form-error">
                @if (count($errors) > 0)
                    <span>
                        @foreach ($errors->all() as $key => $error)
                            {{ $error }}
                        @endforeach
                            </span>
                @endif
            </div>
        </form>
    </div>

</div>
{{--轮播图 -e--}}