<?php $this->layout->setLayoutData('content_for_layout_title','Edit Metatag');?>
<?php if(@$errormsg):?>
 <div class="notice_4" id="errormsg">
	<span class="notice_icon"></span> 
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php echo base_url('images/cross_grey_small.png');?>" />
	</a>
	<p><?php echo $errormsg; ?></p>
</div>
<?php endif;
?>
<form method="post" name="frmMetatag" id="frmMetatag" enctype="multipart/form-data">
	<input type="hidden" name="id" id="id" value="<?php echo isset($metatag['id']) ? $metatag['id'] : "";?>" class="adm_box1" />
	<input type="hidden" name="lng" id="lng" class="adm_box1" value="<?php echo $selectedLang;?>">
	<p class="ft_title">URL</p>
	<p class="setft">
		<input type="text" name="url" id="url" value="<?php echo isset($metatag['url']) ? $metatag['url'] : "";?>" class="adm_box1" style="width:33%" />
	</p>
	<div style="float:left;width:50%;">
	<p class="ft_title">Title</p>
	<p class="setft">
		<input type="text" name="title" id="title" value="<?php echo isset($metatag['title']) ? $metatag['title'] : "";?>" class="adm_box1" style="width:90%" />
	</p>	
	<p class="ft_title">Keywords</p>
	<p class="setft">
		<input type="text" name="keywords" id="keywords" value="<?php echo isset($metatag['keywords']) ? $metatag['keywords'] : "";?>" class="adm_box1" style="width:90%" />
	</p>	
	<p class="ft_title">Descriptions</p>
	<p class="setft">
		<input type="text" name="descriptions" id="descriptions" value="<?php echo isset($metatag['descriptions']) ? $metatag['descriptions'] : "";?>" class="adm_box1" style="width:90%" />
	</p>
	</div>
	<?php
	if($selectedLang!="en"){?>
	<div style="float:left;width:50%;">
	<p class="ft_title"><?php echo $options[$selectedLang];?> Title</p>
	<p class="setft">
		<input type="text" name="<?php echo $selectedLang;?>_title" id="<?php echo $selectedLang;?>_title" value="<?php echo isset($metatag[$selectedLang."_title"]) ? $metatag[$selectedLang."_title"] : "";?>" class="adm_box1" style="width:90%" />
	</p>
	<p class="ft_title"><?php echo $options[$selectedLang];?> Keywords</p>
	<p class="setft">
		<input type="text" name="<?php echo $selectedLang;?>_keywords" id="<?php echo $selectedLang;?>_keywords" value="<?php echo isset($metatag[$selectedLang."_keywords"]) ? $metatag[$selectedLang."_keywords"] : "";?>" class="adm_box1" style="width:90%" />
	</p>
	<p class="ft_title"><?php echo $options[$selectedLang];?> Descriptions</p>
	<p class="setft">
		<input type="text" name="<?php echo $selectedLang;?>_descriptions" id="<?php echo $selectedLang;?>_descriptions" value="<?php echo isset($metatag[$selectedLang."_descriptions"]) ? $metatag[$selectedLang."_descriptions"] : "";?>" class="adm_box1" style="width:90%" />
	</p>
	</div>
	<?php }?>
	<p class="setft" style="clear:both;">
	<br/>
       <a href="javascript:void(0)" onclick="checkform()" class="button">Submit</a>&nbsp;
       <a href="javascript:void(0)" onclick="cancelform()" class="button">Cancel</a>
    </p>
</form>
<script type="text/javascript">
function checkform(){
	if ($("#url").val()=="") {
		alert("Please Enter URL");		
		$("#url").focus();
		return false;
	} else if ($("#title").val()=="") {
		alert("Please Enter Title");		
		$("#title").focus();
		return false;
	}
	$('#frmMetatag').submit();
}

function cancelform(){
	window.location.href = '<?php echo base_url('admin/metatag');?>';
}
setTimeout('showmenu("psettings",13)',1000);
</script>
</body>
</html>