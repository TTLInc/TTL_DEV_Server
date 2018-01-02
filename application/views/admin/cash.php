<?php
session_start();
$this->layout->setLayoutData('content_for_layout_title','Cash');
$currentUrl = base_url('admin/cash');
$this->layout->setLayoutData('content_for_layout_links','<div style="float:left;font-weight:bold;"><input style="width:55%;padding:4px;float:left;margin-right: 5px;" class="adm_box1" type="text" value="'.$this->session->userdata['searchdisputes'].'" name="search" id="search" /><a href="javascript:void(0);" class="button submit-search" style="height:17px;line-height:19px;">Search</a> </div>');
echo $this->session->userdata('searchcash');?>
<!--<div class="exp-btn">
	<a onclick="ExportDispute();" href="javascript:void(0);">Export</a>
</div>-->
<table class="data_table">
    <thead>
        <tr>
            <!--<th><input type="checkbox" class="check-all" /></th>-->
            <th>
				Id
				<?php if($sortorder == 'asc' && $sort == 'id'): ?>
					<a href="<?php echo $currentUrl.'/sortorder/desc/sort/id'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
					<a href="<?php echo $currentUrl.'/sortorder/asc/sort/id'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
			</th>
			<th>
				Member
				<?php if($sortorder == 'asc' && $sort == 'user_id'): ?>
					<a href="<?php echo $currentUrl.'/sortorder/desc/sort/user_id'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
					<a href="<?php echo $currentUrl.'/sortorder/asc/sort/user_id'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
			</th>
			<th>Amount
				<?php if($sortorder == 'asc' && $sort == 'amount'): ?>
					<a href="<?php echo $currentUrl.'/sortorder/desc/sort/amount'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
					<a href="<?php echo $currentUrl.'/sortorder/asc/sort/amount'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
			</th>
            <th>
				Date
				<?php if($sortorder == 'asc' && $sort == 'payment_date'): ?>
					<a href="<?php echo $currentUrl.'/sortorder/desc/sort/payment_date'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
					<a href="<?php echo $currentUrl.'/sortorder/asc/sort/payment_date'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
			</th>
		</tr>
    </thead>
	<tbody>
	<?php $j = 0; 
	foreach ($results as $key => $val) :?>
        <tr id="id_<?php echo $val['id'];?>">
           <!-- <td><input type="checkbox" name="ids[]" value="<?php echo $val['id'];?>" /></td>-->
            <td><?php echo $val['id'];?></td>
			<td>
				<?php 
				$user = $this->profile_model->getProfile(@$val['user_id']);
				echo @$user['firstName'].' '.@$user['lastName'];
				?>
			</td>
			<td><?php echo "$". number_format(@$val['amount'],2,'.','');?></td>
			<td>
				<?php
				if ($val['payment_date'] != '0000-00-00 00:00:00') {
					echo date("Y-m-d", strtotime($val['payment_date']));
				}?>
			</td>
			<!--  <td><?php echo $val['date'];?></td>-->
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
				<div class="pagination"><?php echo $pagination;?></div>
				<!-- End .pagination -->
				<div class="clear"></div>
			</td>
        </tr>
    </tfoot>
</table>
<script type="text/javascript">
function changelimit(limit)
{
	window.location.href="<?php echo base_url().'admin/cash/limit/'?>"+limit;
}
setTimeout('showmenu("financial",3)',1000);
function del(_id){
	if(window.confirm('Are you sure you want to delete this?')){
		$.post('<?php echo Base_url("admin/disputes_del")?>',{id:_id},function(msg){
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
				window.location.reload(true);
			}
			else{
				alert(json.msg);
			}
		})
	}
}
function pospond(_id)
{
	//alert(_id);return false;
	if(window.confirm('Are you sure you want to postpone this payment?')){
		$.post('<?php echo Base_url("admin/disputes_postpond")?>',{id:_id},function(msg){
			if (String == msg.constructor) {
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			
			if(json.status){
				alert('Successfully postponed');
				window.location.reload(true);
			}
			else{
				alert(json.msg);
			}
		})
	}
}

function approve(_id,_val)
{
//alert(_id);return false;
	if(window.confirm('Are you sure you want to approve this payment?')){
		$.post('<?php echo Base_url("admin/disputes_approve")?>',{id:_id,approveval:_val},function(msg){
			if (String == msg.constructor) {      
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			
			if(json.status){
				$('.appcat').attr('val',json.val);
				alert('Successfully status changed');
				window.location.reload(true);
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
	
		$form = $("<form id='disputeslist' method='post' action='"+currentPage+"'></form>");
		$form.append('<input type="hidden" name="search" id="search" value="'+search+'" />');
		$('body').append($form);
		$('#disputeslist').submit();
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
	$('.poscat').click(function(){
		pospond([$(this).attr('mid')]);
	})
	$('.appcat').click(function(){
		approve([$(this).attr('mid')],[$(this).attr('val')]);
	})
})
</script>
<script type="text/javascript">
$(function(){
	$('a@[href=#]').attr('href','javascript:void(0)');
})

function ExportDispute()
{
	var actionPage = '<?php echo base_url().'admin/GenerateCsvDispute' ?>';
	$form = $("<form id='DispCsv' method='post' action='"+actionPage+"'></form>");
	$('body').append($form);
	$('#DispCsv').submit();
}
</script>
</body>
</html>