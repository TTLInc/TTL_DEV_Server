<?php $this->layout->appendFile('css',"css/contact.css");?>
<script>
function changePassword(){
	var _password = $('#password').val();
	if(_password == ''){
		alert('The password can`t be empty.');
		return false;
	}
	/*if(_password.length <6 || if(_password > 15)){
		alert('The password can`t be more than 15 charactor or less than 6.');
		return false;
	}*/
	var _cpassword = $('#cpassword').val();
	if(_password != _cpassword){
		alert('The confirm password is not the same to password.');
		return false;
	}
	return true;
}
</script>
<div class="contact_us">
	<div class="contact_us_top">Change Password</div>
	<div class="contact_us_mid">
		<p >Enter new password and then re-login.</p>
		<p style="color:Red"><?php if(isset($error)) echo $error;?></p>
		<?php if(isset($errorMsg)){ ?>
		<p style="color:green"><?php if(isset($error));echo $errorMsg;?></p>
		<?php } ?>
		<form method="post" action="">
		<p>
			<label style="width:160px;display: inline-block;">New Password:</label><input type="password" name="password" value="" id="password" />
		</p>
		<p>
			<label style="width:160px;display: inline-block;">Confirm Password:</label><input type="password" name="cpassword" value="" id="cpassword" />
			<?php if(isset($infoStatus)):?>
			<input id="email"  name="email" type="hidden" value="<?php echo $infoStatus['email'];?>" class="box_01" />
            <input id="username"  name="username" type="hidden" value="<?php echo $infoStatus['username'];?>" class="box_01" />
            <input id="fid"  name="fid" type="hidden" value="<?php echo $infoStatus['id'];?>" class="box_01" />
			<?php endif;?>
		</p>
		<p>
		<label style="width:160px;display: inline-block;"></label><input type="submit" value="Change" name="submit" />
        </p>
        <!--<p>Input your new password for change password.</p>-->
		</form>
		
	</div>
</div>
