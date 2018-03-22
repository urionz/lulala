var app = angular.module('GridStack', ['gridstack-angular']).controller('blockController', function($scope, $rootScope, $log, $timeout) {
    gridScope = $scope;
    //存放所有数据包括状态，标题
    $rootScope.gridListData = data;


    $scope.gridList = data.widgets

    //xy必须排序一下
    $scope.gridList.sort(function(a,b){
        return a.x - b.x;
    })
    $scope.gridList.sort(function(a,b){
        return a.y - b.y;
    })

    $scope.options = {
        animate: true,
        //disableDrag:disableDrag,
        disableResize: true,
        cellHeight: 'auto',
        //resizable : true,
        verticalMargin: 0
    };

    $scope.clickItem = function(event, item) {
        if(global_press)return;
        if (item.image_herf != ""){
            window.open(item.image_herf.indexOf('http') === 0 ? item.image_herf : ('//' + item.image_herf));
        }else if(item.original){
            window.open(item.original);
        }
    }

    $('.mobile_area').css({'visibility':'visible'});
    $(document).attr("title",$rootScope.gridListData.title);

    $(function() {
        $('.div_scroll').scroll_absolute({
            arrows: false
        })
    });
});

$(document).ready(function(){
    updateGridAreaMargin();
});

$(window).resize(function(event) {
    updateGridAreaMargin();
});

function updateGridAreaMargin(){
    var curWidth = 230;
    var curMarginTop = 150 * (curWidth/375);
    $('#grids_area').css("margin-top",curMarginTop);
}
