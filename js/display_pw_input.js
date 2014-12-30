function pw_input () {
	/**/
	document.getElementById("modify_pw_title").innerText = "修改密码";
	origin_pw.innerHTML = "<p id='origin_pw'>原密码：<input type='password' id='origin_pw_input' /></p>"
	new_pw.innerHTML = "<p id='new_pw'>新密码：<input type='password' id='new_pw_input' /></p>";
	confirm_pw.innerHTML = "<p id='confirm_pw'>确认密码：<input type='password' id='confirm_pw_input' /></p>";
	//pw_submit.innerHTML = "<p id='pw_submit'><button width='100px' height='30px'>确认修改密码</button></p>";
	/* 插入JS 
	judge_pw_null.innerHTML = "<script src='../js/modify_judge_pw.js'></script>";*/
}