<?php $this->layout->setLayoutData('content_for_layout_title','Tutor Guide');?>
 
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




<form method="post" action="" name="addTresourcesform" id="addTresourcesform" enctype="multipart/form-data">
 	
	<p class="ft_title">Type</p>
	<p class="setft">
		<select name="type">
 
		<option value="p">PDF</option>
		</select>
	</p>
	
	
 <p class="ft_title">Language</p>
	<p class="setft">
	<select name="lang" id="position" >
	
	<option value="3">English</option>
	<option value="1">CN Simplified</option>
	<option value="2">CN Traditional</option>
	<option value="5">Japanese</option>
	<option value="6">Korean</option>
	<option value="7">Portuguese</option>
	<option value="8">Spanish</option>
	<option value="4">French</option>
	</select></p>

	
	
	 <p class="ft_title">categories</p>
	<p class="setft">
	<select name="categories" id="categories">
	<option value="sel"> Select</option>
	<?php for($i=0;$i<count($cat);$i++)
	{?>
	<option value="<?php echo $cat[$i]['guide_categories_id'];?>"> <?php echo $cat[$i]['name']?></option>
	<?php }?>
	</select></p>
	<span id="catreq" class="err" style="display:none;">select catagory</span>

	
	 <p class="ft_title">Display Order</p>
	<p class="setft">
	<select name="orderNo" id="orderNo">
	
	<?php for($i=1;$i<=10;$i++)
	{?>
	<option value="<?php echo $i; ?>"> <?php echo $i;?></option>
	<?php }?>
	</select></p>
	
	
	<div id="pSection">
	<p class="ft_title">PDF Title</p>
	<p class="setft" ><input type="text" name="Title" id="Title"    class="adm_box1" /></p>
	<span class="err" id="titlereq" style="display:none;">Enter Title</span>
	<p class="ft_title">PDF</p>
	<p class="setft"><input type="file" name="pfile" id="pfile"    class="adm_box1" /></p>
	<span class="err" id="pdfreq" style="display:none;">Select PDF File</span>
	<p class="ft_title">Description</p>
   	<p class="setft"><textarea rows="8" cols="70"  name="Description" id="Description"></textarea></p>
	
	<span class="err" id="descereq" style="display:none;">Enter Description</span>
	</div>
	<p class="ft_title">Status</p>
    <p class="setft"><input type="radio" name="Status" value="1"  checked="checked"/>Active
    <input type="radio" name="Status" value="0"  />Inactive </p>
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>

</form>

<style>
.err
{
	color:red;
}
</style>
<script type="text/javascript">

 $('input:file').change(
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
	 
	 if($('#categories').val() == 'sel')
	 {
		 $('#catreq').show();
		 return false;
	 }
	 else
	 {
		  $('#catreq').hide();
	 }		 
	 
	if($('#Title').val() == '')
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
		 
	}
	
	 
	$('#addTresourcesform').submit();
}
 
setTimeout('showmenu("pcontent",18)',1000);
</script>
</body>
</html>