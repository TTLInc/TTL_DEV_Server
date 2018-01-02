<?php $this->layout->setLayoutData('content_for_layout_title','Affiliate Payments');?>

<?php $currentUrl = base_url('admin/Affi_payment');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<div style="float:left;font-weight:bold;"><input style="width:22%;padding:4px;float:left;margin-right: 5px;" class="adm_box1" type="text" placeholder="select date" value="'.$dsearch.'" name="dsearch" id="dsearch" /><input style="width:23%;padding:4px;float:left;margin-right: 5px;" class="adm_box1" type="text" value="'.$search.'" name="search" id="search" /><a href="javascript:void(0);" class="button submit-search" style="height:17px;line-height:19px;">Search</a> </div>');?>

<table class="data_table">
    <thead>
        <tr>
            <!--<th><input type="checkbox" class="check-all" /></th>-->
            <!--<th>Id</th>-->
			<th>
			Affiliate Id
			<?php if($sortorder == 'asc' && $sort == 'id'): ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/id'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
					<?php else: ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/id'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
					<?php endif;?>
			</th>
            <th>
				Affiliate Name
				<?php if($sortorder == 'asc' && $sort == 'name'): ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/name'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
					<?php else: ?>
					<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/name'; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
					<?php endif;?>
				
			</th>
			
			
            <th>
				Student Loads
				
			</th>
			
            

			
            <th>
			 Payments Due
				
			</th>
           <th>Payments Action</th>
            
           
        </tr>
    </thead>

    <tbody>
	
    <?php $j = 0; foreach ($payments as $key => $val) :?>
        <tr id="id_<?php echo $val['id'];?>">
           <!-- <td><input type="checkbox" name="ids[]" value="<?php echo $val['id'];?>" /></td>-->
            <!--<td><?php echo $val['id'];?></td>-->
			<td><?php echo @$val['id'];?></td>
			<td><?php echo @$val['affiname'];?></td>
			<td><?php if(@$val['sid'] !=''){echo @$val['sid']; }else{echo '0';}?></td>
			<td><?php if(@$val['amount'] !=''){echo @$val['amount']; }else{echo '0';}?></td>
			
			
			 <!--  <td><?php echo $val['date'];?></td>-->
            <?php 
            	// hour calculation
            	
					$class = "actionenabled";
					?>
					<td id="actions" class="<?php echo $class; ?>" >
						<?php if($val['paid'] == 1){?>
						<img alt="Postpone" src="<?php echo base_url('/images/postpon-gray.png');?>" />
						<?php }else{ ?>
						<a href="javascript:void(0);" class="poscat" mid="<?php echo $val['id']; ?>" title="Postpone"><img alt="Postpone" src="<?php echo base_url('/images/postpon-red.png');?>" /></a>
						<?php } ?>
						<?php  if($val['paid'] == 1){?>
						 <img alt="Approve" src="<?php echo base_url('/images/approve-gray.png');?>" /> 
						<?php  }else{?>
						<a href="javascript:void(0);" class="appcat" mid="<?php echo $val['id']; ?>" val="<?php echo  $val['amount'] ;//echo $val['approve']; ?>" title="Approve"><img alt="Approve" src="<?php echo base_url('/images/approve-red.png');?>" /></a>
						<?php  } ?>
						<?php  if($val['paid'] == 1){?>
						<img alt="delete" src="<?php echo  base_url('images/close-gray.png')?>" />
						<?php }else{?>
						<a href="javascript:void(0);" class="delcat" mid="<?php echo $val['id']; ?>" title="Delete"><img alt="delete" src="<?php echo  base_url('images/close-red.png')?>" /></a> 
						<?php }?>
						<a href="<?php echo base_url('admin/get_Affinote/id/'.$val['id']);?>" title="User Notes"><img alt="Note" src="<?php echo base_url('/images/cm_note.png');?>" /></a>
					</td>	
				
            
			
        </tr>
	<?php endforeach; ?>
    </tbody>
    <tfoot>
	
       <!-- <tr>
            <td colspan="6">
            <div class="bulk-actions align-left">
			<span>Display</span>
            <select name="limit" id="limit" onchange="changelimit(this.value);">
                <option value="10" <?php if($limit == 10){echo 'selected="selected"';} ?>>10</option>
                <option value="20" <?php if($limit == 20){echo 'selected="selected"';} ?>>20</option>
                <option value="50" <?php if($limit == 50){echo 'selected="selected"';} ?>>50</option>
                <option value="100" <?php if($limit == 100){echo 'selected="selected"';} ?>>100</option>
             </select> 
            
			 </div>

            <div class="pagination">
				
            </div>
            
            <div class="clear"></div>
            </td>
        </tr>-->
    </tfoot>
	
</table>
<script type="text/javascript">
function changelimit(limit)
{
	window.location.href="<?php echo base_url().'admin/Affi_payment/limit/'?>"+limit;
}
setTimeout('showmenu("spayments",0)',1000);
function del(_id){
//alert(_id);return false;
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
//alert(_val);return false;
	if(window.confirm('Are you sure you want to approve this payment?')){
		$.post('<?php echo Base_url("admin/affi_pay_approve")?>',{id:_id,approveval:_val},function(msg){
			if (String == msg.constructor) {
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			
			if(json.status){
				//$('.appcat').attr('val',json.val);
				alert('Payment has been approved.');
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
		var dsearch = $('#dsearch').val();
		
		var currentPage = window.location.href;
	
		$form = $("<form id='disputeslist' method='post' action='"+currentPage+"'></form>");
		if(search !='' || search == '')
		{
		$form.append('<input type="hidden" name="search" id="search" value="'+search+'" />');
		}
		if(dsearch !='')
		{
			$form.append('<input type="hidden" name="dsearch" id="dsearch" value="'+dsearch+'" />');
		}
		$('body').append($form);
		$('#disputeslist').submit();
	});
	$('#search').on('keypress', function (event) {
		 if(event.which == '13'){
			//$(this).attr("disabled", "disabled");
			$(".submit-search").trigger('click');
		 }
	});
	
	
/*$(".submit-search").click(function() {
		var dsearch = $('#dsearch').val();
		//alert(dsearch);
		var currentPage = window.location.href;
	
		$form = $("<form id='disputeslist' method='post' action='"+currentPage+"'></form>");
		$form.append('<input type="hidden" name="dsearch" id="dsearch" value="'+dsearch+'" />');
		$('body').append($form);
		$('#disputeslist').submit();
	});
	$('#dsearch').on('keypress', function (event) {
		 if(event.which == '13'){
			//$(this).attr("disabled", "disabled");
			$(".submit-dsearch").trigger('click');
		 }
	});*/
	
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


<script>
	
	$(function(){
		$('a@[href=#]').attr('href','javascript:void(0)');
		
	})

$("#dsearch,#exp_session").datepicker({ dateFormat: 'yy-mm-dd' } );
/*$('td.actiondisabled a').attr("disabled", true);*/
</script>


</body>
</html>
