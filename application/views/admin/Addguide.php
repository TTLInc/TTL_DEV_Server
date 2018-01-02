<?php $this->layout->setLayoutData('content_for_layout_title','Add Guide Categories');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<div style="float:left;margin-right:110px;font-weight:bold;">   </div><a href="'.base_url('admin/guide').'"> List Category</a>');?>
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
<form method="post" action="" name="guideform" id="guideform" enctype="multipart/form-data">
    
	 
	<p class="ft_title">Name</p>
	
    <p class="setft"><input type="text" name="name" id="name" value=""  class="adm_box1" /></p>
    <span class="valError" id="terror" style="display:none;margin-top:4px;">Enter   Name </span>
	 <br/>
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">
function checkform(){
	//
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