<?php $this->layout->setLayoutData('content_for_layout_title','Edit Instant Message');?>

<?php if(@$errormsg):?>
	<div class="notice_4 notice_6" id="errormsg">
		<span class="notice_icon notice_icon6"></span> 
		<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<!--<img src="<?php //echo base_url('images/arow-right.png');?>" />-->
		</a>
		<p><?php echo $errormsg; ?></p>
	</div>
<?php elseif(@$succrmsg):?>
	<div class="notice_4 notice_6" id="errormsg" style="background: none repeat scroll 0 0 green !important;color: #FFFFFF !important;">
	<span class="notice_icon6"></span> 
	<a class="notice_icon6 " href="javascript:void(0);" onclick="$('#errormsg').hide()">
	<!--<img src="<?php //echo base_url('images/arow-right.png');?>" />-->
	</a>
	<p ><?php echo $succrmsg; ?></p>
	</div>
<?php endif;?>


<form method="post" action="" name="editImform" id="editImform" enctype="multipart/form-data">
<p class="ft_title">Question</p>
<p class="setft"><textarea rows="4" cols="70" name="que" id="que"><?php echo $ad['que'];?></textarea></p>


<p class="ft_title">Answer</p>
<p class="setft"><textarea rows="8" cols="70"  name="ans" id="ans"><?php echo $ad['ans'];?></textarea></p>


<p class="ft_title">Status</p>
<p class="setft">
<input type="radio" name="status" value="ACTIVE" <?php if($ad['status']=='ACTIVE'){echo 'checked';} ?>/>Active
<input type="radio" name="status" value="INACTIVE" <?php if($ad['status']=='INACTIVE'){echo 'checked';} ?> />Inactive 
</p>
<p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">
function checkform(){
	
	var frmQ = $('#que').val();
	var frmA = $('#ans').val();
	if(frmQ == "" || frmA == ""){
		if(frmQ == ""){
			alert('Question is required');
		}
		if(frmA == ""){
			alert('Answer is required');
		}
	}else{
	 $('#editImform').submit();
	}

}
setTimeout('showmenu("im",1)',1000);
</script>
</body>
</html>