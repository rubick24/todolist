<?php
include_once("connect.php");

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$username = test_input($_POST['username']);

//检测用户名是否存在
$query = mysqli_query($link,"select id from t_user where username=$username");
$num = mysqli_num_rows($query);
echo $num;
if($num==1){
	echo '<script>alert("用户名已存在，请更换用户名");window.history.go(-1);</script>';
	exit;
}
$password = md5(test_input($_POST['password']));
$email = test_input($_POST['email']);
$regtime = time();

$token = md5($username.$password.$regtime); //创建用于激活识别码
$token_exptime = time()+60*60*24;//过期时间为24小时后

$sql = "insert into `t_user` (`username`,`password`,`email`,`token`,`token_exptime`,`regtime`) values ('$username','$password','$email','$token','$token_exptime','$regtime')";

echo $sql;

mysqli_query($link,$sql);

if(mysqli_insert_id($link)){//写入成功，发邮件
	include_once("smtp.class.php");
	$smtpserver = "smtp.163.com"; //SMTP服务器
    $smtpserverport = 25; //SMTP服务器端口
    $smtpusermail = ""; //SMTP服务器的用户邮箱
    $smtpuser = ""; //SMTP服务器的用户帐号
    $smtppass = ""; //SMTP服务器的用户密码
    $smtp = new Smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass); //这里面的一个true是表示使用身份验证,否则不使用身份验证.
    $emailtype = "HTML"; //信件类型，文本:text；网页：HTML
    $smtpemailto = $email;
    $smtpemailfrom = $smtpusermail;
    $emailsubject = "用户帐号激活";
    $emailbody = "亲爱的".$username."：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/><a href='register/active.php?verify=".$token."' target='_blank'>register/active.php?verify=".$token."</a><br/>如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。<br/>如果此次激活请求非你本人所发，请忽略本邮件。<br/><p style='text-align:right'>-------- todolist工作组敬上</p>";
    $rs = $smtp->sendmail($smtpemailto, $smtpemailfrom, $emailsubject, $emailbody, $emailtype);
	if($rs==1){
		$msg = '恭喜您，注册成功！<br/>请登录到您的邮箱及时激活您的帐号！';	
	}else{
		$msg = $rs;	
	}
    echo $msg;}
?>