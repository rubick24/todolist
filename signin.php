<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
    <style type="text/css">
        #登录 {
            border: 1px solid #a0b1c4;
            width: 334px;
            height: 387px;
            _height: 371px;
            background-color: #fff;
            position: relative;
            z-index: 12;
            padding: 0;
            border-radius: 5px;
            overflow: hidden;
        }
        .login{width:300px; margin:40px auto 0 auto; min-height:250px;}
        .login p{line-height:30px; padding:4px}
        .btn {
            display: inline-block;
            *display: inline;
            *zoom: 1;
            box-sizing: border-box;
            width:100%
            height: 40px;
            height: 38px \9;
            line-height: 38px;
            padding: 0 20px;
            margin-top: 9px;
            *vertical-align: -6px;
            font-size: 16px;
            font-weight: normal;
            color: #fff;
            text-align: center;
            background: #5a98de;
            border-radius: 3px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            outline: none;
            border: none;
            cursor: pointer;
        }
        </style>
    <script type="text/javascript">
        function chk_form(){
            var user = document.getElementById("user");
            if(user.value==""){
                alert("用户名不能为空！");
                return false;
                //user.focus();
            }
            var pass = document.getElementById("pass");
            if(pass.value==""){
                alert("密码不能为空！");
                return false;
                //pass.focus();
            }
        }
    </script>
</head>
<body style="background-color:#d9edf7; "><div align="center">
<div id="登录" style="width: 334px; height: 387px; visibility: visible;">
    <div class="login">
        <h3 align="center" class="top_title">登录</h3><br/>
        <div align="center"> <form id="reg" action="login.php" method="post" onsubmit="return chk_form();">
            <p>用户名：<input type="text" class="input" name="username" id="user" value="<?php echo $_COOKIE['username'];?>"></p>
            <p>密&nbsp;码：<input type="password" class="input" name="password" id="pass" value="<?php echo $_COOKIE['pswd']?>"></p>
            <div style="width: 100%"> <p style="font-size: small">记住密码
            <?php if($_COOKIE['remember'] == 1)
                    {?><input type="checkbox" name="remember" value="1" checked><?php }
                   else{($_COOKIE['remember'] == "")?><input type="checkbox" name="remember" value="1"><?php } ?></p></div>
            <p><input type="submit" class="btn" value="登录"></p>
        </form></div>
        <p align="right" style="font-size: small">还没有账号？现在<a href="signup.html">注册</a></p>
</div></div></div>
</body>
</html>