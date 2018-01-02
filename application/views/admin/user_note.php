<?php $this->layout->setLayoutData('content_for_layout_title','User note');?>

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
    <p class="ft_title">Dispute ID</p>
    <p class="setft"><input type="text" name="dispute_id" id="dispute_id" value="<?php if(isset($user['dispute_id'])) {echo $user['countryName'];}?>"  class="adm_box1"/></p>
	<p class="ft_title">Note</p>
   	<p class="setft"><textarea rows="8" cols="70"  name="note" id="note"></textarea></p>
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">
function checkform(){
	$('#edituserform').submit();
}
setTimeout('showmenu("usermenu",0)',1000);
</script>
</body>
</html>