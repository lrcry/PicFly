<?php
/* 防止SQL注入攻击1 */
function check_input($value)
{
// 去除斜杠
if (get_magic_quotes_gpc())
  {
  $value = stripslashes($value);
  }
// 如果不是数字则加引号
//if (!is_numeric($value))
  //{
  $value = mysql_real_escape_string($value);
  //}
return $value;
}

/* 过滤用户名的输入 */
function clean_input($input) {
	$clean = mysql_real_escape_string($input); //对输入的恶意SQL进行转义
	//$clean = strtolower($clean); //转换为小写
	//$clean = preg_replace("/[^a-z]/", "", $clean); //只允许字母
	$clean = substr($clean, 0, 15); //只允许1-16位的输入，多余的被抛弃
						//(已经有了maxlength这一步会不会多余？)
	return $clean;
}

/* 过滤密码 */
function clean_pw($pw) {
	$clean = mysql_real_escape_string($pw); //对输入的恶意SQL进行转义
	$clean = substr($clean, 0, 31); //只允许1-32位的输入，多余的被抛弃
	return $clean;
}
?>