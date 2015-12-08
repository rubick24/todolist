<?php
include_once("../connect.php");
session_start();
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$username=test_input($_POST['username']);
$pswd=test_input($_POST['password']);
$password=md5($pswd);
$remember = $_POST['remember'];


$query = mysqli_query($link,"select id from t_user where username=$username");
$num = mysqli_num_rows($query);
if($num==1) {
    $id=mysqli_fetch_array($query);
    $pw=mysqli_fetch_array(mysqli_query($link,"select password from t_user where id=$id[0]"));
    $ps=$pw['password'];
    if ($password==$ps) {
        if($remember == 1){
            setcookie('pswd',$pswd,time()+3600*24);
            setcookie('remember',$remember,time()+3600*24);
        }else{
            setcookie('pswd',$pswd,time()-3600*24);
            setcookie('remember',$remember,time()-3600*24);
        }
        setcookie('username',$username,time()+3600*24);
        $_SESSION['userid']=$id[0];
        echo json_encode("{\"status\":\"success\",\"msg\":\"登录成功\"}");
        header("refresh:1;url=../index.php");
    }
    else echo json_encode("{\"status\":\"fail\",\"msg\":\"密码错误\"}");
}
else echo json_encode("{\"status\":\"fail\",\"msg\":\"用户名不存在\"}");
?>