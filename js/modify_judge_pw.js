function check_modify() {
	if (!judge_nickname) {
		return false;
	} else if (!judge_pw) {
		return false;
	} else {
		return true;
	}
}

function judge_nickname() {
	if (document.getElementById("nickname").value == "") {
		alert("改一个好看点的名字吧，别空着呀~^_^");
		return false;
	}
}

function judge_pw() {
	if (origin_pw_input.value == "") {
		alert("原密码不能为空！");
		return false;
	}
	
	if (new_pw_input.value == "") {
		alert("请填写您的新密码！");
		return false;
	}
	
	if (new_pw_input.value.length < 6) {
		alert("请填写一个足够长的密码以保证您帐号的安全！最小长度为6位");
		return false;
	}
	
	if (new_pw_input.value != confirm_pw_input.value) {
		alert("两次输入的密码不一致！");
		return false;
	}
}