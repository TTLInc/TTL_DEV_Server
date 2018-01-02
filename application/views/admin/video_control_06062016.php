<?php $this->layout->setLayoutData('content_for_layout_title','Video Control');?>
<?php //$this->layout->setLayoutData('content_for_layout_links','<a href="'.base_url('admin/dashboardmessages_add').'">Add new Message</a>');?>
<table class="data_table">
	<thead>
        <tr>
			<th><input type="checkbox" class="check-all" /></th>
            <th>Id</th>
            <th>Video Title</th>
            <th>Description</th>
			<th>User Name</th>
            <th>Post Date</th>
			<th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php $j = 0; foreach ($videos as $key => $val) :?>
        <tr id="id_<?php echo $val['id'];?>">
			<td><input type="checkbox" name="ids[]" value="<?php echo $val['id'];?>" /></td>
            <td><?php echo $val['id'];?></td>
			<td><?php echo $val['name'];?></td>
            <td><?php echo $val['desc'];?></td>
			<td><?php echo $val['firstName']." ".$val['lastName'];?></td>
			<td><?php echo date('Y-m-d g:i A',strtotime($val['creat_at']));?></td>
            <td>
				<a href="javascript:void(0);" class="visUpdate" mid="<?php echo $val['id']; ?>">
					<?php
						if ($val['visibility']=='1') { 
							$vis = "Visible"; 
							$src = base_url('images/active_icon.png');
						} else { 
							$vis = "Invisible";
							$src = base_url('images/inactive_icon.png');
						}?>
					<img alt="<?php echo $vis;?>" title="<?php echo $vis;?>" src="<?php echo $src;?>" />
				</a>
				<a href="javascript:void(0);" class="delcat" uid="<?php echo $val['uid']; ?>" mid="<?php echo $val['id']; ?>">
					<img alt="delete" src="<?php echo  base_url('images/cm_cross.png')?>" /></a>
			</td>
        </tr>
	<?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6">
				<div class="bulk-actions align-left">
					<select name="dropdown" id="action">
						<option value="0">Choose an action...</option>
						<option value="1">Delete</option>
					</select> 
					<a href="javascript:void(0);" id="apply" class="button">Apply to selected</a>
				</div>
				<div class="pagination"><?php echo $pagination;?></div>
				<!-- End .pagination -->
				<div class="clear"></div>
            </td>
        </tr>
    </tfoot>
</table>
<script type="text/javascript">
setTimeout('showmenu("psettings",16)',1000);
function del(_id, _uid){
	if(window.confirm('Are you sure you want to delete this?')){
		$.post('<?php echo Base_url("admin/delvideo")?>',{'id':_id,'uid':_uid},function(msg){
			if (String == msg.constructor) {      
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			if(json.status){
				$.each(json.ids,function(k,v){
					$('#id_'+v).remove();
				})
				alert('Successfully deleted');
			}
			else{
				alert(json.msg);
			}
		})
	}
}
$(function(){
	$(".check-all").click(function() {
		$("input[name='ids[]']").attr('checked', this.checked);
	});
	$('#apply').click(function(){
		var _checked = $("input[name='ids[]']:checked");
		if($('#action').val() ==0 ){
			alert('Choose an action first');
			return;
		}
		if(_checked.size()>0){
			var _checkedVal = [];
			_checked.each(function(k,v){
				_checkedVal.push($(this).val());
			})
			del(_checkedVal)
		}
		else{
			alert('Must check one item.');
			return;
		}
	});
	$('.delcat').click(function(){
		del($(this).attr('mid'),$(this).attr('uid'));
	});
	
	$('.visUpdate').click(function(){
		var vid = $(this).attr("mid");
		$.post('<?php echo Base_url("admin/chngvideostatus")?>',{'id':$(this).attr("mid")},function(){
			if ($('#id_'+vid+' .visUpdate img').attr("alt")=='Invisible') { 
				vis = "Visible"; 
				src = '<?php echo base_url('images/active_icon.png');?>';
			} else { 
				vis = "Invisible";
				src = '<?php echo base_url('images/inactive_icon.png');?>';
			}
			$('#id_'+vid+' .visUpdate img').attr({"src":src,"alt":vis,"title":vis});
			alert('Successfully Updated');
		});
	});
})
</script>
</body>
</html>