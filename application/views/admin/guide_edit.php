<?php $this->layout->setLayoutData('content_for_layout_title','Edit Category');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<div style="float:left;margin-right:110px;font-weight:bold;">   </div><a href="'.base_url('admin/guide').'"> List Category</a>');?>
<?php if(@$errormsg):?>
 <div class="notice_3" id="errormsg">
	<span class="notice_icon"></span>
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php echo base_url('images/cross_grey_small.png');?>" />
	</a>
	<p><?php echo $errormsg; ?></p>
</div>
<?php endif;?>
<form method="post" action="" name="guideform" id="guideform" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="<?php echo $guide['guide_categories_id'];?>"  class="adm_box1" />
	 
	 

	<p class="ft_title">Name</p>
    <p class="setft"> <input type="text" name="name" id="name" value="<?php echo $guide['name'];?>"  class="adm_box1" /></p>
	 
     <span class="valError" id="terror" style="display:none;margin-top:4px;">Enter   Name </span>
    <p class="setft" style="margin-top:25px;"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a>
	<a  style="margin-left:15px;" href="<?php echo base_url('admin/guide') ?>" class="button">Cancel</a>
	</p>

	</form>
<script type="text/javascript">
function checkform(){
	 
	if($("#name").val()=='')
		{
			$('#terror').show(); 
			return false;
		}
		else
		{
			$('#terror').hide(); 
		}
		
		 
		$('#guideform').submit();
}
setTimeout('showmenu("pcontent",9)',1000);
</script>
<style>
.valError
{
color:red;
font-size:16px;
}
</style>
</body>
</html>