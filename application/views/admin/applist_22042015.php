<?php $this->layout->setLayoutData('content_for_layout_title','Language App');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<a href="'.base_url('admin/AddLanguageApp').'">Add new</a>');?>

<table class="data_table">
    <thead>
        <tr>
            
            <th>Id</th> 
            <th>Title</th>
            <th>Link</th>
            <th>Image</th>
			 
			<th>Status</th>
			 
            <th>Options</th>
        </tr>
    </thead>
<?php 

		?>
    <tbody>
    <?php foreach ($languageapp as $key => $val) :?>
         <tr id="id_<?php echo $val['LanguageAppID'];?>">
             <td><?php echo $val['LanguageAppID'];?></td>
            <td><?php echo $val['Title'];?></td>
            <td><?php echo $val['Link'];?></td>
            <td><img src="<?php echo base_url('LanuageApp/'.$val['Source']);?>" width="140px" height="100px"/></td>
            
			<td><a href="<?php echo Base_url("admin/updateStatus?id=".$val['LanguageAppID'])?>"><?php echo $val['status'];?></a></td>
			 
			<td>
			 
            <a href="<?php echo base_url('admin/AppEdit/id/'.$val['LanguageAppID']);?>"><img alt="Edit" src="<?php echo base_url('/images/cm_pencil.png');?>" /></a>
			 
            <a href="javascript:void(0);" class="delcat" mid="<?php echo $val['LanguageAppID']; ?>"><img alt="delete" src="<?php echo  base_url('images/cm_cross.png')?>" /></a> 
            </td>
        </tr>
	<?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6">
            <div class="bulk-actions align-left">
           <!-- <select name="dropdown" id="action">
                <option value="0">Choose an action...</option>
                <option value="1">Delete</option>
             </select> 
             <a href="javascript:void(0);" id="apply" class="button">Apply to selected</a>--></div>

            <div class="pagination">
            
            </div>
            <!-- End .pagination -->
            <div class="clear"></div>
            </td>
        </tr>
    </tfoot>
</table>
<script type="text/javascript">
setTimeout('showmenu("apps",0)',1000);
function del(_id){
	if(window.confirm('Are you sure you want to delete this?')){
		$.post('<?php echo Base_url("admin/DeleteApp")?>',{id:_id},function(msg){
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
$('.delcat').click(function(){
		del([$(this).attr('mid')]);
	})
</script>
</body>
</html>
