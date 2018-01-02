<?php $this->layout->setLayoutData('content_for_layout_title','School Users');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<div style="float:left;margin-right:110px;font-weight:bold;"><input style="width:55%;padding:4px;float:left;margin-right: 5px;" class="adm_box1" type="text" value="'.$search.'" name="search" id="search" /><a href="javascript:void(0);" class="button submit-search" style="height:17px;line-height:19px;">Search</a> </div>');?>
<?php $currentUrl = base_url('admin/SchoolUsers');?>


<table class="data_table">
    <thead>
        <tr>
           <!-- <th class="rw1"><div class="rw1"><input type="checkbox" class="check-all" /></div></th>-->
            <th class="rw2">
				<div class="rw2">
					Id
					<?php if($sortorder == 'asc' && $sort == 'id'): ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/id'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
					<?php else: ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/id'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
					<?php endif;?>
				</div>
			</th>
            <th class="rw3">
				<div class="rw3" style="margin-left:5px;">
					Name
					<?php if($sortorder == 'asc' && $sort == 'firstName'): ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/firstName'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
					<?php else: ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/firstName'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
					<?php endif;?>
				</div>
			</th>
            <th class="rw4">
				<div class="rw4">
					Email
					<?php if($sortorder == 'asc' && $sort == 'email'): ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/email'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
					<?php else: ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/email'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
					<?php endif;?>
				</div>
			</th>
            <th class="rw5">
				<div class="rw5">
					Role
					 
				</div>
			</th>
			
			  
			<!--<th class="rw6">
				<div class="rw6">
					Dispute
					<?php if($sortorder == 'asc' && $sort == 'disputes'): ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/disputes'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
					<?php else: ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/disputes'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
					<?php endif;?>	
				</div>
			</th>-->
			 
            <th class="rw8">
				<div class="rw8">
					Create At
					<?php if($sortorder == 'asc' && $sort == 'add_time'): ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/add_time'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
					<?php else: ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/add_time'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
					<?php endif;?>	
				</div>
			</th>
            <th class="rw9"><div class="rw9">Options</div></th>
        </tr>
    </thead>

    <tbody>
    <?php 
	
	foreach ($users as $key => $val) :?>
        <tr id="id_<?php echo $val['id'];?>">
            <!--<td class="rw1"><div class="rw1"><input type="checkbox" name="ids[]" value="<?php echo $val['id'];?>" /></div></td>-->
            <td class="rw2"><div class="rw2"><?php echo $val['id'];?></div></td>
            <td class="rw3"><div class="rw3"><?php echo $val['usernm'];?></div></td>
            <td class="rw4"><div class="rw4"><?php echo $val['email'];?></div></td>
			<td class="rw5"<div class="rw5"><?php echo @$types[$val['roleId']];?></div></td>
			  
		 
			<!--<td class="rw8"><div class="rw8">
			<?php
				/*if(@$val['completedSessionDate'])
				{
					echo date('Y-m-d H:i:s',strtotime($val['completedSessionDate']));
				}*/
			?></div>-->
			</td>
            <td class="rw9"><div class="rw9"><?php echo date('Y-m-d', strtotime($val['add_time']));?></div></td>
            <td class="rw10"><div class="rw10">
            <a href="<?php echo base_url('admin/school_user_edit/id/'.$val['id']);?>"><img alt="Edit" src="<?php echo base_url('/images/cm_pencil.png');?>" /></a>
		     <a href="javascript:void(0);" class="delcat" mid="<?php echo $val['id']; ?>"><img alt="delete" src="<?php echo  base_url('images/cm_cross.png')?>" /></a> 
			</td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="8">
           <!-- <div class="bulk-actions align-left">
            <select name="dropdown" id="action">
                <option value="0">Choose an action...</option>
                <option value="1">Delete</option>
            </select> 
             <a href="javascript:void(0);" id="apply" class="button">Apply to selected</a></div>
			-->
            <div class="pagination">
            <?php echo $page;?>
            </div>
         
            <div class="clear"></div>
            </td>
			
        </tr>
    </tfoot>
</table>

<script type="text/javascript">
setTimeout('showmenu("SchoolUsers1",0)',1000);
function del(_id){ 
	if(window.confirm('Are you sure you want to delete this?')){
		$.post('<?echo base_url("admin/sch_del")?>',{id:_id},function(msg){
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
<style>.data_content{ padding:20px 10px;}
.data_table th, .data_table td{ padding:5px 0px;}</style>
</body>
</html>
