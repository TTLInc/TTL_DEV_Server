<?php $this->layout->setLayoutData('content_for_layout_title','Add country');?>

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
	<p class="ft_title">country</p>
    <p class="setft"> <input type="text" name="country" id="country" value=""  class="adm_box1" /></p>
    <?php
//		$country = $_POST['country'];
//		$sql = "select * from countries where country = '$country'";
//		$re = mysql_query($sql);
//		print_r($re);
//		//$js = mysql_fetch_row($re);
//		if($re!==''){
//			//echo "<script language=\"javascript\">alert('country already exists.');history.go(0)</script>";
//		}
//		else{
//
//		}
//
	?>

    <p class="ft_title">Country_Code</p>
    <p class="setft"> <input type="text" name="Country_Code" id="Country_Code"  value="" onchange="if(/\D/.test(this.value)){alert('Country_Code only number can be input !');this.value='';}" class="adm_box1" /></p>
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button" >submit</a></p>
</form>


<script type="text/javascript">
function checkform(){
	if($('#country').val()==''){
		alert('country can not be empty !');
		$("#country").focus();
		return false;
	}
	$('#articleform').submit();
}
setTimeout('showmenu("location",1)',1000);
</script>
</body>
</html>