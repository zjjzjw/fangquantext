{{--头部 -s--}}
<header>
    <div class="header-box">
        <div class="logo-box">
            <a href="/">
                <img src="/www/images/developer/new-logo.png" alt="">
            </a>
        </div>
        <div class="propaganda">
            <p>汇聚项目精品信息，打造供需双方沟通平台，我们为您提供最及时、最精准的行业资讯</p>
        </div>
        <div class="login-box">
            @if(empty($basic_data['user']))
                <a class="lon-in" href="{{route('login')}}"><i class="iconfont">&#xe63c;</i>登录</a>
                <span>|</span>
                <a class="register" href="{{route('register')}}"><i class="iconfont">&#xe60e;</i>注册</a>
            @else
                <a href="{{route('personal.message.list')}}" class="messages">
                    <i class="iconfont">&#xe64b;</i>
                    @if(($basic_data['login_info']['msg_unread_count'] ?? 0)> 0)
                        <span></span>
                    @endif
                </a>
                <a href="{{route('personal.home')}}"
                   class="nickname"><em>{{$basic_data['user']->nickname or ''}}</em></a>
                <span>|</span>
                <a class="register" href="{{route('logout')}}">退出</a>
            @endif
        </div>
    </div>
</header>
{{--头部 -e--}}