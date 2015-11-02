<?php
include_once("connect.php");

function test_input($data)
{
$data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$username=test_input($_POST['username']);
$password=md5(test_input($_POST['password']));
$query = mysql_query("select id from t_user where username='$username'");
$num = mysql_num_rows($query);
if($num==1) {
    $que = mysql_query("select password from t_user where id=='$query'");
    if ($password==$que) {
        echo '登陆成功';
        //这里写推送信息
    }
    else echo '密码错误 请重试';
}
else echo '用户名不存在';