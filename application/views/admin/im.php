<?php $this->layout->setLayoutData('content_for_layout_title','Instant Messaging'.'   [ unread : '.$unread.' ]');?>
<?php //$this->layout->setLayoutData('content_for_layout_links','<a href="'.base_url('admin/im_add').'">Add new FAQ</a>');?>

<table class="data_table">
	<thead>
		<tr>
			<th><input type="checkbox" class="check-all" /></th>
			<th>Id</th>
			<th>Question</th>
			<th>Status</th>
			<th>Options</th>
		</tr>
	</thead>

	<tbody>
	<?php $j = 0; foreach ($ims as $key => $val) :?>
	<tr id="id_<?php echo $val['id'];?>">
		<td><input type="checkbox" name="ids[]" value="<?php echo $val['id'];?>" /></td>
		<td><?php echo $val['id'];?></td>
		
		<td><a title="Click to answer" href="<?php echo base_url('admin/im_edit/id/'.$val['id']);?>"><?php if($val['ans'] == '--'){ echo "<strong>".$val['que']."</strong>";}else{echo $val['que'];}?></a></td>

		<td><?php if($val['status'] == 'ACTIVE'){ echo 'Active'; } else{ echo 'Inactive';}?></td>
		<td>
		<a href="<?php echo base_url('admin/im_edit/id/'.$val['id']);?>"><img alt="Edit" src="<?php echo base_url('/images/cm_pencil.png');?>" /></a>
		<a href="javascript:void(0);" class="delcat" mid="<?php echo $val['id']; ?>"><img alt="delete" src="<?php echo  base_url('images/cm_cross.png')?>" /></a> 
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
	<a href="javascript:void(0);" id="apply" class="button">Apply to selected</a></div>
	<div class="pagination"></div>
	<!-- End .pagination -->
	<div class="clear"></div>
	</td>
	</tr>
	</tfoot>

</table>
<script type="text/javascript">

	setTimeout('showmenu("im",1)',1000);
	function del(_id){
		if(window.confirm('Are you sure you want to delete this?')){
			$.post('<?php echo Base_url("admin/im_del")?>',{id:_id},function(msg){
				if (String == msg.constructor) {      
					eval ('var json = ' + msg);
				} else {
					var json = msg;
				}

				if(json.status){	
					$.each(json.ids,function(k,v){
						$('#id_'+v).remove();
					})
					alert('succeed.');
				}else{
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
			}else{
				alert('Must check one item.');
				return;
			}
		});
		
		$('.delcat').click(function(){
			del([$(this).attr('mid')]);
		})
	})
	
</script>
</body>
</html>