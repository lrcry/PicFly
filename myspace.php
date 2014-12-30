<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>

<head>

<title>
我的PicFly小窝
</title>
<script>
function change_userinfo (username) {
	userinfo.innerText = username;
}
</script>
<style>
/*@import url(css/myspace.css);*/
</style>
</head>

<body>
<?php include "menu.php"; ?>
<?php
//if (!isset($_SESSION)) {
	session_start();
//}
include "login/login_state_judge.php";
$current_time = time();
$timeout = 15 * 60;
/* 
 * Judgement of login state 
 * (Q: Should multithread be considered in this situation?) 
 * A: I've tried under different devices, it seems that multithread 
 * has been solved by php itself._judge.php
 * It has been replaced by login_state_judge.php
 */ 
if (!judge_login_state("username", $timeout, $current_time, "start_time")) {
	exit;
}  else { 
	/* Query DB to get content */
	$con = mysql_connect("localhost:3306", "root", "admin");
	if (!$con) {
		die ("Cannot connect to DB when getting last login time");
	}
	
	mysql_select_db("picfly");
	
	$timesql = "select * from picfly_registration_information where username = '" . $_SESSION["username"] . "'";
	//echo "<h1>" . $timesql . "</h1>";
	$result = mysql_query($timesql);
	$row = mysql_fetch_array($result);
	//global $row;
	//$_SESSION["test"] = $row["nickname"];
	//$last_time_login = $row["last_login_time"];
	echo "<script>userinfo.innerText = '欢迎您，" . $row["nickname"] . "';</script>"; 
	echo "<script>userinfo_1.innerHTML = '<button width=\'100px\' height=\'25px\' onclick=\"window.location.href=\'login/logout.php\'\">注销登录</button>';</script>";
	//echo "<h1>" . $_SESSION["username"] . "</h1>";
	mysql_close($con);
}
?>

<table width="101.5%" height="80%" style="margin-left: -11px; margin-top: -5px">
	<tr>
		<td style="background-image: url('images/bg-0030.gif')" width="20%" height="100%">
			<iframe src="frame/menu_left.html" width="100%" height="100%" scrolling="no"></iframe>
		</td>
		<td style="background-image: url('images/bg-0006.gif')" width="80%" height="100%">
			<iframe id="right_iframe" name="right_iframe" src="frame/content_right_latestpic.html" width="100%" height="100%"></iframe>
		</td>
	</tr>
</table>

<p align="center">Copyright RangE 2013 - PicFly and its affiliates are all opensourced</p>
</body>

</html>