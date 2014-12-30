<?php
/*
 * 修改资料：
 * 1. 输入并验证原密码；
 * 2. 验证通过：修改信息；
 * 3. 点击 保存，如果昵称为空，页面提示 昵称为空，
 * 4. 如果昵称不为空，密码为空，则开始写数据库
 * 5. 先判断 新资料与原资料某项相同，就不修改，否则修改
 * 6. 如果密码是空的，视为没有修改
 */
session_start();
include "../access_db_for_sth.php";
include "../login/login_state_judge.php";
$current_time = time();
$timeout = 15 * 60;
if (!judge_login_state("username", $timeout, $current_time, "start_time")) {
	//echo "<script>top.location.href='login/login.php';</script>";
	exit;
} 

$row = fetch_from_db("password", "username", $_SESSION["username"]);
echo "<h3>请先输入原密码：</h3>";
echo "<form action=''>";
	echo "<input type='password' id='pw_id' />";
	echo "";
echo "</form>";
?>