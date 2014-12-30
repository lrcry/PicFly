<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>登录成功</title>
<style>
@import url(../css/login.css);
.log_success {
text-align: center;
color: #FFD700;
margin-top: 100px;
}

</style>
<script language="javascript">
function countdown(secs,jump_to) {
jump_sec.innerText=secs;//<span>中显示的内容值
	//alert(jump_to);
	if (--secs>0) {
		setTimeout("countdown(" + secs + ",'" + jump_to + "')", 1000);//设定超时时间
	} else {
		location.href = jump_to;//跳转页面
	} 
}
</script>
</head>
<body>
<?php include "../menu.php";
 function get_user_ip() {
        if (isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP']!='unknown') {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']!='unknown') {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    } 
?>

<div class="log_success">
<h1>登录成功。欢迎来到PicFly！</h1>
<?php
//if (!isset($_SESSION)) {
	session_start();
//}
include "login_state_judge.php";
$current_time = time();
$timeout = 15 * 60;
/*if (!isset($_SESSION["username"])) { //Not login yet
	echo "<script>alert('啊哦，您还没登录！');</script>";
	echo "<script>window.location.href='login.php'</script>";
	exit;
} else if (($current_time - $_SESSION["start_time"]) > $timeout) { //Timeout 15min
	echo "<script>alert('您已经登录了15分钟以上，为了安全请您重新登录！');</script>";
	unset($_SESSION["username"]);
	echo "<script>window.location.href='login.php'</script>";
	exit;*/
if (!judge_login_state("username", $timeout, $current_time, "start_time")) {
	exit;
} else {
//if (isset($_POST["login_un"]) && isset($_POST["login_pw"])) { //正常登录
	//echo "<script>alert('OK!');</script>";
	/*
	 * 登录成功页：
	 * 显示 登录成功，跳转到个人空间
	 * 个人空间的布局页面一样，其中显示什么内容去查询数据库
	 */
	/*
	 * PHP connect MySQL:
	 * 1. Create a connection: $con = mysql_connect("localhost:3306", username, pwd);
	 * 2. Judge if the connection is successfully set: if (!$con) {failed and exit;}
	 * 3. Select current DB in use: mysql_select_db(dbname);
	 * 4. Create SQL statement;
	 * 5. Query in DB: [$result = ]mysql_query($sql_statement);
	 * 6. Close the connection: mysql_close($con);
	 */
	
	//echo $_SESSION["username"];
	$con = mysql_connect("localhost:3306", "root", "admin");
	if (!$con) {
		die("Cannot connect to DB!");
	}
	$username = $_SESSION["username"];
	mysql_select_db("picfly");
	
	/* 获取上次登录时间和IP */
	$sql_last_login = "select nickname, last_login_time, last_login_ip from picfly_registration_information
	where username = '" . $username . "'";
	$result_last_login = mysql_query($sql_last_login);
	$row_last_login = mysql_fetch_array($result_last_login);
	
	/* 获取昵称用于显示 */
	echo "<script>userinfo.innerText = '欢迎您，" . $row_last_login["nickname"] . "';</script>"; 
	echo "<script>userinfo_1.innerText = '';</script>";
	
	if ($row_last_login["last_login_time"] == "") { //如果是第一次登录
		echo "<h3>这是您第一次登录。</h3>";
	} else {
		echo "<h3>上一次您登录是在：" . $row_last_login["last_login_time"] . "</h3>";
	}
	
	if ($row_last_login["last_login_ip"] == "") {}
	else {
		echo "<h3>上一次登录的IP地址：" . $row_last_login["last_login_ip"] . "</h3>";
	}
	
	$ip = get_user_ip();
	
	/* 更新上次登录时间和IP */
	$update_last_login = "update picfly_registration_information
		set last_login_time = now(), last_login_ip = '" . $ip . "' where username = '" . $username . "'";
	mysql_query($update_last_login);
	
	
	mysql_close($con);
//} else { //如果没登录直接访问了这个页面
	//echo "<script>alert('您还没登录！');</script>";
	//echo "<script>location.href='login.php'</script>";
//}
}
?> 
<h3><span id="jump_sec">5</span>秒之后自动跳转到您的小窝。
<script language="javascript">countdown(5,'../myspace.php');</script></h3>
<h3>如果没有自动跳转，请点击<a href="../myspace.php">这里</a></h3>

</div>

</body>
</html>