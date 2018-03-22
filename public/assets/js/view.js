var app = angular.module('GridStack', ['gridstack-angular']).controller('blockController', function($scope, $rootScope, $log, $timeout) {
    gridScope = $scope;
    //存放所有数据包括状态，标题
    $rootScope.gridListData = data;


    $scope.gridList = data.widgets;

    if($scope.gridList){
         //xy必须排序一下
        $scope.gridList.sort(function(a,b){
            return a.x - b.x;
        })
        $scope.gridList.sort(function(a,b){
            return a.y - b.y;
        })
    }

    $scope.options = {
        animate: true,
        //disableDrag:disableDrag,
        disableResize: true,
        cellHeight: 'auto',
        //resizable : true,
        verticalMargin: 0
    };

    $scope.clickItem = function(event, item) {
        if (item.image_herf != ""){
            window.open(item.image_herf.indexOf('http') === 0 ? item.image_herf : ('//' + item.image_herf));
        }else if(item.original){
            window.open(item.original);
        }
    }    
    $('.content').css({'visibility':'visible'});   
});


//bringing back the images with style

$(document).ready(function(){
     $("#crop-avatar").find("a").each(function(item){
        var curTitle = $(this).attr("title")       
        if(curTitle == "站长统计"){
            $(this).css("display","none");
        }
     });
    updateGridAreaMargin();
})

$(window).resize(function(event) {
    updateGridAreaMargin();
});

function updateGridAreaMargin(){
    var curWidth = Math.min(800,$(window).width());
    var curMarginTop = 150 * (curWidth/375);
    var curHeight = 30 * (curWidth/375);
    $('#grids_area').css("margin-top",curMarginTop);
    // $('.lulala_logo').css("max-width",curWidth + "px");
    // $('.lulala_logo').css("height",curHeight + "px");
    // $('.lulala_logo').css("line-height",curHeight + "px");
}
