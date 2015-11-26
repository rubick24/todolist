<?php
include_once("connect.php");
session_start();
$db_table ="list";
$query_result = mysqli_query ($link,$query);
$id = stripslashes(trim($_GET['id']));
mysqli_query($link,"DELETE FROM $db_table WHERE event_id='$id' LIMIT 1");
        ?>
                    <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
                    <html>
                    <head>
                    <title>Calendar - Delete Event</title>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                    <script language='javascript' type="text/javascript">
                    <!--
                     function redirect_to(where, closewin)
                     {
                             opener.location= 'index.php?' + where;

                             if (closewin == 1)
                             {
                                     self.close();
                             }
                     }
                      //-->
                     </script>
                    </head>
                    <body onLoad="javascript:redirect_to('month=<? $nowmonth=date("m",time())+1; echo $nowmonth."&year=".date("Y",time()); ?>',1);">
                    </body>
                    </html>
