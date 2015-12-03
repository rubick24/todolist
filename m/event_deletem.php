<?php
include_once("../connect.php");
session_start();
$db_table ="list";
$query_result = mysqli_query ($link,$query);
$id = stripslashes(trim($_GET['id']));
mysqli_query($link,"DELETE FROM $db_table WHERE event_id='$id' LIMIT 1");
echo json_encode("{\"status\":\"success\",\"msg\":\"删除成功\"}");

?>