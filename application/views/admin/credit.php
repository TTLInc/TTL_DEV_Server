<?php $this->layout->setLayoutData('content_for_layout_title','RMB to TalkList Credits conversion');?>

<?php if(@$errormsg):?>
	<div class="notice_4 notice_6" id="errormsg">
		<span class="notice_icon notice_icon6"></span> 
		<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		</a>
		<p><?php echo $errormsg; ?></p>
	</div>
<?php elseif(@$succrmsg):?>
	<div class="notice_4 notice_6" id="errormsg" style="background: none repeat scroll 0 0 green !important;color: #FFFFFF !important;">
		<span class="notice_icon6"></span> 
		<a class="notice_icon6 " href="javascript:void(0);" onclick="$('#errormsg').hide()">
		</a>
		<p ><?php echo $succrmsg; ?></p>
	</div>
<?php endif;?>




<form method="post" action="" name="addCreditform" id="addCreditform" enctype="multipart/form-data">
	<p class="ft_title">Percentage uplift on each tutor's price</p>
    <p class="setft"><input type="text" name="puot_price" id="puot_price" value=""  class="adm_box1" /></p>

	<p class="ft_title">Percentage uplift on each tutor's video</p>
    <p class="setft"><input type="text" name="puot_video" id="puot_video" value=""  class="adm_box1" /></p>
	
	<p class="ft_title">Monthly Price for Tutor Premium Member</p>
    <p class="setft"><input type="text" name="tpm_monthly_price" id="tpm_monthly_price" value=""  class="adm_box1" /></p>

    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">
function checkform(){
	var puot_price 			= $('#puot_price').val();
	var puot_video 			= $('#puot_video').val();
	var tpm_monthly_price 	= $('#tpm_monthly_price').val();
	
	if(puot_price == "" || puot_video == "" || tpm_monthly_price == ""){
		if(puot_price == ""){
			alert("Percentage uplift on each tutor's price is required");
		}
		if(puot_video){
			alert("Percentage uplift on each tutor's video is required");
		}
		if(tpm_monthly_price){
			alert("Monthly Price for Tutor Premium Member is required");
		}
		
	}else{
	 $('#addCreditform').submit();
	}
}
setTimeout('showmenu("credit",1)',1000);
</script>
