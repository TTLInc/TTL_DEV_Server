<?php $this->layout->setLayoutData('content_for_layout_title','Add Test Scenarios');?>

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
		<select name="type">
 
		<option value="p">PDF</option>
		</select>
	</p>
	
	
	<p class="ft_title">Recourse for</p>
    <p class="setft"><input type="radio" name="rtype" value="T"  checked="checked"/>Tutor
    <input type="radio" name="rtype" value="S"  />Student </p>

	

	<div id="pSection">
	<p class="ft_title">PDF Title</p>
	<p class="setft"><input type="text" name="Title" id="Title" value=""  class="adm_box1" /></p>
	<p class="ft_title">PDF</p>
	<p class="setft"><input type="file" name="pfile" id="pfile"    class="adm_box1" /></p>
	
	<p class="ft_title">Description</p>
   	<p class="setft"><textarea rows="8" cols="70"  name="Description" id="Description"></textarea></p>
	</div>
	<p class="ft_title">Status</p>
    <p class="setft"><input type="radio" name="Status" value="1"  checked="checked"/>Active
    <input type="radio" name="Status" value="0"  />Inactive </p>
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>

</form>


<script type="text/javascript">
function checkform(){
	$('#addTresourcesform').submit();
}
 
setTimeout('showmenu("TestScenarios",1)',1000);
</script>
</body>
</html>