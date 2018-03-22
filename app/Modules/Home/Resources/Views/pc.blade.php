<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, minimum-scale=1">
    <title>主播的小秘密</title>
    <link rel="stylesheet" href="{{ asset('assets/fonts/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}"/>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/gridstack.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/gridstack-extra.css') }}" />
 	<link rel="stylesheet" href="{{ asset('assets/css/publish_pc.css') }}">
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
</head>
<script type="text/javascript">
    var data = {!! $template !!};
</script>

<body ng-app="GridStack" id="crop-avatar">
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
      
    </div>
    <div class="main_bg">
	    <div class="publish_area">
	    	<div class="mobile_area"  ng-controller="blockController" style="visibility: hidden">
		    <div class="mobile_bg"></div>
		    <div class="mobile_title">@{{gridListData.title}}</div>
		    <div class="content dragscroll" style="height: 373px;overflow: hidden;" >  
		            <div class="container-fluid" style="width:230px;padding-top: 0;position: relative;">
		                <div class="row" id="screenshot">
		                    <div class="fluid_bg col-md-12" style="padding-right:0;padding-left:0">
		                        <img ng-src=@{{gridListData.background}}>
		                    </div>
		                    <div id="grids_area" class="col-md-12" style="padding: 2.5px;min-height: 30px;margin-top:150px; width:100%">
		                        <div gridstack class="grid-stack grid1" options="options" on-change="onChange(event,items)" on-drag-start="onDragStart(event,ui)" on-drag-stop="onDragStop(event,ui)" on-resize-start="onResizeStart(event,ui)" on-resize-stop="onResizeStop(event,ui)">
		                            <div gridstack-item ng-repeat="grid in gridList" class="grid-stack-item" gs-item-x="grid.x" gs-item-y="grid.y" gs-item-width="grid.width" gs-item-height="grid.height" gs-item-autopos="0" on-item-added="onItemAdded(item)" on-item-removed="onItemRemoved(item)"
		                                data-id=@{{grid.id}} data-x=@{{grid.x}} data-y=@{{grid.y}}>
		                                <div class="grid-stack-item-content" ng-click="clickItem($event,grid)">
		                                    <div class="w_item">
		                                        <div ng-show="!grid.img_url" class="bgDiv"></div>
		                                        <img ng-show="grid.img_url" ng-src=@{{grid.img_url}}>
		                                        <img ng-show="gridListData.border['border_'+grid.height+'_'+grid.width]" ng-src=@{{gridListData.border['border_'+grid.height+'_'+grid.width]}}>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		            </div>            
                    <div class="lulala_logo">
                        <img class="lulala_watermark" src="{{ asset('assets/images/watermark.png') }}">
                     </div>
		    </div>
		    </div>
		    </div>
		    <div class="right_area">
		    	<div class="qr_area">
					<div class="qr_code">
                        {!! QrCode::size(210)->generate(Request::url()) !!}
					</div>
					<p>微信扫描预览</p>
		    	</div>
		    	<div class="share_area">
		    		<p>分享至：</p>
		    		<div class="weixin" >
		    			<a href="#"><img src="{{ asset('assets/images/wechat.png') }}"></a>
		    			<div class="pop_qr">
		    				<div class="pop_area">
                                {!! QrCode::size(210)->generate(Request::url()) !!}
		    				</div>
		    			</div>
		    		</div>
		    		<a target="_blank" href="http://s.share.baidu.com/?click=1&url={!! Request::url() !!}&uid=0&to=sqq&type=text&pic={{ strpos($template->thumbnail, 'http') === 0 ? $template->thumbnail : Request::url() . '/' . $template->thumbnail }}&title={{ $template->title }}"><img src="{{ asset('assets/images/qq.png') }}"></a>
		    		<a target="_blank" href="http://s.share.baidu.com/?click=1&url={!! Request::url() !!}&uid=0&to=tsina&type=text&pic={{ strpos($template->thumbnail, 'http') === 0 ? $template->thumbnail : Request::url() . '/' . $template->thumbnail }}&title={{ $template->title }}"><img src="{{ asset('assets/images/weibo.png') }}"></a>
		    		<a target="_blank" href="http://s.share.baidu.com/?click=1&url={!! Request::url() !!}&uid=0&to=qzone&type=text&pic={{ strpos($template->thumbnail, 'http') === 0 ? $template->thumbnail : Request::url() . '/' . $template->thumbnail }}&title={{ $template->title }}"><img src="{{ asset('assets/images/q_zone.png') }}"></a>
		    		<a target="_blank" href="http://s.share.baidu.com/?click=1&url={!! Request::url() !!}&uid=0&to=douban&type=text&pic={{ strpos($template->thumbnail, 'http') === 0 ? $template->thumbnail : Request::url() . '/' . $template->thumbnail }}&title={{ $template->title }}"><img src="{{ asset('assets/images/dou.png') }}"></a>
		    	</div>

		    	<div class="share_input">
		    		<div class="text_show" >{!! Request::url() !!}</div>
		    		<div class="copy_btn" id="copy_btn" data-clipboard-text="{!! Request::url() !!}">复制</div>
		    	</div>
	    	</div>
	    </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/lodash/lodash.min.js') }}"></script>
    <script src="{{ asset('assets/js/angular/angular.min.js') }}"></script>
    <script src="{{ asset('assets/js/libs/gridstack.js') }}"></script>
    <script src="{{ asset('assets/js/mousewheel.js') }}"></script>
    <script src="{{ asset('assets/js/easyscroll.js') }}"></script>
    <script src="{{ asset('assets/js/publish_pc.js') }}"></script>
    <script src="{{ asset('third/dragscroll/dragscroll_micro.js') }}" charset="utf-8"></script>
    <script src="{{ asset('third/clipboard/clipboard.min.js') }}" charset="utf-8"></script>
    <script type="text/javascript">
        var btn = document.getElementById('copy_btn');
        var clipboard = new Clipboard(btn);

        clipboard.on('success', function(e) {
            alert('已复制到剪贴板!');
        });

        clipboard.on('error', function(e) {
            alert('复制失败!');
        });
    </script>
</body>

</html>
