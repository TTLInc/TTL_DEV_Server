<?php $this->layout->setLayoutData('content_for_layout_title','Referral Payments');?>
<?php //$this->layout->setLayoutData('content_for_layout_links','<a href="'.base_url('admin/messaging_send').'">Send New Message</a> <a style="margin-left:10px;" href="'.base_url('admin/messaging_affiliate_send').'">Send New Affiliate Message</a>');?>
<?php $currentUrl = base_url('admin/referralpayment');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<div style="float:left;font-weight:bold;"><input style="width:55%;padding:4px;float:left;margin-right: 5px;" class="adm_box1" type="text" value="'.$search.'" name="search" id="search" /><a href="javascript:void(0);" class="button submit-search" style="height:17px;line-height:19px;">Search</a> </div>');?>
<table class="data_table">
    <thead>
        <tr>
            <!--<th><input type="checkbox" class="check-all" /></th>-->
            <!--<th>Id</th>-->
          <th>ID
		  <?php if($sortorder == 'asc' && $sort == 'id'): ?>
				<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/desc/sort/id'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/start/'.$start.'/sortorder/asc/sort/id'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
		  </th>
		   <th>
				Affiliate Name
				<?php if($sortorder == 'asc' && $sort == 'name'): ?>
				<a href="<?php echo $currentUrl.'/sortorder/desc/sort/name'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/sortorder/asc/sort/name'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
			</th>

            <th>
				 Type
				 <?php if($sortorder == 'asc' && $sort == 'type'): ?>
				<a href="<?php echo $currentUrl.'/sortorder/desc/sort/type'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/sortorder/asc/sort/type'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
				 
			</th>
		 
			
            <th>
				Payment Mode
			<?php if($sortorder == 'asc' && $sort == 'mode'): ?>
				<a href="<?php echo $currentUrl.'/sortorder/desc/sort/mode'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/sortorder/asc/sort/mode'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
				
			</th>
             <th>Amount
           <?php if($sortorder == 'asc' && $sort == 'total'): ?>
				<a href="<?php echo $currentUrl.'/sortorder/desc/sort/total'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/sortorder/asc/sort/total'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
			 </th>
			 <th>Date</th>
			<th>Paid</th>	
		   <th>Status</th>
		   
            
           
        </tr>
    </thead>

    <tbody>
	<?php

	?>
    <?php $j = 0; foreach ($payments as $key => $val) :?>
	
        <tr id="id_<?php echo $val['id'];?>">
           <!-- <td><input type="checkbox" name="ids[]" value="<?php echo $val['id'];?>" /></td>-->
            <td><?php echo $val['id'];?></td>
			<td><?php echo @$val['affiliate'];?></td>
			<td><?php echo @$val['type'];?></td>
			 
            <td>
            <?php
            	//if($val['status'] == 1)
            		echo $val['payment_type'];
            	//else 
            		//echo "UnPaid";
            ?>
            </td>
             <td>
			 <?php if($val['amount'] >0){?>
				<?php 
				echo "$".number_format(@$val['amount'],2,'.','');
					
				?>
				<?php }else {?>-<?php }?>
			</td>
			<td>
			<?php if($val['paid'] == 1){?>
			<?php echo @$val['paid_date']; ?>
			<?php }else {?>
			  -
			 <?php }?>
			</td>
			<td> 
			<?php if($val['paid'] == 1){?>
			 <?php echo "$".number_format(@$val['PaidAmount'],2,'.',''); ?>
			 <?php }else {?>
			  -
			 <?php }?>
			 </td>
				
            <?php 
            	
            		$class = "actiondisabled";
					?>
					
					
				<?php	
            	//}else{
					$class = "actionenabled";
					?>
					<td id="actions" class="<?php echo $class; ?>">
					<a target="_blank" href="<?php echo base_url('admin/genpdf/id/'.$val['ref']);?>" class="genpdf" mid="<?php echo $val['ref']; ?>" title="Generate PDF"><img alt="Generate" src="<?php echo base_url('/images/pdf.png');?>"width="15px" /></a>
						
					
						<?php if($val['amount'] > 0){?>
						
						 <a href="javascript:void(0);" class="appcat" mid="<?php echo $val['ref']; ?>" val="<?php echo $val['approve']; ?>" title="Approve"><img alt="Approve" src="<?php echo base_url('/images/approve-red.png');?>" /></a> 
						
						<?php }?>
						
					</td>	
			
            
			
        </tr>
	<?php endforeach; ?>
    </tbody>
    <tfoot>
	
        <tr>
            <td colspan="6">


            <div class="pagination">
				<?php echo $page; ?>
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
	window.location.href="<?php echo base_url().'admin/referralpayment/limit/'?>"+limit;
}
setTimeout('showmenu("referralpayment",0)',1000);
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

function approve(_id)
{
  //alert(_id);return false;
	if(window.confirm('Are you sure you want to approve this payment?')){
		$.post('<?php echo Base_url("admin/affiliate_payment")?>',{id:_id},function(msg){
			if (String == msg.constructor) {      
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			 //alert(json.status);
			if(json.status){
				//$('.appcat').attr('val',json.val);
				alert('Payment successfully done');
				 document.location.href="<?php echo base_url('admin/referralpayment');?>";
				
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
		approve([$(this).attr('mid')] );
	})
	 
})
</script>


<script>
	
	$(function(){
		$('a@[href=#]').attr('href','javascript:void(0)');
		
	})


/*$('td.actiondisabled a').attr("disabled", true);*/
</script>


</body>
</html>
