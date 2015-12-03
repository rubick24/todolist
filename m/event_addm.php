<?php
include_once("../connect.php");
session_start();
    $_POST['description'] = substr($_POST['description'],0,500);
    $_POST['title'] = substr($_POST['title'],0,30);

    mysqli_query($link,"INSERT INTO list (`userid`,`event_id` , `event_day` , `event_month` , `event_year` , `event_time` , `event_title` , `event_desc` ) VALUES (".$_SESSION['userid'].",'', '".addslashes($_POST['day'])."', '".addslashes($_POST['month'])."', '".addslashes($_POST['year'])."', '".addslashes($_POST['hour'].":".$_POST['minute'])."', '".addslashes($_POST['title'])."', '".addslashes($_POST['description'])."')");
    $_POST['month'] = $_POST['month'] + 1;
    echo json_encode("{\"status\":\"success\",\"msg\":\"添加成功\"}");
?>

