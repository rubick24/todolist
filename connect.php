<?php
$host="localhost";
$db_user="root";
$db_pass="111111";
$db_name="todolist";
$timezone="Asia/Shanghai";

$link=mysqli_connect($host,$db_user,$db_pass);
mysqli_select_db($db_name,$link);
mysqli_query("SET names UTF8");

header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set($timezone);
?>
