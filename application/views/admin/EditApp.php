<?php $this->layout->setLayoutData('content_for_layout_title','Edit APP');?>
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
<form method="post" action="" name="addAdform" id="addAdform" enctype="multipart/form-data">

 
    <p class="ft_title">Title</p>
    <p class="setft"><input type="text" name="Title" id="Title" value="<?php echo $ad['Title'];?>"  class="adm_box1" /></p>
     <span class="valError" id="terror" style="display:none">Enter Title </span>
	<p class="ft_title">Image</p>
    <p class="setft">
        <input type="file" name="image" id="image" value=""  class="adm_box1" />
        <p>
            <img src="<?php echo base_url('LanuageApp/'.$ad['Source']);?>" width="245px" />
        </p>
    </p>
    <p class="ft_title">Link<span>(www.example.com)</span></p>
    <p class="setft"><input type="text" name="Link" id="Link" value="<?php echo $ad['Link'];?>"  class="adm_box1" /></p>
    <span class="valError" id="lerror" style="display:none">Enter Link </span>
	<p class="ft_title">Desc</p>
    <p class="setft"><textarea name="Desc" id="Desc"><?php echo $ad['Desc'];?></textarea></p>
	
	 
	 
 

	
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">Submit</a>
	 <a href="<?php echo site_url('admin/LanguageApp')  ?>"  class="button">Close</a>
	 </p>
</form>


<script type="text/javascript">

function checkform(){
	if($("#Title").val()=='')
		{
			$('#terror').show(); 
			return false;
		}
		else
		{
			$('#terror').hide(); 
		}
		
		if($("#Link").val()=='')
		{
			$('#lerror').show(); 
			return false;
		}
		else
		{
			$('#lerror').hide(); 
		}
	$('#addAdform').submit();
}
setTimeout('showmenu("apps",0)',1000);
</script>
</body>
</html>