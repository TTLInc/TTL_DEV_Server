<?php $this->layout->setLayoutData('content_for_layout_title','Settings');?>
<!-- fixed success msg style BY TECHNO-SANJAY -->

<?php if(@$errormsg):?>
 <div class="notice_4" id="errormsg">
	<span class="notice_icon"></span> 
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php echo base_url('images/cross_grey_small.png');?>" />
	</a>
	<p><?php echo $errormsg;
	
	?></p>
</div>
<?php elseif(@$succrmsg):?>
	<div class="notice_4 notice_6" id="errormsg" style="background: none repeat scroll 0 0 green !important;color: #FFFFFF !important;">
	<span class="notice_icon notice_icon6"></span> 
	<a class="notice_icon6 " href="javascript:void(0);" onclick="$('#errormsg').hide()">
		
	</a>
	<p ><?php echo $succrmsg; ?></p>

</div>
<?php endif;?>

<form method="post" action="" name="addSettingsform" id="addSettingsform" enctype="multipart/form-data">
<p style="color:green;"> Please enter below Banned words with comma separated.</p>
 	<p class="ft_title">Banned Words</p>
   	<p class="setft">
    	<p class="setft"><textarea name="banded_words" id="banded_words" rows="8" cols="54"><?php echo $ad['banded_words'];?></textarea></p>
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">
function checkform(){
	$('#addSettingsform').submit();
}
setTimeout('showmenu("psettings",6)',1000);
</script>
</body>
</html>