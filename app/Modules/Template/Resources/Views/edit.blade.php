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
    <link rel="stylesheet" href="{{ asset('assets/css/gridstack.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/gridstack-extra.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/lulala_main.css') }}"/>

    <link href="{{ asset('third/crop-avatar/dist/cropper.min.css') }}" rel="stylesheet">
    <link href="{{ asset('third/crop-avatar/css/main.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/layer/layer.js') }}"></script>
</head>
<script type="text/javascript">
    var collection = {!! $collection !!};
    var csrf = "{{ csrf_token() }}";
</script>

<body ng-app="GridStack" id="crop-avatar">
<div class="header">
    <img class="left_icon" src="{{ asset('assets/images/icon_logo.png') }}">
    <div class="title_input">
        <input id="input_grid_title" type="text" placeholder=@{{gridListData.placeholder}}></input>
    </div>
    <div class="right_icons">       
        <ul>            
            <li id="reviewBtn" class="review right_icons_item"><i class="icon iconfont icon-yanjing "></i>&nbsp预览</li>
            <li id="publishBtn" class="publish right_icons_item"><i class="icon iconfont icon-fabu"></i>&nbsp发布</li>
            <li id="saveBtn" class="save right_icons_item"><i class="icon iconfont icon-iconfontbaocun"></i>&nbsp保存</li>
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
    <div class="left_area" ng-controller="leftController">
        <div class="content">
            <div class="template_nav">
                <div ng-click="clickChangeMenu(1)" data-id=1 class="template_item active">模板</div>
                <div ng-click="clickChangeMenu(2)" data-id=2 class="template_item">定制</div>
                <div ng-click="clickChangeMenu(3)" data-id=3 class="template_item">我的</div>
            </div>
            <div class="img_area">                        
                    <div class="img_list">      
                        <div class="div_scroll">                 
                             <div ng-show="!curLibs.length" class="no_images">
                                <img ng-src="{{ asset('assets/images/no_template.png') }}" >
                             </div>
                            <ul>
                                <li ng-click="clickUseModule(image,$event)" ng-mouseOver="mouseOverTemplateHandler(image.status,$event)" ng-mouseOut="mouseOutTemplateHandler(image.status,$event)"
                                    data-id=@{{image.id}} data-type=@{{image.type}} ng-repeat="image in curLibs">                       
                                <img ng-src=@{{image.thumbnail}}>
                                <div class="template_del" ng-click="clickDelTempalte(image.id,$event)">
                                     <i class="icon iconfont icon-iconfontguanbi2"></i>
                                </div>   
                                <img class="template_used" ng-show="image.status == 1 && curMenu !=1"
                                     ng-src="{{ asset('assets/images/using.png') }}">
                                </li>
                            </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div ng-controller="blockController" class="mid_area" ng-click="cancelClickHandler($event)">
        <!-- <div class="div_scroll"> -->
        <!-- <div class="out_container"> -->
        <div class="container-fluid" style="width: 375px;padding-top: 85px;padding-bottom: 20px;">
            <div class="row" id="screenshot">
                <div class="fluid_bg">
                    <div id="uploadBgBtn" class="set_up_bg">设置背景</div>
                    <img ng-src=@{{grid_bg_img?'/tpl/cors?imageurl='+grid_bg_img:''}}>
                </div>
                <div class="col-md-12" style="padding: 2.5px;min-height: 30px;margin-top:155px;width:100%">
                    <div gridstack class="grid-stack grid1" options="options" on-change="onChange(event,items)"
                         on-drag-start="onDragStart(event,ui)" on-drag-stop="onDragStop(event,ui)"
                         on-resize-start="onResizeStart(event,ui)" on-resize-stop="onResizeStop(event,ui)">
                        <div gridstack-item ng-repeat="grid in gridList" class="grid-stack-item" gs-item-x="grid.x"
                             gs-item-y="grid.y" gs-item-width="grid.width" gs-item-height="grid.height"
                             gs-item-autopos="0" on-item-added="onItemAdded(item)" on-item-removed="onItemRemoved(item)"
                             data-id=@{{grid.id}} data-x=@{{grid.x}} data-y=@{{grid.y}}>
                            <div class="grid-stack-item-content" ng-click="clickItem($event,grid)">
                                <div class="w_item">
                                    <div ng-show="!grid.img_url" class="bgDiv"></div>
                                    <img ng-show="grid.img_url" ng-src=@{{grid.img_url?'/tpl/cors?imageurl='+grid.img_url:""}}>
                                    <img ng-show="gridListData.border['border_'+grid.height+'_'+grid.width]"
                                         ng-src=@{{gridListData.border['border_'+grid.height+'_'+grid.width]?"/tpl/cors?imageurl="+gridListData.border['border_'+grid.height+'_'+grid.width]:""}}>
                                    <div ng-show="grid.isEdit" class="show_modify_grid"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="add_moudel" ng-click="clickReqAddGrid()">
                    <i class="add_type icon iconfont icon-tianjia"></i>
                </div>
                @if(Auth::user()->id === 10000)
                    <div class="add_border">
                        <i class="add_type icon iconfont icon-f-plus" data-toggle="modal" data-target="#setBorder"></i>
                    </div>
                @endif
            </div>
            <!-- </div> -->
            <!-- </div> -->
        </div>
    </div>

    <div class="right_area">
        <div class="content">           
            <!-- 修改网格 -->
            <div ng-show="curModifyData!=null" class="modify_grid" ng-controller="modifyController"> 
                <div class="modify_title"><i class="icon iconfont icon-f-plus"></i>&nbsp模块修改</div>
                <div class="modify_top">                   
                    <ul class="add_del">
                        <li id="delGrid" class="del_grid" ng-click="clickDelGrid()">删除模块</p>
                    </ul>
                </div>
                <div class="modify_title"><i class="icon iconfont icon-diaozhengdaxiaoresize5 resize_img"></i>&nbsp调整大小</div>
                <div class="set_size">
                    <div class="title">&nbsp</div>
                    <div ng-click="clickSelGridType({width:4,height:4},1)" data-id=1 class="size_type set_size_active">
                        <i class="icon iconfont icon-xiao1"></i></div>
                    <div ng-click="clickSelGridType({width:8,height:4},3)" data-id=2 class="size_type"><i
                                class="icon iconfont icon-kuan1"></i></div>
                    <div ng-click="clickSelGridType({width:8,height:8},5)" data-id=3 class="size_type"><i
                                class="icon iconfont icon-da1"></i></div>
                </div>
                <div class="modify_title"><i class="icon iconfont icon-19 resize_img"></i>&nbsp编辑图片</div>
                <div class="img_nav">
                    <div ng-click="clickChangeLibs(1)" data-id=1 class="img_nav_item active">默认</div>
                    <div ng-click="clickChangeLibs(2)" data-id=2 class="img_nav_item">我的</div>
                </div>
                <div class="modify_mid">

                    <!--  图片上传和选择 -->
                    <div class="img_modify_eara">                      
                        <div class="img_area">                           
                                <div class="img_list">    
                                 <div class="div_scroll">
                                     <div ng-show="curType == 2" class="del_panel">
                                        <div class="del_item_left"></div>     
                                        <div class="del_item_mid" ng-click="clickDelAllSelectdImages()"><i class="add_type icon iconfont icon-shanchu"></i> 删除</div>                                    
                                        <div class="del_item_right" ng-click="clickManage()">管理</div>
                                     </div>                                                  
                                        <ul>                                          
                                            <li class=@{{"img_"+curType}}  ng-click="clickUpdateImage(image)" ng-repeat="image in curLibs" ng-mouseOver="mouseOverHandler($event)" ng-mouseOut="mouseOutHandler($event)">
                                                <div class="hover_del" ng-click="clickDelImage(image.id,$event)">
                                                     <i class="icon iconfont icon-iconfontguanbi2"></i>
                                                </div>                                                
                                                <div class="sel_del checkboxStyle" ng-click="checkBoxClickHandler(image.id,$event)">                                                                                                      
                                                    <input class="input_class" type="checkbox" value="1" id=@{{image.id}} name="remember"
                                                 ></input>
                                                <label for=@{{image.id}}></label>               

                                                </div>
                                                <img ng-src=@{{image.material}}>
                                            </li>
                                        </ul>                                
                                </div>
                            </div>    
                            <div ng-show="curType == 2" class="uploadImage avatar-view">上传图片</div>                       
                        </div>
                      
                    </div>
                </div>
                <div class="modify_bottom">

                    <ul>
                        <li class="notice"><i class="icon iconfont icon-lianjie1"></i>链接</li>
                        <li>
                            <input type="text" ng-model="curModifyData.image_herf" class="input_herf"></input>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Cropping modal -->
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog"
         tabindex="-1">
        <div class="modal-dialog modal-lg" style="z-index: 99999999;">
            <div class="modal-content">
                <form class="avatar-form" action="{{ route('material.upload') }}" enctype="multipart/form-data" method="post">
                    {!! csrf_field() !!}
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title" id="avatar-modal-label">上传图片</h4>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">

                            <!-- Upload image and data -->
                            <div class="avatar-upload">
                                <input class="avatar-src" name="avatar_src" type="hidden">
                                <input class="avatar-data" name="avatar_data" type="hidden">
                                <label for="avatarInput">请选择上传图片</label>
                                <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                            </div>

                            <!-- Crop and preview -->
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="avatar-wrapper"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="avatar-preview preview-lg"></div>
                                    <div class="avatar-preview preview-md"></div>
                                    <div class="avatar-preview preview-sm"></div>
                                </div>
                            </div>

                            <div class="row avatar-btns">
                                <div class="col-md-3">
                                    <button class="btn btn-primary btn-block avatar-save" type="submit">确定</button>
                                </div>

                                <div class="col-md-3">
                                    <button class="btn btn-primary btn-block avatar-scale" type="button" data="1/1">
                                        图片比例1:1
                                    </button>
                                </div>

                                <div class="col-md-3">
                                    <button class="btn btn-primary btn-block avatar-scale" type="button" data="2/1">
                                        图片比例2:1
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">
              <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
            </div> -->
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->

    <!-- Cropping modal -->
    <div class="modal fade" id="background-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog"
         tabindex="-1">
        <div class="modal-dialog modal-lg" style="z-index: 99999999;">
            <div class="modal-content">
                <form class="background-form" action="{{ route('border.upload') }}" enctype="multipart/form-data"
                      method="post">
                    {!! csrf_field() !!}
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title" id="avatar-modal-label">上传图片</h4>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">

                            <!-- Upload image and data -->
                            <div class="avatar-upload">
                                <input class="background-src" name="avatar_src" type="hidden">
                                <input class="background-data" name="avatar_data" type="hidden">
                                <label for="avatarInput">请选择上传图片</label>
                                <input class="background-input" id="avatarInput" name="avatar_file" type="file">
                            </div>

                            <!-- Crop and preview -->
                            <div class="row">
                                <div class="col-md-9" style="max-height: 600px;overflow: auto;">
                                    <div class="background-wrapper"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="avatar-preview preview-lg background-preview"></div>
                                    <div class="avatar-preview preview-md background-preview"></div>
                                    <div class="avatar-preview preview-sm background-preview"></div>
                                </div>
                            </div>

                            <div class="row background-btns" style="margin-top:10px;">
                                <div class="col-md-3">
                                    <button class="btn btn-primary btn-block background-save" type="submit">确定</button>
                                </div>
                                <div class="col-md-3" style="visibility: hidden">
                                    <button class="btn btn-primary btn-block background-scale" type="button"
                                            data="2.14">2.14:1
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">
              <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
            </div> -->
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->

    <!-- Cropping modal -->
    <div class="modal fade" id="borderSet-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog"
         tabindex="-1">
        <div class="modal-dialog modal-lg" style="z-index: 99999999;">
            <div class="modal-content">
                <form class="borderSet-form" action="{{ route('border.upload') }}" enctype="multipart/form-data"
                      method="post">
                    {!! csrf_field() !!}
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" type="button">&times;</button>
                        <h4 class="modal-title" id="avatar-modal-label">上传图片</h4>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">

                            <!-- Upload image and data -->
                            <div class="borderSet-upload">
                                <input class="borderSet-src" name="avatar_src" type="hidden">
                                <input class="borderSet-data" name="avatar_data" type="hidden">
                                <label for="avatarInput">请选择上传图片</label>
                                <input class="borderSet-input" id="avatarInput" name="avatar_file" type="file">
                            </div>

                            <!-- Crop and preview -->
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="borderSet-wrapper"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="avatar-preview preview-lg borderSet-preview"></div>
                                    <div class="avatar-preview preview-md borderSet-preview"></div>
                                    <div class="avatar-preview preview-sm borderSet-preview"></div>
                                </div>
                            </div>

                            <div class="row background-btns">
                                <div class="col-md-3">
                                    <button class="btn btn-primary btn-block borderSet-save" type="submit">确定</button>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-primary btn-block borderSet-scale" type="button"
                                            data-scale="1/1" data-state="1">1:1大
                                    </button>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-primary btn-block borderSet-scale" type="button"
                                            data-scale="1/1" data-state="3">1:1小
                                    </button>
                                </div>

                                <div class="col-md-3">
                                    <button class="btn btn-primary btn-block borderSet-scale" type="button"
                                            data-scale="2/1" data-state="2">2:1
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">
              <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
            </div> -->
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal -->

    <!-- Loading state -->
    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
</div>

<script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery/jquery-ui.min.js') }}"></script>

<script src="{{ asset('assets/js/lodash/lodash.min.js') }}"></script>
<script src="{{ asset('assets/js/angular/angular.min.js') }}"></script>

<script src="{{ asset('assets/js/mousewheel.js') }}"></script>
<script src="{{ asset('assets/js/easyscroll.js') }}"></script>

<script src="{{ asset('assets/js/libs/gridstack.js') }}"></script>
<script src="{{ asset('assets/js/lulala_data.js') }}"></script>
<script src="{{ asset('assets/js/lulala_main.js') }}"></script>

<script src="{{ asset('third/crop-avatar/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('third/crop-avatar/dist/cropper.min.js') }}"></script>
<script src="{{ asset('third/crop-avatar/js/main.js') }}"></script>
<script src="{{ asset('assets/js/backgroundCrop.js') }}"></script>
<script src="{{ asset('assets/js/borderSet.js') }}"></script>


<script type="text/javascript" src="{{ asset('third/html2canvas/html2canvas.js') }}"></script>

</body>

</html>
