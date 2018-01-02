<?php $this->layout->setLayoutData('content_for_layout_title','Rewards');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<div style="float:left;font-weight:bold;"><input style="width:22%;padding:4px;float:left;margin-right: 5px;" class="adm_box1" type="text" placeholder="select date" value="'.$dsearch.'" name="dsearch" id="events_widget" /><input style="width:23%;padding:4px;float:left;margin-right: 5px;" class="adm_box1" type="text" value="'.$search.'" name="search" id="search" /><a href="javascript:void(0);" class="button submit-search" style="height:17px;line-height:19px;">Search</a> </div>');?>
<?php $this->layout->appendFile('javascript',"js/jquery.mtz.monthpicker.js");?>

<table class="data_table">
    <thead>
        <tr>
            
			<th>
				User Id
			</th>
			<th>Name</th>
			<th>Date</th>
			<th>Amount</th>
            <th>Redemption</th>
			<th>Option</th>
        </tr>
    </thead>
	<tbody>
	
	<?php 
		foreach($data as $reward => $value) 
		{ ?>	
		<tr id="id_<?php echo $value->id;?>"> 
			<td><?php echo $value->userId; ?></td>
			<td><?php echo $value->Name; ?></td>
			<td><?php echo  $value->date; ?> </td>
			<td><?php echo $value->amount; ?></td>
			<td><?php echo $value->redemption; ?></td>
			<td> <a href="javascript:void(0);" class="delcat" mid="<?php echo $value->id; ?>"><img alt="delete" src="<?php echo  base_url('images/cm_cross.png')?>" /></a></td>
		</tr>
	<?php	}
	?>
	</tr>
    </tbody>
    <tfoot>
	
        <tr>
            <td colspan="8">

            <div class="pagination">
            <?php //echo $page;?>
            </div>
            <!-- End .pagination -->
            <div class="clear"></div>
            </td>
			
        </tr>
    </tfoot>
</table>
<script>
setTimeout('showmenu("financial",1)',1000);
function del(_id){
	if(window.confirm('Are you sure you want to delete this?')){
		$.post('<?echo base_url("admin/rewa_del")?>',{id:_id},function(msg){
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
		del([$(this).attr('mid')]);
	});

</script>