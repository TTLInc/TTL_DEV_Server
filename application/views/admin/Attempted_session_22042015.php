<?php session_start();?>
<?php $this->layout->setLayoutData('content_for_layout_title','Attempted Sessions');?>
<?php //$this->layout->setLayoutData('content_for_layout_links','<a href="'.base_url('admin/messaging_send').'">Send New Message</a> <a style="margin-left:10px;" href="'.base_url('admin/messaging_affiliate_send').'">Send New Affiliate Message</a>');?>
<?php $currentUrl = base_url('admin/Attempted_Session');?>
<?php //$this->layout->setLayoutData('content_for_layout_links','<div style="float:left;font-weight:bold;"><input style="width:55%;padding:4px;float:left;margin-right: 5px;" class="adm_box1" type="text" value="'.$this->session->userdata['searchdisputes'].'" name="search" id="search" /><a href="javascript:void(0);" class="button submit-search" style="height:17px;line-height:19px;">Search</a> </div>');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<div style="float:left;font-weight:bold;"><input style="width:22%;padding:4px;float:left;margin-right: 5px;" class="adm_box1" type="text" placeholder="select date" value="'.$dsearch.'" name="dsearch" id="events_widget" /><input style="width:23%;padding:4px;float:left;margin-right: 5px;" class="adm_box1" type="text" value="'.$search.'" name="search" id="search"  /><a href="javascript:void(0);" class="button submit-search" style="height:17px;line-height:19px;">Search</a> </div>');?>
<?php echo $this->session->userdata('searchdisputes');?>
<?php $this->layout->appendFile('javascript',"js/jquery.mtz.monthpicker.js");?>
<div class="exp-btn">
<a onclick="ExportAttend();" href="javascript:void(0);">Export</a>
</div>
<table class="data_table">
    <thead>
        <tr>
             
            <th>
				ID
				<?php if($sortorder == 'asc' && $sort == 'id'): ?>
				<a href="<?php echo $currentUrl.'/sortorder/desc/sort/id'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/sortorder/asc/sort/id'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
			</th>
			
			
            <th>
				Student
				<?php if($sortorder == 'asc' && $sort == 'sname'): ?>
				<a href="<?php echo $currentUrl.'/sortorder/desc/sort/sname'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/sortorder/asc/sort/sname'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
			</th>
			
            <th>
				Email
				<?php if($sortorder == 'asc' && $sort == 'email'): ?>
				<a href="<?php echo $currentUrl.'/sortorder/desc/sort/email'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/sortorder/asc/sort/email'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
			</th>

			
			
            <th>
				Tutor
				<?php if($sortorder == 'asc' && $sort == 'tname'): ?>
				<a href="<?php echo $currentUrl.'/sortorder/desc/sort/tname'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/sortorder/asc/sort/tname'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
			</th>
             <th>Session Date  
			 <?php if($sortorder == 'asc' && $sort == 'Date'): ?>
				<a href="<?php echo $currentUrl.'/sortorder/desc/sort/Date'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-n"></span></a>
				<?php else: ?>
				<a href="<?php echo $currentUrl.'/sortorder/asc/sort/Date'.'/limit/'.$limit.'/page/'.$page; ?>"><span class="css_right ui-icon ui-icon-triangle-1-s"></span></a>
				<?php endif;?>
			 </th>
            <th>
				Session Type
				
			</th>
           <th>Session Approved</th>
		   <th>TPresent (Y/N)</th>
		   <th>SPresent (Y/N)</th>
		   <th>Session Amt</th>
            
           
        </tr>
    </thead>

    <tbody>
	<?php
	//echo '<pre>'; print_r($payments);die;
	?>
    <?php $j = 0; foreach ($payments as $key => $val) :?>
        <tr id="id_<?php echo $val['id'];?>">
           <!-- <td><input type="checkbox" name="ids[]" value="<?php echo $val['id'];?>" /></td>-->
            <td><?php echo @$val['id'];?></td>
			<td><?php echo @$val['student'];?></td>
			<td><?php echo @$val['email'];?></td>
			<td><?php echo @$val['tutor'];?></td>
			<td>
				<?php
					$currentDtStr = strtotime($val['creatAt']);
					 
					echo date('Y-m-d',$currentDtStr);
				?>
			</td>
            <td>
           <?php //if(@$val['Intent'] >=1 || @$val['session_id']=='' ||  @$val['session_id']==NULL)
			$edate = date('Y-m-d H:i:s');
			if(@$val['Intent'] >=1 )
			{
					echo 'Aborted';
			}
			else if(@$val['sconnect']=='N'  && @$val['tconnect']=='N' && @$val['endTime'] < $edate)
			{
				echo 'Aborted';
			}

			else if(@$val['session_type'] == 'free')
			{
					echo 'Free';
			}

			else if(@$val['Booking'] == 'Booked' && @$val['endTime'] < $edate)
			{
					echo 'Aborted';
			}

			else if(@$val['Booking'] == 'Booked')
			{
					echo 'Booked';
			}
			else if(@$val['Booking']=='Requested')
			{
					echo 'Requested';
			}
			else
			{
				echo 'Requested';
			}
		   ?>
            </td>
            <td><?php
			if(@$val['s_attend'] == 1 && @$val['Intent']==0)
			{
					echo 'Yes';
			}
			else if(@$val['s_attend'] == 0 && @$val['t_attend'] == 1 && @$val['session_type'] == 'free')
			{
				echo 'Yes';
			}
			else{
				echo 'No';
			}
			?>
			</td>
			 <td> <?php echo @$val['tconnect']; ?></td>
			  <td> <?php echo @$val['sconnect']; ?></td>
			   <td> <?php echo "$". number_format(@$val['fee'],2,'.',''); ?></td>
            
			 
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
	window.location.href="<?php echo base_url().'admin/Attempted_Session/limit/'?>"+limit;
}
setTimeout('showmenu("attempted",0)',1000);
function del(_id){

	if(window.confirm('Are you sure you want to delete this?')){
		$.post('<?php echo Base_url("admin/disputes_deldd")?>',{id:_id},function(msg){
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
 


$(function(){
	$(".check-all").click(function() {
		$("input[name='ids[]']").attr('checked', this.checked);
	});
	
	$(".submit-search").click(function() {
		var search = $('#search').val();
		var dsearch = $('#events_widget').val();
		var currentPage = window.location.href;
		$form = $("<form id='sessioncnt' method='post' action='"+currentPage+"'></form>");
		if(search !='' || dsearch == '')
		{ 
		$form.append('<input type="hidden" name="search" id="search" value="'+search+'" />');
		}
		if(dsearch !='')
		{ 
			$form.append('<input type="hidden" name="dsearch" id="dsearch" value="'+dsearch+'" />');
		}
		 
		$('body').append($form);
		$('#sessioncnt').submit();
	});
	$('#search').on('keypress', function (event) {
		 if(event.which == '13'){
			//$(this).attr("disabled", "disabled");
			$(".submit-search").trigger('click');
		 }
	});
	$("#dsearch,#exp_session").datepicker({ dateFormat: 'yy-mm-dd' } );
	$('#events_widget').monthpicker();
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

function ExportAttend()
{
	var actionPage = '<?php echo base_url().'admin/ExportAttend' ?>';
	$form = $("<form id='DispCsv' method='post' action='"+actionPage+"'></form>");
	$('body').append($form);
	$('#DispCsv').submit();
}
/*$('td.actiondisabled a').attr("disabled", true);*/
</script>


</body>
</html>
