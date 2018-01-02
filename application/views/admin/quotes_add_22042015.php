<?php $this->layout->setLayoutData('content_for_layout_title','Add Quotes');?>
<!-- fixed success msg style BY TECHNO-SANJAY -->

<?php if(@$errormsg):?>
 <div class="notice_4" id="errormsg">
	<span class="notice_icon"></span> 
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php echo base_url('images/cross_grey_small.png');?>" />
	</a>
	<p><?php echo $errormsg;
	
	
	
	?></p>

</div>
<?php elseif(@$succrmsg):?>
	<div class="notice_4 notice_6" id="errormsg" style="background: none repeat scroll 0 0 green !important;color: #FFFFFF !important;">
	<span class="notice_icon notice_icon6"></span> 
	<a class="notice_icon6 " href="javascript:void(0);" onclick="$('#errormsg').hide()">
		
	</a>
	<p ><?php echo $succrmsg; ?></p>

</div>
<?php endif;?>

<form method="post" action="" name="addQuteform" id="addQuteform" enctype="multipart/form-data">
 	<p class="ft_title">Quotes</p>
   	<p class="setft"><textarea name="quote" id="quote"></textarea></p>
   	<p class="ft_title">Quoted By</p>
    <p class="setft"><input type="text" name="quotedby" id="quotedby" value=""  class="adm_box1" /></p>
    <p class="ft_title">Status</p>
    <p class="setft"><input type="radio" name="status" value="active"  checked="checked"/>Active
    <input type="radio" name="status" value="inactive"  />Inactive </p>
	    
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">
function checkform(){
	$('#addQuteform').submit();
}
setTimeout('showmenu("quotes",1)',1000);
</script>
</body>
</html>