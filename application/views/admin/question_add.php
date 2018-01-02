<?php $this->layout->setLayoutData('content_for_layout_title','Add Question');?>
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
	<p ><?php echo $succrmsg; 
	
	?></p>
</div>
<?php endif;?>
<form method="post" action="" name="addQuestionform" id="addQuestionform" enctype="multipart/form-data">
    <p class="ft_title">Select Document</p>
    <p class="setft">
		<select name="docid" id="docid" class="adm_box1"  style="width:40% !important;">
		<?php 
			if(count($documents)>0)
			{
				foreach($documents as $document)
				{
					echo '<option value="'.$document['id'].'">'.$document['title'].'</option>';
				}
			}
		?>
		</select>
	</p>
    <p class="ft_title">Question</p>
    <p class="setft"><input type="text" name="question" id="question" value="" class="adm_box1" style="width:50% !important;" /></p>
	<p class="ft_title">Option 1</p>
    <p class="setft"><input type="text" name="ans1" id="ans1" value="" class="adm_box1" /></p>
	<p class="ft_title">Option 2</p>
    <p class="setft"><input type="text" name="ans2" id="ans2" value="" class="adm_box1" /></p>
	<p class="ft_title">Option 3</p>
    <p class="setft"><input type="text" name="ans3" id="ans3" value="" class="adm_box1" /></p>
	<p class="ft_title">Option 4</p>
    <p class="setft"><input type="text" name="ans4" id="ans3" value="" class="adm_box1" /></p>
	<p class="ft_title">Answer</p>
    <p class="setft">
		<input type="radio" name="rans" id="rans" value="1" checked  />Option 1
		<input type="radio" name="rans" id="rans" value="2"  />Option 2
		<input type="radio" name="rans" id="rans" value="3" />Option 3
		<input type="radio" name="rans" id="rans" value="4"  />Option 4
	</p>
	
	
    <p class="ft_title">Status</p>
    <p class="setft"><input type="radio" name="status" value="active" checked="checked" />Active
    <input type="radio" name="status" value="inactive"  />Inactive </p>
	<p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>


<script type="text/javascript">
function checkform(){
	$('#addQuestionform').submit();
}
setTimeout('showmenu("lmstracking",1)',1000);
</script>
</body>
</html>