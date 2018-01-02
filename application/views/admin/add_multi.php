<?php $this->layout->setLayoutData('content_for_layout_title','Add Multilingual');?>

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
	<p class="ft_title">Name</p>
    <p class="setft"> <input type="text" name="name" id="name" value=""  class="adm_box1" /></p>
    
    <p class="ft_title">English</p>
    <p class="setft"><?php echo $ckEditor->editor('en','');?></p>
    
    <p class="ft_title">Korean</p>
    <p class="setft"><?php echo $ckEditor->editor('kr','');?></p>
    
    <p class="ft_title">Chinese</p> 
    <p class="setft"><?php echo $ckEditor->editor('ch','');?></p>
    
    <p class="ft_title">Japanese</p>
    <p class="setft"><?php echo $ckEditor->editor('jp','');?></p>
    
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">
function checkform(){
	$('#articleform').submit();
}
setTimeout('showmenu("langs",1)',1000);</script>
</body>
</html>