/* 
* @Author: xujunkai
* @Date:   2016-12-20 11:03:34
* @Last Modified by:   xujunkai
* @Last Modified time: 2016-12-29 10:02:27
*/


$("#reviewBtn").click(function(){

});



 var disableDrag = false;
 var isLastDragging = false;
 var curId = 0;

   //创建一个空白的网格数据
 function createEmptyGridData(){  
    return { x:0, y:0, width:4, height:4 , "img_url":"","image_herf":""};
 }

 var app = angular.module('GridStack', ['gridstack-angular']).
controller('blockController', function($scope, $rootScope,$log,$timeout) { 
            $scope.gridList = [{ x:0, y:0, width:4, height:4 ,"img_url":"","image_herf":""}, { x:0, y:0, width:4, height:4 ,"img_url":"","image_herf":""}, { x:0, y:0, width:4, height:4 ,"img_url":"","image_herf":""}, 
                              { x:0, y:0, width:8, height:4 ,"img_url":"","image_herf":""},{ x:0, y:0, width:4, height:4 ,"img_url":"","image_herf":""},
                              { x:0, y:0, width:8, height:8 ,"img_url":"","image_herf":""},{ x:0, y:0, width:4, height:4 ,"img_url":"","image_herf":""},{ x:0, y:0, width:4, height:4 ,"img_url":"","image_herf":""},
                              { x:0, y:0, width:4, height:4 ,"img_url":"","image_herf":""}, { x:0, y:0, width:4, height:4 ,"img_url":"","image_herf":""}, { x:0, y:0, width:4, height:4 ,"img_url":"","image_herf":""}, 
                              { x:0, y:0, width:4, height:4 ,"img_url":"","image_herf":""}, { x:0, y:0, width:4, height:4 ,"img_url":"","image_herf":""}, { x:0, y:0, width:4, height:4 ,"img_url":"","image_herf":""},
            ];

            $scope.options = {
                animate:true,
                //disableDrag:disableDrag,
                disableResize:true,
                cellHeight: 'auto',
                //resizable : true,
                verticalMargin: 0
            };           

             //处理数据
             $scope.processData = function(data){
                data['isEdit'] = false; 
                data['id']     = curId++;
             }   

             //重置编辑状态
             $scope.resetEdit = function(except_id){
                var curData;    
                for(var i = 0;i<$scope.gridList.length;i++){
                  if(except_id ==  $scope.gridList[i].id){
                    $scope.gridList[i].isEdit = true;
                    curData = $scope.gridList[i];
                  }else{
                    $scope.gridList[i].isEdit = false;         
                  }
                }
                $scope.updateViews();
                $rootScope.$broadcast("showEditEvent", {"id":except_id,"data":curData});
             }

            $scope.addGrid = function(param) {
              var gridData = createEmptyGridData();              
               gridData.width = param.data.width || 4 ;
               gridData.height = param.data.height ||4 ;
               $scope.processData(gridData);
               $scope.gridList.push(gridData);
               $scope.resetEdit(gridData.id);
               $scope.updateViews(); 
            };

            $scope.delGrid = function(param) {
              var id = param.data.id;
              for(var i = 0;i<$scope.gridList.length;i++){
                if($scope.gridList[i].id == id){
                  $scope.gridList.splice(i,1)
                }
              }                 
            };
           
            $scope.clickItem = function(event, item) {
               if(disableDrag){
                if(data.herf!="")
                  window.location.href=data.herf; 
                return;
              }     
              if(isLastDragging){
                isLastDragging = false;
                return
              }
               $scope.resetEdit(item.id);
            }

            $scope.clickReqAddGrid = function() {
              $rootScope.$broadcast("reqAddGridEvent", {});
            };

            $scope.onDragStart = function(event, ui) {
              isLastDragging = true;
              var dragItem = ui.helper[0];
              if(dragItem){                 
                var id = $(dragItem).attr("data-id");
                 for(var i = 0;i<$scope.gridList.length;i++){
                  if($scope.gridList[i].id == id){
                    $scope.gridList[i].isEdit = false;
                    break;
                  }
                }
                $scope.updateViews();  
              }
              //$log.log("onDragStart event: "+event+" ui:"+ui);              
            };

            // 修改网格大小
            $scope.udpateGridType = function(param) {
              var value = param.data.gridData;
              var id = param.data.id;             
              var grid = $('.grid-stack').data('gridstack');

               $('.grid-stack').find('.grid-stack-item').each(function(index){
                  var curId = $(this).attr('data-id');                 
                  if(curId == id){
                    var curWidth =  $(this).attr('data-gs-width');
                    var curHeight = $(this).attr('data-gs-height');
                    var curGsX = $(this).attr('data-gs-x');
                    var curGsY = $(this).attr('data-gs-y');
                    if(curGsX == 8){
                      //最右边的,只能变小不能变大
                      if(curWidth<value.width){
                            grid.move($(this), 4, curGsY);
                            grid.resize($(this),value.width, value.height);    
                            $scope.modifyGridWHData(value,curId)  

                        // if(value.width == 8 && value.height == 4){
                        //    if(grid.isAreaEmpty(4,curGsY,4,4)){
                        //     grid.move($(this), 4, curGsY);
                        //     grid.resize($(this),value.width, value.height);    
                        //     $scope.modifyGridWHData(value,curId)  
                        //   }
                        // }else{
                        //   //最大的左边需要2个空位子才能移动
                        // }

                      }else{
                        //$(this).attr('data-gs-width',value.width);
                        //$(this).attr('data-gs-height',value.height);    
                        $scope.modifyGridWHData(value,curId)  
                        grid.resize($(this),value.width, value.height);      
                      }
                    }else{
                       $scope.modifyGridWHData(value,curId)  
                       grid.resize($(this),value.width, value.height);      
                    }                        
                  }
                })

            }

            // 修改网格宽高数据
            $scope.modifyGridWHData=function(data,id){
              for(var i = 0;i<$scope.gridList.length;i++){
                if($scope.gridList[i].id == id){
                    $scope.gridList[i].width = data.width;
                    $scope.gridList[i].height = data.height;
                }
              }                       
              console.log("$scope.gridList",$scope.gridList);              
              $scope.updateViews(); 
            }

            // 修改图片数据
            $scope.modifyGridImageData=function(param){
              var data = param.data.imageData;
              var id = param.data.id
              for(var i = 0;i<$scope.gridList.length;i++){
                if($scope.gridList[i].id == id){
                    $scope.gridList[i].img_url = data.img_url;                 
                }
              }                      
                  
              $scope.updateViews(); 
            }

            // 修改网格链接
            $scope.modifyGridLinkData=function(param){
              var data = param.data.linkData;
              var id = param.data.id
              for(var i = 0;i<$scope.gridList.length;i++){
                if($scope.gridList[i].id == id){
                   $scope.gridList[i].image_herf = data.image_herf;                 
                }
              }            
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

            $scope.updateViews = function(){
             if(!$scope.$$phase) { 
                  $scope.$apply();  
                }
            }

            $scope.$on("addGridEvent", function(value,param) {
              console.log("请添加一个格子");
              $scope.addGrid(param)           

            });

            $scope.$on("delGridEvent", function(value,param) {
              console.log("删除一个格子");
              $scope.delGrid(param)  
              $scope.resetEdit();         
           });     

           $scope.$on("updateGridType", function(value,param) {
              console.log("更新网格大小");
              $scope.udpateGridType(param)      
           });   

           $scope.$on("updateGridImage", function(value,param) {
              console.log("更新图片");
              $scope.modifyGridImageData(param);
           }); 
            
          $scope.$on("updateGridLink", function(value,param) {
              console.log("更新链接");
               $scope.modifyGridLinkData(param);
           });

            
           $scope.$on("dragOverShowEidt", function(value,param) {
              console.log("拖放完毕显示有修改的网格的状态为对应的选择状态");
              $scope.resetEdit(param.id);
           });           

           ///////////////////////////////fistr run/////////////////////////////// 
           $scope.gridList.forEach(function(data){
             $scope.processData(data);
           })         

           $timeout(function(){
              $scope.clickItem(null,$scope.gridList[0]);
           },50)

          });



  // 修改控制器 
  app.controller("modifyController",function ($scope,$rootScope,$http) {
     //图片库
    $scope.imageLibs = [{"img_url":"assets/images/common/test_1.jpg"},{"img_url":"assets/images/common/test_2.png"},{"img_url":"assets/images/common/test_3.png"},{"img_url":"assets/images/common/test_4.jpg"},{"img_url":"assets/images/common/test_1.jpg"}]
    //当前选择的图片库
    $scope.curLibs = [];
    //当前修改数据
    $scope.curModifyData;
    //当前选择的网格类型
    $scope.curGirdType = {"width":4,"heigth":4};

    //选择格子类型
    $scope.clickSelGridType = function(type,id){
      $scope.curGirdType  = type;
      updateSelGridActive(id);
      $rootScope.$broadcast("updateGridType", {"data": {"gridData":$scope.curGirdType,"id":$scope.curModifyData.id}});
    }

    // 更新图片
    $scope.clickUpdateImage = function(data){
      $rootScope.$broadcast("updateGridImage",{"data": {"imageData":data,"id":$scope.curModifyData.id}});
    }

    // 更新链接
    $scope.updateLink = function(data){
      $rootScope.$broadcast("updateGridLink",{"data": {"linkData":data,"id":$scope.curModifyData.id}});
    }

    //增加i个格子    
    $scope.clickAddGrid=function(){
       var curData = createEmptyGridData();
       curData.class_type = "g_1_1";
       curData.herf="www.heyshow.tv";
       $rootScope.$broadcast("addGridEvent", {"data":curData});      
    }

    //删除i个格子
    $scope.clickDelGrid=function(){
      if($scope.curModifyData)
        $rootScope.$broadcast("delGridEvent", {"data":$scope.curModifyData});
    }

    // 修改图片链接
    $scope.clickSumbitImageHerfMoify = function(){
      var herfStr = $scope.curModifyData.herf;
      console.log(herfStr)
    }

    function updateSelGridActive(id){
      $(".set_size .size_type").removeClass('set_size_active');
      var searchStr = ".set_size :eq(" + id + ")";      
      $(searchStr).addClass("set_size_active");
    }

    $(".input_herf").change(function(){
      console.log("chagne text area ++++++++++++")
    })

    var watch = $scope.$watch('curModifyData',function(newValue,oldValue){
        if(newValue){
            $(".modify_grid").css("display","table");
            $(".mid_area").css("left","340px");
            $(".mid_area").css("right","340px");
        }else{
            $(".modify_grid").css("display","none");
            $(".mid_area").css("left","60px");
            $(".mid_area").css("right","60px");
        }      
      });


    ////////////////////////////////////////////////event//////////////////////////////////////////    
    $scope.$on("dragOverIsShowEidt", function(value,param) {
        if($scope.curModifyData){
           $rootScope.$broadcast("dragOverShowEidt", $scope.curModifyData);
        }
    });

     $scope.$on("reqAddGridEvent", function(value,param) {
       var curData = createEmptyGridData();
       curData.width = $scope.curGirdType.width;
       curData.height = $scope.curGirdType.height;       
       $rootScope.$broadcast("addGridEvent", {"data":curData});      
        
    });

    $scope.$on("showEditEvent", function(value,param) {
        //console.log(" get showEdit event",param)
        if(param.id == -1 ){
          //没选择修改
          $scope.curModifyData = null;
        }else{
          if($scope.curModifyData &&($scope.curModifyData.id == param.id )){
            return
          }
          console.log(" get showEdit event run")
          $scope.curModifyData = param.data;
        }
        if(!$scope.$$phase) { 
            $scope.$apply();  
        }
    });
   
    $('.modify_grid').css("visibility","visible")
  });


    // 模板定制我的控制器 
  app.controller("templeteController",function ($scope,$rootScope,$http) {

  });