<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>登录失败</title>
<style>
@import url(../css/login.css);
.logf {
margin-top: 100px;
}
</style>
</head>
<body>

<?php include "../func_clean.php";
include "../menu.php";
?>

<div class="logf">
<?php
/*
 * 服务器端验证登录表单，先处理，再进数据库查询
 */
//$lifetime = 60 * 15;
//session_set_cookie_params($lifetime);
if (!isset($_SESSION)) {	
	session_start();
}
//$errfound = false;
//$unreg_username = false;
//$pw_error = false;

/*用户名*/
if (isset($_POST["login_un"]) && isset($_POST["login_pw"])) { //正常登录
	//echo "<script>alert('OK!');</script>";

	$username = check_input($_POST["login_un"]);
	$password = check_input($_POST["login_pw"]);
	if (!strcmp($username, "")) {
		$errfound = true;
	} else {
		$con = mysql_connect("localhost:3306", "root", "admin");
		if (!$con) {
			die("Could not connect to db: " . mysql_error());
		}
		mysql_select_db("picfly", $con);
		$sqlstr = "select password from picfly_registration_information where 
		username = '" . $username . "'"; 
		$result = mysql_query($sqlstr);
		$row = mysql_fetch_array($result);
		
		if (!$row) { //用户名不存在
			//$errfound = true;
			echo "<h1>噗，登录失败……</h1>"; 
			echo "<h3>啊哦，我们找不到您的用户名了，您是不是没有注册呢？</h3>";
			echo "<h3>点击这里<a href='../registration/register.php'><button style='width:100px; height:25px'>注册</button></a></h3>";
			echo "<h3>或戳我<a href='login.php'><button style='width:100px; height:25px'>重新登录</button></a></h3>";
		} else if (strcmp($password, $row["password"])) { //密码错误
			//$errfound = true;
			echo "<h1>噗，登录失败……</h1>"; 
			echo "<h3>您的密码好像输错了呢，回忆一下？</h3>";
			echo "<h3>戳我<a href='login.php'><button style='width:100px; height:25px'>重新登录</button></a></h3>";
		} else {
			//创建已登录cookie
			session_register("username");
			$_SESSION["username"] = $username;
			$_SESSION["start_time"] = time(); //session开始的时间
			//跳转
			echo "<script>location.href='log_success.php'</script>";
			//header("Location:log_success.php");
		}
		
		mysql_close($con);
	}
} else { //如果没登录直接访问了这个页面
	echo "<script>alert('您还没登录！');</script>";
	echo "<script>location.href='login.php'</script>";
}
?>
</div>
</body>
</html>