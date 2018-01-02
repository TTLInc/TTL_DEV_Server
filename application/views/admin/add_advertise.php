<?php $this->layout->setLayoutData('content_for_layout_title','Add advertisement');?>
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
<form method="post" action="" name="addAdform1" id="addAdform1" enctype="multipart/form-data">
    
	<p class="ft_title">Container</p>
	<p class="setft">
	<select name="container" id="position" >
	<option value="1">  Container 1      </option>
	<option value="2">  Container 2      </option>
	<option value="3">  Container 3       </option>
	</select></p>
	<p class="ft_title">Title</p>
    <p class="setft"><input type="text" name="title" id="title" value=""  class="adm_box1" /></p>
    <p class="ft_title">Image <span>(Ideal image width and height should be 350px by 265px and upload only jpg,gif or png file.)</span></p>
    <p class="setft">
		<input type="file" name="image" id="image" value=""  class="adm_box1" />
		
	</p>
    <p class="ft_title">Link</p>
    <p class="setft"><input type="text" name="link" id="link" value=""  class="adm_box1" /></p>
    <p class="ft_title">Desc</p>
    <p class="setft"><textarea name="desc" id="desc"></textarea></p>
    <!-- added dropdown for position for advertisement BY TECHNO-SANJAY-->
		<?php 
	$user=$this->session->userdata['roleId'];
	if($user == 1002){
	 ?>

	<p class="ft_title">EXP Date</p>
    <p class="setft"><input type="text" name="expDate" id="expDate"   class="adm_box1"/></p>
    <?php }?>	
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">
function checkform(){
	$('#addAdform1').submit();
}
$("#expDate").datepicker({ dateFormat: 'yy-mm-dd' } );
setTimeout('showmenu("pcontent",5)',1000);
</script>
</body>
</html>