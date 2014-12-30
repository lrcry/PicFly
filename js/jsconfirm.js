/*
 * jsconfirm.js 用于验证输入的合法性（浏览器端），服务端验证是phpconfirm.php
 * 验证输入是否为空，格式是否正确
 */
function submit_confirm() {
	if (!check_username(document.reg_form.username.value)) {
		return false;
	}
	
	if (!check_nickname(document.reg_form.nickname.value)) {
		return false;
	}
	
	if (!check_pw(document.reg_form.password.value, 
			document.reg_form.pw_confirm.value)) {
		return false;
	}
	
	if (!check_email(document.reg_form.email.value)) {
		return false;
	}
}

function check_username(str_username) {
	var un_pattern = /^[a-zA-Z][a-zA-Z0-9_]*$/;
	if (str_username == "") { //用户名为空
		alert("啊哦，用户名不能为空哦，给自己起个名字吧，可爱点的^_^");
		return false;
	} else if (str_username.length < 5) { //用户名小于5个字母
		alert("这个用户名有点短，起个长点的刷刷存在感~");
		return false;
	} else if (!un_pattern.test(str_username)) { //用户名格式不对
		alert("啊哦，用户名的格式不对，只能是5-16个字母、数字与下划线的组合哦");
		return false;
	} else {
		return true;
	}
}

function check_nickname(str_nickname) {
	if (str_nickname == "") { //昵称为空
		alert("昵称不能为空，给自己起个可爱点的昵称吧#^_^");
		return false;
	} else {
		return true;
	}
}

function check_pw(str_pw, str_pw_confirm) {
	if (str_pw == "") { //密码为空
		alert("请输入一个密码，用于保护您的帐号");
		return false;
	} else if (str_pw.length < 6) { //密码长度小于6
		alert("密码太短了，不安全哦，请重设");
		return false;
	} else if (str_pw_confirm != str_pw) { //两次输入密码不一致
		alert("啊哦，您好像记错了，两次输入的密码不一样哦");
		return false;
	} else {
		return true;
	}
}
 
function check_email(str_email) {
	var e_pattern = /^[a-zA-Z0-9_.]+@([a-zA-Z0-9_]+.)+[a-zA-Z]{2,3}$/;
	if (str_email == "") { //邮箱为空
		alert("请填一个邮箱吧，方便您找回密码");
		return false;
	} else if (!e_pattern.test(str_email)) { //邮箱格式不正确
		alert("啊哦，您的邮箱格式不正确，请重新填写一下^_^");
		return false;
	} else {
		return true;
	}
}