/* Auto jump */
function countdown(secs,jump_to) {
jump_sec.innerText=secs;//<span>中显示的内容值
	//alert(jump_to);
	if (--secs>0) {
		setTimeout("countdown(" + secs + ",'" + jump_to + "')", 1000);//设定超时时间
	} else {
		location.href = jump_to;//跳转页面
	} 
}
