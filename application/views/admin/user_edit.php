<?php $this->layout->setLayoutData('content_for_layout_title','User edit');
?>
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
<form method="post" action="" name="edituserform" id="edituserform" enctype="multipart/form-data">
    <!--<p class="ft_title">Username</p>
    <p class="setft"><input type="text" name="username" id="username" value="<?php echo $user['username'];?>"  class="adm_box1" disabled="disabled"/></p>
	-->
	
	<p class="ft_title">Email</p>
    <p class="setft"><input type="text" name="email" id="email" value="<?php echo $user['email'];?>"  class="adm_box1" disabled="disabled" /></p>
	<p class="ft_title">Role</p>
    <p class="setft">
		<?php echo form_dropdown('roleId',$types,$userroledata,' id="roleId" class="textarea_box"');?>
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

	<p class="ft_title">Test Account
		<input type="checkbox" name="testAccount" id="testAccount" value="1" <?php if($user['testAccount']=='1'){echo 'checked';} ?> />
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
    
	<?php
	if($user['roleId'] != 4 && $user['roleId'] != 5){
	?>
	<p class="ft_title">Age</p>
    <p class="setft"><input type="text" name="age" id="age" value="<?php echo $user['age'];?>"  class="adm_box1" disabled/></p>
    <?php } ?>
	
	<p class="ft_title">Cell phone</p>
    <p class="setft"><input type="text" name="cell" id="cell" value="<?php echo $user['cell'];?>"  class="adm_box1" disabled/></p>
    
	<?php
	if($user['roleId'] != 4 && $user['roleId'] != 5){
	?>
	<p class="ft_title">Course Rate</p>
    <p class="setft"><input type="text" name="hRate" id="hRate" value="<?php echo $user['hRate'];?>"  class="adm_box1" disabled/></p>
    <?php } ?>

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
	<p class="setft"><input type="text" name="money" id="money" value="<?php echo ($user['money']>0) ? $user['money'] : "0.00";?>"  class="adm_box1" <?php echo $disabled;?>/></p>
	<!--<p class="ft_title">Current Balance</p>
    <?php
	if($isAccount == FALSE) { $disabled = ' disabled'; }
	else { $disabled = ''; }
	?>
	<p class="setft"><input type="text" name="cur_bal" id="cur_bal" value="<?php echo ($user['money']>0) ? $user['money'] : "0.00";?>"  class="adm_box1" <?php echo $disabled;?>/></p>-->
	<p class="ft_title">Purchased Balance</p>
    <?php
	if($isAccount == FALSE) { $disabled = ' disabled'; }
	else { $disabled = ''; }
	?>
	<p class="setft"><input type="text" name="purchased_credits" id="purchased_credits" value="<?php echo ($user['purchased_credits']>0) ? $user['purchased_credits'] : "0.00";?>"  class="adm_box1" <?php echo $disabled;?>/></p>
	<p class="ft_title">Earned Balance</p>
    <?php
	if($isAccount == FALSE) { $disabled = ' disabled'; }
	else { $disabled = ''; }
	?>
	<p class="setft"><input type="text" name="earned_credits" id="earned_credits" value="<?php echo ($user['earned_credits']>0) ? $user['earned_credits'] : "0.00";?>"  class="adm_box1" <?php echo $disabled;?>/></p>
	<p class="ft_title">Coupon Balance</p>
    <?php
	if($isAccount == FALSE) { $disabled = ' disabled'; }
	else { $disabled = ''; }
	?>
	<p class="setft"><input type="text" name="earned_credits" id="earned_credits" value="<?php echo ($user['coupon_credits']>0) ? $user['earned_credits'] : "0.00";?>"  class="adm_box1" <?php echo $disabled;?>/></p>
	<!---- by viplove 24-2-14 edit free expiry session ----> 
	<?php 
	if($user['roleId'] < 4){
	if($isAccount == TRUE) { ?>
    <p class="ft_title">Free Session Expiry Date </p>
    <p class="setft"><input type="text" name="exp_session" id="exp_session" value="<?php echo date("Y-m-d", strtotime($user['exp_session'])); ?>"  class="adm_box1"/></p>
	
	<p class="ft_title">Free Session Eligible</p>
		<p><input type="checkbox" name="is_eligible" id="is_eligible" value="1" <?php if($user['is_eligible']=='1'){echo 'checked';} ?> />
	</p>

	
	<?php } 
	}
	?>	
	<!---- by viplove 24-2-14 edit free expiry session ----> 
	<?php 
	if($user['roleId'] == 3){
	if($isAccount == TRUE) { ?>
    <p class="ft_title">PEXP Date</p>
    <p class="setft"><input type="text" name="expDate" id="expDate" value="<?php echo date("Y-m-d", strtotime($expDate)); ?>"  class="adm_box1"/></p>
	
		
	<?php } 
	}
	?>	
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a>  <a href="javascript:void(0)"  style="margin-left:40px;" onclick="cancelInfo();" class="button">Cancel</a></p>
	
</form>


<script type="text/javascript">
function cancelInfo(){
	 window.location.href="<?php echo base_url('admin/user');?>";
	}
function checkform(){
	$('#edituserform').submit();
}
$("#expDate,#exp_session").datepicker({ dateFormat: 'yy-mm-dd' } );
setTimeout('showmenu("usermenu",0)',1000);
</script>
</body>
</html>