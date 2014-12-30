<?php
/*
 * phpconfirm.php 
 * 在jsconfirm.js进行浏览器端验证后，用于验证输入合法性（服务器端），
 * 进行sanitation并再次验证，验证与数据库相关的内容（如查重），
 * 防止别人修改登录页面注入非法信息
 */

include "../func_clean.php";
$err_found = false;
$flag_un = false;
$flag_nn = false;
$flag_ge = false;
$flag_pw = false;
$flag_pc = false;
$flag_em = false;

$username_repeated = false;

/*数据库连接*/
$con = mysql_connect("localhost:3306", "root", "admin");
//echo "正在连接数据库" . "<br />";
if (!$con) {
	//echo "呵呵了。";
	die("Could not connect to db: " . mysql_error());
}

/*服务器验证用户名 有问题*/
$username = check_input($_POST["username"]);
if (!strcmp($username, "") || !strcmp($username, "''")) { //用户名为空
	$err_found = true;
	//$final_username = $username;
	//echo "username null;";
} else if (!isset($username{4}) && isset($username{0})) { //用户名过短
	$err_found = true;
	//$final_username = $username;
	//echo "username short;";
} else if (!ereg("^[a-zA-Z][a-zA-Z0-9_]*$", $username)
	|| !ereg("^[a-zA-Z][a-zA-Z0-9_]*$", $username)) { //用户名格式不正确
	$err_found = true;
	//$final_username = $username;
	//echo "username pattern not right;";
} else {
	//echo "用户名判断完毕，正在查询数据库" . "<br />";
	//if 有重名
	//	echo "啊哦，有人比您先用了这个名字哪……"
	//else
	//	echo $username . " 用户名可用";
	//	将用户名保留 $final_username = $username;
	//$err_found = false;
	
	//echo "正在选择数据库" . "<br />";
	mysql_select_db("picfly", $con);
	
	//echo "Querying" . "<br />";
	$select_name = "select username from picfly_registration_information where username='"
	. $username . "'";
	//echo $select_name . "<br />";
	$result = mysql_query($select_name);
	$row = mysql_fetch_array($result);
	//echo $row["username"];
	//echo $result["username"];
	//exit;
	/**/
	if ($row["username"] == $username) {
		$username_repeated = true;
		echo "<script>location.href='reg_failed_1.php';</script>"; //其实应该是跳转
		exit;
		//exit;
	} else {
		//echo "正在写入" . "<br />";
		$final_username = $username;
	}
	
	//echo "End";
}

//echo "flag in username: " . $err_found . "<br />";

/*服务器验证昵称 有问题*/
$nickname = check_input($_POST["nickname"]);
//echo $nickname;
if (!strcmp($nickname, "") || !strcmp($nickname, "''")) { //昵称为空
	$err_found = true;
	//$final_nickname = $nickname;
	//echo "nickname null;";
} else {
	$final_nickname = $nickname;
}

//echo "flag in nickname: " . $err_found . "<br />";

/*服务器验证性别*/
$gender = $_POST["gender"]; //M = 0; F = 1 获得性别
if ($gender != 0 && $gender != 1) { //不相信用户的任何输入^_^
										//如果输入了别的直接屏蔽掉
	$err_found = true;
	//$final_gender = $gender;
	//echo "gender not right;";
} else {
	$final_gender = $gender;
}

//echo "flag in gender: " . $err_found . "<br />";

/*服务器验证密码 有问题*/
$pw = check_input($_POST["password"]);
if (!strcmp($pw, "") || !strcmp($pw, "''")) { //密码为空
	$err_found = true;
	//$final_pw = $pw;
	//echo "pw null;";
} else if (!isset($pw{5}) && isset($pw{0})) { //密码小于6位
	$err_found = true;
	//$final_pw = $pw;
	//echo "pw short;";
} else {
	$final_pw = $pw;
}

//echo "flag in pw: " . $err_found . "<br />";

/*服务器验证确认密码 有问题*/
$pw_confirm = check_input($_POST["pw_confirm"]);
if (!strcmp($pw_confirm, "") || !strcmp($pw_confirm, "''")) {//确认密码为空
	$err_found = true;
	//$final_pw = $pw_confirm;
	//echo "pwconfirm null;";
} else if (strcmp($pw, $pw_confirm)) {//两次输入密码不一致
	$err_found = true;
	//$final_pw = $pw_confirm;
	//echo "pwconfirm not right;";
} else {
	$final_pw = $pw_confirm;
}

//echo "flag in pwconfirm: " . $err_found . "<br />";

/*服务器验证邮箱*/
$email = check_input($_POST["email"]);
$email_pattern = "^[a-zA-Z0-9_.]+@([a-zA-Z0-9_]+.)+[a-zA-Z]{2,3}$";
if (!strcmp($email, "") || !strcmp($email, "''")) { //邮箱为空
	$err_found = true;
	//$final_email = $email;
	//echo "email null;";
} else if (!ereg($email_pattern, $email)) { //邮箱格式不正确
	$$err_found = true;
	//$final_email = $email;
	//echo "email not right;";
} else {
	$final_email = $email;
}

//echo "flag in email: " . $err_found . "<br />";

if (!$err_found) {
//存入数据库
	//跳转 注册成功页面，注册成功，现在登录
	//点击 登录， 跳转到login.php
	$sql_insert = "insert into picfly_registration_information (username, nickname, gender, password, email) 
	values ('" . $final_username . "', '" . $final_nickname . "', " . $final_gender . ", '" . $final_pw . "', '" . $final_email . "')";
	mysql_query($sql_insert);
	mysql_close($con);
	echo "<script>location.href='reg_success.php';</script>";
	exit;
	/*echo $_POST["username"] . "<br />";*/
} else {
	echo "<script>location.href='reg_failed.php'; </script>";
	exit;
	/*echo "Error: your information is not accepted by server. 
	Please check if there were illegal inputs.";
	echo $final_username . "<br />";
	echo $final_nickname . "<br />"; // echoed
	echo $final_gender . "<br />"; // echoed
	echo $final_pw . "<br />"; // echoed
	echo $final_email . "<br />";*/
}
?>