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

	<p class="ft_title">Container</p>
	<p class="setft">
		<select name="container" id="container" >
			<option value="1" <?php if($ad['container']=='1'){echo 'selected="selected"';} ?>>Container 1</option>
			<option value="2" <?php if($ad['container']=='2'){echo 'selected="selected"';} ?>>Container 2</option>
			<option value="3" <?php if($ad['container']=='3'){echo 'selected="selected"';} ?>>Container 3</option>
			
		</select></p>
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
	
	<p class="ft_title">Status</p>
	<p class="setft">
		<select name="status" id="status" >
			<option value="Active" <?php if($ad['status']=='Active'){echo 'selected="selected"';} ?>>Active</option>
			<option value="Deactive" <?php if($ad['status']=='Deactive'){echo 'selected="selected"';} ?>>Deactive</option>
			
			
		</select></p>
	<?php 
	$user=$this->session->userdata['roleId'];
	if($user == 1002){
	 ?>
    <p class="ft_title">EXP Date</p>
    <p class="setft"><input type="text" name="expDate" id="expDate" value="<?php echo date("Y-m-d", strtotime($ad['expdate'])); ?>"  class="adm_box1"/></p>
	<?php  
	}
	?>		
		
		
    <!-- added dropdown for position for advertisement BY TECHNO-SANJAY -->

	
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">Submit</a>
	 <a href="<?php echo site_url('admin/advertise_list')  ?>"  class="button">Close</a>
	 </p>
</form>


<script type="text/javascript">

function checkform(){
	$('#addAdform').submit();
}
$("#expDate").datepicker({ dateFormat: 'yy-mm-dd' } );
setTimeout('showmenu("ad1",0)',1000);
</script>
</body>
</html>