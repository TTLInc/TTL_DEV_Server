function checkLogin(){
	var username = $("#username").val();
	var password =$("#password").val();
	
	if(username==''){
		alert('username can not empty!');
		$("#username").focus();
		return false;
	}else if(password==''){
		alert('password can not empty!');
		$("#password").focus();
		return false;
	}
	else{
		return true;
	}
	
}