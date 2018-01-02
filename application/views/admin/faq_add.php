<?php $this->layout->setLayoutData('content_for_layout_title','Add Quotes');?>

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




<form method="post" action="" name="addFaqform" id="addFaqform" enctype="multipart/form-data">
 	
	<p class="ft_title">Language
		<select id="lang_q" name="lang">
		<option value="en">English</option>
		<option value="kr">Korean</option>
		<option value="ch">Chinese(Simplyfied)</option>
		<option value="tw">Chinese(Traditional)</option>
		<option value="jp">Japanese</option>
		<option value="pt">Portuguese</option> 
		<option value="es">Spanish</option>
		<option value="fr">French</option>
		</select>
	</p>
	
	<p class="ft_title">Category
		<select id="category" name="category">
		<option value="GENERAL">General</option>
		<option value="REGISTRATION_PROFILE">Registration Profile</option>
		<option value="PAYMENT">Payment</option>
		<option value="CALENDER">Calender</option>
		<option value="SESSION">Session</option>
		<option value="FEEDBACK">Feedback</option>
		</select>
	</p>
	
	<p class="ft_title">Question</p>
   	<p class="setft"><textarea rows="4" cols="70"  name="question" id="question"></textarea></p>
 	
	
	

	
	
	<p class="ft_title">Answer</p>
   	<p class="setft"><textarea rows="8" cols="70"  name="answer" id="answer"></textarea></p>
	<p class="ft_title">Order</p>
    <p class="setft"><input type="text" name="order" id="order" value=""  class="adm_box1" /></p>
	<p class="ft_title">Status</p>
    <p class="setft"><input type="radio" name="status" value="1"  checked="checked"/>Active
    <input type="radio" name="status" value="0"  />Inactive </p>
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
	 $('#addFaqform').submit();
	}
	
	
	
}
setTimeout('showmenu("psettings",8)',1000);
</script>
</body>
</html>