<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, minimum-scale=1">
    <title></title>
    <link rel="stylesheet" href="assets/fonts/iconfont.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/gridstack.css" />
    <link rel="stylesheet" href="assets/css/gridstack-extra.css" />

    <script src="assets/js/jquery/jquery.min.js"></script>   
</head>
<style media="screen">
    .grid1 {
      background: none;
    }
    .grid-stack-item-content {
      text-align: center;
      padding: 2.5px;
    }
    .grid-stack-item-content .w_item {
      width: 100%;
      height: 100%;
      position: relative;
      overflow: hidden;
    }
    .grid-stack-item-content .w_item .bgDiv {
      background-color: #f3f5f7;
      width: 100%;
      height: 100%;
    }
    .grid-stack-item-content .w_item img {
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    .row{       
        background-color: #f3f5f7;
    }
    .fluid_bg{
        height: 175px;
        position: absolute;
        text-align: center;  
        top: -1px;                           
    }
    .fluid_bg img{
        width: 100%;
        /*height: 100%;*/
    }
    .w_item {
        width: 100%;
        height: 100%;
        position: relative;
    }
   .lulala_logo{
        position: absolute;      
        bottom: 10px;
        right: 10px;        
    }
    .lulala_logo img{
        width: 75px;
        height: 18px;
    }
</style>
<script type="text/javascript">
    var data = {!! $template !!};

</script>
<script src="http://s4.cnzz.com/z_stat.php?id=1261153954&web_id=1261153954" language="JavaScript"></script>

<body ng-app="GridStack" id="crop-avatar">
    <div class="content" style="visibility: hidden">
        <div ng-controller="blockController"  class="mid_area">
            <div class="container-fluid" style="max-width:600px;padding-top: 0;position: relative;">
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
                                        <img ng-show="gridListData.border['border_'+grid.height+'_'+grid.width]" ng-show="gridListData.border['border_'+grid.height+'_'+grid.width]" ng-src=@{{gridListData.border['border_'+grid.height+'_'+grid.width]}}>
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
    <script src="assets/js/lodash/lodash.min.js"></script>
    <script src="assets/js/angular/angular.min.js"></script>
    <script src="assets/js/libs/gridstack.js"></script>  
    <script src="assets/js/view.js"></script>
</body>

</html>
