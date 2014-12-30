<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
<title>
	注册 - 加入PicFly，让风景随心飞翔
</title>
<style>
@import url(../css/fail.css);
@import url(../css/register.css);
</style>
<script type="text/javascript" src="../js/jsconfirm.js"></script>
</head>

<body>



<?php 
session_start();
include "../menu.php";
include "../access_db_for_sth.php";
$current_time = time();
$timeout = 15 * 60;
if (!isset($_SESSION["username"]) || (($current_time - $_SESSION["start_time"]) > $timeout)) {
	; //如果未登录则可以注册new帐号
} else {
	$row = fetch_from_db("nickname", "username", $_SESSION["username"]);
	echo "<script>userinfo.innerText = '欢迎您，" . $row["nickname"] . "';</script>"; 
	echo "<script>userinfo_1.innerHTML = '<button width=\'100px\' height=\'25px\' onclick=\"window.location.href=\'login/logout.php\'\">注销登录</button>';</script>";
	echo "<script>alert('您正处于登录状态，请先注销再注册其他帐号！');</script>";
	echo "<script>top.location.href='../myspace.php';</script>";
}
?>
<div class="register">
<h1 align="center">成为PicFly的一员</h1>
<h3 align="center">天天分享，记录生活点滴，让心情自然流露，让风景随风飞翔</h3>

<div class="form">
<!-- 将action设置为空或者#，就是将表单传给自己 -->
	<form name="reg_form" onsubmit="return submit_confirm()" action="phpconfirm.php" method="post"> 
		<table style="table-layout: fixed">
			<!-- Input User Name -->
			<tr>
				<td>用户名（5-16个字母、数字与下划线的组合）<b style="color:red">*</b></td>
				<td><input type="text" name="username" id="username" maxlength="16" /></td>
			</tr>
			
			<!-- Input Nickname -->
			<tr>
				<td>昵称（不超过16个字符或汉字）<b style="color:red">*</b></td>
				<td><input type="text" name="nickname" id="nickname" maxlength="16" /></td>
			</tr>
			
			<!-- Select Gender -->
			<tr>
				<td>性别<b style="color:red">*</b></td>
				<td>帅哥<input type="radio" name="gender" id="gender" value="0" checked="checked" />
				美女<input type="radio" name="gender" id="gender" value="1" /></td>
			</tr>
			
			<!-- Input Password -->
			<tr>
				<td>密码（6-32个字符）<b style="color:red">*</b></td>
				<td><input type="password" name="password" id="password" maxlength="32" /></td>
			</tr>
			
			<!-- Confirm Password -->
			<tr>
				<td>密码确认<b style="color:red">*</b></td>
				<td><input type="password" name="pw_confirm" id="pw_confirm" maxlength="32" /></td>
			</tr>
			
			<!-- Input Email -->
			<tr>
				<td>邮箱（用于找回密码）<b style="color:red">*</b></td>
				<td><input type="text" name="email" id="email" ></td>
				
			</tr>
			
			<!-- Submit -->
			<tr>
				<td><input style="width: 175px; height: 40px" type="submit" name="submit" value="开启时光之旅" /></td>
				<td><input style="width: 175px; height: 40px" type="reset" name="reset" value="重新填写资料" /></td>
			</tr>
		</table>
	</form>
</div>
</div>

<div align="center" style="color: #FFD700">
<h3>已有账户？点击此处 <a href="../login/login.php"><button style="width:175px; height:40px">登录</button></a></h3>
</div>

</body>

</html>

