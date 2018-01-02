<?php $this->layout->setLayoutData('content_for_layout_title','Edit Test Scenario');?>
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

<form method="post" action="" name="editTresourcesform" id="editTresourcesform" enctype="multipart/form-data">
	
	<p class="ft_title">Type</p>
	<p class="setft">
		<select name="type">
 
		<option value="p">PDF</option>
		</select>
	</p>
	<p class="ft_title">Recourse for</p>
    <p class="setft">
	<input type="radio" name="rtype" value="T"   <?php if($EditData['rtype'] == 'T'){ echo '  checked="CHECKED"'; } ?>/>Tutor
    <input type="radio" name="rtype" value="S"   <?php if($EditData['rtype'] == 'S'){ echo '  checked="CHECKED"'; }?>/>Student </p>
 	
	 
	<div id="vSection"  >
	<p class="ft_title">PDF Title</p>
	<p class="setft"><input type="text" name="Title" id="Title" value="<?php echo $EditData['Title'];?>"  class="adm_box1" /></p>
	<p class="ft_title">PDF</p>
	<p class="setft"><input type="file" name="pfile" id="pfile"  class="adm_box1" /></p>
	<p class="ft_title">Description</p>
   	<p class="setft"><textarea rows="8" cols="70"  name="Description" id="Description"><?php echo $EditData['Description'];?></textarea></p>
	</div>
	

<p class="ft_title">Status</p>
<p class="setft">
<input type="radio" name="Status" value="1" <?php if($EditData['Status']=='1'){echo 'checked';} ?>/>Active
<input type="radio" name="Status" value="0" <?php if($EditData['Status']=='0'){echo 'checked';} ?> />Inactive 
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
setTimeout('showmenu("pcontent",17)',1000);
</script>
</body>
</html>