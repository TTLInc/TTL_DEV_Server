<?php $this->layout->setLayoutData('content_for_layout_title','Review list');?>
<?php //$this->layout->setLayoutData('content_for_layout_links','<a href="'.base_url('admin/messaging_send').'">Send New Message</a> <a style="margin-left:10px;" href="'.base_url('admin/messaging_affiliate_send').'">Send New Affiliate Message</a>');?>

<table class="data_table">
    <thead>
        <tr>
            <!--<th><input type="checkbox" class="check-all" /></th>-->
            <!--<th>Id</th>-->
            <th>Tutor</th>
            <th>Student</th>
            <th>Review Message</th>
			<th>Date</th>
            <th>Status</th>
            <th>Action</th>
            
           
        </tr>
    </thead>

    <tbody>
	<?php 
	// echo '<pre>';
	// print_r($reviews);
	// exit;
	?>
    <?php $j = 0; foreach ($reviews as $key => $val) :
		//echo $val;//exit;
	?>
        <tr id="id_<?php echo $val['id'];?>">
            <!--<td><input type="checkbox" name="ids[]" value="<?php echo $val['id'];?>" /></td>-->
            
			<td><?php echo $val['tutor'];?></td>
            <td><?php echo $val['student'];?></td>
            <td>
				<?php echo $val['msg'];?>
			</td>
			<td>
				<?php echo date('Y-m-d h:i A', strtotime($val['create_at']));;?>
			</td>
			<td>
				<?php if($val['status'] == 1): ?>
					<a href="javascript:void(0);" class="statusupdate" mid="<?php echo $val['id']; ?>" sid ="0" style="color:green;" >Visible</a>
					<input type="hidden" name="hstatus" id="hstatus" value="0" />
				<?php else: ?>
					<a href="javascript:void(0);" class="statusupdate" mid="<?php echo $val['id']; ?>" sid ="1" style="color:red;">Invisible</a>
					<input type="hidden" name="hstatus" id="hstatus" value="1" />
				<?php endif; ?>
				
			</td>
			 <td>
				<a href="javascript:void(0);" class="delcat" mid="<?php echo $val['id']; ?>"><img alt="delete" src="<?php echo  base_url('images/cm_cross.png')?>" /></a>
			 </td>
            <!--
			<td>
            <a href="<?php echo base_url('admin/dashboardmessages_edit/id/'.$val['id']);?>"><img alt="Edit" src="<?php echo base_url('/images/cm_pencil.png');?>" /></a>
            <a href="javascript:void(0);" class="delcat" mid="<?php echo $val['id']; ?>"><img alt="delete" src="<?php echo  base_url('images/cm_cross.png')?>" /></a> 
            </td>
			-->
        </tr>
	<?php endforeach; ?>
    </tbody>
    <tfoot>
	
        <tr>
            <td colspan="6">
            <div class="bulk-actions align-left">
			<span>Display</span>
            <select name="limit" id="limit" onchange="changelimit(this.value);">
                <option value="10" <?php if($limit == 10){echo 'selected="selected"';} ?>>10</option>
                <option value="20" <?php if($limit == 20){echo 'selected="selected"';} ?>>20</option>
                <option value="50" <?php if($limit == 50){echo 'selected="selected"';} ?>>50</option>
                <option value="100" <?php if($limit == 100){echo 'selected="selected"';} ?>>100</option>
             </select> 
             <!--<a href="javascript:void(0);" id="apply" class="button">Apply to selected</a>-->
			 </div>

            <div class="pagination">
				<?php echo $pagination; ?>
            </div>
            <!-- End .pagination -->
            <div class="clear"></div>
            </td>
        </tr>
    </tfoot>
</table>
<script type="text/javascript">
setTimeout('showmenu("psettings",15)',1000);
function del(_id){
	if(window.confirm('Are you sure you want to delete this?')){
		$.post('<?php echo Base_url("admin/review_del")?>',{id:_id},function(msg){
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

function changelimit(limit)
{
	window.location.href="<?php echo base_url().'admin/reviews/limit/'?>"+limit;
}
function statusupdate(_id,_status){
	
	//var _status = $('#hstatus').val();
	//alert(_status);return false;
	$.post('<?php echo Base_url("admin/review_status_update")?>',{id:_id,hstatus:_status},function(msg){
		if (String == msg.constructor) {      
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}
		if(json.status){
			window.location.reload();
		}
		else{
			alert(json.msg);
		}
	})
	
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
		del([$(this).attr('mid')]);
	})
	$('.statusupdate').click(function(){
		statusupdate([$(this).attr('mid')],[$(this).attr('sid')]);
	})
})
</script>


<script>
	
	$(function(){
		$('a@[href=#]').attr('href','javascript:void(0)');
		
	})

</script>


</body>
</html>
