<form method="post" action="signup.php">

    姓名：
    <input type="text" name="name" value="">
    <span class="error">* </span>
    <br><br>
    电子邮箱：
    <input type="text" name="email" value="">
    <span class="error">* </span>
    <br><br>
    密码：
    <input type="password" name="password" value="">
    <span class="error"></span>
    <br><br>
    确认密码：
    <input type="password" name="password2" value="">
    <span class="error"></span>
    <br><br>
    <input type="submit" value="提交" >
</form>

<?php $name = $email = $gender = $comment = $website = $password2 = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    $con = mysqli_connect("localhost", "root", "111111");
    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }
    mysqli_select_db("todolist", $con);
    mysqli_query("INSERT INTO users (name,email,password)
                 VALUES ('$name', '$email', '$password')");

    mysqli_query($sql, $con);

    mysqli_close($con);
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


require_once "email.class.php";
//******************** 配置信息 ********************************
$smtpserver = "smtp.163.com";//SMTP服务器
$smtpserverport =25;//SMTP服务器端口
$smtpusermail = "shenpengfei2008bj@163.com";//SMTP服务器的用户邮箱
$smtpemailto = $email;//发送给谁
$smtpuser = "shenpengfei2008bj@163.com";//SMTP服务器的用户帐号
$smtppass = "13994623943";//SMTP服务器的用户密码
$mailtitle = "验证邮件";//邮件主题
$mailcontent = "<h1>确认</h1>";//邮件内容
$mailtype = "HTML";//邮件格式（HTML/TXT）,TXT为文本邮件
//************************ 配置信息 ****************************
$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
$smtp->debug = false;//是否显示发送的调试信息
$state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype);

echo "<div style='width:300px; margin:36px auto;'>";
if($state==""){
    echo "对不起，邮件发送失败！请检查邮箱填写是否有误。";
    echo "<a href='index.html'>点此返回</a>";
    exit();
}
echo "邮件发送成功，请查收";
echo "<a href='index.html'>点此返回</a>";
echo "</div>";
?>