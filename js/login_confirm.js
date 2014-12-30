function check_login() {
	if (!check_login_un(document.form_login.login_un.value)) {
		return false;
	}
	
	if (!check_login_pw(document.form_login.login_pw.value)) {
		return false;
	}
}

function check_login_un(str_un) {
	if (str_un == "") {
		alert("咦，您是谁？您好像没有填用户名哦~");
		return false;
	} else {
		return true;
	}
}

function check_login_pw(str_pw) {
	if (str_pw == "") {
		alert("别忘记输入密码，没有密码不能登录哦");
		return false;
	} else {
		return true;
	}
}