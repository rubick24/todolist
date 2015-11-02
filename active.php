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
		$msg = '激活成功！';
		$tablename=mysqli_query($link,"select username from where id=".$row['id']);
		mysqli_query($link,
			"CREATE TABLE [$tablename]
						('id' int(10) NOT NULL AUTOINCRMENT,
						 'date' int(10) NOT NULL COMMENT '事件日期',
						 'location' VARCHAR (50) NOT NULL COMMENT '事件地点',
						 'event' VARCHAR(50) NOT NULL COMMENT '事件名',
						 'describe' VARCHAR (200) NOT NULL COMMENT '事件描述',
						 PRIMARY KEY ('id')
						)ENGINE=MyISAM DEFAULT CHARSET=utf8");
	}
}else{
	$msg = 'error.';
}
echo $msg;
?>
