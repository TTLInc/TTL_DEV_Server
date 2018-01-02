<?php $this->layout->setLayoutData('content_for_layout_title','User Notes');?>
<?php// $this->layout->setLayoutData('content_for_layout_links','<div style="float:left;margin-right:110px;font-weight:bold;"><input style="width:55%;padding:4px;float:left;margin-right: 5px;" class="adm_box1" type="text" value="'.$search.'" name="search" id="search" /><a href="javascript:void(0);" class="button submit-search" style="height:17px;line-height:19px;">Search</a> </div>');?>
<?php $currentUrl = base_url('admin/get_user_note/id/'.$id.'/');?>

<div class="exp-btn"><a href="javascript:void(0);" onclick="history.back(-1)">Back</a></div>
<table class="data_table">

	<?php if($usernotes){ ?>
	<thead>
		<tr>
			<th class="rw2">
				<div class="rw2">
				Date
				<?php if($sortorder == 'asc' && $sort == 'add_date'): ?>
				<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/add_date'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/add_date'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
				</div>
			</th> 
			
			
			<th class="rw2">
				<div class="rw2">
				Role
				<?php if($sortorder == 'asc' && $sort == 'role'): ?>
				<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/role'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/role'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
				</div>
			</th> 
			
			
			<th class="rw2">
				<div class="rw2">
				Note
				<?php if($sortorder == 'asc' && $sort == 'note'): ?>
				<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/note'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/note'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
				</div>
			</th> 
			
			<th class="rw2">
				<div class="rw2">
				Note ID
				<?php if($sortorder == 'asc' && $sort == 'dispute_id'): ?>
				<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/dispute_id'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/dispute_id'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
				</div>
			</th> 
		</tr>
	</thead>

	<tbody>
	<?php 
	foreach ($usernotes as $key => $val) :?>
	<tr id="id_<?php echo $val['id'];?>">
	<td class="rw1"><div class="rw1"><?php echo date('Y-m-d H:i:s',strtotime($val['add_date']));?></div></td>
	<td class="rw2"><div class="rw2"><?php echo $val['role'];?></div></td>
	<td class="rw3"><div class="rw3"><?php echo $val['note'];?></div></td>
	<td class="rw4"><div class="rw4"><?php echo $val['dispute_id'];?></div></td>
	</tr>
	<?php endforeach; ?>
	</tbody>
<tfoot>
<tr>
<td colspan="8">

<div class="pagination">
<?php echo $page;?>
</div>
<!-- End .pagination -->
<div class="clear"></div>
</td>

</tr>
</tfoot>
<?php }else{ ?>
No notes has been added for this user.
<?php } ?>
</table>

<?php if(@$errormsg):?>
 <div class="notice_4" id="errormsg">
	<span class="notice_icon"></span> 
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php echo base_url('images/cross_grey_small.png');?>" />
	</a>
	<p><?php echo $errormsg; ?></p>
</div>
<?php endif;?>
<form method="post" action="" name="edituserform" id="edituserform" enctype="multipart/form-data">
    <p class="ft_title">Note ID</p>
    <p class="setft"><input type="text" name="dispute_id" id="dispute_id" value="<?php if(isset($user['dispute_id'])) {echo $user['countryName'];}?>"  class="adm_box1"/></p>
	<p class="ft_title">Note</p>
   	<p class="setft"><textarea rows="8" cols="70"  name="note" id="note"></textarea></p>
    <p class="setft"><a href="javascript:void(0)" onclick="checkform()" class="button">submit</a>
    <a href="javascript:void(0)" class="button" onclick="history.back(-1)">back</a></p>
</form>


<script type="text/javascript">
function checkform(){
	$('#edituserform').submit();
}
setTimeout('showmenu("usermenu",0)',1000);
</script>
<style>.data_content{ padding:20px 10px;}
.data_table th, .data_table td{ padding:5px 0px;}</style>
</body>
</html>
