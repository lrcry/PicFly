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
#maindiv {
width: 100%;
overflow: hidden;
}
#leftdiv, #rightdiv {
float: left;
display: inline=block;
}
#leftdiv {
width: 60%;
}
#rightdiv {
width: 40%;
}
</style>
<script src="../js/display_pw_input.js"></script>
<!--  <script src="../js/modify_judge_pw.js"></script>-->
<script>
/*document.onclick = function() {
	var btn = event.srcElement;
	if (btn.name == "btn_pw") {
		alert("修改密码！");
	}
};*/
</script>
<body>
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
?>
<!-- 在修改个人资料的时候需要输入原密码 -->
<h1 style="color: #36648B">修改个人资料</h1>
<form>
	<table>
		<tr>
			<td>用户ID(User ID)：</td>
			<td><?php echo $row["userid"];?></td>
		</tr>
		<tr>
			<td>用户名(User Name)：</td>
			<td><?php echo $row["username"];?></td>
		</tr>
		<tr>
			<td>昵称(Nickname)：</td>
			<td><?php echo "<input id='nickname' name='nickname' type='text' value='" . $row["nickname"] . "' />";?></td>
		</tr>
		<tr>
			<td>性别(Gender)：</td>
			<td>
			<?php 
			echo "<input id='gender0' name='gender' type='radio' value='0' />帅哥";
			echo "<input id='gender1' name='gender' type='radio' value='1' />美女";
			echo "<script>document.getElementById('gender" . $row["gender"] . "').setAttribute('checked', 'checked')</script>";
			?>
			</td>
		</tr>
		<tr>
			<td>新密码(New Password)：</td>
			<td><input id="pw" type="password" /></td>
		</tr>
		<tr>
			<td>电子邮箱(E-mail)：</td>
			<td><?php echo $row["email"];?></td>
		</tr>
	</table>
	<h4 style='color: blue'>强烈建议您不要修改邮箱，邮箱是您找回密码的唯一途径</h4>
	<h4 style='color: blue'>如果您实在需要修改邮箱请联系网站管理员superadmin</h4>
	<p style='margin-left: 15%'>
	<button name='modify_submit' type='submit' style='width:100px;height:40px;'>保存！</button> 
	<button style='width:60px;height:25px;'>取消</button>
	</p>
</form>

<?php
/* 修改 
//echo "<form action=''";
echo "<div id='maindiv'>";
//echo "<form>";
	echo "<div id='leftdiv'>"; //修改其他资料
		echo "<table>";
			echo "<tr>";
				echo "<td>";
					echo "用户ID(User ID)：";//不能修改
				echo "</td>";
				echo "<td>";
					echo $row["userid"];
				echo "</td>";
			echo "<tr>";
			
			echo "<tr>";
				echo "<td>";
					echo "用户名(User Name)：";//不能修改
				echo "</td>";
				echo "<td>";
					echo $row["username"];
				echo "</td>";
			echo "<tr>";
			
			echo "<tr>";
				echo "<td>";
					echo "昵称(Nickname)：";//可以修改
				echo "</td>";
				echo "<td>";
					echo "<input id='nickname' name='nickname' type='text' value='" . $row["nickname"] . "' />";
				echo "</td>";
			echo "<tr>";
			
			echo "<tr>";
				echo "<td>";
					echo "性别(Gender)：";
				echo "</td>";
				echo "<td>";
					echo "<input id='gender0' name='gender' type='radio' value='0' />帅哥";
					echo "<input id='gender1' name='gender' type='radio' value='1' />美女";
					echo "<script>document.getElementById('gender" . $row["gender"] . "').setAttribute('checked', 'checked')</script>";
				echo "</td>";
			echo "<tr>";
			
			echo "<tr>";
				echo "<td>";
					echo "密码(Password)：";
				echo "</td>";
				echo "<td>";
					echo "<button name='btn_pw' style='width: 150px; height:25px;' onclick=pw_input()>点我！修改密码</button>";
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
		//echo "<div>";
		echo "<h4 style='color: blue'>强烈建议您不要修改邮箱，邮箱是您找回密码的唯一途径</h4>";
		echo "<h4 style='color: blue'>如果您实在需要修改邮箱请联系网站管理员superadmin</h4>";
		echo "<p style='margin-left: 15%'><button name='modify_submit' type='submit' style='width:100px;height:40px;'>保存！</button> <button style='width:60px;height:25px;'>取消</button></p>";
		//echo "</div>";
	echo "</div>";
	echo "<div id='rightdiv'>"; //修改密码
		echo "<h2 id='modify_pw_title' style='color: #36648B'></h2>";
		echo "<p id='origin_pw'></p>";
		echo "<p id='new_pw'></p>";
		echo "<p id='confirm_pw'></p>";
		//echo "<p id='pw_submit'></p>";
	echo "</div>";
//echo "</form>";
echo "<div>";
*/
?>
</body>
</html>