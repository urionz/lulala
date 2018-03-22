<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
</head>
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/user_account.css') }}">
<link href="{{ asset('third/crop-avatar/dist/cropper.min.css') }}" rel="stylesheet">
<link href="{{ asset('third/crop-avatar/css/main.css') }}" rel="stylesheet">
<body>
<div class="content">
    <div class="content_item">
        <p class="col_1">修改密码</p>
        <p class="col_2">已设置</p>
        <p class="col_3">建议使用字母数字组合</p>
        <p class="col_4">修改密码</p>
    </div>    
</div>
 <!-- 修改密码 -->
        <div class="change_pass" data-id="change_pass_id">
            <div class="change_pass_area">
                <form action="{{ route('password.modify') }}" method="post" id="passwordModifyFrm">
                    {{ csrf_field() }}
                    <!-- 登录输入提示 -->
                    <div class="pass_top">
                        <div class="logo">
                            <img src="{{ asset('assets/images/login/logo.png') }}">
                        </div>

                        <div class="password">
                            <p>
                                输入原始密码
                            </p>
                            <input class="input_class" name="old_password" required type="password"></input>
                        </div>
                        <div class="password">
                            <p>
                                输入新密码
                            </p>
                            <input class="input_class" name="password" required type="password"></input>
                        </div>
                        <div class="password">
                            <p>重新输入新密码</p>
                            <input class="input_class" required name="password_confirmation" type="password"></input>
                        </div>
                        <button type="submit" class="register_btn">
                            确定修改
                        </button>
                    </div>
                </form>
            </div>
        </div>
</body>
<script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {      
        $(".col_4").click(function(event){           
            $(".change_pass").css("display","block");
        });
        $(".change_pass").click(function (event) {
             console.log("click")
            var target = event.target;
            var result = $(target).attr("data-id");
            if (result == "change_pass_id") {
                $(".change_pass").css("display", "none");
            }
            
        });    
        $('#passwordModifyFrm').submit(function(){
            var frm = $(this);
            $.ajax({
                url:frm[0].action,
                data:frm.serialize(),
                type:'post',
                success:function(response){
                    top.document.location.href = response.location;
                },
                error:function(response){
                    alert(response.responseText);
                }
            });
            return false;
        })   
    })
</script>
</html>