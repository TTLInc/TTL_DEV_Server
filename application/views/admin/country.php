<?php $this->layout->setLayoutData('content_for_layout_title','Country List');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<a href="'.base_url('admin/country_add/').'">Add new Country</a>');?>

<table class="data_table">
    <thead>
        <tr>
            <th><input type="checkbox" class="check-all" /></th>
            <th>Id</th>
            <th>Country</th>
			<th>Country_Code</th>
            <th>Options</th>
        </tr>
    </thead>

    <tbody>
	 <?php

        $sql='SELECT id,country, Country_Code FROM countries ';
        $query=mysql_query($sql);
        //var_dump($query);
        while($row=mysql_fetch_array($query)):?>

	        <tr id="id_<?php echo $row['id'];?>">
	            <td><input type="checkbox" name="ids[]" value="<?php echo $row['id'];?>" /></td>
	            <td><?php echo $row['id'];?></td>
	            <td><?php echo $row['country'];?></td>

				<td><?php echo $row['Country_Code'];?></td>

	            <td>
	            <a href="<?php echo base_url('admin/country_edit/id/'.$row['id']);?>"><img alt="Edit" src="<?php echo base_url('/images/cm_pencil.png');?>" /></a>
	            <a href="javascript:void(0);" class="delcat" mid="<?php echo $row['id']; ?>"><img alt="delete" src="<?php echo  base_url('images/cm_cross.png')?>" /></a>
				<a href="<?php echo base_url('admin/location/cid/'.$row['id']);?>">Location</a>
	            </td>
	        </tr>



    <?php endwhile;?>
   <!-- <?php
     foreach ($countries as $key => $val) :?>

        <tr id="id_<?php echo $key;?>">
            <td><input type="checkbox" name="ids[]" value="<?php echo $key;?>" /></td>
            <td><?php echo $key;?></td>
            <td><?php echo $val;?></td>

			<td><?php echo $row['Country_Code'];?></td>

            <td>
            <a href="<?php echo base_url('admin/country_edit/id/'.$key);?>"><img alt="Edit" src="<?php echo base_url('/images/cm_pencil.png');?>" /></a>
            <a href="javascript:void(0);" class="delcat" mid="<?php echo $key; ?>"><img alt="delete" src="<?php echo  base_url('images/cm_cross.png')?>" /></a>
			<a href="<?php echo base_url('admin/location/cid/'.$key);?>">Location</a>
            </td>
        </tr>
    <?php endforeach; ?>-->
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
setTimeout('showmenu("psettings",7)',1000);
function del(_id){
	if(window.confirm('Are you sure you want to delete this?')){
		$.post('<?echo base_url("admin/country_del")?>',{id:_id},function(msg){
			if (String == msg.constructor) {
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			if(json.status){
				$.each(json.ids,function(k,v){
					$('#id_'+v).remove();
				})
				alert('sccueed.');
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
