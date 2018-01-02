<?php $this->layout->setLayoutData('content_for_layout_title','User Add');?>

<?php if(@$errormsg or @$successmsg):?>
 <div class="<?php echo ($successmsg) ? "notice_3" :"notice_4";?>" id="errormsg">
	<?php $errormsg = $successmsg;?>
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
    
    <p class="ft_title">Chat</p>
	<p class="setft"><select name="chat" id="chat" >
    <option value="1">Yes</option>
    <option value="0">No</option></select></p>
    
	<p class="ft_title">Role</p>
    <p class="setft">
		<?php echo form_dropdown('roleId',$types,@$user['roleId'],' id="roleId" class="textarea_box"');?>
	</p>
    <p class="ft_title">Hide Account
		<input type="checkbox" name="hiddenRole" id="hiddenRole" value="1" <?php if(@$user['hiddenRole']=='1'){echo 'checked';} ?> />
	</p>
	<p class="ft_title">Quarantine Account
		<input type="checkbox" name="quarantine" id="quarantine" value="1" <?php if(@$user['quarantine']=='1'){echo 'checked';} ?> />
	</p>
    <p class="ft_title">Qualified</p>
    <p class="setft">
		<?php echo form_dropdown('lms_complete',$chat,@$user['lms_complete'],' id="lms_complete" class="textarea_box"');?>
	</p>
	<p class="ft_title">Dispute</p>
    <p class="setft">
		<?php echo form_dropdown('disputes',$chat,@$user['disputes'],' id="disputes" class="textarea_box"');?>
	</p>
	
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">
function checkform(){
	if( $('#password').val() !=  $('#cppassword').val()){
		alert('Confirm password is not the same to password');
		return;
	}
	if( $('#password').val().length < 5){
		alert('password can not be less than 5 character');
		return;
	}
	
	if( $('#password').val().length > 18){
		alert('password can not be more than 18 character');
		return;
	}
	$('#adduserform').submit();
}
setTimeout('showmenu("usermenu",1)',1000);
</script>
</body>
</html>