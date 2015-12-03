<?php
include_once("../connect.php");

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$username = test_input($_POST['username']);

$query = mysqli_query($link,"select id from t_user where username=$username");
$num = mysqli_num_rows($query);
if($num==1){
    echo '<script>alert("用户名已存在，请更换用户名");window.history.go(-1);</script>';
    exit;
}
$password = md5(test_input($_POST['password']));
$email = test_input($_POST['email']);
$regtime = time();

$token = md5($username.$password.$regtime);
$token_exptime = time()+60*60*24;

$sql = "insert into `t_user` (`username`,`password`,`email`,`token`,`token_exptime`,`regtime`) values ('$username','$password','$email','$token','$token_exptime','$regtime')";

mysqli_query($link,$sql);


$verify = $token;
$nowtime = time();

$query = mysqli_query($link,"select id,token_exptime from t_user where status='0' and `token`='$verify'");
$row = mysqli_fetch_array($query);
if($row){
    if($nowtime>$row['token_exptime']){
        $msg = "{\"status\":\"fail\",\"msg\":\"注册已过期\"}";
    }else{
        mysqli_query($link,"update t_user set status=1 where id=".$row['id']);
        if(mysqli_affected_rows($link)!=1) die(0);
        $msg ="{\"status\":\"success\",\"msg\":\"注册成功\"}";

    }
}else{
    $msg = "{\"status\":\"fail\",\"msg\":\"error\"}";
}
echo json_encode($msg);
?>