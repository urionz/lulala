/*
* @Author: xujunkai
* @Date:   2016-12-20 11:03:34
* @Last Modified by:   xujunkai
* @Last Modified time: 2017-02-05 09:57:45
*/

$("#reviewBtn").click(function() { 
    var widgets = getEditGridData();
      $.ajax({
        url: "/tpl/preview",
        type: 'post',
        async: false,
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        data: {
            'widgets': widgets
        },       
        success: function(data) {           
           window.open(data.location);           
        },
        complete: function(){
           
        },
        error: function(){
           layer.confirm("出现异常稍后再试", {btn: ['确定'] } );          
        }
    })

});

$("#publishBtn").click(function() {
    var layerIndex = layer.msg('发布中...', {
        icon: 16,
        shade: 0.01
    });
    saveDocument(function(response) {
        layer.close(layerIndex);
        if(response.hasOwnProperty('location')){
            layer.confirm('发布成功，浏览发布页？', {
                btn: ['确定','取消'] //按钮
            }, function(){
                window.open(response.location);
                layer.closeAll();
            });
        }
    }, '/tpl/publish');
});

//上传背景
$("#uploadBgBtn").click(function() {});

$("#saveBtn").click(function() {
    var layerIndex = layer.msg('保存中...', {
        icon: 16,
        shade: 0.01
    });

    saveDocument(function(response) {
        isModifyed = false;
        layer.close(layerIndex);
    });
});

function saveDocument(callback, saveUrl) {
    var curData = getEditGridData();
    gridScope.snapHideSelState();
    createScreenShot($('#screenshot'), curData, callback, saveUrl);
}

function getEditGridData(){
     var serializedData = _.map($('.grid-stack > .grid-stack-item:visible'), function(el) {
        el = $(el);
        var node = el.data('_gridstack_node');
        var id = $(el).attr('data-id');
        var width = $(el).attr('data-gs-width');
        var height = $(el).attr('data-gs-height');
        return {x: node.x, y: node.y, id: node._id, width: width, height: height};
    }, this);

    var curData = gridScope.getSaveData();        
        curData.thumbnail = "";
    var gridDataList = curData.gridData;
    if (serializedData && gridDataList) {
        serializedData.forEach(function(data) {
            for (var i = 0; i < gridDataList.length; i++) {
                //console.log("data.id",data.id,"serializedData[i].id", serializedData[i].id);
                if (data.id == gridDataList[i].id) {
                    data["img_url"] = gridDataList[i].img_url;                    
                }
            }
        })
    }

    if ($("#input_grid_title").val() != "") {
        curData.title = $("#input_grid_title").val();
    }
    return curData
}
function saveTemplate(widgets, callback, saveUrl) {
    saveUrl = saveUrl ? saveUrl : '/tpl/save';
    var successData = '';
    $.ajax({
        url: saveUrl,
        type: 'post',
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        data: {
            'widgets': widgets
        },
        async:false,
        success: function(data) {
            isModifyed = false;
            data.result["placeholder"] = data.result.title;
            var index = -1;
            for(var i=0;i<collection.user.templates.length;i++){
                 if(data.result.status){
                    collection.user.templates[i].status = 0;        
                }
                if(collection.user.templates[i].id == data.result.id){
                    collection.user.templates[i] = data.result; 
                    index = 1;
                }
            }

            if (index == -1) {
                collection.user.templates.push(data.result);
            }

            // 如果为发布状态,重新排序
            if(data.result.status){
                 collection.user.templates.sort(function(a,b){
                    return b.status - a.status;
                })        
            }

            gridScope.updateId(data.result.id);
            templateScope.updateViews();
            if (callback)
                callback(data)
        }
    });
}

function screenshotAnimate(cart, Ele) {
    var cart = cart;
    var imgtodrag = Ele;
    if (imgtodrag) {
        var imgclone = imgtodrag.clone().offset({top: imgtodrag.offset().top, left: imgtodrag.offset().left}).css({'opacity': '0.5', 'position': 'absolute', 'height': '150px', 'width': '150px', 'z-index': '100'}).appendTo($('body')).animate({
            'top': cart.offset().top + 10,
            'left': cart.offset().left + 10,
            'width': 75,
            'height': 75
        }, 1000, 'easeInOutExpo');
        // setTimeout(function() {
        //     cart.effect('shake', {
        //         times: 2
        //     }, 200);
        // }, 1500);
        imgclone.animate({
            'width': 0,
            'height': 0
        }, function() {
            $(this).detach();
        });
    }
}

function createScreenShot(element, curData, callback, saveUrl) {
    var screenshot = element;
    var screenshotHeight = screenshot.height();
    html2canvas(screenshot, {
        allowTaint: true,
        taintTest: false,
        useCORS: true,
        onrendered: function(canvas) {
            var dataUrl = canvas.toDataURL();
            var image = document.createElement('img');
            var screenshot = $('#screenshot');
            var screenshotTop = screenshot.offset().top;
            var screenshotLeft = screenshot.offset().left;
            image.src = dataUrl;
            image.id = 'screenshotElm';
            image.style = "position:absolute;top:" + screenshotTop + "px;left:" + screenshotLeft + "px;";
            document.body.appendChild(image);
            curData.thumbnail = dataUrl;
            var imgElm = $('#screenshotElm');

            screenshotAnimate($('.template_item').eq(2), imgElm);

            imgElm.remove();

            saveTemplate(curData, callback, saveUrl);
        }
    });
}

var disableDrag = false;
var isLastDragging = false;
var curId = 0;
var modifyScope;
var gridScope;
var templateScope;
var isModifyed = false;
var first_init = true;
var delLayerIndex = 0;

//创建一个空白的网格数据
function createEmptyGridData() {
    var serializedData = _.map($('.grid-stack > .grid-stack-item:visible'), function(el) {
        el = $(el);
        var node = el.data('_gridstack_node');
        var id = $(el).attr('data-id');
        var width = $(el).attr('data-gs-width');
        var height = $(el).attr('data-gs-height');
        return {x: node.x, y: node.y, width: width, height: height};
    }, this);
    serializedData.sort(function(a, b) {
        return b.y - a.y
    })
    var y_pos = 0;
    var x_pos = 0;
    if (serializedData.length) {
        y_pos = serializedData[0].y;
        var total_width = 0;
        for (var i = 0; i < serializedData.length; i++) {
            if (serializedData[i].y == y_pos) {
                total_width += parseInt(serializedData[i].width);                
                x_pos += parseInt(serializedData[i].width);
                if((i < serializedData.length -1) && (serializedData[i+1].height == 8)){
                   total_width += parseInt(serializedData[i+1].width);         
                }
            }           
        }

        if (total_width >= 12) {
            y_pos += 4;
            x_pos = 0;
        }
    }

    return {
        x: x_pos,
        y: y_pos,
        width: 4,
        height: 4,
        border: gridScope.getBorderUrl(4, 4),
        "img_url": "",
        "image_herf": ""
    };
}

var app = angular.module('GridStack', ['gridstack-angular']).controller('blockController', function($scope, $rootScope, $log, $timeout) {
    gridScope = $scope;
    //存放所有数据包括状态，标题
    $rootScope.gridListData = null;

    $scope.gridList = [];

    $scope.grid_bg_img = "";

    $scope.options = {
        animate: true,
        //disableDrag:disableDrag,
        disableResize: true,
        cellHeight: 'auto',
        //auto : false,
        verticalMargin: 0
    };

    //处理数据
    $scope.processData = function(data) {
        data['isEdit'] = false;
        data['id'] = ++curId;
    }

    //重置编辑状态
    $scope.resetEdit = function(except_id) {
        var curData;
        for (var i = 0; i < $scope.gridList.length; i++) {
            if (except_id == $scope.gridList[i].id) {
                $scope.gridList[i].isEdit = true;
                curData = $scope.gridList[i];
            } else {
                $scope.gridList[i].isEdit = false;
            }
        }
        $scope.updateViews();
        $rootScope.$broadcast("showEditEvent", {
            "id": except_id,
            "data": curData
        });
    }

    $scope.addGrid = function(param) {
        isModifyed = true;
        var gridData = createEmptyGridData();
        gridData.width = param.data.width || 4;
        gridData.height = param.data.height || 4;
        $scope.processData(gridData);
        $scope.gridList.push(gridData);
        $scope.resetEdit(gridData.id);
        $scope.updateViews();
    };

    $scope.udpateBackground = function(url) {
        $rootScope.gridListData.background = url;
        $scope.grid_bg_img = $rootScope.gridListData.background;
        $scope.updateViews();
        for (var i = 0; i < collection.user.materials.length; i++) {
            if (collection.user.materials[i].id == $rootScope.gridListData.id) {
                collection.user.materials[i].background = url;
                break;
            }
        }
    }

    $scope.delGrid = function(param) {
        isModifyed = true;
        var id = param.data.id;
        for (var i = 0; i < $scope.gridList.length; i++) {
            if ($scope.gridList[i].id == id) {
                $scope.gridList.splice(i, 1);
            }
        }
        $scope.updateViews();
    };

    $scope.clickItem = function(event, item) {
        if (disableDrag) {
            if (data.herf != "")
                window.location.href = data.herf;
            return;
        }
        if (isLastDragging) {
            isLastDragging = false;
            return
        }
        $scope.resetEdit(item.id);
    }

    $scope.clickReqAddGrid = function() {
        $rootScope.$broadcast("reqAddGridEvent", {});
    };

     // 取消选择
    $scope.cancelClickHandler = function($event){
        var target = $event.target;
        if($(target).attr('class') == "mid_area ng-scope" ){
            $scope.resetEdit(-1);
            $rootScope.$broadcast("cancelModifyEvent", {"data": null});        
        }
    }

    $scope.onDragStart = function(event, ui) {
        isModifyed = true;
        isLastDragging = true;
        var dragItem = ui.helper[0];
        if (dragItem) {
            var id = $(dragItem).attr("data-id");
            for (var i = 0; i < $scope.gridList.length; i++) {
                if ($scope.gridList[i].id == id) {
                    $scope.gridList[i].isEdit = false;
                    break;
                }
            }
            $scope.updateViews();
        }
        //$log.log("onDragStart event: "+event+" ui:"+ui);
    };

    //获取当前模板id
    $scope.getCurTemplateId = function() {
        if ($rootScope.gridListData) {
            return $rootScope.gridListData.id;
        }
        return "";
    }

    // 修改网格大小
    $scope.udpateGridType = function(param) {
        isModifyed = true;
        var value = param.data.gridData;
        var id = param.data.id;
        var grid = $('.grid-stack').data('gridstack');

        $('.grid-stack').find('.grid-stack-item').each(function(index) {
            var dataId = $(this).attr('data-id');
            if (dataId == id) {
                var curWidth = $(this).attr('data-gs-width');
                var curHeight = $(this).attr('data-gs-height');
                var curGsX = $(this).attr('data-gs-x');
                var curGsY = $(this).attr('data-gs-y');
                if (curGsX == 8) {
                    //最右边的,只能变小不能变大
                    if (curWidth < value.width) {
                        grid.move($(this), 4, curGsY);
                        grid.resize($(this), value.width, value.height);
                        $scope.modifyGridWHData(value, dataId)
                    } else {
                        $scope.modifyGridWHData(value, dataId)
                        grid.resize($(this), value.width, value.height);
                    }
                } else {
                    $scope.modifyGridWHData(value, dataId)
                    grid.resize($(this), value.width, value.height);
                }
            }
        })
    }

    // 更新背景框
    $scope.getBorderUrl = function(width, height) {
        var type = "border_" + width + "_" + height;
        if ($rootScope.gridListData && $rootScope.gridListData.border) {
            if ($rootScope.gridListData.border[type]) {
                return $rootScope.gridListData.border[type]
            }
            return ""
        }
        return ""
    }

    //保持边框
    $scope.saveBorder = function(url, type) {
        if ($rootScope.gridListData.border == null) {
            $rootScope.gridListData.border = {};
        }
        if (type == 1) {
            $rootScope.gridListData.border["border_8_8"] = url;
        } else if (type == 2) {
            $rootScope.gridListData.border["border_4_8"] = url;
        } else if (type == 3) {
            $rootScope.gridListData.border["border_4_4"] = url;
        }
    }

    // 修改网格宽高数据
    $scope.modifyGridWHData = function(data, id) {
        for (var i = 0; i < $scope.gridList.length; i++) {
            if ($scope.gridList[i].id == id) {
                $scope.gridList[i].width = data.width;
                $scope.gridList[i].height = data.height;
                $scope.gridList[i].border = gridScope.getBorderUrl(data.height, data.width);
            }
        }
        
        $scope.updateViews();
    }

    // 修改图片数据
    $scope.modifyGridImageData = function(param) {
        var data = param.data.imageData;
        var id = param.data.id
        for (var i = 0; i < $scope.gridList.length; i++) {
            if ($scope.gridList[i].id == id) {
                $scope.gridList[i].img_url = data.material;         
                $scope.gridList[i]['original'] = data.original;             
            }
        }
        $scope.updateViews();
    }

    // 修改网格链接
    $scope.modifyGridLinkData = function(param) {
        var data = param.data.linkData;
        var id = param.data.id
        for (var i = 0; i < $scope.gridList.length; i++) {
            if ($scope.gridList[i].id == id) {
                $scope.gridList[i].image_herf = data.image_herf;
            }
        }
    }

    $scope.getSaveData = function() {
        var border = {};
        border["border_4_4"] = $rootScope.gridListData.border
            ? $rootScope.gridListData.border.border_4_4
            : "";
        border["border_4_8"] = $rootScope.gridListData.border
            ? $rootScope.gridListData.border.border_4_8
            : "";
        border["border_8_8"] = $rootScope.gridListData.border
            ? $rootScope.gridListData.border.border_8_8
            : "";
        return {
            "id": $rootScope.gridListData.id,
            "title": $rootScope.gridListData.title,
            "gridData": angular.fromJson(angular.toJson($scope.gridList)),
            "background": $rootScope.gridListData.background || "",
            "border": border
        }
    }

    //抓取图片的时候隐藏选中状态
    $scope.snapHideSelState = function() {
        $(".mid_area").find(".show_modify_grid").css("visibility", "hidden");
        $(".mid_area").find(".uploadBgBtn").css("visibility", "hidden");

        $timeout(function() {
            $(".mid_area").find(".show_modify_grid").css("visibility", "visible");
            $(".mid_area").find(".uploadBgBtn").css("visibility", "visible");
        }, 1000)
    }

    $scope.onDragStop = function(event, ui) {
        isLastDragging = false;
        $rootScope.$broadcast("dragOverIsShowEidt", {});
        //$log.log("onDragStop event: "+event+" ui:"+ui);
    };

    $scope.onResizeStart = function(event, ui) {
        //$log.log("onResizeStart event: "+event+" ui:"+ui);
    };

    $scope.onResizeStop = function(event, ui) {
        //$log.log("onResizeStop event: "+event+" ui:"+ui);
    };

    $scope.onItemAdded = function(item) {
        //$log.log("onItemAdded item: "+item);
    };

    $scope.onItemRemoved = function(item) {
        //$log.log("onItemRemoved item: "+item);
    };

    $scope.updateViews = function() {
        if(!$scope.$$phase) {
            $scope.$apply();
        }
        $(function() {
            $('.div_scroll').scroll_absolute({arrows: false})
        });
    }

    //更新模板id
    $scope.updateId = function(id) {
        $rootScope.gridListData["id"] = id;
    }

    $scope.$on("addGridEvent", function(value, param) {
        console.log("请添加一个格子");
        $scope.addGrid(param)

    });

    $scope.$on("delGridEvent", function(value, param) {
        console.log("删除一个格子");
        var prevObj = null;

        var curGirdList = getEditGridData().gridData;       

        curGirdList.sort(
            firstBy(function (a, b) { return a.y - b.y})
            .thenBy(function (a, b) { return a.x - b.x  })   
        );

        for (var i = 0; i < curGirdList.length; i++) {
            //console.log("data.id",data.id,"serializedData[i].id", serializedData[i].id);
            if (param.data.id == curGirdList[i].id && i>0) {
               prevObj = curGirdList[i-1];
               break;
            }
        }

        $scope.delGrid(param)
        $scope.resetEdit();

        //默认选择一个格子为可编辑状态
        $timeout(function(){
            if (prevObj) {
                $scope.clickItem(null, prevObj);  
            }            
        },100)
      
    });    

    $scope.$on("updateGridType", function(value, param) {
        console.log("更新网格大小");
        $scope.udpateGridType(param)
    });

    $scope.$on("updateGridImage", function(value, param) {
        console.log("更新图片");
        $scope.modifyGridImageData(param);
    });

    $scope.$on("updateGridLink", function(value, param) {
        console.log("更新链接");
        $scope.modifyGridLinkData(param);
    });

    $scope.$on("dragOverShowEidt", function(value, param) {
        //console.log("拖放完毕显示有修改的网格的状态为对应的选择状态");
        $scope.resetEdit(param.id);
    });

    $scope.$on("updateGridListEvent", function(value, param) {
        console.log("更新网格列表数据消息来源模板");        
        $scope.gridList = [];
        $scope.updateViews();       
        $timeout(function(){
            if(param.data && param.data.widgets){
                $scope.gridList = param.data.widgets;
                $rootScope.gridListData = param.data;
            } else {
                $scope.gridList = [];
                $rootScope.gridListData.title = "";
            }
            curId = 0;      
            $scope.grid_bg_img = $rootScope.gridListData.background;
            $scope.gridList.forEach(function(data) {
                $scope.processData(data);
            })
            //xy必须排序一下
            $scope.gridList.sort(
                firstBy(function (a, b) { return a.y - b.y})
                .thenBy(function (a, b) { return a.x - b.x  })   
            ); 
            //选择默认的第一个格子为编辑状态
            // if ($scope.gridList.length) {
            //     $scope.clickItem(null, $scope.gridList[0]);
            //     //再次显示placeholder
            //     $("#input_grid_title").val('');
            // }     

            $rootScope.$broadcast("cancelModifyEvent", {"data": null});            
            $scope.updateViews();
        })     
    },100);
});

// 修改控制器
app.controller("modifyController", function($scope, $rootScope, $http, $timeout) {
    modifyScope = $scope;
    //图片库
    $scope.imageLibs = collection.user.materials;
    $scope.defaultLibs = collection.common.materials;

    $scope.curType = 1;
    //当前选择的图片库
    $scope.curLibs = [];
    //当前修改数据
    $scope.curModifyData;
    //当前选择的网格类型  
    $scope.curGirdType = {
        "width": 4,
        "heigth": 4
    };
    // 当前删除模式1为普通，2为选择删除
    $scope.curDelMode = 1;

    //修改图片库类型
    $scope.clickChangeLibs = function(type) {
        $scope.curType = type;
        $scope.updateLibs();
        $scope.cancelSelMode();
        $(".right_area .content .modify_grid .img_nav").find(".img_nav_item").each(function(item) {
            $(this).removeClass('active');
            if ($(this).attr('data-id') == $scope.curType) {
                $(this).addClass('active');
            }
        });

        $timeout(function(){
             $('.div_scroll').scroll_absolute({arrows: false})
         },50)        
    }

    $scope.updateLibs = function() {
        if ($scope.curType == 1) {
            $scope.curLibs = $scope.defaultLibs;
            $(".img_modify_eara").css("bottom","10px");
        } else if ($scope.curType == 2) {
            $scope.curLibs = $scope.imageLibs;
            $(".img_modify_eara").css("bottom","50px");
        }
    }

    // 上传图片完成后回调刷新数据php已经完成
    $scope.addImageData = function(data) {       
        $scope.cancelSelMode();
        $scope.updateViews();
    }
    
    // 选择格子类型
    $scope.clickSelGridType = function(type, id) {
        $scope.curGirdType = type;
        updateSelGridActive(id);
        $rootScope.$broadcast("updateGridType", {
            "data": {
                "gridData": $scope.curGirdType,
                "id": $scope.curModifyData.id
            }
        });
    }

    // 更新图片
    $scope.clickUpdateImage = function(data) {
        isModifyed = true;
        $rootScope.$broadcast("updateGridImage", {
            "data": {
                "imageData": data,
                "id": $scope.curModifyData.id
            }
        });
    }

    $scope.checkBoxClickHandler = function(imageId,$event){
         if($scope.getAllCheckedImageList().length){
             $(".del_item_mid").css("display","inline-block"); 
         }else{
             $(".del_item_mid").css("display","none"); 
         }
        var isChecked = $("#"+imageId).is(":checked");
        console.log("isChecked",isChecked)
        //$("input[type='checkbox']").attr("checked");       
        $event.stopPropagation();
    }

    $scope.getAllCheckedImageList = function(){
        var selImageList = [];
        if($scope.curType==2){  
            $(".img_modify_eara .img_area .img_list ul li").each(function(item) {
                var selDel = $(this).find(".sel_del .input_class");
                var imageId = $(selDel).attr("id");             
                var isChecked = $("#"+imageId).is(":checked");
                if(isChecked){
                    selImageList.push(imageId)
                }
            });
        }
        return selImageList;
    }

    // 点击删除图片
    $scope.clickDelImage = function(imageId,$event){
        var target = $event.target;
        var targetClass = $(target).attr("class");
        if(targetClass !="hover_del"){         
            showDelDailog("是否要删除所选图片","/user/material/remove",[imageId],function(){
                $scope.delImageData([imageId]);
                $scope.updateViews();
                $('.div_scroll').scroll_absolute({arrows: false})
            })      
        }
        $event.stopPropagation();
    }

    // 删除图片数据
    $scope.delImageData=function(imageList){
        //$scope.imageLibs = collection.user.materials;
        //$scope.defaultLibs = collection.common.materials;
        var i=0;
        var j=0;
        for(i = 0; i<imageList.length;i++){
            for(j=0; j<collection.user.materials.length;j++){
                if(collection.user.materials[j].id == imageList[i]){
                    collection.user.materials.splice(j,1);
                }
            }
        }

        for(i = 0; i<imageList.length;i++){
            for(j=0;j<$scope.curLibs.length;j++){
                if($scope.curLibs[j].id == imageList[i]){
                    $scope.curLibs.splice(j,1);
                }
            }
        }
    }

    // 点击选择删除模式
    $scope.clickManage = function(){
        if($scope.curLibs.length == 0){
            layer.confirm("您当前的图片数量为零，请上传完图片后再来进行管理.", {
                btn: ['确定']               
            });   
            return;
        }
        if($scope.curDelMode == 1){
           $scope.inSeleMOde();
        }else{           
           $scope.cancelSelMode();
        }       
    }

      // 删除所有选择的图片
    $scope.clickDelAllSelectdImages = function(){
        var selectedImages = [];
            selectedImages = $scope.getAllCheckedImageList();
            if(selectedImages.length){
                showDelDailog("是否要删除所选图片","/user/material/remove",selectedImages,function(){
                     $scope.delImageData(selectedImages);                     
                     if($scope.curLibs.length == 0){
                        $scope.cancelSelMode();
                     }       
                     $scope.updateViews();
                     $('.div_scroll').scroll_absolute({arrows: false})
                 })      
            }       
    }

    // 进入手动选择模式
    $scope.inSeleMOde = function(){
        $scope.curDelMode = 2;
        $scope.showAllSelImage();
        $(".del_item_right").html("完成") ;
     }

    // 重置选择
    $scope.cancelSelMode = function(){                   
        $(".img_modify_eara .img_area .img_list .div_scroll ul li").each(function(item) {
            $(this).find(".sel_del").css("display","none");              
        });        
        $scope.curDelMode = 1;
        $(".del_item_right").html("管理") ;
        $(".del_item_mid").css("display","none"); 
    }

    // 显示所有能删除的图片来选择删除
    $scope.showAllSelImage = function($event){
        if($scope.curType==2){           
            $(".img_modify_eara .img_area .img_list .div_scroll ul li").each(function(item) {
                $(this).find(".sel_del").css("display","block");              
            });
        }
    }

    // 鼠标移上
    $scope.mouseOverHandler = function($event){
       if($scope.curType==2 && $scope.curDelMode == 1){
           var target = $event.currentTarget;
           $(target).find(".hover_del").css("display","block");
       }
    }

    // 鼠标移出
    $scope.mouseOutHandler=function($event){
         if($scope.curType==2 && $scope.curDelMode == 1){
            var target = $event.currentTarget;           
            $(target).find(".hover_del").css("display","none");
       }
    }

    // 更新链接
    $scope.updateLink = function(data) {
        $rootScope.$broadcast("updateGridLink", {
            "data": {
                "linkData": data,
                "id": $scope.curModifyData.id
            }
        });
    }   

    //删除i个格子
    $scope.clickDelGrid = function() {
        if ($scope.curModifyData) {
            $rootScope.$broadcast("delGridEvent", {"data": $scope.curModifyData});
        }
    }   

    $scope.updateViews = function() {
        if (!$scope.$$phase) {
            $scope.$apply();
        }
    }

    function updateSelGridActive(id) {
        $(".set_size .size_type").removeClass('set_size_active');
        var searchStr = ".set_size :eq(" + id + ")";
        $(searchStr).addClass("set_size_active");
    }

    $(".input_herf").change(function() {
        isModifyed = true;       
    })

    $("#input_grid_title").change(function() {
        isModifyed = true;      
    })

    var watch = $scope.$watch('curModifyData', function(newValue, oldValue) {
        if (newValue) {
            $(".modify_grid").css("display", "table");
            if( $(".modify_grid").css("right") =="-272px"){
                $(".modify_grid").css("right", "-272px");
                $(".modify_grid" ).animate({               
                    right: "0"                
                  }, 200, function() {
                    // Animation complete.
                });           
            }          
        } else {     
            // $(".modify_grid").animate({                
            //     right: "-272px"                
            //   }, 200, function() {
            //    $(".modify_grid").css("display", "none");
            // });     
            $(".modify_grid").css("right","-272px");          
            $(".modify_grid").css("display", "none");
        }

        $timeout(function() {
            $('.div_scroll').scroll_absolute({arrows: false})
        }, 50)

    });

    $scope.updateLibs();

    ////////////////////////////////////////////////event//////////////////////////////////////////
    $scope.$on("dragOverIsShowEidt", function(value, param) {
        if ($scope.curModifyData) {
            $rootScope.$broadcast("dragOverShowEidt", $scope.curModifyData);
        }
    });

    $scope.$on("reqAddGridEvent", function(value, param) {
        var curData = createEmptyGridData();
        // curData.width = $scope.curGirdType.width;
        // curData.height = $scope.curGirdType.height;
        curData.width = 4;
        curData.height = 4;
        $rootScope.$broadcast("addGridEvent", {"data": curData});

    });

    $scope.$on("cancelModifyEvent", function(value, param) {
        console.log("取消修改");
        if ($scope.curModifyData) {
            $scope.curModifyData = null;
        }
    });

    $scope.$on("showEditEvent", function(value, param) {
        //console.log(" get showEdit event",param)
        if (param.id == -1) {
            //没选择修改
            $scope.curModifyData = null;
        } else {
            if ($scope.curModifyData && ($scope.curModifyData.id == param.id)) {
                return
            }           
            $scope.curModifyData = param.data;
        }
        $scope.updateViews();
    });
});

// 模板定制我的控制器数据来源lulala_data.js
app.controller("leftController", function($scope, $rootScope, $http, $timeout) {
    templateScope = $scope;
    //当前库
    $scope.curLibs = [];
    //模板库
    $scope.templateLibs = [];
    //我的库
    $scope.selfLibs = [];
    //定制库
    $scope.diyLibs = [];

    //1为模板2为定制3为我的
    $scope.curMenu = 1;

    countLibsData();

    // 数据分类
    function countLibsData() {
        //生成一个默认空白模板
        var emptyTemplateData = {
            "id": 0,
            "type": 1,
            "title": "我的模板",
            "background": "/assets/images/default_frame/bg_pic.jpg",
            "thumbnail": "/assets/images/default_frame/thumbnail.jpg",
            "border": {},
            "widgets": self_defaultGridData
        }
        collection.common.templates.unshift(emptyTemplateData);       

        $scope.templateLibs = collection.common.templates;
        collection.user.templates.sort(function(a,b){
            return b.status - a.status;
        })

        collection.common.templates.forEach(function(value){
             value["placeholder"]="点击输入标题";             
        })

        collection.user.templates.forEach(function(value){
            value["placeholder"]=value.title;
        })

        $scope.selfLibs = collection.user.templates;
    }

    $scope.mouseOverTemplateHandler = function(state,$event){
        if($scope.curMenu == 3 && state != 1){
           var target = $event.currentTarget;
           $(target).find(".template_del").css("display","block");
       }
    }

    $scope.mouseOutTemplateHandler = function(state,$event){
        if($scope.curMenu == 3 && state != 1){
           var target = $event.currentTarget;           
           $(target).find(".template_del").css("display","none");
       }
    }

    // 点击删除模板
    $scope.clickDelTempalte = function(templateId,$event){
        var target = $event.target;
        var targetClass = $(target).attr("class");
        if(targetClass !="template_del"){
             showDelDailog("是否要删除所选模板","/tpl/remove",[templateId],function(){
                 $scope.delTempalteData([templateId]);
                 $scope.updateViews();
                 $('.div_scroll').scroll_absolute({arrows: false})
             })      
        }
        event.stopPropagation();
    }

    // 删除模板数据
    $scope.delTempalteData=function(templateList){        
        var i=0 , j=0;
        for(i = 0; i<templateList.length;i++){
            for(j=0;j<$scope.curLibs.length;j++){
                if($scope.curLibs[j].id == templateList[i]){                  
                    $scope.curLibs.splice(j,1);
                }
            }
        }
    }

    //切换菜单
    $scope.clickChangeMenu = function(data) {
        if ($scope.curMenu == data)
            return;
        $scope.updateMenuImageList(data);        
    }

    //点击使用对应模板
    $scope.clickUseModule = function(data, $event) {
        if ($event) {
            //询问框
            if (isModifyed) {
                layer.confirm('选择模板前，请先保存文档，否则文档会丢失', {
                    btn: ['确定保存', '不保存'] //按钮
                }, function() {
                    var layerIndex = layer.msg('保存中', {
                        icon: 16,
                        shade: 0.01
                    });
                    saveDocument(function() {
                        isModifyed = false;
                        layer.close(layerIndex);
                        $scope.useModule(data);
                    })
                }, function() {
                    isModifyed = false;                   
                    $scope.useModule(data);
                });
            } else {
                $scope.useModule(data);
            }
        } else {
            $scope.useModule(data);
        }
    }

    $scope.useModule = function(data) {
        var colneData = JSON.parse(JSON.stringify(data));
        if($scope.curMenu == 1){            
            $("#input_grid_title").val('');        
        }else{
            $("#input_grid_title").val(colneData.title);        
        }
        $rootScope.$broadcast("updateGridListEvent", {"data": colneData});
        $(".left_area .content .img_list").find("li").each(function(item) {
            $(this).removeClass('active');
            if ($(this).attr('data-id') == data.id) {
                $(this).addClass('active');
            }
        });

    }

    $scope.updateViews = function() {
        if ($scope.curMenu == 1) {
            $scope.curLibs = $scope.templateLibs;
        } else if ($scope.curMenu == 2) {
            $scope.curLibs = $scope.selfLibs;
        }
        if (!$scope.$$phase) {
            $scope.$apply();
        }
    }

    $scope.updateMenuImageList = function(data) {
        $scope.curMenu = data;
        if (data == 1) {
            $scope.curLibs = $scope.templateLibs;
        } else if (data == 2) {
            $scope.curLibs = $scope.diyLibs;
        } else {
            $scope.curLibs = $scope.selfLibs;
        }
        $(".left_area .content .template_nav").find(".template_item").each(function(item) {
            $(this).removeClass('active');
            if ($(this).attr('data-id') == $scope.curMenu) {
                $(this).addClass('active');
            }
        });

        //默认通知使用模板里面的第一个
        $timeout(function() {
            if ($scope.curLibs.length) {
                var cloneData = JSON.parse(JSON.stringify($scope.curLibs[0]));
                if(first_init){
                    first_init = false;
                    $scope.clickUseModule(cloneData);
                }                
            }
            $('.div_scroll').scroll_absolute({arrows: false})
        }, 200);
    }

    $timeout(function() {
        $scope.updateMenuImageList($scope.curMenu);
        $(".container-fluid").css("visibility", "visible");
        $(".title_input").css("visibility", "visible");
        $('.modify_grid').css("visibility", "visible");        
        $('.modify_mid').css("visibility", "visible");
        $('.img_nav').css("visibility", "visible");    
        $('.left_area').css("visibility", "visible");    
    }, 100);

});

$(document).ready(function(){
    $('.div_scroll').scroll_absolute({ arrows: false});
})

$(window).resize(function(event) {
    $('.div_scroll').scroll_absolute({ arrows: false});
});

function showDelDailog(title,url,delData,callback){
    layer.confirm(title, {
            btn: ['确定删除', '不删除'] //按钮
        }, function() {
            delLayerIndex = layer.msg('删除中', {
                icon: 16,
                shade: 0.01
             });
           reqDelImages(url,delData,callback);
        }, function() {
            
        });   
}

function reqDelImages(url,data,callback) {      
    $.ajax({
        url: url,
        type: 'post',
        data: {
            "ids": data           
        },
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        success: function(data) {          
            layer.close(delLayerIndex);         
            callback();
        },
        complete: function(){
           
        },
        error: function(){
           layer.close(delLayerIndex);         
        }
    });
}


var firstBy = (function() {

    function identity(v){return v;}

    function ignoreCase(v){return typeof(v)==="string" ? v.toLowerCase() : v;}

    function makeCompareFunction(f, opt){
        opt = typeof(opt)==="number" ? {direction:opt} : opt||{};
        if(typeof(f)!="function"){
            var prop = f;
            // make unary function
            f = function(v1){return !!v1[prop] ? v1[prop] : "";}
        }
        if(f.length === 1) {
            // f is a unary function mapping a single item to its sort score
            var uf = f;
            var preprocess = opt.ignoreCase?ignoreCase:identity;
            f = function(v1,v2) {return preprocess(uf(v1)) < preprocess(uf(v2)) ? -1 : preprocess(uf(v1)) > preprocess(uf(v2)) ? 1 : 0;}
        }
        if(opt.direction === -1) return function(v1,v2){return -f(v1,v2)};
        return f;
    }

    /* adds a secondary compare function to the target function (`this` context)
       which is applied in case the first one returns 0 (equal)
       returns a new compare function, which has a `thenBy` method as well */
    function tb(func, opt) {
        var x = typeof(this) == "function" ? this : false;
        var y = makeCompareFunction(func, opt);
        var f = x ? function(a, b) {
                        return x(a,b) || y(a,b);
                    }
                  : y;
        f.thenBy = tb;
        return f;
    }
    return tb;
})();