<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登录</title>
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
<body>
<form id="reg" action="login.php" method="post" onsubmit="return chk_form();">
    <p>用户名：<input type="text" class="input" name="username" id="user" value="<?php echo $_COOKIE['username'];?>"></p>
    <p>密码：<input type="password" class="input" name="password" id="pass" value="<?php echo $_COOKIE['pswd']?>"></p>
    <p>记住密码
    <?php if($_COOKIE['remember'] == 1)
                {?><input type="checkbox" name="remember" value="1" checked><?php }
           else{($_COOKIE['remember'] == "")?><input type="checkbox" name="remember" value="1"><?php } ?></p>
    <p><input type="submit" class="btn" value="登录"></p>
</form>
<p>还没有账号？现在<a href="signup.html">注册</a></p>
</body>
</html>