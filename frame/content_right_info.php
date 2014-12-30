<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<style>
td {
width: 250px;
height: 30px;
}
</style>
<body>
<h1 style="color: #36648B">我的个人资料</h1>
<?php
session_start();
include "../access_db_for_sth.php";
include "../login/login_state_judge.php";
$current_time = time();
$timeout = 15 * 60;
if (!judge_login_state("username", $timeout, $current_time, "start_time")) {
	//echo "<script>top.location.href='login/login.php';</script>";
	exit;
} 

$row = fetch_from_db("*", "username", $_SESSION["username"]);
echo "<table>";
	echo "<tr>";
		echo "<td>";
			echo "用户ID(User ID)：";
		echo "</td>";
		echo "<td>";
			echo $row["userid"];
		echo "</td>";
	echo "<tr>";
	
	echo "<tr>";
		echo "<td>";
			echo "用户名(User Name)：";
		echo "</td>";
		echo "<td>";
			echo $row["username"];
		echo "</td>";
	echo "<tr>";
	
	echo "<tr>";
		echo "<td>";
			echo "昵称(Nickname)：";
		echo "</td>";
		echo "<td>";
			echo $row["nickname"];
		echo "</td>";
	echo "<tr>";
	
	echo "<tr>";
		echo "<td>";
			echo "性别(Gender)：";
		echo "</td>";
		echo "<td>";
			if ($row["gender"] == 0) {
				echo "帅哥";
			} else {
				echo "美女";
			}
		echo "</td>";
	echo "<tr>";
	
	echo "<tr>";
		echo "<td>";
			echo "密码(Password)：";
		echo "</td>";
		echo "<td>";
			for ($i = 0; $i < strlen($row["password"]); $i++) {
				echo "*";
			}
		echo "</td>";
	echo "<tr>";
	
	echo "<tr>";
		echo "<td>";
			echo "电子邮箱(E-mail)：";
		echo "</td>";
		echo "<td>";
			echo $row["email"];
		echo "</td>";
	echo "<tr>";
echo "</table>";

/*echo "User ID: " . $row["userid"] . "<br />";
echo "User Name: " . $row["username"] . "<br />";
echo "Nickname: " . $row["nickname"] . "<br />";
echo "Gender: " . $row["gender"] . "<br />";
echo "Password: " . $row["password"] . "<br />";
echo "E-mail: " . $row["email"] . "<br />";
echo "Last login time: " . $row["last_login_time"] . "<br />";
echo "Last login IP: " . $row["last_login_ip"] . "<br />";*/
?>

</body>
</html>