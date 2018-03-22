<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <title>主播的小秘密</title>
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}"/>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/about_us.css') }}">
    <meta charset="utf-8">
</head>
<body>
<div class="header">
    <img class="left_icon" src="{{ asset('assets/images/icon_logo.png') }}">
    <div class="right_icons">       
        <ul>
            @if(Auth::user())
                <li id="userName" class="user_info">
                    <div class="user_nick">
                        <p class="short_nick">
                            <span class="glyphicon glyphicon-user"></span>
                            <a href="{{ route('user.index') }}">{{ !empty(Auth()->user()->nickname) ? Auth()->user()->nickname : Auth()->user()->email }}</a>
                        </p>
                        <p class="caret"></p>
                    </div>
                    <ul class="user_info_container">
                        <li class="user_info_item" ><a href="{{ route('tpl.edit') }}">模板编辑</a></li>
                        <li class="user_info_item" ><a href="/logout">退出登录</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</div>
<div class="content">
    <div class="content_header">    
    </div>
    <div class="content_body" >
        <div class="item_list">
            <div class="info_item">
                <img src="{{ asset('assets/images/about_us/icon_mail.png') }}" >
                <div>
                    <P>官方邮箱：contact@lulala.com</P>                  
                </div>
            </div>
            <div class="info_item">
                <img src="{{ asset('assets/images/about_us/icon_qq.png') }}" >
                <div>
                    <P>官方Q群：569099235</P>                   
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <p>Copyright © 2017-2018 lulala. All rights reserved.丨鄂ICP备16016929号-4</p>
</div>
</body>
</html>