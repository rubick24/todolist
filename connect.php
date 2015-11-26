<?php
$host="localhost";
$db_user="root";
$db_pass="111111";
$db_name="todolist";
$timezone="Asia/Shanghai";
$TBL_PR = "calendar_";

$link=mysqli_connect($host,$db_user,$db_pass);
echo mysqli_error($link);
mysqli_select_db($link,$db_name);
mysqli_query($link,"SET names UTF8");

header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set($timezone);
?>
