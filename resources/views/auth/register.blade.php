<!DOCTYPE html>
<html lang="en">
<head>
    <title>主播的小秘密</title>
    <link rel="stylesheet" href="{{ asset('assets/css/passport.css') }}">
    <meta charset="utf-8">
</head>
<body>
    <!-- 背景特效 -->
    <div id="container" class="bg_effect container">
        <div id="output" class="container">
        </div>
        <div id="vignette" class="overlay vignette">
        </div>
        <div id="noise" class="overlay noise">
        </div>
        <div id="ui" class="wrapper">
            <header id="header" class="header" style="display: none">
                <img class="logo" src="assets/graphics/logo.svg">
            </header>
            <article id="information" class="information">
            </article>
            <footer id="footer" class="footer" style="display: none">

            </footer>
        </div>
        <div id="controls" class="controls" style="display: none">
        </div>
    </div>
     <div class="footer">      
            <p>Copyright © 2017-2018 lulala. All rights reserved.丨鄂ICP备16016929号-4</p>
    </div>
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
    {{ csrf_field() }}
    <!-- 注册区域 -->
        <div class="register_area">
            <!-- 登录输入提示 -->
            <div class="register_top">
                <div class="logo">
                    <img src="assets/images/login/logo.png">
                </div>
              
                <div class="user_name">
                    <p>
                        邮箱
                        @if ($errors->has('email'))
                            <span style="color:red">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </p>
                    <input class="input_class" name="email" required value="{{ old('email') }}" type="text"></input>
                </div>
                <div class="password">
                    <p>
                        输入密码
                        @if ($errors->has('password'))
                            <span style="color:red">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                    </p>
                    <input class="input_class" name="password" required type="password"></input>
                </div>
                <div class="password">
                    <p>重新输入密码</p>
                    <input class="input_class" required name="password_confirmation" type="password"></input>
                </div>
                <div class="password">
                    <p>
                        请输入邀请码
                        @if ($errors->has('porn'))
                            <span style="color:red">
                                {{ $errors->first('porn') }}
                            </span>
                        @endif
                    </p>
                    <input class="input_class" required name="porn" type="text"></input>
                </div>
                <button type="submit" class="register_btn">
                    注册
                </button>
            </div>
             <!-- 快速注册 -->
            <div class="login_bottom">
                <p class="about_us"><a href="{{ route('about') }}" style="color:white">联系我们</a></p>
                <p class="quick_login"><a style="color:white" href="/login">快速登录&nbsp></a></p>
            </div>
        </div>
        <audio src="{{ asset('assets/music/bg_music.mp3') }}"  autoplay="autoplay" loop="loop"/>
    </form>
    <script src="{{ asset('assets/js/effectlibs/prefixfree.min.js') }}"></script>
    <script src="{{ asset('assets/js/effectlibs/dat.gui.min.js') }}"></script>
    <script src="{{ asset('assets/js/effectlibs/fss.min.js') }}"></script>
    <script src="{{ asset('assets/js/passport.js') }}"></script>
</body>
</html>
