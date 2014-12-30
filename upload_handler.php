<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>分享成功</title>
</head>

<body>
<?php include "func_clean.php";?>
<?php 
session_start();
/* 图片文件格式 */
$uptypes = array(  
    'image/jpg',  
    'image/jpeg',  
    'image/png',  
    'image/pjpeg',  
    'image/gif',  
    'image/bmp',  
    'image/x-png'  
);  

if (isset($_SESSION["username"]) && isset($_POST)) {
	$dest_dir = "./upload_images/" . $_SESSION["username"];

	if ((in_array($_FILES["pic"]["type"], $uptypes)) //格式正确
		&& ($_FILES["pic"]["size"] <= 2 * 1024 * 1024)) { //小于2M
		if (($_FILES["pic"]["error"] > 0) && ($_FILES["pic"]["error"] != 4)) {
			echo "Server error code: " . $_FILES["file"]["error"] . "<br />";
			echo "<div>啊哦，网站崩溃了耶，真的不好意思，麻烦您通知我们好嘛？-_-</div>";
		} else {
			/*
			 * 1. 将图片保存至指定目录
			 * 2. 将图片信息：路径，图片标题（重命名），图片描述，图片作者，上传日期保存至数据库picture表
			 * 3. */
			//echo $dest_dir;
			if (!file_exists($dest_dir)) {
				mkdir($dest_dir);
			}
			
			$username = $_SESSION["username"]; //pic_owner
			$get_date = getdate(); 
			$upload_date = $get_date["year"] . "-" . $get_date["mon"] . "-" . $get_date["mday"] 
			. " " . $get_date["hours"] . ":" . $get_date["minutes"] . ":" . $get_date["seconds"];; //upload_time
			$filename = $_FILES["pic"]["tmp_name"]; //临时文件名
			$size = $_FILES["pic"]["size"]; //图片大小
			$pinfo = pathinfo($_FILES["pic"]["name"]);
			$filetype = $pinfo["extension"];
			$dest = $dest_dir . "/" . time() . "." . $filetype; //图片位置
			$title_redefined = check_input($_POST["name"]);
			$description = check_input($_POST["description"]);
			
			if ((strlen($title_redefined) > 32) || (strlen($description) > 160)) {
				echo "Too long title or description!";
				exit;
			}
			
			if (!move_uploaded_file($filename, $dest)) {
				echo "Move file error!";
				exit;
			} //Upload succeeded
			
			/* Write DB */
			$ins_sql = "insert into picfly_pic_information (pic_name, pic_owner, pic_upload_date, 
			pic_size, pic_location, pic_description) values
			('" . $title_redefined . "', '" . $username . "', now() , " . $size . 
			", '" . $dest . "', '" . $description . "')";
			//echo $ins_sql;
			
			$con = mysql_connect("localhost:3306", "root", "admin");
			if (!$con) {
				echo "Sth wrong with dbconnection!";
				exit;
			}
			mysql_select_db("picfly", $con);
			if (!mysql_query($ins_sql)) {
				echo "Sth wrong with dbwriting!";
				mysql_close($con);
				exit;
			} else {
				//mysql_close($con);
			/*
			echo $get_date["year"] . "-" . $get_date["mon"] . "-" . $get_date["mday"] 
			. " " . $get_date["hours"] . ":" . $get_date["minutes"] . ":" . $get_date["seconds"];
			
			echo $username . "<br />";
			echo $upload_date . "<br />";
			echo $filename . "<br />";
			echo $size . "<br />";
			echo $dest . "<br />";
			echo $title_redefined . "<br />";
			echo $description . "<br />";
			*/
			
				echo "<div align='center' style='margin-top: 80px;  width:240px; overflow: hidden; margin-left:auto; margin-right: auto'>
				<div style='float: left; display: inline-block; width: 40px'><img src='images/tick.jpg' /></div>
				<div style='float: left; display: inline-block; width: 200px; font-size: 40px; color: #8B6508; text-align: center'><b>分享成功！</b></div>
				<div style='margin-top: 80px'><a href=''>点击查看</a></div>
				</div>";
				
				/*
				 * 数据库中是乱码，但是浏览器解析出的不是乱码，[问题不大]
				 * $result = mysql_query("select * from picfly_pic_information where picid = 3");
				$row = mysql_fetch_array($result);
				echo $row["pic_description"];
				mysql_close($con);
				 */
			}
		}
	} else {
		echo //上传出错
		"<div align='center' style='margin-top: 80px; width:240px; overflow:hidden;
			margin-left:auto; margin-right: auto'>
			<div style='float:left; display: inline-block; width:40px'><img src='images/cross.jpeg' /></div>
			<div style='float: left; display: inline-block; width: 200px; font-size: 40px; color: #ff0000'><b>上传失败！</b></div>
		</div>";
		if ($_FILES["pic"]["size"] > 2 * 1024 * 1024) {//如果大于2M
			echo "<div align='center' style='color: #8A8A8A; margin-top: 40px'>抱歉打搅您的好心情，您的风景太大了，我们容纳不下，请您压缩一下，重新上传。^_^</div>";
		} else if ($_FILES["pic"]["error"] == 4) {//如果什么都没有上传
			echo "<div align='center' style='color: #8A8A8A; margin-top: 40px'>抱歉打搅您的好心情，您好像什么都没有上传哦，请您重新上传。^_^</div>";
		} else {//文件格式不对
			echo "<div align='center' style='color: #8A8A8A; margin-top: 40px'>抱歉打搅您的好心情，您上传的好像不是图片哦，请您重新上传。^_^</div>";
		}
		
		echo "<div align='center' style='margin-top: 40px'><a href='pic_upload.php'><button style='width: 100px; height: 30px;'>点击返回</button></a></div>";
	}
} else {
	echo "Something wrong! Session or Post!"; //Do not forget to hide this!
}

?> 

<div>
	更多照片[滚动显示]
</div>

</body>
</html>