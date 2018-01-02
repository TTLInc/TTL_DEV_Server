<?php 
$this->layout->setLayoutData('content_for_layout_title',(isset($data[0]['id']) ? "Modify" : "Add").' Language and Culture');?>
<?php
if(@$errormsg or @$successmsg):?>
 <div class="<?php echo ($successmsg) ? "notice_3" :"notice_4";?>" id="errormsg">
	<?php //$errormsg = $successmsg;?>
	<span class="notice_icon"></span> 
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php echo base_url('images/cross_grey_small.png');?>" />
	</a>
	<p><?php echo $errormsg; ?></p>
</div>
<?php endif;?>
<form method="post" action="" name="frmlnc" id="frmlnc" enctype="multipart/form-data">
    <p class="ft_title">Title</p>
    <p class="setft"><input type="text" name="title" id="title" value="<?php echo isset($data[0]['title']) ? $data[0]['title'] : "";?>" class="adm_box1" /></p>    
	<p class="ft_title">URL</p>
    <p class="setft"><input type="text" name="url" id="url" value="<?php echo isset($data[0]['url']) ? $data[0]['url'] : "";?>" class="adm_box1" /></p> 	
	<p class="ft_title">Image</p>
    <p class="setft">
		<input type="file" name="image" id="image" class="adm_box1" />
		<?php echo isset($data[0]['image']) ? basename($data[0]['image']) : "";?>
	</p>   
	<p class="ft_title">Description</p>
    <p class="setft"><textarea name="description" id="description" class="adm_box1" rows="10"><?php echo isset($data[0]['description']) ? $data[0]['description'] : "";?></textarea></p>	
	<p class="ft_title">Status</p>
    <p class="setft">
		<select id="status" name="status" class="adm_box1">
			<option value="Active" <?php echo ((isset($data[0]['status'])) and "Active"==$data[0]['status']) ? "selected" : "";?>>Active</option>
			<option value="Inactive" <?php echo ((isset($data[0]['status'])) and "Inactive"==$data[0]['status']) ? "selected" : "";?>>Inactive</option>
		</select>		
	</p><br/>
    <p class="setft">
		<input type="hidden" name="id" id="id" value="<?php echo isset($data[0]['id']) ? $data[0]['id'] : "";?>" />
		<a href="javascript:void(0)" onclick="checkform()" class="button">submit</a>
	</p>
</form>
<script type="text/javascript">
$("#title").focus();
function checkform(){
	if ($("#title").val()=="") {
		alert("Please Enter Title");
		$("#title").focus();
		return false;
	} else {
		$('#frmlnc').submit();
	}
}
setTimeout('showmenu("pcontent",12)',1000);
</script>
</body>
</html>