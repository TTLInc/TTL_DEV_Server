<?php $this->layout->setLayoutData('content_for_layout_title','Static Article Change');?>

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
    <input type="hidden" name="id" id="id" value="<?php echo $article['id'];?>"  class="adm_box1" />
	<p class="ft_title">Title</p>
    <p class="setft"><?php echo $article['title'];?><!--<input type="text" name="title" id="title" value=""  class="adm_box1" />--></p>
    
    <p class="ft_title">Desc</p>
    <p class="setft"><?php echo $ckEditor->editor('desc',$article['desc']);?></p>
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">
function checkform(){
	$('#articleform').submit();
}
setTimeout('showmenu("pcontent",6)',1000);
</script>
</body>
</html>