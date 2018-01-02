<?php $this->layout->setLayoutData('content_for_layout_title','Sent Message list');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<div style="float:left;font-weight:bold;"><input style="width:55%;padding:4px;float:left;margin-right: 5px;" class="adm_box1" type="text" value="'.$search.'" name="search" id="search" /><a href="javascript:void(0);" class="button submit-search" style="height:17px;line-height:19px;">Search</a> </div><a href="'.base_url('admin/messaging_send').'">Send New Message</a> <a style="margin-left:10px;" href="'.base_url('admin/messaging_affiliate_send').'">Send New Affiliate Message</a>');?>
<?php //$this->layout->setLayoutData('content_for_layout_links','<div style="float:left;font-weight:bold;"><input style="width:55%;padding:4px;float:left;margin-right: 5px;" class="adm_box1" type="text" value="'.$search.'" name="search" id="search" /><a href="javascript:void(0);" class="button submit-search" style="height:17px;line-height:19px;">Search</a> </div>');?>
<?php $currentUrl = base_url('admin/messaging');?>
<table class="data_table">
    <thead>
        <tr>
            <th><input type="checkbox" class="check-all" /></th>
            <!--<th>Id</th>-->
            <th>
				Subject
				<?php if($sortorder == 'asc' && $sort == 'subject'): ?>
				<a href="<?php echo $currentUrl.'/sortorder/desc/sort/subject'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/sortorder/asc/sort/subject'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
			</th>
            <th>
				Message
				<!--
				<?php if($sortorder == 'asc' && $sort == 'message'): ?>
				<a href="<?php echo $currentUrl.'/sortorder/desc/sort/message'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/sortorder/asc/sort/message'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
				-->
			</th>
            <th>
				Send To
				<?php if($sortorder == 'asc' && $sort == 'sendto'): ?>
				<a href="<?php echo $currentUrl.'/sortorder/desc/sort/sendto'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/sortorder/asc/sort/sendto'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>	
			</th>
            <th>
				Group
				<?php if($sortorder == 'asc' && $sort == 'group'): ?>
				<a href="<?php echo $currentUrl.'/sortorder/desc/sort/group'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/sortorder/asc/sort/group'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>	
			</th>
			<th>
				Name
				<?php if($sortorder == 'asc' && $sort == 'name'): ?>
				<a href="<?php echo $currentUrl.'/sortorder/desc/sort/name'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/sortorder/asc/sort/name'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>	
			</th>
			<th>
				Id
				<?php if($sortorder == 'asc' && $sort == 'uid'): ?>
				<a href="<?php echo $currentUrl.'/sortorder/desc/sort/uid'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/sortorder/asc/sort/uid'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>	
			</th>
            <th>
				Date
				<?php if($sortorder == 'asc' && $sort == 'date'): ?>
				<a href="<?php echo $currentUrl.'/sortorder/desc/sort/date'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/sortorder/asc/sort/date'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>	
			</th>
            
           
        </tr>
    </thead>

    <tbody>
    <?php $j = 0; foreach ($messages as $key => $val) :?>
        <tr id="id_<?php echo $val['id'];?>">
            <td><input type="checkbox" name="ids[]" value="<?php echo $val['id'];?>" /></td>
            <!--<td><?php echo $val['id'];?></td>-->
			<td><?php echo $val['subject'];?></td>
            <td><?php echo $val['message'];?></td>
             <td>
				<?php 
					if($val['sendto'] == 'inbox')
					{
						echo 'TheTalkList inbox';
					}elseif($val['sendto'] == 'email')
					{
						echo 'Email addresses';
					}else{
						echo $val['sendto'];
					}
				?>
			</td>
			<td>
				<?php 
					if($val['group'] == 'allmember'):
						echo 'All members';
					elseif($val['group'] == 'individualmember'):
						echo 'Individual members';
					elseif($val['group'] == 'upgradedtutor'):
						echo 'Upgraded Tutors';
					elseif($val['group'] == 'alltutor'):
						echo 'All Tutors';
					elseif($val['group'] == 'allstudent'):
						echo 'All Students';
					else:
						echo $val['group'];
					endif;
				?>
			</td>
			<td><?php echo $val['name'];?></td>
			<td><?php if($val['uid']!= 0){echo $val['uid'];}?></td>
			 <td><?php echo $val['date'];?></td>
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
				<select name="dropdown" id="action">
					<option value="0">Choose an action...</option>
					<option value="1">Delete</option>
				 </select> 
				 <a href="javascript:void(0);" id="apply" class="button">Apply to selected</a>
				 
				 <span>Display</span>
				 <select name="limit" id="limit" onchange="changelimit(this.value);">
					<option value="10" <?php if($limit == 10){echo 'selected="selected"';} ?>>10</option>
					<option value="20" <?php if($limit == 20){echo 'selected="selected"';} ?>>20</option>
					<option value="50" <?php if($limit == 50){echo 'selected="selected"';} ?>>50</option>
					<option value="100" <?php if($limit == 100){echo 'selected="selected"';} ?>>100</option>
				 </select> 
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
function changelimit(limit)
{
	window.location.href="<?php echo base_url().'admin/messaging/limit/'?>"+limit;
}

setTimeout('showmenu("pcontent",10)',1000);
function del(_id){
	if(window.confirm('Are you sure you want to delete this?')){
		$.post('<?php echo Base_url("admin/messages_del")?>',{id:_id},function(msg){
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
	
	$(".submit-search").click(function() {
		var search = $('#search').val();
		var currentPage = window.location.href;
	
		$form = $("<form id='userlist' method='post' action='"+currentPage+"'></form>");
		$form.append('<input type="hidden" name="search" id="search" value="'+search+'" />');
		$('body').append($form);
		$('#userlist').submit();
	});
	$('#search').on('keypress', function (event) {
		 if(event.which == '13'){
			//$(this).attr("disabled", "disabled");
			$(".submit-search").trigger('click');
		 }
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


<script>
	
	$(function(){
		$('a@[href=#]').attr('href','javascript:void(0)');
		
	})

</script>


</body>
</html>
