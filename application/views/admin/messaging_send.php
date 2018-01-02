<?php $this->layout->setLayoutData('content_for_layout_title','Send Mass Message');?>
<?php $this->layout->appendFile('css',"css/auto.css");?>
<?php $this->layout->appendFile('javascript',"js/auto.js");?>
<input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url();?>" />

<?php if(@$errormsg):?>
 <div class="notice_4" id="errormsg">
	<span class="notice_icon"></span> 
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php echo base_url('images/cross_grey_small.png');?>" />
	</a>
	<p><?php echo $errormsg; ?></p>

	</div>
<?php elseif(@$succrmsg):?>
	<div class="notice_4 notice_6" id="errormsg" style="background: none repeat scroll 0 0 green !important;color: #FFFFFF !important;">
	<span class="notice_icon notice_icon6"></span> 
	<a class="notice_icon6 " href="javascript:void(0);" onclick="$('#errormsg').hide()">
		
	</a>
	<p><?php echo $succrmsg; 
	
	?></p>
</div>
<?php endif;?>
<form method="post" action="" name="sendMassmessageform" id="sendMassmessageform" enctype="multipart/form-data">
    <p class="ft_title">Send To</p>
    <p class="setft">
		<!--<input type="text" name="text" id="text" value=""  class="adm_box1" />-->
		<select name="sendtype" id="sendtype" class="adm_box1" >
			<option value="inbox" >TheTalkList inbox</option>
			<option value="email" >Email addresses</option>
			<option value="affiliates" >Affiliates</option>
		</select>
	</p>
	<p class="ft_title">Group</p>
    <p class="setft">
		<select name="group" id="group" class="adm_box1">
			<option value="allmember" >All members</option>
			<option value="individualmember" >Individual member</option>
			<option value="upgradedtutor" >Upgraded Tutors</option>
			<option value="alltutor" >All Tutors</option>
			<option value="allstudent" >All Students</option>
		</select>
	</p>
	
	<div id="indmem" style="display:none;">
		<p class="ft_title">Select Member</p>
		<p class="setft">
			<input type="text"  class="input adm_box1" name="keyword" id="keyword" tabindex="0"  autocomplete="off" value="" >
			<div class="autosug" id="ajax_response"  >
				<div class="wrapper systemError" id="nameErrorBox" style="display: none;"></div>
			</div>
		</p>
		
	</div>
	<input type="hidden" value="" id="email" name="email"  /> 
	<p class="ft_title">Subject</p>
    <p class="setft">
		<input type="text" name="subject" id="subject" class="adm_box1" style="width:62%;"/>
	</p>
	<p class="ft_title">Message</p>
    <p class="setft">
		<textarea name="message" id="message" cols="50" rows="10"></textarea>
	</p>
   
	
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">Send</a></p>
</form>


<script type="text/javascript">
function checkform(){
	$('#sendMassmessageform').submit();
}
setTimeout('showmenu("pcontent",10)',1000);

function setemail(email)
{
	//alert(email)
	$('#email').val(email);
}
$(document).ready(function() {
	$( "#group" ).change(function() {
		if($( "#group" ).val() == 'individualmember')
		{
			$('#indmem').show('slow');
		}else{
			$('#indmem').hide('slow');
		}
	});
});
</script>
</body>
</html>