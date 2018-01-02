<?php $this->layout->setLayoutData('content_for_layout_title','Edit FAQ');?>

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


<form method="post" action="" name="editFaqform" id="editFaqform" enctype="multipart/form-data">
	
	
	
	<p class="ft_title">Language
		<select id="lang_q" name="lang";>
		<option value="en" <?php if($ad['lang'] == 'en'){ echo 'SELECTED="SELECTED"'; }?>>English</option>
		<option value="kr" <?php if($ad['lang'] == 'kr'){ echo 'SELECTED="SELECTED"'; }?>>Korean</option>
		<option value="ch" <?php if($ad['lang'] == 'ch'){ echo 'SELECTED="SELECTED"'; }?>>Chinese(Simplyfied)</option>
		<option value="tw" <?php if($ad['lang'] == 'tw'){ echo 'SELECTED="SELECTED"'; }?>>Chinese(Traditional)</option>
		<option value="jp" <?php if($ad['lang'] == 'jp'){ echo 'SELECTED="SELECTED"'; }?>>Japanese</option>
		<option value="pt" <?php if($ad['lang'] == 'pt'){ echo 'SELECTED="SELECTED"'; }?>>Portuguese</option>
		<option value="es" <?php if($ad['lang'] == 'es'){ echo 'SELECTED="SELECTED"'; }?>>Spanish</option>
		</select>
	</p>

	<p class="ft_title">Category
		<select id="category" name="category">
		<option value="GENERAL <?php if($ad['category'] == 'GENERAL'){ echo 'SELECTED="SELECTED"'; }?>">General</option>
		<option value="REGISTRATION_PROFILE <?php if($ad['category'] == 'REGISTRATION_PROFILE'){ echo 'SELECTED="SELECTED"'; }?>">Registration Profile</option>
		<option value="PAYMENT <?php if($ad['category'] == 'PAYMENT'){ echo 'SELECTED="SELECTED"'; }?>">Payment</option>
		<option value="CALENDER <?php if($ad['category'] == 'CALENDER'){ echo 'SELECTED="SELECTED"'; }?>">Calender</option>
		<option value="SESSION" <?php if($ad['category'] == 'SESSION'){ echo 'SELECTED="SELECTED"'; }?>>Session</option>
		<option value="FEEDBACK <?php if($ad['category'] == 'FEEDBACK'){ echo 'SELECTED="SELECTED"'; }?>">Feedback</option>
		</select>
	</p>
	
	
	
	
	
	
	
	
<p class="ft_title">Question</p>
<p class="setft"><textarea rows="4" cols="70" name="question" id="question"><?php echo $ad['question'];?></textarea></p>








<p class="ft_title">Answer</p>
<p class="setft"><textarea rows="8" cols="70"  name="answer" id="answer"><?php echo $ad['answer'];?></textarea></p>

<p class="ft_title">Order</p>
<p class="setft"><input type="text" name="order" id="order" value="<?php echo $ad['order'];?>"  class="adm_box1" /></p>

<p class="ft_title">Status</p>
<p class="setft">
<input type="radio" name="status" value="1" <?php if($ad['status']=='1'){echo 'checked';} ?>/>Active
<input type="radio" name="status" value="0" <?php if($ad['status']=='0'){echo 'checked';} ?> />Inactive 
</p>
<p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">
function checkform(){
	var frmQ = $('#question').val();
	var frmA = $('#answer').val();
	if(frmQ == "" || frmA == ""){
		if(frmQ == ""){
			alert('FAQ question is required');
		}
		if(frmA){
			alert('FAQ answer is required');
		}
	}else{
	 $('#editFaqform').submit();
	}
}
setTimeout('showmenu("faq",1)',1000);
</script>
</body>
</html>