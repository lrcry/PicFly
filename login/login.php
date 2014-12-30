<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php include "../menu.php"; ?>
<html>
<head>
<title>登录 - 进入PicFly，让风景随心飞翔</title>
<!-- 我TMD每天究竟在写些什么东西啊 -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
<script>

</script>
<style type="text/css">
@import url(../css/login.css);
td {
width: 100px;
height: 50px;
color: #9400D3;
}
</style>
<script src="../js/login_confirm.js"></script>
</head>

<body>

<?php 
session_start();
include "../access_db_for_sth.php";
$current_time = time();
$timeout = 15 * 60;
if (!isset($_SESSION["username"]) || (($current_time - $_SESSION["start_time"]) > $timeout)) {
	; //如果未登录则登录
} else {
	$row = fetch_from_db("nickname", "username", $_SESSION["username"]);
	echo "<script>userinfo.innerText = '欢迎您，" . $row["nickname"] . "';</script>"; 
	echo "<script>userinfo_1.innerHTML = '<button width=\'100px\' height=\'25px\' onclick=\"window.location.href=\'login/logout.php\'\">注销登录</button>';</script>";
	echo "<script>alert('您正处于登录状态，请先注销再登录其他帐号！');</script>";
	echo "<script>top.location.href='../myspace.php';</script>";
}
?>
<div align="center" style="margin-top: 80px">
<h1>现在就登录PicFly</h1>
<h3>用图片记录生活，用风景谱写心情</h3>
<form method="post" name="form_login" onsubmit="return check_login()" action="log_confirm.php">
<table>
	<tr>
		<td>用户名</td>
		<td><input type="text" name="login_un" id="login_un" maxlength="16" /></td>
	</tr> 
	<tr>
		<td>密码</td>
		<td><input type="password" name="login_pw" id="login_pw" maxlength="32" /></td>
	</tr>
</table>
<input type="submit" style="width: 150px; height: 40px" name="login_submit" value="开始分享" />
<input type="reset" style="width: 150px; height: 40px" name="login_reset" value="重新填写" />
</form>
<h3 style="color: #9400D3">还没有账户？请移步这里
	<a href="../registration/register.php"><button style="width:90px; height:25px">加入PicFly</button></a>
</h3>
</div>



<!--  <button onclick="chgBg()"></button>-->
</body>
</html>