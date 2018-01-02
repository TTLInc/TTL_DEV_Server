<?php $this->layout->setLayoutData('content_for_layout_title','Tutor Organization');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<div style="float:left;margin-right:110px;font-weight:bold;"><input style="width:55%;padding:4px;float:left;margin-right: 5px;" class="adm_box1" type="text" value="'.$search.'" name="search" id="search" /><a href="javascript:void(0);" class="button submit-search" style="height:17px;line-height:19px;">Search</a> </div>');?>
<?php $currentUrl = base_url('admin/school_Layout');?>
<table class="data_table">
    <thead>
        <tr>
            
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
	   
		 
		  
			
            <th class="rw9"><div class="rw9">Unique Landing Page</div></th>
        </tr>
    </thead>

    <tbody>
    <?php 
	
	foreach ($users as $key => $val) :?>
        <tr id="id_<?php echo $val['uid'];?>">
          
            <td class="rw2"><div class="rw2"><?php echo $val['id'];?></div></td>
            <td class="rw3" style="padding-left:10px;"><?php echo $val['firstName']." ".$val['lastName'] ;?></td>
           <td> <input type="checkbox" onclick="checkMe(<?php echo $val['uid']?>);" <?php if ($val['s_layout'] ==1) { ?> checked <?php }?> value="<?php echo $val['s_layout'];?>"> </td>
			 
			
        </tr>
        <?php endforeach; ?>
     <div class="pagination">
           
            </div>
	</tbody>
    <tfoot>
	<tr>
            <td colspan="8">
			  <div class="pagination">
            <?php echo $page;?>
            </div>
         
            <div class="clear"></div>
            </td>
			
        </tr>
       
    </tfoot>
</table>

<script type="text/javascript">
setTimeout('showmenu("s_layout",0)',1000);
function checkMe(status){
	 
	 
		$.post('<?echo base_url("admin/updatLayoutStatus")?>',{id:status},function( ){
			 
			 alert('updated successfully');
			 location.reload();
		});
	 
}
	$(".submit-search").click(function() {
		var search = $('#search').val();
		var currentPage = window.location.href;
	
		$form = $("<form id='userlist' method='post' action='"+currentPage+"'></form>");
		$form.append('<input type="hidden" name="search" id="search" value="'+search+'" />');		
		$('body').append($form);
		$('#userlist').submit();
	});


</script>
<style>.data_content{ padding:20px 10px;}
.data_table th, .data_table td{ padding:5px 0px;}</style>
</body>
</html>
