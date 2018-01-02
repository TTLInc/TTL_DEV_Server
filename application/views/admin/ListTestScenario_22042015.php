<?php $this->layout->setLayoutData('content_for_layout_title','TestScenarios list');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<a href="'.base_url('admin/AddTestScenario').'">Add Test Scenario</a>');?>

<table class="data_table">
	<thead>
		<tr>
			<th><input type="checkbox" class="check-all" /></th>
			<th>Title</th>
			<th>Type of resource</th>
			<th>PDF</th>
			<th>Description</th>
			<th>Status</th>
			<th>Options</th>
		</tr>
	</thead>

	<tbody>
	<?php $j = 0; foreach ($TetsScenario as $key => $val) :?>
	<tr id="id_<?php echo $val['test_scenario_id'];?>">
		<td><input type="checkbox" name="ids[]" value="<?php echo $val['test_scenario_id'];?>" /></td>		
		<td><?php  echo $val['Title']?></td>
		<td><?php if($val['rtype'] == "T") { echo "Tutor";} else { echo "Student";}?></td>
		<td><?php if($val['pfile'] != "") { echo $val['pfile'];} else { echo '-';}?></td>
		<td>
	
		<?php if($val['Description'] != "")
		{ 
		echo $val['Description'];
		}
		?></td>
		
		
		<td><?php if($val['Status'] == 1){ echo 'Active'; } else{ echo 'Inactive';}?></td>
		
		<td>
		<a href="<?php echo base_url('admin/EditTestScenario/id/'.$val['test_scenario_id']);?>"><img alt="Edit" src="<?php echo base_url('/images/cm_pencil.png');?>" /></a>
		<a href="javascript:void(0);" class="delcat" mid="<?php echo $val['test_scenario_id']; ?>"><img alt="delete" src="<?php echo  base_url('images/cm_cross.png')?>" /></a> 
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
	
	<tfoot>
	<tr>
	<td colspan="10">
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
	setTimeout('showmenu("TestScenarios",0)',1000);
	function del(_id){
		if(window.confirm('Are you sure you want to delete this?')){
			$.post('<?php echo Base_url("admin/DleteTestSAcenario")?>',{id:_id},function(msg){
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