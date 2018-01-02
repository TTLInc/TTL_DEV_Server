<?php $this->layout->setLayoutData('content_for_layout_title','Edit Document');?>
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

<form method="post" action="" name="editVideoform" id="editVideoform" enctype="multipart/form-data">
    <p class="ft_title">Title</p>
    <p class="setft"><input type="text" name="title" id="title" value="<?php echo $ad['title'];?>"  class="adm_box1" /></p>
    <p class="ft_title">Document</p>
    <p class="setft">
        <input type="file" name="document_file" id="document_file" value="<?php echo $ad['document_file'];?>"  class="adm_box1" />
       
    </p>
   <p class="ft_title">Status</p>
   
   <p class="setft">
			<input type="radio" name="status" value="active" <?php if($ad['status']=='active'){echo 'checked';} ?>/>Active
			<input type="radio" name="status" value="inactive" <?php if($ad['status']=='inactive'){echo 'checked';} ?> />Inactive 
		</p>
	<p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>

<script type="text/javascript">
function checkform(){
	$('#editVideoform').submit();
}
setTimeout('showmenu("lmstracking",1)',1000);
</script>
</body>
</html>