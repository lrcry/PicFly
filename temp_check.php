<!-- Validation at server side, deprecated in this project -->
<?php 
echo "<script>location.href='reg_success.php';</script>";
?>
<!--<?php 
$FIND_ERROR = false; //标记
$username = clean_input($_POST["username"]);

/*if (不超过16个字符或数字) {
	查询数据库看用户名是否重复
 * 	if (重复) {
 * 		清空username，echo 重新输入
 * } 
} else if (为空) {
	echo 用户名空
}*/

/*数据库判断在后台*/
if (!strcmp($username, "")) { //用户名为空
	echo "<td><p style='color: red'>给自己起个名字吧，可爱点的^_^</p></td>";
	$FIND_ERROR = true;
} else if (!isset($username{4}) && isset($username{0})) {
	echo "<td><p style='color: red'>这个名字有点短，起个长点的刷刷存在感~</p></td>";
	$FIND_ERROR = true;
} else { //否则进入数据库判断
	//SQL
	//if 有重名
	//	echo "啊哦，有人比您先用了这个名字哪……"
	//else
	//	echo $username . " 用户名可用";
	//	将用户名保留 $final_username = $username;
	//
	$final_username = $username;
	echo "<td></td>";
}
?>

<?php 
$nickname = check_input($_POST["nickname"]);
//echo $nickname;
if (!strcmp($nickname, "") || !strcmp($nickname, "''")) { //昵称为空
	echo "<td><p style='color: red'>给自己起个可爱点的昵称吧#^_^</p></td>";
	$FIND_ERROR = true;
} else {
	$final_nickname = $nickname;
}
	//else if (!isset($username{5}) && isset($username{0})) {
	//echo "<p style='color: red'>啊哦，用户名太短了，这样不行哦。</p>";
	//$FIND_ERROR = false;
//} 
//否则不管，爱叫啥叫啥
	echo "<td></td>";
?>

<?php 
$gender = $_POST["gender"]; //M = 0; F = 1 获得性别
if ($gender != "M" && $gender != "F") { //不相信用户的任何输入^_^
//echo "出错啦~~"; //如果输入了别的直接屏蔽掉
$FIND_ERROR = true;
} else {
$final_gender = $gender;
echo "<td></td>";
}
?>

<?php 
$pw = clean_pw($_POST["password"]);
//$pw = $_POST["password"];
//echo $pw;
if (!strcmp($pw, "")) { //密码为空
	echo "<td><p style='color: red'>和别人一样，登录是需要密码的。。</p></td>";
	//echo $pw;
	$FIND_ERROR = true;
} else if (!isset($pw{5}) && isset($pw{0})) { //密码小于6位
	echo "<td><p style='color: red'>密码太短了，不安全哦</p></td>";
	$FIND_ERROR = true;
} else {
	$final_pw = $pw;
	echo "<td></td>";
}
?>

<?php 
$pw_confirm = clean_pw($_POST["pw_confirm"]);
//$pw_confirm = $_POST["pw_confirm"];	
if (!strcmp($pw_confirm, "")) {//确认密码为空
	echo "<td><p style='color: red'>确认一下您的密码，加深一下印象吧</p></td>";
	$FIND_ERROR = true;
} else if (strcmp($pw, $pw_confirm)) {
	echo "<td><p style='color: red'>啊哦，您好像记错了，两次不一样哦</p></td>";
	$FIND_ERROR = true;
} else {
	echo "<td></td>";
	$final_pw = $pw_confirm;
}
?>

<?php 
$email = $_POST["email"];
if (!strcmp($email, "")) {
	echo "<td><p style='color: red'>请填一个邮箱吧，方便您找回密码</p></td>";
	$FIND_ERROR = true;
} else {
	$final_email = $email;
	echo "<td></td>";
}

//echo $FIND_ERROR;

if (!$FIND_ERROR) {
	
	//存入数据库
	//跳转 注册成功页面，注册成功，现在登录
	//点击 登录， 跳转到login.php
	echo "<script>location.href='reg_success.php';</script>";
	exit;
}
?>

<?php 
//echo "Registration Information: " . "<br />";
//echo "User name: " . $final_username . "<br />";
//echo "Nickname: " . $final_nickname . "<br />";
//echo "Password: " . $final_pw . "<br />";
//echo "Email" 

?> -->

<!-- login -->
<?php 
session_start();
$_SESSION["logingin"] = 1;

/*验证登陆*/
$un_login = clean_input($_POST["login_un"]);
$pw_login = clean_pw($_POST["login_pw"]);

if ($_SESSION["logingin"]) {
	if (!strcmp($un_login, "")) { //用户名为空
		echo "<script>alert('啊哦，用户名是空的，你是谁呢~');</script>";
	} else if (!strcmp($pw_login, "")) { //密码为空
		echo "<script>alert('您是不是忘了输入密码？');</script>";
	} else {
		//使用username查询数据库，看用户是否存在
		//	不存在 则 echo "<script>alert('真不巧，这个用户还没有注册耶……');</script>";
		//	存在 则查询该用户密码
		//		密码错误 则 echo "<script>alert('啊哦，密码不对耶，别着急，再想想？');</script>";
		//		密码正确 则 跳转到log_success.php
		echo "<script>location.href='log_success.php';</script>";
	}
}
?>