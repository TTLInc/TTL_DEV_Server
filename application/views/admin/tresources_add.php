<?php $this->layout->setLayoutData('content_for_layout_title','Add Support Resource');?>

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




<form method="post" action="" name="addTresourcesform" id="addTresourcesform" enctype="multipart/form-data">
 	
	<p class="ft_title">Type</p>
	<p class="setft">
		<select name="type" onchange="showResType(this.value);">
		<option value="v">Video</option>
		<option value="l">Link</option>
		<option value="p">PDF</option>
		</select>
	</p>
	
	
	<p class="ft_title">Recourse for</p>
    <p class="setft"><input type="radio" name="rType" value="T"  checked="checked"/>Tutor
    <input type="radio" name="rType" value="S"  />Student </p>

	<div id="vSection" style="display:block">
	<p class="ft_title">Video Title</p>
	<p class="setft"><input type="text" name="vtitle" id="vtitle" value=""  class="adm_box1" /></p>
	<p class="ft_title">Video</p>
	<p class="setft"><input type="file" name="vfile" id="vfile"  class="adm_box1" /></p>
	<p class="ft_title">Description</p>
   	<p class="setft"><textarea rows="8" cols="70"  name="vdescription" id="vdescription"></textarea></p>
	</div>

	<div id="pSection" style="display:none">
	<p class="ft_title">PDF Title</p>
	<p class="setft"><input type="text" name="ptitle" id="ptitle" value=""  class="adm_box1" /></p>
	<p class="ft_title">PDF</p>
	<p class="setft"><input type="file" name="pfile" id="pfile"  class="adm_box1" /></p>
	<p class="ft_title">Description</p>
   	<p class="setft"><textarea rows="8" cols="70"  name="pdescription" id="pdescription"></textarea></p>
	</div>
	
	<div id="lSection" style="display:none">
	<p class="ft_title">Link Title</p>
	<p class="setft"><input type="text" name="ltitle" id="ltitle" value=""  class="adm_box1" /></p>
	<p class="ft_title">Link</p>
	<p class="setft"><input type="text" name="link" id="link" value=""  class="adm_box1" /></p>
	<p class="ft_title">Description</p>
   	<p class="setft"><textarea rows="8" cols="70"  name="ldescription" id="ldescription"></textarea></p>
	</div>
	
	
	
	
	
	<p class="ft_title">Status</p>
    <p class="setft"><input type="radio" name="status" value="1"  checked="checked"/>Active
    <input type="radio" name="status" value="0"  />Inactive </p>
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>

</form>


<script type="text/javascript">
function checkform(){
	$('#addTresourcesform').submit();
}
function showResType(type){
	if(type == 'l'){
		$('#pSection').css('display', 'none');
		$('#vSection').css('display', 'none');
		$('#lSection').css('display', 'block');		
	}else if(type == 'p'){
		$('#pSection').css('display', 'block');
		$('#vSection').css('display', 'none');
		$('#lSection').css('display', 'none');
	}else{
		$('#vSection').css('display', 'block');
		$('#lSection').css('display', 'none');
		$('#pSection').css('display', 'none');
	}
}
setTimeout('showmenu("treseources",1)',1000);
</script>
</body>
</html>