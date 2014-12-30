<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>注销成功</title>
<style>
body {
background-image: url(../images/logout.jpg);
background-repeat: no-repeat; /* 背景不重复 */
background-position: center center; /* 背景居中 */
}
h1, h3 {
color: #000080;
text-align: center;
margin-bottom: 50px;
}
h1 {
margin-top: 100px;
}
</style>
<script src="../js/logout_jump.js"></script>
</head>
<body>
<?php include "../menu.php"; ?>
<?php
session_start();

/* Logout */
if (isset($_SESSION["username"])) { //如果在有效登录状态
	unset($_SESSION["username"]);
} else { //如果没登录
	echo "<script>alert('您还没有登录！')</script>";
	echo "<script>window.location.href='login.php'</script>";
	exit;
}

if (!isset($_SESSION["username"])) {
	echo "<h1>注销成功</h1>";
	echo "<h3>您已经成功注销，别忘了经常回来看看我哦~</h3>";
	echo "<h3><span id='jump_sec'>5</span>秒之后跳转回<a href='../index.php'>首页</a></h3>";
	echo "<script>countdown(5, '../index.php')</script>";
	exit;
} else { //注销失败
	echo "<h3>You could directly close your browser or this tag.</h3>";
}
?>
</body>
</html>