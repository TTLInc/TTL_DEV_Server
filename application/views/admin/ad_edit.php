<?php $this->layout->setLayoutData('content_for_layout_title','Edit advertisement');?>
<!-- fixed success msg style BY TECHNO-SANJAY -->
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
    <p class="setft"><input type="text" name="title" id="title" value="<?php echo $ad['title'];?>"  class="adm_box1" /></p>
    <p class="ft_title">Image</p>
    <p class="setft">
        <input type="file" name="image" id="image" value=""  class="adm_box1" />
        <p>
            <img src="<?php echo base_url('uploads/images/ad/'.$ad['source']);?>" width="245px" />
        </p>
    </p>
    <p class="ft_title">Link</p>
    <p class="setft"><input type="text" name="link" id="link" value="<?php echo $ad['link'];?>"  class="adm_box1" /></p>
    <p class="ft_title">Desc</p>
    <p class="setft"><textarea name="desc" id="desc"><?php echo $ad['desc'];?></textarea></p>
    <!-- added dropdown for position for advertisement BY TECHNO-SANJAY -->
	<p class="ft_title">Position</p>
	<p class="setft">
		<select name="position" id="position" >
			<option value="user-dashboard" <?php if($ad['position']=='user-dashboard'){echo 'selected="selected"';} ?>>User Dashboard</option>
			<option value="other" <?php if($ad['position']=='other'){echo 'selected="selected"';} ?>>Other</option>
		</select></p>
	
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a>
	<a href="<?php echo site_url('admin/ads')  ?>"  class="button">Close</a>
	</p>
</form>


<script type="text/javascript">
function checkform(){
	$('#addAdform').submit();
}
setTimeout('showmenu("ad",1)',1000);
</script>
</body>
</html>