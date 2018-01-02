<?php $this->layout->setLayoutData('content_for_layout_title','List of Category');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<a href="'.base_url('admin/addcategory').'">Add New</a>');?>
<?php $currentUrl = base_url('admin/listcategories');?>
<?php if(@$errormsg):?>
	<div class="notice_4 notice_6" id="errormsg">
		<span class="notice_icon notice_icon6"></span> 
		<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<!--<img src="<?php //echo base_url('images/arow-right.png');?>" />-->
		</a>
		<p><?php echo $errormsg; ?></p>
	</div>
<?php elseif(@$succrmsg):?>
	<div class="notice_4 notice_6" id="errormsg" style="background: none repeat scroll 0 0 green !important;color: #FFFFFF !important;">
		<span class="notice_icon6"></span> 
		<a class="notice_icon6 " href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<!--<img src="<?php //echo base_url('images/arow-right.png');?>" />-->
		</a>
		<p ><?php echo $succrmsg; ?></p>
	</div>
<?php endif;?>
<table class="data_table">
	<thead>
		<tr>
			<th><input type="checkbox" class="check-all" /></th>
			<th>Category
				<?php if($sortorder == 'asc' && $sort == 'category'): ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/category'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
					<?php else: ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/category'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
					<?php endif;?>
			</th>
			<?php /*<th>Language
			
			<?php if($sortorder == 'asc' && $sort == 'lang'): ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/lang'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
					<?php else: ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/lang'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
					<?php endif;?>
			</th>
			<th>Categories
			
			<?php if($sortorder == 'asc' && $sort == 'categories'): ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/categories'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
					<?php else: ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/categories'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
					<?php endif;?>
			</th>
			
			<th>Display Order
			
			<?php if($sortorder == 'asc' && $sort == 'orderNo'): ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/orderNo'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
					<?php else: ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/orderNo'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
					<?php endif;?>
			</th>
			
			<th>PDF</th>*/?>
			<th>Options</th>
		</tr>
	</thead>

	<tbody>
	<?php $j = 0; foreach ($categories as $key => $val) :?>
	<tr id="id_<?php echo $val['id'];?>">
		<td><input type="checkbox" name="ids[]" value="<?php echo $val['id'];?>" /></td>		
		<td><?php  echo $val['category'];?></td>
		<?php /*<td>
		<?php 
			switch($val['lang'])
			{
				case 3:
					echo 'English';
					break;
				case 6:
					echo 'Korean';
					break;
				case 1:
					echo 'CN Simplified';
					break;
				case 5:
					echo 'Japanese';
					break;
				case 7:
					echo 'Portuguese';
					break;
				case 2:
					echo 'CN Traditional';
					break;	
				case 8:
					echo 'Spanish';
					break;
					
					case 4:
					echo 'French';
					break;
				default :
					echo 'English';
					break;	
					
					
			}
		?>
		</td>
		<td><?php echo $val['name'];?></td>
		<td><?php echo $val['orderNo'];?></td>
		<td><?php if($val['pfile'] != "") { echo $val['pfile'];} else { echo '-';}?></td>*/?>
		<td>
		<a href="<?php echo base_url('admin/editCategory/id/'.$val['id']);?>"><img alt="Edit" src="<?php echo base_url('/images/cm_pencil.png');?>" /></a>
		<a href="javascript:void(0);" class="delcat" mid="<?php echo $val['id']; ?>"><img alt="delete" src="<?php echo  base_url('images/cm_cross.png')?>" /></a> 
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
	setTimeout('showmenu("pcontent",18)',1000);
	function del(_id){
		if(window.confirm('Are you sure you want to delete this?')){
			$.post('<?php echo Base_url("admin/deletecategory")?>',{id:_id},function(msg){
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