<?php $this->layout->setLayoutData('content_for_layout_title','Edit Resource');?>

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

<form method="post" action="" name="editTresourcesform" id="editTresourcesform" enctype="multipart/form-data">
<p class="ft_title">Type</p>
<p class="setft">
	<select name="type" onchange="showResType(this.value);">
	<option value="v" <?php if($ad['type'] == 'v'){ echo 'SELECTED="SELECTED"'; }?>>Video</option>
	<option value="l" <?php if($ad['type'] == 'l'){ echo 'SELECTED="SELECTED"'; }?>>Link</option>
	<option value="P" <?php if($ad['type'] == 'p'){ echo 'SELECTED="SELECTED"'; }?>>PDF</option>
	</select>
</p>


	<p class="ft_title">Resource for</p>
    <p class="setft">
	<input type="radio" name="rType" value="T"   <?php if($ad['rType'] == 'T'){ echo '  checked="CHECKED"'; } ?>/>Tutor
    <input type="radio" name="rType" value="S"   <?php if($ad['rType'] == 'S'){ echo '  checked="CHECKED"'; }?>/>Student </p>

	<?php if($ad['type'] == 'v'){ $vStyle = 'block';  }else { $vStyle = 'none';} ?>
	<?php if($ad['type'] == 'l'){ $lStyle = 'block';  }else { $lStyle = 'none';} ?>
	<?php if($ad['type'] == 'p'){ $pStyle = 'block';  }else { $pStyle = 'none';} ?>

	<div id="vSection" style="display:<?php echo $vStyle;?>">
	<p class="ft_title">Video Title</p>
	<p class="setft"><input type="text" name="vtitle" id="vtitle" value="<?php echo $ad['vtitle'];?>"  class="adm_box1" /></p>
	<p class="ft_title">Video</p>
	<p class="setft"><input type="file" name="vfile" id="vfile"  class="adm_box1" /></p>
	<p class="ft_title">Description</p>
   	<p class="setft"><textarea rows="8" cols="70"  name="vdescription" id="vdescription"><?php echo $ad['vdescription'];?></textarea></p>
	</div>

	
	<div id="lSection" style="display:<?php echo $lStyle;?>">
	<p class="ft_title">Link Title</p>
	<p class="setft"><input type="text" name="ltitle" id="ltitle" value="<?php echo $ad['ltitle'];?>"  class="adm_box1" /></p>
	<p class="ft_title">Link</p>
	<p class="setft"><input type="text" name="link" id="link" value="<?php echo $ad['link'];?>"  class="adm_box1" /></p>
	<p class="ft_title">Description</p>
   	<p class="setft"><textarea rows="8" cols="70"  name="ldescription" id="ldescription"><?php echo $ad['ldescription'];?></textarea></p>
	</div>

	<div id="vSection" style="display:<?php echo $pStyle;?>">
	<p class="ft_title">PDF Title</p>
	<p class="setft"><input type="text" name="ptitle" id="ptitle" value="<?php echo $ad['ptitle'];?>"  class="adm_box1" /></p>
	<p class="ft_title">PDF</p>
	<p class="setft"><input type="file" name="pfile" id="pfile"  class="adm_box1" /></p>
	<p class="ft_title">Description</p>
   	<p class="setft"><textarea rows="8" cols="70"  name="pdescription" id="pdescription"><?php echo $ad['pdescription'];?></textarea></p>
	</div>
	

<p class="ft_title">Status</p>
<p class="setft">
<input type="radio" name="status" value="1" <?php if($ad['status']=='1'){echo 'checked';} ?>/>Active
<input type="radio" name="status" value="0" <?php if($ad['status']=='0'){echo 'checked';} ?> />Inactive 
</p>
<p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">
function checkform(){
	$('#editTresourcesform').submit();
}
function showResType(type){
	if(type == 'l'){
		$('#vSection').css('display', 'none');
		$('#lSection').css('display', 'block');
	}else{
		$('#vSection').css('display', 'block');
		$('#lSection').css('display', 'none');
	}
}
setTimeout('showmenu("treseources",1)',1000);
</script>
</body>
</html>