<?php
function fetch_from_db ($something, $where_condition_left, $where_condition_right) {
	$con = mysql_connect("localhost:3306", "root", "admin");
	if (!$con) {
		die ("DB error!");
	}
	
	mysql_select_db("picfly");
	$str_query = "select " . $something . " from picfly_registration_information where 
	" . $where_condition_left . "='" . $where_condition_right . "'";
	$result = mysql_query($str_query, $con);
	$row = mysql_fetch_array($result);
	mysql_close($con);
	return $row;
}
?>