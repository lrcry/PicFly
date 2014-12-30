<!----> <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style>
.top {
width: 101.5%;
overflow: hidden;
height: 100px;
background-color: #808000;
FILTER: progid:DXImageTransform.Microsoft.Gradient(gradientType=1,startColorStr=#b8c4cb,endColorStr=#f6f6f8);
background:-moz-linear-gradient(left,#b8c4cb,#f6f6f8);
background:-webkit-gradient(linear, 35% 50%, 100% 100%, from(#808000), to(#FCFCFC));
margin-top: -10px;
margin-left: -10px;
}
.left, .middle {
float: left;
display: inline-block;

}
.right {
float: right;
display: inline-block;

}
.left {
width: 350px;
border-right: 1px;
}
.middle {
width: 350px;
border-right: 1px;
text-align: middle;
}
.right {
width: 300px;
}
</style>
<!----> 
<script>
$(document).ready(function() {
	$(".menuitem").mouseenter(function() {
		$(this).css('background-color', '#ffffff');
	});
	$(".menuitem").mouseleave(function() {
		$(this).css('background-color', '#000000');
	});
});

</script>
</head>


<body>

<div class="top">

	<!-- Banner 350*100 Generated online HTML -->
	<div class="left">
		<embed height="100" width="350" flashvars="bannerWidth=350&bannerHeight=100&bannerSID=http://img2.tbcdn.cn/tfscom/T1dQyIFiXfXXXgzXjX.xml&bannerXML=&bannerLink=http%3A%2F%2F&dataSource=&bid=37577497&appSource=default" wmode="transparent" allowscriptaccess="always" quality="high" name="37577497" id="37577497" style="" src="http://img.uu1001.cn/bcv3.swf?v=20130904-175748" type="application/x-shockwave-flash"/></embed>
	</div>
	
	<!-- Menu -->
	<div class="middle">
		<table align="center" style="width: 300px; height: 50px">
			<tr>
				<td class="menuitem" style="width: 75px;"><a href="http://localhost/PicFly/index.php"> 网站首页</a></td>
				<td class="menuitem" style="width: 75px;"><a href="http://localhost/PicFly/myspace.php">我的PicFly</a></td>
				<td class="menuitem" style="width: 75px;"><a href="http://localhost/PicFly/look.php">随便看看</a></td>
				<td class="menuitem" style="width: 75px;"><a href="http://localhost/PicFly/about.php">关于本站</a></td>
			</tr>
		</table>
	</div>
	
	<!-- User Information -->
	<div class="right">
		<span id="userinfo" style="color:#551A8B">客官您好，走过路过不要错过哦，</span>
		<br />
		<span id="userinfo_1" style="color:#551A8B">进来看看吧^_^</span>
	</div>

</div>

<!--  <?php 
//if (!isset($_SESSION)) {
	//session_start();
//}
$current_time = time();
$timeout = 15 * 60;
/* 根据登录状态显示用户信息 */
if (!isset($_SESSION["username"])) {
	;
} else if (($current_time - $_SESSION["start_time"]) > $timeout) {
	;
} else {
	echo "<script>userinfo.innerText = '欢迎您，" . $_SESSION["nickname"] . "';</script>"; 
	echo "<script>userinfo_1.innerHTML = '<button width=\'100px\' height=\'25px\' onclick=\"window.location.href=\'login/logout.php\'\">注销登录</button>';</script>";
}
?>-->

<!---->  </body>
</html>