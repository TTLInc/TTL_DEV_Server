<?php $this->layout->setLayoutData('content_for_layout_title','School_User edit');
?>
<?php if(@$errormsg):?>
 <div class="notice_4" id="errormsg">
	<span class="notice_icon"></span> 
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php echo base_url('images/cross_grey_small.png');?>" />
	</a>
	<p><?php echo $errormsg; ?></p>
</div>
<?php endif;?>
<form method="post" action="" name="edituserform" id="edituserform" enctype="multipart/form-data">
    <!--<p class="ft_title">Username</p>
    <p class="setft"><input type="text" name="username" id="username" value="<?php echo $user['username'];?>"  class="adm_box1" disabled="disabled"/></p>
	-->
	
	<p class="ft_title">Email</p>
    <p class="setft"><input type="text" name="email" id="email" value="<?php echo $user['email'];?>"  class="adm_box1" disabled="disabled" /></p>
	<p class="ft_title">Role</p>
    <p class="setft">
		<?php echo form_dropdown('roleId',$types,$user['roleId'],' id="roleId" class="textarea_box"');?>
	</p>
    
    <p class="ft_title">Chat</p>
    <p class="setft">
		<?php echo form_dropdown('chat',$chat,$user['chat'],' id="chat" class="textarea_box"');?>
	</p>
	<?php
	if($user['roleId'] != 0){
	?>
    <p class="ft_title">Hide Account
		<input type="checkbox" name="hiddenRole" id="hiddenRole" value="1" <?php if($user['hiddenRole']=='1'){echo 'checked';} ?> />
	</p>
	
	<?php
	if($user['roleId'] != 4 && $user['roleId'] != 5){
	?>
	<p class="ft_title">Qualified</p>
	<p class="setft">
		<?php echo form_dropdown('lms_complete',$chat,$user['lms_complete'],' id="lms_complete" class="textarea_box"');?>
	</p>
	<?php }?>
	<p class="ft_title">Dispute</p>
	<p class="setft">
		<?php echo form_dropdown('disputes',$chat,$user['disputes'],' id="lms_complete" class="textarea_box"');?>
	</p>
	<?php
	}
	?>
	<p class="ft_title">Quarantine Account
		<input type="checkbox" name="quarantine" id="quarantine" value="1" <?php if($user['quarantine']=='1'){echo 'checked';} ?> />
	</p>
	
    <input type="hidden" name="id" value="<?php echo $user['uid'];?>">
	<?php if ($user['roleId'] == 4 || $user['roleId'] == 5){?>
			<?php if($user['roleId'] == 5){?>
					<p class="ft_title">Affiliate Name</p>
					<p class="setft"><input type="text" name="firstName" id="firstName" value="<?php echo $user['firstName']. $user['lastName'];?>"  class="adm_box1" disabled/></p>
			<?php }else {?>
				<p class="ft_title">School Name</p>
				<p class="setft"><input type="text" name="firstName" id="firstName" value="<?php echo $user['firstName']. $user['lastName'];?>"  class="adm_box1" disabled/></p>
	   <?php }?>
    
	  <p class="ft_title">Principal Name</p>
    <p class="setft"><input type="text" name="firstName" id="firstName" value="<?php echo $user['principle_name']?>"  class="adm_box1" disabled/></p>
	<?php } else{?>
    <p class="ft_title">First Name</p>
    <p class="setft"><input type="text" name="firstName" id="firstName" value="<?php echo $user['firstName'];?>"  class="adm_box1" disabled/></p>
    <p class="ft_title">Last Name</p>
    <p class="setft"><input type="text" name="lastName" id="lastName" value="<?php echo $user['lastName'];?>"  class="adm_box1" disabled/></p>
  <?php } ?>
    <p class="ft_title">Country</p>
	
    <p class="setft"><input type="text" name="country" id="country" value="<?php echo $user['countryName'];?>"  class="adm_box1" disabled/></p>
    <p class="ft_title">State</p>
    <p class="setft"><input type="text" name="province" id="province" value="<?php echo $user['stateName'];?>"  class="adm_box1" disabled/></p>
    <p class="ft_title">City</p>
    <p class="setft"><input type="text" name="city" id="city" value="<?php echo $user['city'];?>"  class="adm_box1" disabled/></p>
    
 
	
	<p class="ft_title">Cell phone</p>
    <p class="setft"><input type="text" name="cell" id="cell" value="<?php echo $user['cell'];?>"  class="adm_box1" disabled/></p>
    
	 
		<?php
	if($user['roleId'] == 4){
	?>
	<p class="ft_title">Tutor Markup</p>
    <p class="setft"><input type="text" name="hRate" id="hRate" value="<?php echo $user['tutor_markup']=number_format($user['tutor_markup'],2,'.','')  ;?>"  class="adm_box1" disabled/></p>
    <?php } ?>

	
	<p class="ft_title">Account Balance</p>
    <?php
	if($isAccount == FALSE) { $disabled = ' disabled'; }
	else { $disabled = ''; }
	?>
	<p class="setft"><input type="text" name="money" id="money" value="<?php echo $user['money'];?>"  class="adm_box1" <?php echo $disabled;?>/></p>
 
	<p class="ft_title">Private Balance  <input type="checkbox" <?php if($user['pbalance'] > 0){?> checked <?php }?>></p>
   
	<p class="setft"><input type="text"  <?php if($user['pbalance'] <= 0){?> style="display:none" <?php }?> name="pbalance" id="pbalance" value="<?php echo $user['pbalance'];?>"  class="adm_box1" /></p>
 
	 
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">
$("input[type=checkbox]").change(function(){
   if($(this).prop('checked')){
		$("#pbalance").show();
   }
   else
   {
	$("#pbalance").hide();
   }
});
function checkform(){
	$('#edituserform').submit();
}
$("#expDate,#exp_session").datepicker({ dateFormat: 'yy-mm-dd' } );
setTimeout('showmenu("SchoolUsers1",0)',1000);
</script>
</body>
</html>