<?php
include_once("../connect.php");
$query = "SELECT * FROM list WHERE event_id='$_GET[id]' LIMIT 1";
$query_result = mysqli_query ($link,$query);
$info = mysqli_fetch_array($query_result);
$date = date ("l, jS F Y", mktime(0,0,0,$info['event_month'],$info['event_day'],$info['event_year']));
$time_array = split(":", $info['event_time']);
$time = date ("g:ia", mktime($time_array['0'],$time_array['1'],0,$info['event_month'],$info['event_day'],$info['event_year']));
$event_id=$info['event_id'];$event_title=$info['event_title'];$event_desc=$info['event_desc'];
$data=array('event_id'=>$info['event_id'],
             'event_title'=>$info['event_title'],
             'event_time'=>$time,
             'event_date'=>$date,
             'event_desc'=>$info['event_desc']
            );
echo json_encode($data);
?>