<?php $this->layout->setLayoutData('content_for_layout_title','Affiliate Summary');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<div style="float:left;margin-right:110px;font-weight:bold;"><input style="width:55%;padding:4px;float:left;margin-right: 5px;" class="adm_box1" type="text" value="'.$search.'" name="search" id="search" /><a href="javascript:void(0);" class="button submit-search" style="height:17px;line-height:19px;">Search</a> </div>');?>
<?php $currentUrl = base_url('admin/s_summary');?>

<!--<div class="exp-btn"><a href="<?php echo base_url().'admin/user_export' ?>" onclick="exportUsers();">Export Users</a></div>-->
<table class="data_table">
    <thead>
        <tr>
            <th class="rw1"><div class="rw1"><input type="checkbox" class="check-all" /></div></th>
            <th class="rw2">
				<div class="rw2">
					ID
					
				</div>
			</th>
            <th class="rw3">
				<div class="rw3" style="margin-left:5px;">
					Affiliate Name
					
				</div>
			</th>
			
			<th class="rw3">
				<div class="rw3" style="margin-left:5px;">
					Contact Name
					
				</div>
			</th>
			
            <th class="rw4">
				<div class="rw4">
					Email
					
				</div>
			</th>
            <th class="rw5">
				<div class="rw5">
					Join Date
					
				</div>
			</th>
			
			
			<!--R&D@Dec-05 : Added PEXP Date-->
			<th class="rw10">
				<div class="rw10">
					Sessions
						
				</div>
			</th>
			
            <th class="rw8">
				<div class="rw8">
					Sum Earning
						
				</div>
			</th>
            <th class="rw9"><div class="rw9">Options</div></th>
        </tr>
    </thead>

    <tbody>
    <?php 
	
	foreach ($users as $key => $val) :?>
        <tr id="id_<?php echo $val['id'];?>">
            <td class="rw1"><div class="rw1"><input type="checkbox" name="ids[]" value="<?php echo $val['id'];?>" /></div></td>
            <td class="rw2"><div class="rw2"><?php echo $val['id'];?></div></td>
            <td class="rw3"><div class="rw3"><?php echo $val['affiname'];?></div></td>
			<td class="rw3"><div class="rw3"><?php echo $val['principle_name'];?></div></td>
            <td class="rw4"><div class="rw4"><?php echo $val['email'];?></div></td>
			<td class="rw5"<div class="rw5"><?php echo date('Y-m-d',strtotime($val['add_time']));?></div></td>
		
		     <td><div class="rw9"><?php if(@$val['sid'] !=''){echo @$val['sid']; }else{echo '0';}?></div> </td>
			 
            <td class="rw9"><div class="rw9"><?php if(@$val['amount'] !=''){echo @$val['amount']; }else{echo '0';}?></div></td>
            <td class="rw10"><div class="rw10">
            
		    <a href="javascript:void(0);" class="delcat" mid="<?php echo $val['id']; ?>"><img alt="delete" src="<?php echo  base_url('images/cm_cross.png')?>" /></a> 
            <a href="<?php echo base_url('admin/get_Affinote/id/'.$val['id']);?>" title="User Notes"><img alt="Note" src="<?php echo base_url('/images/cm_note.png');?>" /></a></div>
			</td>
			
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
	
        <tr>
            <td colspan="8">
            <div class="bulk-actions align-left">
			
            <select name="dropdown" id="action">
                <option value="0">Choose an action...</option>
                <option value="1">Delete</option>
            </select> 
             <a href="javascript:void(0);" id="apply" class="button">Apply to selected</a></div>

            <div class="pagination">
            <?php //echo $page;?>
            </div>
            <!-- End .pagination -->
            <div class="clear"></div>
            </td>
			
        </tr>
    </tfoot>
</table>

<script type="text/javascript">
setTimeout('showmenu("ssummary",0)',1000);
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

function exportUsers()
{
	var _checked = $("input[name='ids[]']:checked");
	if(_checked.size()>0){
		var _checkedVal = [];
		_checked.each(function(k,v){
			_checkedVal.push($(this).val());
		})
		
	}else{
		var _checkedVal = '';
	}
	var actionPage = '<?php echo base_url().'admin/user_export' ?>';
	$form = $("<form id='userexport' method='post' action='"+actionPage+"'></form>");
	$form.append('<input type="hidden" name="users" id="users" value="'+_checkedVal+'" />');
	$('body').append($form);
	$('#userexport').submit();
	
}
</script>
<style>.data_content{ padding:20px 10px;}
.data_table th, .data_table td{ padding:5px 0px;}</style>
</body>
</html>
