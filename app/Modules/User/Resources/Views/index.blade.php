<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <title>主播的小秘密</title>
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}"/>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/fonts/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/user_center.css') }}">
    <link href="{{ asset('third/crop-avatar/dist/cropper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('third/crop-avatar/css/main.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/layer/layer.js') }}"></script>
    <meta charset="utf-8">
</head>
<body ng-app="userCenterApp" >
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
<div ng-controller="userCenterControl">
    <div class="left_area">
        <div class="user_info">
            <img class="user_avatar" src="{{ Auth()->user()->avatar ? Auth()->user()->avatar : asset('assets/images/default_avatar.jpg') }}">
            <p class="user_name">{{ Auth()->user()->name ? Auth()->user()->name : Auth()->user()->email }}</p>
            <p class="user_type">普通</p>
        </div>
        <div class="nav">
            <div class="sub_nav">                
                <div class="sub_title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp作品管理</div>
                <div ng-click="clickSelType(11)" data-id=11 class="nav_item">&nbsp&nbsp&nbsp&nbsp作品列表</div>                                    
                <div ng-click="clickSelType(12)" data-id=12 class="nav_item">&nbsp&nbsp&nbsp&nbsp资源管理</div>               
            </div>
            <div class="sub_nav">                
                <div class="sub_title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp账号设置</div>
                <div ng-click="clickSelType(21)" data-id=21 class="nav_item">&nbsp&nbsp&nbsp&nbsp个人信息</div>                                    
                <div ng-click="clickSelType(22)" data-id=22 class="nav_item">&nbsp&nbsp&nbsp&nbsp账号安全</div>               
            </div>
             <div class="sub_nav">
                <div class="sub_title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp我的收益</div>
                <div ng-click="clickSelType(31)" data-id=31 class="nav_item">&nbsp&nbsp&nbsp&nbsp收益概况</div>                               
                <div ng-click="clickSelType(32)" data-id=32 class="nav_item">&nbsp&nbsp&nbsp&nbsp打赏管理</div>               
            </div>
            <div class="sub_nav">
                <div class="sub_title"><i class="glyphicon glyphicon-list-alt"></i>&nbsp数据统计</div>
                <div ng-click="clickSelType(41)" data-id=41 class="nav_item">&nbsp&nbsp&nbsp&nbsp基础概况</div>                               
                <div ng-click="clickSelType(42)" data-id=42 class="nav_item">&nbsp&nbsp&nbsp&nbsp高级数据</div>               
            </div>
            <div class="sub_nav">
                 <div class="sub_title"><i class="glyphicon glyphicon-list-alt"></i>&nbspOur Lulala</div>  
                 <div ng-click="clickSelType(51)" data-id=51 class="nav_item">&nbsp&nbsp&nbsp&nbsp制作技巧</div>
                 <div ng-click="clickSelType(52)" data-id=52 class="nav_item">&nbsp&nbsp&nbsp&nbsp联系我们</div>                 
            </div>
        </div>
    </div>
    <div class="right_area">
       <!-- 作品管理 -->
        <div ng-show="curTypeId==11" class="faq_info">
            <div class="title"><i class="icon iconfont icon-16pxtishi"></i>&nbsp暂无内容</div>
            <div class="content">
            <iframe class="iframe_class" scrolling="yes" src="" data-id=41 ></iframe>
            </div>
        </div>
         <!-- 资源管理 -->
        <div ng-show="curTypeId==12" class="faq_info">
            <div class="title"><i class="icon iconfont icon-16pxtishi "></i>&nbsp暂无内容</div>
            <div class="content">
            <iframe class="iframe_class" scrolling="yes" src="" data-id=42 ></iframe>
            </div>
        </div>
        <!-- 用户信息 -->
        <div ng-show="curTypeId==21" class="user_info">
            <div class="title"><i class="icon iconfont icon-anquan "></i>&nbsp个人信息</div>            
            <div class="content">
                <iframe class="iframe_class" id="user_info" scrolling="yes" src="" data-id=21 ></iframe>
            </div>           
        </div>
        <!-- 账号信息 -->
        <div ng-show="curTypeId==22" class="account_info">
            <div class="title"><i class="icon iconfont icon-anquan "></i>&nbsp账号安全</div>
            <div class="content">
              <iframe class="iframe_class" scrolling="yes" src="" data-id=22 ></iframe>
            </div>
        </div>
       
         <!-- 收益情况 -->
        <div ng-show="curTypeId==31" class="faq_info">
            <div class="title"><i class="icon iconfont icon-16pxtishi "></i>&nbsp暂无内容</div>
            <div class="content">
            <iframe class="iframe_class" scrolling="yes" src="" data-id=41 ></iframe>
            </div>
        </div>
         <!-- 打赏管理 -->
        <div ng-show="curTypeId==32" class="faq_info">
            <div class="title"><i class="icon iconfont icon-16pxtishi "></i>&nbsp暂无内容</div>
            <div class="content">
            <iframe class="iframe_class" scrolling="yes" src="" data-id=42 ></iframe>
            </div>
        </div>

        <!-- 基础数据 -->
        <div ng-show="curTypeId==41" class="faq_info">
            <div class="title"><i class="icon iconfont icon-16pxtishi "></i>&nbsp暂无内容</div>
            <div class="content">
            <iframe class="iframe_class" scrolling="yes" src="" data-id=41 ></iframe>
            </div>
        </div>
         <!-- 高级数据 -->
        <div ng-show="curTypeId==42" class="faq_info">
            <div class="title"><i class="icon iconfont icon-16pxtishi "></i>&nbsp暂无内容</div>
            <div class="content">
            <iframe class="iframe_class" scrolling="yes" src="" data-id=42 ></iframe>
            </div>
        </div>
         <!-- faq -->
        <div ng-show="curTypeId==51" class="faq_info">           
            <div class="content">
            <iframe class="iframe_class" scrolling="yes" src="" data-id=51 ></iframe>
            </div>
        </div>
          <!-- 联系我们 -->
        <div ng-show="curTypeId==52" class="faq_info">
            <div class="title"><i class="icon iconfont icon-lianxiwomen "></i>&nbsp联系我们</div>
            <div class="content">
            <iframe class="iframe_class" scrolling="yes" src="" data-id=52 ></iframe>
            </div>
        </div>
        <div class="footer">
            <p>Copyright © 2017-2018 lulala. All rights reserved.丨鄂ICP备16016929号-4</p>
        </div>       
    </div>

</div>



<script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/angular/angular.min.js') }}"></script>

<script type="text/javascript">
    var userCenterApp = angular.module('userCenterApp', []);
    var iframeUrlDic = {};
    iframeUrlDic['id_21']="{{ route('user.user_info') }}", iframeUrlDic['id_22']="{{ route('user.user_account') }}" , iframeUrlDic['id_51']="{{ route('user.faq') }}", iframeUrlDic['id_52']="{{ route('user.about_us') }}";
    userCenterApp.controller('userCenterControl', function ($scope, $log, $timeout) {
        $scope.userAvator = "{{ asset('assets/images/default_frame/test.jpg') }}";
        $scope.curTypeId = 0;
        $scope.clickSelType = function (id) {
            if (id == $scope.curTypeId)return
            $scope.curTypeId = id;
            $scope.changeViews(id);
            $scope.updateViews();
            $(".iframe_class").css("height","99%");
            $timeout(function(){
                $(".iframe_class").css("height","100%");
            },50)
        }

        $scope.changeViews = function (id) {
            $(".left_area .nav").find(".nav_item").each(function (index) {
                var dataId = $(this).attr('data-id');
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active')
                }
                if (dataId == id) {
                    $(this).addClass("active");
                    $(".right_area").find(".iframe_class").each(function(index) {
                         var frameId = $(this).attr('data-id');
                         if(frameId == dataId){
                            if(!$(this).attr("src")){
                                $(this).attr("src",iframeUrlDic["id_"+frameId]);
                            }
                         }
                    });
                }
            });
        }

        $scope.updateViews = function() {
            if (!$scope.$$phase) {
                $scope.$apply();
            }
        }

        $scope.clickSelType(21);
        $(".user_info").css("visibility","visible");
        $(".account_info").css("visibility","visible");
        $(".faq_info").css("visibility","visible");
        // $(".iframe_class").css("overflow","scroll");

    });

    console.log($('#user_info').contents().find('#crop-avatar'));
</script>
</body>
</html>