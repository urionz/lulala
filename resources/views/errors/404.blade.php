<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<style type="text/css">
    body{
        font: normal 12px/1.6em Microsoft YaHei,Tahoma,simsun;
    }
    .error{
        position: absolute;
        width: 540px;
        /*height: 407px;*/
        top: 100px;
        left: 0;
        right: 0;
        bottom: 0;
        margin: 0 auto;
    }
    .error .error_notice{
        width: 100%;
        height: 50px;
        text-align: center;
        font-size: 16px;
        font-weight: 700;
    }
    .error .error_notice .normal{
        color: #353637;
    }
    .error .error_notice .gohoem{
        color: #00a1d8;
    }
    a{
        color: #00a1d8;
    }

</style>
<body>
<div class="error">
    <div class="error_gif">
        <img src="{{ asset('assets/images/404.gif') }}">
    </div>
    <div class="error_notice">
        <p>
            <span class="normal">老司机似乎迷了路啊，</span>
            <span class="gohome"><a href="{{ env('APP_URL') }}">GO HOME</a></span>
        </p>
    </div>
</div>
</body>
</html>