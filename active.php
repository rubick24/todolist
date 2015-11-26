<?php
include_once("connect.php");

$verify = stripslashes(trim($_GET['verify']));
$nowtime = time();

$query = mysqli_query($link,"select id,token_exptime from t_user where status='0' and `token`='$verify'");
$row = mysqli_fetch_array($query);
if($row){
	if($nowtime>$row['token_exptime']){
		$msg = '您的激活有效期已过.';
	}else{
		mysqli_query($link,"update t_user set status=1 where id=".$row['id']);
		if(mysqli_affected_rows($link)!=1) die(0);
		$msg = '激活成功！<p>现在<a href=signin.php>登录</a></p>';

	}
}else{
	$msg = 'error.';
}
echo $msg;
?>
