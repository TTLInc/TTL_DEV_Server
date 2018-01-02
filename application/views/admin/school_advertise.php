<?php $this->layout->setLayoutData('content_for_layout_title','Add advertisement');?>
<!-- fixed success msg style BY TECHNO-SANJAY -->
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
	<p ><?php echo $succrmsg; ?></p>

</div>
<?php endif;?>
<form method="post" action="" name="addAdform1" id="addAdform1" enctype="multipart/form-data">
    
	<p class="ft_title">Language</p>
	<p class="setft">
	<select name="lang" id="position" >
	
	<option value="1">English</option>
	<option value="3">CN Simplified</option>
	<option value="6">CN Traditional</option>
	<option value="4">Japanese</option>
	<option value="2">Korean</option>
	<option value="5">Portuguese</option>
	<option value="7">Spanish</option>
	</select></p>
	<p class="ft_title">Name</p>
    <p class="setft"><input type="text" name="title" id="title" value=""  class="adm_box1" /></p>
    <p class="ft_title">Image </p>
    <p class="setft">
		<input type="file" name="image" id="image" value=""  class="adm_box1" />
		
	</p>
    
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">
function checkform(){
	$('#addAdform1').submit();
}
$("#expDate").datepicker({ dateFormat: 'yy-mm-dd' } );
setTimeout('showmenu("schadd",1)',1000);
</script>
</body>
</html>