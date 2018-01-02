<?php $this->layout->setLayoutData('content_for_layout_title','Guide Categories');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<div style="float:left;margin-right:110px;font-weight:bold;"><input style="width:55%;padding:4px;float:left;margin-right: 5px;" class="adm_box1" type="text" value="'.$search.'" name="search" id="search" /><a href="javascript:void(0);" class="button submit-search" style="height:17px;line-height:19px;">Search</a> </div><a href="'.base_url('admin/Addguide').'">Add New Category</a>');?>
<?php $currentUrl = base_url('admin/guide');?>
<table class="data_table">
    <thead>
        <tr>
          <th>
			 Id
			<?php if($sortorder == 'asc' && $sort == 'id'): ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/id'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
					<?php else: ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/id'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
					<?php endif;?>
			</th>
            <th>
				Category Name
				<?php if($sortorder == 'asc' && $sort == 'name'): ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/name'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
					<?php else: ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/name'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
					<?php endif;?></th>
			 
			<th>  Action</th>
        </tr>
    </thead>

    <tbody>
	
    <?php $j = 0; foreach ($guide as $key => $val) :?>
        <tr id="id_<?php echo $val['guide_categories_id'];?>">
           
			<td><?php echo @$val['guide_categories_id'];?></td>
			<td><?php echo @$val['name'];?></td>
		 
					
			    <td class="rw10"><div class="rw10">
			
		   <a href="<?php echo base_url('admin/guide_edit/id/'.$val['guide_categories_id']);?>"><img alt="Edit" src="<?php echo base_url('/images/cm_pencil.png');?>" /></a>
		    <a href="javascript:void(0);" class="delcat" mid="<?php echo $val['guide_categories_id']; ?>"><img alt="delete" src="<?php echo  base_url('images/cm_cross.png')?>" /></a> 
          </div>
			</td>
        </tr>
	<?php endforeach; ?>
    </tbody>
    <tfoot>
	 </tfoot>
	
</table>
<script type="text/javascript">
function changelimit(limit)
{
	window.location.href="<?php echo base_url().'admin/Affi_payment/limit/'?>"+limit;
}
setTimeout('showmenu("pcontent",9)',1000);
function del(_id){
 
	if(window.confirm('Are you sure you want to delete this?')){
		$.post('<?php echo Base_url("admin/Deleteguide")?>',{id:_id},function(msg){
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
s}
$(function(){
	 
	$(".submit-search").click(function() {
		var search = $('#search').val();
		var dsearch = $('#dsearch').val();
		
		var currentPage = window.location.href;
	
		$form = $("<form id='guidelist' method='post' action='"+currentPage+"'></form>");
		if(search !='' || search == '')
		{
		$form.append('<input type="hidden" name="search" id="search" value="'+search+'" />');
		}
		if(dsearch !='')
		{
			$form.append('<input type="hidden" name="dsearch" id="dsearch" value="'+dsearch+'" />');
		}
		$('body').append($form);
		$('#guidelist').submit();
	});
	$('#search').on('keypress', function (event) {
		 if(event.which == '13'){
			 
			$(".submit-search").trigger('click');
		 }
	});
	$('.delcat').click(function(){
		del([$(this).attr('mid')]);
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
