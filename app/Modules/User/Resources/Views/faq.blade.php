<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
</head>
<link rel="stylesheet" href="{{ asset('assets/fonts/iconfont.css') }}">
<style type="text/css">
    body{
        font: normal 12px/1.6em Microsoft YaHei,Tahoma,simsun;
    }
    p{
        margin: 0;
        padding: 0;
    }
    .content{
        width: 90%;
        padding: 80px 5px 10px 80px;        
    }
    .p_title{
        color: #00a1d8;
    }
    .p_normal{
        color: #9a9a9a;
        text-indent:2em;
    }

    .p_title_h2{
        color: #9a9a9a;
    }
    .p_normal_h2{
        color: #9a9a9a;
        text-indent:2em;
    }
    .img_content{
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .title{
      margin-left: 25px;
      margin-top: 25px;
      color: black;
      font-size: 16px;
      position: absolute;
      z-index: 100;
    }

</style>
<body>
 <div class="title"><i class="icon iconfont icon-jieda "></i>&nbsp制作技巧</div>
<div class="content">
    <div class="item">
        <div class="faq_content">          
            <p class="p_title">一，怎样推广自己的信息微博，直播房间，淘宝店，视频空间等？</p>
            <p class="p_normal">选择要设置的模块，把自己的对应主页的网址，复制到右侧编辑栏底端的链接框里，发布之后点击对应的模块就会跳转到对应页面</p>
        </div>
        <div class="img_content">
            <img  style="width:800px" src="{{ asset('assets/images/faq_images/1.gif') }}">
        </div>
    </div>
    <div class="item">
        <div class="faq_content">
            <p class="p_title">二，怎么分享QQ群？</p>
            <p class="p_normal">打开要推广的群，获取分享链接，然后选择模块，复制到对应模块右侧编辑栏底端的链接框，注意：必须删除http前面的汉字，否则无法生效。发布之后点击QQ群模块就会发起加群邀请。</p>
        </div>
        <div class="img_content">
            <img  style="width:800px" src="{{ asset('assets/images/faq_images/2.gif') }}">
        </div>
    </div>    
    <div class="item">
        <div class="faq_content">
            <p class="p_title">三，怎么修改标题？</p>
            <p class="p_normal">打开编辑页，在页面顶端，点击输入标题保存，就可以修改了。</p>
        </div>
        <div class="img_content">
            <img  style="width:800px" src="{{ asset('assets/images/faq_images/3.gif') }}">
        </div>
    </div>
    <div class="item">
        <div class="faq_content">
            <p class="p_title">四，怎么更换图片？</p>
            <p class="p_normal_h2">点击要更换的模块，然后点击右边图片栏里的图片就可以更换了；</p>
        </div>
        <div class="img_content">
            <img  style="width:800px" src="{{ asset('assets/images/faq_images/4.gif') }}">
        </div>
    </div>
    <div class="item">
        <div class="faq_content">
            <p class="p_title">五，怎么上传自己的图片</p>
            <p class="p_normal_h2">右侧编辑栏，点击“我的”，然后点"上传图片"，就可以上传自己的图片了，支持jpg.png.gif格式；</p>
        </div>
        <div class="img_content">
            <img  style="width:800px" src="{{ asset('assets/images/faq_images/5.gif') }}">
        </div>
    </div>
    <div class="item">
        <div class="faq_content">
            <p class="p_title">六，怎么改变模块的大小形状？</p>
            <p class="p_normal_h2">选中要更换的模块，然后点击右侧编辑栏的图标，就可以改变大小了；</p>
        </div>
        <div class="img_content">
            <img style="width:800px" src="{{ asset('assets/images/faq_images/6.gif') }}">
        </div>
    </div>
    <div class="item">
        <div class="faq_content">
            <p class="p_title">七，怎么移动，添加和删除模块？</p>            
        </div>
        <div class="img_content">
            <img  style="width:800px" src="{{ asset('assets/images/faq_images/7.gif') }}">
        </div>  
    </div>
   
    <div class="item">
        <div class="faq_content">
            <p class="p_title">八，怎么分享我的主页给朋友看？</p>
            <p class="p_normal_h2">编辑好页面之后，点击发布，会跳转到分享页面</p>
        </div>
        <div class="img_content">
            <img  style="width:800px" src="{{ asset('assets/images/faq_images/10.gif') }}">
        </div>       
    </div>
</div>
</body>
</html>