<?php $this->layout->setLayoutData('content_for_layout_title','School Advertisement list');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<a href="'.base_url('admin/school_advertise').'">Add new Advertisement</a>');?>

<table class="data_table">
    <thead>
        <tr>
            <th><input type="checkbox" class="check-all" /></th>
            <th>Language</th>
            <th>Name</th>
            
            <th>Image</th>
			
			
			
            <th>Options</th>
        </tr>
    </thead>
<?php 

		?>
    <tbody>
    <?php foreach ($adddata as $key => $val) :?>
        <tr id="id_<?php echo $val['id'];?>">
            <td><input type="checkbox" name="ids[]" value="<?php echo $val['id'];?>" /></td>
            <td>
			<?php
			switch($val['lang']){
			
			case 1:
			    echo "En";
				break;
			case 2:
				 echo "Kr";
					break;
			case 3:
				 echo "Ch";
					break;		
			case 4:
				 echo "Jp";
					break;		
			case 5:
				 echo "Pt";
					break;
			case 6:
				 echo "Tw";
					break;
			case 7:
				 echo "Es";
					break;				
			}
			?>
			</td>
            <td><?php echo $val['title'];?></td>
            
            <td><img src="<?php echo base_url('uploads/images/ad/'.$val['source']);?>" width="auto" height="100px"/></td>
            

			
			
			<td>
			
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

            <div class="pagination">
            
            </div>
            <!-- End .pagination -->
            <div class="clear"></div>
            </td>
        </tr>
    </tfoot>
</table>
<script type="text/javascript">
setTimeout('showmenu("schadd",0)',1000);
function del(_id){
	if(window.confirm('Are you sure you want to delete this?')){
		$.post('<?php echo Base_url("admin/schoolAdd_del")?>',{id:_id},function(msg){
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
		del([$(this).attr('mid')]);
	})
})
</script>
</body>
</html>
