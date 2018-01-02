<?php $this->layout->setLayoutData('content_for_layout_title','Add Topic');?>
<script type="text/javascript">
<!--
	function checkform(){
		$('#topic_create').submit();
	}
	$(document).ready(function(){
		$("#topic_create").submit(function(){
			if($("#title").val() == "") {
				alert("<?php echo addslashes("Title cannot be empty") ?>");
				return false;
			}
		});
});
//-->
</script>
<!--
<div class="leftmenu">
	<h1 id="pageinfo"><?php echo "Information";?></h1>
		<ul id="tabs" class="quickmenu">
			<li><a href="#one"><?php echo "Details";?></a></li>
			<li><a href="#two"><?php echo "Administrators";?></a></li>
		</ul>
		<div class="quickend"></div>
</div>
-->
<?php if ($notice = $this->session->flashdata('notification')):?>
 <div class="notice_4 notice_6" id="errormsg">
	<span class="notice_icon notice_icon6"></span> 
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php //echo base_url('images/arow-right.png');?>" />
	</a>
	<p><?php echo $notice;?></p>
</div>
<?php endif;?>

<form class="edit" id="topic_create" method="post" action="<?php echo site_url('admin/topic/save') ?>">
<input type='hidden' name='tid' value="<?php echo $topic['tid'] ?>" />

<p class="ft_title">Category :
		<select name="category" id="category">
		<option value="TheTalklist - Official announcements">TheTalklist - Official announcements </option>
		<option value="General Discussion - Questions and help">General Discussion - Questions and help</option>
		</select>
</p>


<p class="ft_title"><?php echo "Title:";?></p>
<p class="setft"><input type="text" id="title" name="title" value="<?php echo $topic['title'] ?>" class="adm_box1"/></p>
<p class="ft_title"><?php echo "Description:"; ?></p>
<p class="setft"><textarea name="description" id="description" class="input-text"><?php echo $topic['description'] ?></textarea></p>
<p class="ft_title"><?php echo "Tags:";?></p>
<p class="setft"><input type="text" id="tags" name="tags" value="<?php echo $topic['tags'] ?>" class="adm_box1"/></p>



<p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a></p>
</form>
<script type="text/javascript">
setTimeout('showmenu("psettings",4)',1000);
</script>
