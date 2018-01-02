<?php $this->layout->setLayoutData('content_for_layout_title',(isset($testimonial['id']) ? "Modify" : "Add").' Testimonial');?>
<?php if(@$errormsg):?>
 <div class="notice_4" id="errormsg">
	<span class="notice_icon"></span>
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php echo base_url('images/cross_grey_small.png');?>" />
	</a>
	<p><?php echo $errormsg; ?></p>
</div>
<?php endif;?>
<form method="post" action="" name="frmTestimonial" id="frmTestimonial" enctype="multipart/form-data" onsubmit="return checkform();" >
	<input type="hidden" name="id" id="id" value="<?php echo @$testimonial['id'];?>" />
	<p class="ft_title">Title</p>
    <p class="setft"><input type="text" name="title" id="title" value="<?php echo @$testimonial['title'];?>" class="adm_box1" /></p>
	<p class="ft_title">Desription</p>
    <p class="setft"><textarea name="description" id="description" class="adm_box1"><?php echo @$testimonial['description'];?></textarea></p>
    <p class="ft_title">Author</p>
    <p class="setft"><input type="text" name="author" id="author" value="<?php echo @$testimonial['author'];?>" class="adm_box1" /></p>	
    <p class="ft_title">Website</p>
    <p class="setft"><input type="text" name="website" id="website" value="<?php echo @$testimonial['website'];?>" class="adm_box1" /></p>
    <p class="setft">
		<input type="submit" name="submit" id="submit" value="Submit" class="button" />
		<input type="button" name="cancel" id="cancel" value="Cancel" class="button" onclick="javascript:self.location='<?php echo base_url("admin/testimonials");?>'" />
	</p>
</form>
<script type="text/javascript">
$(document).ready(function(){
	$('#title').focus();
});
function checkform(){
	if($('#title').val()==''){
		alert('Title can not be empty !');
		$("#title").focus();
		return false;
	}
	else if( $('#description').val()==''){
		alert('Description can not be empty !');
		$("#description").focus();
		return false;
	}
	else if( $('#author').val() == ""){
		alert('Author can not be empty !');
		return false;
	}
	else
	{
		return true;
	}
	$('#articleform').submit();
}
setTimeout('showmenu("pcontent",19)',1000);
</script>
</body>
</html>