{{--头部 -s--}}
<header>
    <div class="login-box">
        @if(auth()->guest())
            <span>下午好，</span>
            <a href="{{route('login')}}">
                <span>登录</span>
            </a>
            <a href="">
                <span>注册</span>
            </a>
        @else
            <span>下午好，</span>
            <a href="{{route('personal.main')}}">
                <span>{{request()->user()->account}}</span>
            </a>
        @endif
    </div>
    <div class="welcome-box">
        <span>欢迎来到房圈平台</span>
        <a href="">
            {{--下载APP--}}
        </a>
    </div>
</header>
{{--头部 -e--}}