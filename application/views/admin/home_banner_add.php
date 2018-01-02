<?php $this->layout->setLayoutData('content_for_layout_title','Add index banner');?>
<?php if(@$errormsg or @$successmsg):?>
 <div class="<?php echo ($successmsg) ? "notice_3" :"notice_4";?>" id="errormsg">
	<?php $errormsg = $successmsg;?>
	<span class="notice_icon"></span> 
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php echo base_url('images/cross_grey_small.png');?>" />
	</a>
	<p><?php echo $errormsg; ?></p>
</div>
<?php endif;?>
<form method="post" action="" name="addbannerform" id="addbannerform" enctype="multipart/form-data">
    
    <p class="ft_title">Banner Pic</p>
    <p class="setft"><input type="file" name="pic" id="pic" value=""  class="adm_box1" /></p>
	
	
	<p class="ft_title">Title</p>
    <p class="setft"><input type="text" name="title" id="title" value=""  class="adm_box1" /></p>
	
    <div id="dynamic" style="margin-bottom:10px;width:100%;float:left;clear:both;">
					
						</div>
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">Submit</a></p>
</form>

	
		<style>
	.myown {
    border: 1px solid #ececec;
    display: inline;
    float: left;
    height: 155px;
    text-align: center;
    width: 164px;
}
		.credit
		{
			color: #666666;
    display: block;
    float: left;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 10pt;
    margin: 22px 0 10px;
    text-transform: uppercase;
    width: 100%;
		}
		.by-btn
{
  background: url("<?php echo base_url();?>images/by-btn-bg.jpg") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    color: #fff;
    display: inline-block;
    height: 28px;
    line-height: 26px;
    text-align: center;
    width: 74px;
	
}

</style>

<script type="text/javascript">
function checkform(){
	$('#addbannerform').submit();
}
setTimeout('showmenu("pcontent",6)',1000);
</script>