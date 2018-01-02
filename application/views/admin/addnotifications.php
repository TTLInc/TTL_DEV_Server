<?php 
$this->layout->setLayoutData('content_for_layout_title',(isset($data[0]['id']) ? "Modify" : "Add").' Notifications');?>
<form method="post" action="" name="frmnote" id="frmnote" enctype="multipart/form-data">
    <p class="ft_title">Title</p>
    <p class="setft"><input type="text" name="title" id="title" value="<?php echo isset($data[0]['title']) ? $data[0]['title'] : "";?>" class="adm_box1" /></p>	   
	<p class="ft_title">Description</p>
    <p class="setft"><?php echo $ckEditor->editor('description',(isset($data[0]['description']) ? $data[0]['description'] : ""));?>
	</p>
	<p class="ft_title">Order</p>
    <p class="setft">
		<select id="order" name="order" class="adm_box1">
			<?php for($i=1;$i<=5;$i++) {?>
			<option value="<?php echo $i;?>" <?php echo ((isset($data[0]['order'])) and $i==$data[0]['order']) ? "selected" : "";?>><?php echo $i;?></option>
			<?php }?>
		</select>		
	</p>
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
		$('#frmnote').submit();
	}
}
setTimeout('showmenu("pcontent",15)',1000);
</script>
</body>
</html>