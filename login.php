<?php
include_once("connect.php");
function test_input($data)
{
$data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

header('Content-type: text/html; charset=utf-8');
$username=test_input($_POST['username']);
$password=md5(test_input($_POST['password']));
$query = mysqli_query($link,"select id from t_user where username=$username");
$num = mysqli_num_rows($query);
if($num==1) {
    $id=mysqli_fetch_array($query);
    $pw=mysqli_fetch_array(mysqli_query($link,"select password from t_user where id=$id[0]"));
    $ps=$pw['password'];
    if ($password==$ps) {
        echo "登录成功！即将跳转..";
        header("refresh:1;url=index.php");//����д������Ϣ
    }
    else echo "密码错误 请重试";
}
else echo "用户名不存在";