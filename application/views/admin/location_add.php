<?php $this->layout->setLayoutData('content_for_layout_title','Add Location');?>

<?php if(@$errormsg):?>
 <div class="notice_4" id="errormsg">
	<span class="notice_icon"></span>
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php echo base_url('images/cross_grey_small.png');?>" />
	</a>
	<p><?php echo $errormsg; ?></p>
</div>
<?php endif;?>
<form method="post" action="" name="articleform" id="articleform" enctype="multipart/form-data">
	<p class="ft_title">Country</p>
    <p class="setft"> <?php echo form_dropdown('cid',$country,$cid,'id="cid" class="adm_box1"');?></p>

	<p class="ft_title">Location</p>
    <p class="setft"> <input type="text" name="provice" id="provice" value=""  class="adm_box1" /></p>

    <p class="ft_title">Area_Code</p>
    <p class="setft"> <input type="text" name="Area_Code" id="Area_Code" value="" onchange="if(/\D/.test(this.value)){alert('Country_Code only number can be input !');this.value='';}" class="adm_box1" /></p>


    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">
function checkform(){
	if($('#provice').val()==''){
		alert('Location can not be empty !');
		$("#provice").focus();
		return false;
	}
			if( $('#Area_Code').val()==''){
		alert('Area_Code can not be empty !');
		$("#Area_Code").focus();
		return false;
	}
	if( $('#Area_Code').val().length > 11){
		alert('Area_Code can not be more than 11 character !');
		return;
	}
	$('#articleform').submit();
}
setTimeout('showmenu("psettings",12)',1000);
</script>
</body>
</html>