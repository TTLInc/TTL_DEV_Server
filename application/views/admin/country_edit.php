<?php $this->layout->setLayoutData('content_for_layout_title','Edit country');?>

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
    <input type="hidden" name="id" id="id" value="<?php echo $country['id'];?>"  class="adm_box1" />
	<p class="ft_title">country</p>
    <p class="setft"> <input type="text" name="country" id="country" value="<?php echo $country['country'];?>"  class="adm_box1" /></p>

    <p class="ft_title">Country_Code</p>
    <p class="setft"> <input type="text" name="Country_Code" id="Country_Code"  value="<?php echo $country['Country_Code'];?>" onchange="if(/\D/.test(this.value)){alert('Country_Code only number can be input !');this.value='';}" class="adm_box1" /></p>

    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">

function checkform(){
	if($('#country').val()==''){
		alert('country can not be empty !');
		$("#country").focus();
		return false;
	}

	if( $('#Country_Code').val()==''){
		alert('Country_Code can not be empty !');
		$("#Country_Code").focus();
		return false;
	}
	if( $('#Country_Code').val().length > 11){
		alert('Country_Code can not be more than 11 character !');
		return;
	}
	$('#articleform').submit();
}
setTimeout('showmenu("location",1)',1000);
</script>
</body>
</html>