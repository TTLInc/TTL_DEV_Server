<?php $this->layout->setLayoutData('content_for_layout_title','Category');?> 
<?php if(@$errormsg):?>
	<div class="notice_4 notice_6" id="errormsg">
		<span class="notice_icon notice_icon6"></span> 
		<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<!--<img src="<?php //echo base_url('images/arow-right.png');?>" />-->
		</a>
		<p><?php echo $errormsg; ?></p>
	</div>
<?php elseif(@$succrmsg):?>
	<div class="notice_4 notice_6" id="errormsg" style="background: none repeat scroll 0 0 green !important;color: #FFFFFF !important;">
		<span class="notice_icon6"></span> 
		<a class="notice_icon6 " href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<!--<img src="<?php //echo base_url('images/arow-right.png');?>" />-->
		</a>
		<p ><?php echo $succrmsg; ?></p>
	</div>
<?php endif;?>
<form method="post" action="" name="addcatform" id="addcatform" enctype="multipart/form-data">
	<!--<p class="ft_title">Language</p>
	<p class="setft">
		<select name="lang" id="position">
			<option value="3">English</option>
			<option value="1">CN Simplified</option>
			<option value="2">CN Traditional</option>
			<option value="5">Japanese</option>
			<option value="6">Korean</option>
			<option value="7">Portuguese</option>
			<option value="8">Spanish</option>
			<option value="4">French</option>
		</select>
	</p>-->
	<p class="ft_title">Category</p>
	<p class="setft">
		<input type="text" name="category" id="category" class="adm_box1" />
	</p>
	<span id="catreq" class="err" style="display:none;">Enter Catagory</span>
	<div id="pSection">
		<p class="ft_title">PDF Title</p>
		<p class="setft" ><input type="text" name="ptitle" id="ptitle" class="adm_box1" /></p>
		<span class="err" id="titlereq" style="display:none;">Enter Title</span>
		<p class="ft_title">PDF</p>
		<p class="setft"><input type="file" name="pfile" id="pfile"    class="adm_box1" /></p>
		<span class="err" id="pdfreq" style="display:none;">Select PDF File</span>
		<!--<p class="ft_title">Description</p>
		<p class="setft"><textarea rows="8" cols="70"  name="Description" id="Description"></textarea></p>
		<span class="err" id="descereq" style="display:none;">Enter Description</span>-->
	</div>
	<p class="ft_title">Status</p>
    <p class="setft"><input type="radio" name="status" value="1"  checked="checked"/>Active
    <input type="radio" name="status" value="0"  />Inactive </p>
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>
<style>
.err
{
	color:red;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('input:file').change(function(e) {
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
});
 
function checkform(){
	if($('#category').val() == '') {
		$('#catreq').show();
		return false;
	} else {
		$('#catreq').hide();
	}		 
	
	/*if($('#Title').val() == '')
	{ 
		$('#titlereq').show();
		 return false;
	}
	else
	{
		$('#titlereq').hide();
		 
	} 
	if($('#pfile').val() == '')
	{ 
		$('#pdfreq').show();
		return false;
	}
	else
	{
		$('#pdfreq').hide();
		 
	}
	if($('#Description').val() == '')
	{ 
		$('#descereq').show();
		return false;
	}
	else
	{
		$('#descereq').hide();
		 
	}*/
	$('#addcatform').submit();
} 
setTimeout('showmenu("pcontent",18)',1000);
</script>
</body>
</html>