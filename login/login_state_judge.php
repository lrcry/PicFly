<?php
/**
 * 
 * To judge whether the user is under a legal login state
 * @param $ses_name "username"
 * @param $timeout Timeout of online
 * @param $current Now
 * @param $start The time the user logined
 */
function judge_login_state($ses_name, $timeout, $current, $start) {
		if (!isset($_SESSION[$ses_name]) || !isset($_SESSION[$start])) { //Not login yet
		echo "<script>alert('啊哦，您还没登录！');</script>";
		echo "<script>top.location.href='http://localhost/PicFly/login/login.php'</script>";
		return false;
	} else if (($current - $_SESSION[$start]) > $timeout) { //Timeout 15min
		echo "<script>alert('您已经登录了15分钟以上，为了安全请您重新登录！');</script>";
		unset($_SESSION[$ses_name]);
		echo "<script>top.location.href='http://localhost/PicFly/login/login.php'</script>";
		return false;
	} else {
		return true;
	}
}
?>