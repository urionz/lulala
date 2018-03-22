<!DOCTYPE html>
<html lang="en">
<head>
    <title>主播的小秘密</title>
    <link rel="stylesheet" href="{{ asset('assets/css/passport.css') }}">
    <meta charset="utf-8">
    <!-- <embed src="背景音乐网址" autostart="true" loop="-1"  width="0" height="0" > -->
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
                <img class="logo" src="{{ asset('assets/graphics/logo.svg') }}">
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

    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
        {{ csrf_field() }}
        <!-- 登录区域 -->
        <div class="login_area">
            <!-- 登录输入提示 -->
            <div class="login_top">
                <div class="logo">
                    <img src="{{ asset('assets/images/login/logo.png') }}">
                </div>
                
                <div class="user_name">
                    <p>
                        用户名
                        @if ($errors->has('email'))
                            <span style="color:red">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </p>
                    <input id="email" type="email" class="input_class" name="email"
                           value="{{ old('email') }}" required autofocus>
                </div>
                <div class="password">
                    <p>
                        密码
                        @if ($errors->has('password'))
                            <span style="color:red">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                    </p>
                    <input id="password" type="password" class="input_class" name="password" required>
                </div>
                <div class="notice">
                    <div class="auto_login checkboxStyle">
                        <input type="checkbox" value="1" id="checkboxStyleInput" name="remember"
                               checked="checked">&nbsp&nbsp下次自动登录</input>
                        <label for="checkboxStyleInput"></label>
                    </div>
                    <div class="forget_password">
                        <a href="{{ url('/password/reset') }}" style="color: #00a1d8;">忘记密码?</a>
                    </div>
                </div>
                <button type="submit" class="login_btn">
                    登录
                </button>
            </div>
            <!-- 快速注册 -->
            <div class="login_bottom">
                <p class="about_us"><a href="{{ route('about') }}" style="color:white">联系我们</a></p>
                <p class="quick_register"><a style="color:white" href="/register">快速注册&nbsp></a></p>
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