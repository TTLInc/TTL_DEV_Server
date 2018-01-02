<?php $this->layout->setLayoutData('content_for_layout_title','Edit');
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
    
 
    <p class="ft_title">First Name</p>
    <p class="setft"><input type="text" name="firstName" id="firstName" value="<?php echo $prof['FirstName'];?>"  class="adm_box1" disabled/></p>
    <p class="ft_title">Last Name</p>
    <p class="setft"><input type="text" name="lastName" id="lastName" value="<?php echo $prof['LastName'];?>"  class="adm_box1" disabled/></p>
	 
    <p class="ft_title">Expiry Date </p>
    <p class="setft"><input type="text" name="expirydate" id="expirydate" value="<?php echo date("Y-m-d", strtotime($user['expirydate'])); ?>"  class="adm_box1"/></p>
	<input type="hidden" name="newtutorid" id="newtutorid" value="<?php echo $user['newtutorid'];?>">
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a>  <a href="javascript:void(0)"  style="margin-left:40px;" onclick="cancelInfo();" class="button">Cancel</a></p>
	
</form>


<script type="text/javascript">
function cancelInfo(){
	 window.location.href="<?php echo base_url('admin/newtutorlist');?>";
	}
function checkform(){
	$('#edituserform').submit();
}
$("#expirydate").datepicker({ dateFormat: 'yy-mm-dd' } );
setTimeout('showmenu("editmenu",0)',1000);
</script>
</body>
</html>