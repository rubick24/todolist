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
		$msg = '激活成功！请登录';
		$table=mysqli_fetch_array(mysqli_query($link,"select username from where id=".$row['id']));
		$tablename=$table['username'];
		echo $tablename;
		mysqli_query($link,
			"CREATE TABLE $tablename
						(`id` int(10) NOT NULL AUTO_INCREMENT,
						`starttime` int(10) NOT NULL COMMENT '开始时间',
						`endtime` int(10) NOT NULL COMMENT '结束时间',
						`location` VARCHAR (50) NOT NULL COMMENT '地点',
						`event` VARCHAR(50) NOT NULL COMMENT '事件',
						`description` VARCHAR (200) NOT NULL COMMENT '描述',
						PRIMARY KEY (id)
						)ENGINE=MyISAM DEFAULT CHARSET=utf8");
	}
}else{
	$msg = 'error.';
}
echo $msg;
echo "<p>现在<a href=signin.html>登录</a></p>";
?>
