<?php $this->layout->setLayoutData('content_for_layout_title','Edit Question');?>
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
					if($document['id'] == $question['docid'])
					{
						$dsel = 'selected';
					}else{
						$dsel = '';
					}
					echo '<option value="'.$document['id'].'" '.$dsel.'>'.$document['title'].'</option>';
				}
			}
		?>
		</select>
	</p>
    <p class="ft_title">Question</p>
    <p class="setft"><input type="text" name="question" id="question" value="<?php echo $question['question']; ?>" class="adm_box1" style="width:50% !important;" /></p>
	<p class="ft_title">Option 1</p>
    <p class="setft"><input type="text" name="ans1" id="ans1" value="<?php echo $question['ans1']; ?>" class="adm_box1" /></p>
	<p class="ft_title">Option 2</p>
    <p class="setft"><input type="text" name="ans2" id="ans2" value="<?php echo $question['ans2']; ?>" class="adm_box1" /></p>
	<p class="ft_title">Option 3</p>
    <p class="setft"><input type="text" name="ans3" id="ans3" value="<?php echo $question['ans3']; ?>" class="adm_box1" /></p>
	<p class="ft_title">Option 4</p>
    <p class="setft"><input type="text" name="ans4" id="ans3" value="<?php echo $question['ans4']; ?>" class="adm_box1" /></p>
	<p class="ft_title">Answer</p>
    <p class="setft">
		<input type="radio" name="rans" id="rans" value="1" <?php if($question['rans'] == 1)echo 'checked' ?>/>Option 1
		<input type="radio" name="rans" id="rans" value="2" <?php if($question['rans'] == 2)echo 'checked' ?> />Option 2
		<input type="radio" name="rans" id="rans" value="3" <?php if($question['rans'] == 3)echo 'checked' ?>/>Option 3
		<input type="radio" name="rans" id="rans" value="4"  <?php if($question['rans'] == 4)echo 'checked' ?>/>Option 4
	</p>
	
	
    <p class="ft_title">Status</p>
    <p class="setft"><input type="radio" name="status" value="active" <?php if($question['status'] == 'active')echo 'checked' ?> />Active
    <input type="radio" name="status" value="inactive" <?php if($question['status'] == 'inactive')echo 'checked' ?> />Inactive </p>
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