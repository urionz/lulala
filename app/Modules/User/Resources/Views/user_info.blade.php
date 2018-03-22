<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
</head>
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/user_info.css') }}">
<link href="{{ asset('third/crop-avatar/dist/cropper.min.css') }}" rel="stylesheet">
<link href="{{ asset('third/crop-avatar/css/main.css') }}" rel="stylesheet">
<body id="crop-avatar">
 <form action="{{ route('profile.store') }}" method="post">
                {{ csrf_field() }}
    <div class="content">
        <ul class="content_item">
            <li class="cell_1"><p>头像</p></li>
            <li class="cell_2"><img src="{{ Auth()->user()->avatar ? Auth()->user()->avatar : asset('assets/images/default_avatar.jpg') }}" class="user_avatar"></li>
            <li class="cell_3">
                <div class="change_avator avatar-view"><p>修改头像</p></div>
            </li>
            <li class="cell_4"><p>建议上传200x200像素的图片，格式为jpg,png,gif,文件不要超过1M</p></li>
        </ul>
        <div class="user_web">
            <p>主页地址</p>
            <p class="cell_1">{{ route('show', Auth()->user()->id) }}</p>
            <p class="cell_2">此账号为您注册时随机生成的号码</p>
        </div>
        <div class="account">
            <p><span>账号类型&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span><span>普通用户</span>
            </p>
            <div class="nick">
                <span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp昵称</span><input text="text" name="nickname" value="{{ Auth()->user()->nickname }}"></input>
            </div>
            <div class="address">
                <span class="address_span">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp地址</span>
                <div id="distpicker2">
                    <select name="province" id="province"></select>
                    <select name="city" id="city"></select>
                    <select name="area" id="area"></select>
                </div>
            </div>
        </div>
        <div class="save">
            <button class="save_btn" name="subject" type="submit" value="">保存</button>
        </div>
        </ul>
         
    </div>
</form>
<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="avatar-form" action="{{ route('setAvatar') }}" enctype="multipart/form-data" method="post">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" type="button">&times;</button>
                    <h4 class="modal-title" id="avatar-modal-label">修改头像</h4>
                </div>
                <div class="modal-body">
                    <div class="avatar-body">
                        <div class="avatar-upload">
                            <input class="avatar-src" name="avatar_src" type="hidden">
                            <input class="avatar-data" name="avatar_data" type="hidden">
                            <label for="avatarInput">图片上传</label>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input class="avatar-input" id="avatarInput" name="avatar_file" type="file"></div>
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
                            <div class="col-md-9">
                                <div class="btn-group">
                                    <button class="btn" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees"><i class="fa fa-undo"></i> 向左旋转</button>
                                </div>
                                <div class="btn-group">
                                    <button class="btn" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees"><i class="fa fa-repeat"></i> 向右旋转</button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-success btn-block avatar-save" type="submit"><i class="fa fa-save"></i> 保存修改</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
</div>
</body>
<script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
<script src="//cdn.bootcss.com/cropper/2.3.4/cropper.min.js"></script>
<script src="{{ asset('assets/js/ucenterCrop.js') }}"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="{{ asset('third/picker/distpicker.data.js') }}"></script>
<script src="{{ asset('third/picker/distpicker.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#distpicker2").distpicker({
            province: "{{ Auth()->user()->province }}",
            city: "{{ Auth()->user()->city }}",
            district: "{{ Auth()->user()->area }}",
            autoSelect: true
        });
    })
</script>
</html>