<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PicFly，让风景随心飞翔</title>
<style>
.option {
	width: 1000px;
	overflow: hidden;
	margin-left: auto;
	margin-right: auto;
}
.reg, .login {
	float: left;
	display: inline-block;
	margin-top: 100px;
	color: #912CEE;
}
.reg {
	width: 500px;
	height: 500px;
}
.login {
	width: 500px;
	height:500px;
}

button.index {
	width: 100px;
	height: 50px;
}

body {
background-image: url(images/index_bg_1.jpg);
background-position: 0px 98px;
background-repeat: no-repeat;
}
/*#circle { 
width: 100px; 
height: 100px; 
background: red; 
-moz-border-radius: 50px; 
-webkit-border-radius: 50px; 
border-radius: 50px; 
} */
</style>
</head>
<body>
<?php 
/*如果没登陆，菜单显示 首页，随便看看，关于本站，UserInformation显示 欢迎来宾； 登陆了显示全部，
 * OK*/ 
include "menu.php"; 
?>

<!--  <div class="index_pic">
	
</div>-->
<?php 
session_start();
include "access_db_for_sth.php";
$current_time = time();
$timeout = 15 * 60;
if (!isset($_SESSION["username"]) || (($current_time - $_SESSION["start_time"]) > $timeout)) {
	; //没登录就默认
} else {
	$row = fetch_from_db("nickname", "username", $_SESSION["username"]);
	echo "<script>userinfo.innerText = '欢迎您，" . $row["nickname"] . "';</script>"; 
	echo "<script>userinfo_1.innerHTML = '<button width=\'100px\' height=\'25px\' onclick=\"window.location.href=\'login/logout.php\'\">注销登录</button>';</script>";
	//echo "<script>alert('您正处于登录状态，请先注销再注册其他帐号！');</script>";
	//echo "<script>top.location.href='../myspace.php';</script>";
}
?>
<div class="option">
	<div align="center" class="reg">
	<image src="images/reg_icon.png" />
	<h2>刚了解到PicFly？快来注册一个帐号吧！</h2>
	<h3>加入PicFly，分享“美”一天，让风景随心飞翔。</h3>
	<button class="index" onclick="window.location.href='registration/register.php'">注册</button>
	</div>
	<div align="center" class="login">
	<image src="images/login_icon.png" />
	<h2>老朋友？点击下面按钮登录</h2>
	<h3>记录生活的每一个角落，喜怒哀乐，我们为您珍藏。</h3>
	<button class="index" onclick="window.location.href='login/login.php'">登录</button>
	</div>
</div>
</body>
</html>