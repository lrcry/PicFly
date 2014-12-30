<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style>
.top {
	width: 100%;
	overflow: hidden;
}
.preview_pic, .info {
	float: left;
	display: inline-block;
}
.preview_pic {
	width: 56%;
	height: 400px;
}
.info {
	width: 44%;
	height: 400px;
}

.submit {
	width: 150px;
	height: 50px;
}
</style>
<script src="js/preview_pic.js"></script>
</head>
<body>
<?php 
session_start();
include "login/login_state_judge.php";
$current_time = time();
$timeout = 15 * 60;
if (!judge_login_state("username", $timeout, $current_time, $_SESSION["start_time"])) {
	//echo "<script>top.location.href='login/login.php';</script>";
	exit;
} else {
	;
}
?>
<h1 style="color: #36648B">上传新照片</h1>
<div class="top">
	<!-- Preview -->
	<div class="preview_pic">
		<div id="localImag"><span style="color: #36648B">在这里预览您的照片</span><img id="preview" width=-1 height=-1 style="diplay:none" /></div>
	</div>
	
	<!-- Infomation -->
	<div class="info">
		<form action="upload_handler.php" method="post" 
			enctype="multipart/form-data">
			<table>
				<tr>
					<td>
						<label for="file">图片位置：</label>
					</td>
					<td>
						<input type="file" name="pic" id="pic" onchange="javascript:setImagePreview();" />
					</td>
				</tr>
				<tr>
					<td>
						标题：(不超过32字)
					</td>
					<td>
						<input type="text" name="name" id="name" maxlength="32"  />
					</td>
				</tr>
			</table>
			<table>
				<tr>
					<td>
						图片描述：(不超过160字)
					</td>
				</tr>
				<tr>
					<td>
						<textarea type="text" name="description" rows="4" cols="40" maxlength="160" style="resize: none"></textarea>
					</td>
				</tr>
				<tr>
					<td>
						<input class="submit" type="submit" value="分享心情" />
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
</body>
</html>