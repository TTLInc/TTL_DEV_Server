<?php $this->layout->setLayoutData('content_for_layout_title','Edit Category');?>
<?php if(@$errormsg):?>
	<div class="notice_4 notice_6" id="errormsg">
		<span class="notice_icon notice_icon6"></span> 
		<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		</a>
		<p><?php echo $errormsg; ?></p>
	</div>
<?php elseif(@$succrmsg):?>
	<div class="notice_4 notice_6" id="errormsg" style="background: none repeat scroll 0 0 green !important;color: #FFFFFF !important;">
	<span class="notice_icon6"></span> 
	<a class="notice_icon6 " href="javascript:void(0);" onclick="$('#errormsg').hide()">
	</a>
	<p ><?php echo $succrmsg; ?></p>
	</div>
<?php endif;?>

<form method="post" action="" name="editTresourcesform" id="editTresourcesform" enctype="multipart/form-data">
	<?php /*<p class="ft_title">Language</p>
	<p class="setft">
	<select name="lang" id="position" >	
	<option <?php if($EditData['lang']==3) {?>selected <?php }?> value="3">English</option>
	<option <?php if($EditData['lang']==1) {?>selected <?php }?>value="1">CN Simplified</option>
	<option <?php if($EditData['lang']==2) {?>selected <?php }?> value="2">CN Traditional</option>
	<option <?php if($EditData['lang']==5) {?>selected <?php }?> value="5">Japanese</option>
	<option <?php if($EditData['lang']==6) {?>selected <?php }?> value="6">Korean</option>
	<option <?php if($EditData['lang']==7) {?>selected <?php }?> value="7">Portuguese</option>
	<option <?php if($EditData['lang']==8) {?>selected <?php }?> value="8">Spanish</option>
	<option <?php if($EditData['lang']==4) {?>selected <?php }?> value="4">French</option>	
	</select></p>*/?>
	<p class="ft_title">Category</p>
	<p class="setft">
	<input type="text" name="category" id="category" class="adm_box1" value="<?php echo $EditData['category'];?>" />
	<span id="catreq" class="err" style="display:none;">Enter Catagory</span>
	<div id="vSection"  >
		<p class="ft_title">PDF Title</p>
		<p class="setft"><input type="text" name="ptitle" id="ptitle" value="<?php echo $EditData['ptitle'];?>"  class="adm_box1" /></p>
		<span class="err" id="titlereq" style="display:none;">Enter Title</span>
		<p class="ft_title">PDF</p>
		<p class="setft"><input type="file" name="pfile" id="pfile"  class="adm_box1" /></p>
		<span class="err" id="pdfreq" style="display:none;">Select PDF File</span>
	</div>
	<p class="ft_title">Status</p>
	<p class="setft">
		<input type="radio" name="status" value="1" <?php if($EditData['status']=='1'){echo 'checked';} ?>/>Active
		<input type="radio" name="status" value="0" <?php if($EditData['status']=='0'){echo 'checked';} ?> />Inactive 
	</p>
	<p class="setft" style="margin-top:15px;"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a>
	<a style="margin-left:20px;" href="<?php echo base_url('admin/listcategories');?>" onclick="checkform()" class="button">Cancel</a>
</p>
</form>

<style>
.err
{
	color:red;
}
</style>
<script type="text/javascript">setTimeout('showmenu("pcontent",18)',1000);
('input:file').change(
    function(e) {
        var files = e.originalEvent.target.files;
        for (var i=0, len=files.length; i<len; i++){
            var n = files[i].name,
                s = files[i].size,
                t = files[i].type;
            if(t=='application/pdf')
			{
			}
			else
			{
				alert('Only PDF files allowed.');
				$('#pfile').val('');
			}		
        }
    });
function checkform(){
	if ($('#category').val() == '') {
		$('#catreq').show();
		return false;
	} else {
		  $('#catreq').hide();
	}	
	$('#editTresourcesform').submit();
}

function showResType(type){
	if(type == 'l'){
		$('#vSection').css('display', 'none');
		$('#lSection').css('display', 'block');
	}else{
		$('#vSection').css('display', 'block');
		$('#lSection').css('display', 'none');
	}
}

</script>
</body>
</html>