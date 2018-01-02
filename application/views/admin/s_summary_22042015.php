<?php $this->layout->setLayoutData('content_for_layout_title','School Summary');?>
<?php //$this->layout->setLayoutData('content_for_layout_links','<div style="float:left;margin-right:110px;font-weight:bold;"><input style="width:55%;padding:4px;float:left;margin-right: 5px;" class="adm_box1" type="text" value="'.$search.'" name="search" id="search" /><a href="javascript:void(0);" class="button submit-search" style="height:17px;line-height:19px;">Search</a> </div>');?>
<?php $currentUrl = base_url('admin/s_summary');?>
<table class="data_table">
    <thead>
        <tr>
            <th class="rw1"><div class="rw1"><input type="checkbox" class="check-all" /></div></th>
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
					School Name
					<?php if($sortorder == 'asc' && $sort == 'name'): ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/name'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
					<?php else: ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/name'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
					<?php endif;?>
				</div>
			</th>
			
			<th class="rw3">
				<div class="rw3" style="margin-left:5px;">
					Contact  Name
					<?php if($sortorder == 'asc' && $sort == 'cname'): ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/cname'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
					<?php else: ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/cname'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
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
					Join Date
					<?php if($sortorder == 'asc' && $sort == 'date'): ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/date'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
					<?php else: ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/date'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
					<?php endif;?>
				</div>
			</th>
			
			<th class="rw10">
				<div class="rw10">
					Tutors
						
				</div>
			</th>
			
			<th class="rw6">
				<div class="rw6">
					Students
						
				</div>
			</th>
			<th class="rw7">
				<div class="rw7" style="margin-left:5px;">
					Sessions
					
				</div>
			</th>
            <th class="rw8">
				<div class="rw8">
					Sum Earning
						<?php if($sortorder == 'asc' && $sort == 'total'): ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/total'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
					<?php else: ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/total'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
					<?php endif;?>
				</div>
			</th>
			<!--<th class="rw8">
				<div class="rw8">
					PVT Bal
				  <?php if($sortorder == 'asc' && $sort == 'pbal'): ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/pbal'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
					<?php else: ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/pbal'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
					<?php endif;?>
				</div>
			</th>-->
			
			<th class="rw8">
				<div class="rw8">
					Referral Amount
				   
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
            <td class="rw3" style="padding-left:10px;"><?php echo $val['schoolname'];?></td>
            <td class="rw4"><?php echo $val['principle_name'];?></td>
			<td class="rw4"><?php echo $val['email'];?></td>
			<td class="rw5"><?php echo date('Y-m-d',strtotime($val['add_time']));?></td>
		    
		     <td class="rw6" style="padding-left:14px;"><?php echo $val['tutors'];?></td>
			 <td class="rw6"><div class="rw5"><?php echo $val['students'];?></div></td>
			<td class="rw8"> <div class="rw8"><?php echo $val['tsession'];?></td>
			<?php 
			static $tsession;
			static $searning;
			static $tstudent;
			static $ttutor;
			$tsession+=$val['tsession']; 
			$searning += $val['earning'];
			$tstudent += $val['students'];
			$ttutor += $val['tutors'];
			?>
            <td class="rw9"><div class="rw9"><?php echo "$".  $val['earning']=number_format($val['earning'],2,'.','') ;?></div></td>
			<!--<td class="rw9"><div class="rw9"><?php echo "$".  number_format($val['pbalance'],2,'.','') ;?></div></td>-->
            <td class="rw9"><div class="rw9"><?php echo "$".  number_format($val['refamount'],2,'.','') ;?></div></td>
			<td class="rw10"><div class="rw10">
            
		    <a href="javascript:void(0);" class="delcat" mid="<?php echo $val['id']; ?>"><img alt="delete" src="<?php echo  base_url('images/cm_cross.png')?>" /></a> 
            <a href="<?php echo base_url('admin/get_school_note/id/'.$val['id']);?>" title="User Notes"><img alt="Note" src="<?php echo base_url('/images/cm_note.png');?>" /></a></div>
			</td>
			
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
	<tr><td>Total</td><td></td><td></td><td></td><td></td><td></td><td style="padding-left:10px;"><?php echo $ttutor;?></td><td><?php echo  $tstudent;?></td> <td><?php echo $tsession;?></td> <td><?php echo "$".  $searning=number_format($searning,2,'.','') ;?></td></tr>
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
setTimeout('showmenu("s_summary",0)',1000);
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
