<?php $this->layout->setLayoutData('content_for_layout_title','School Add');?>

<?php if(@$errormsg):?>
 <div class="notice_4" id="errormsg">
	<span class="notice_icon"></span> 
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php echo base_url('images/cross_grey_small.png');?>" />
	</a>
	<p><?php echo $errormsg; ?></p>
</div>
<?php endif;?>
<form method="post" action="" name="adduserform" id="adduserform" enctype="multipart/form-data">
   <!--
	<p class="ft_title">Username</p>
    <p class="setft"><input type="text" name="username" id="username" value="<?php echo @$user['username'];?>"  class="adm_box1" /></p>
	-->
	<p class="ft_title">Email</p>
    <p class="setft"><input type="text" name="email" id="email" value="<?php echo @$user['email'];?>"  class="adm_box1" /></p>
	<p class="ft_title">Password</p>
    <p class="setft"><input type="password" name="password" id="password" value=""  class="adm_box1" /></p>
	<p class="ft_title">Confirm password</p>
    <p class="setft"><input type="password" name="cppassword" id="cppassword" value=""  class="adm_box1" /></p>
    
	<p class="ft_title">Unique code</p>
    <p class="setft"><input type="text" name="UniqueId" id="UniqueId" onblur="chkschoolcode();" value=""  class="adm_box1" /></p>
	
	<p class="ft_title">School name</p>
    <p class="setft"><input type="text" name="username" id="username" value=""  class="adm_box1" /></p>
    
	<div id="showInfo" style="color:red">
		</div>
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">
function checkform(){

     if( $('#email').val()==""){
		alert('Email can not be empty');
		return;
	}

	if( $('#password').val() !=  $('#cppassword').val()){
		alert('Confirm password is not the same to password');
		return;
	}
	if( $('#password').val().length < 5){
		alert('password can not be less than 5 character');
		return;
	}
	
	if( $('#UniqueId').val()==""){
		alert('UniqueId can not be empty');
		return;
	}
	if( $('#username').val()==""){
		alert('School name can not be empty');
		return;
	}
	$('#adduserform').submit();
}

function chkschoolcode()
{
var code = $('#UniqueId').val();

	$.getJSON('<?php echo Base_url("user/checkSchoolcode");?>',{id:'code',value:code},function(msg){
			alert(msg);return false;
			if(msg.success)
			{
						hideInfo("schoolcode");
						return true;
			}
			else 
			{
					//document.getElementById("UniqueId").value='';
					//showInfo('schoolcode','School code already taken.');
					//$('#showInfo').html('School code already taken.');
					alert('School code already taken.');
		 
					document.getElementById("UniqueId").value='';
					return false;
			}
		});

	return false;
}

setTimeout('showmenu("manageschool",1)',1000);
</script>
</body>
</html>