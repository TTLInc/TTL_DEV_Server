<?php
$this->layout->setLayoutData('content_for_layout_title','List <div style="float:right;"><a href="'.base_url('admin/metatag_add/').'" style="font-size:12px;">Add new</a></div><div style="float:right;font-weight:bold;"><input style="width:55%;padding:4px;float:left;margin-right: 5px;" class="adm_box1" type="text" value="'.$search.'" name="search" id="search" /><a href="javascript:void(0);" class="button submit-search" style="height:17px;line-height:19px;">Search</a> </div><div style="float:right;margin-left: 250px;font-weight:bold;"><span style="font-size:13px;">Pickup language :</span> '.$langSelect.'<a href="javascript:void(0);" class="button submit-lang" style="height:17px;line-height:19px;display:none;">Submit</a> </div>');?>
<?php if($this->session->flashdata("msg")):?>
 <div class="notice_3" id="errormsg">
	<span class="notice_icon"></span> 
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php echo base_url('images/cross_grey_small.png');?>" />
	</a>
	<p><?php echo $this->session->flashdata("msg"); ?></p>
</div>
<?php endif;?>
<table class="data_table" border=0>
    <thead>
        <tr>
            <th>Title</th>			
			<th>URL</th>
			<?php
			if($selectedLang['id']!="en"){?>
			<th><?php echo $selectedLang['value']; ?> Title</th>
			<?php }?>
			<th>Options</th>
        </tr>
    </thead>
    <tbody>
    <?php
	foreach ($metatag as $key => $val) {?>
        <tr id="id_<?php echo $val['id'];?>">
			<td>
				<?php
				echo $val['title'];
				?>
			</td>
			<td>
				<?php
				echo $val['url'];
				?>
			</td>
			<?php
			if($selectedLang['id']!="en"){?>
			<td>
				<?php
				echo $val[$selectedLang['id']."_title"];
				?>
			</td>
			<?php }?>
            <td align="center">
				<a href="<?php echo base_url('admin/metatag_add/'.$val['id'].'/'.$selectedLang['id']);?>">
					<img alt="Edit" src="<?php echo base_url('/images/cm_pencil.png');?>" /></a>
				<a href="javascript:void(0);" class="delcat" mid="<?php echo $val['id']; ?>">
					<img alt="delete" src="<?php echo  base_url('images/cm_cross.png')?>" /></a> 
            </td>
        </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">
            <div class="bulk-actions align-left">
            <div class="pagination">
            <?php echo $page;?>
            </div>
            <!-- End .pagination -->
            <div class="clear"></div>
            </td>
        </tr>
    </tfoot>
    
</table>
<script type="text/javascript">
setTimeout('showmenu("psettings",13)',1000);
function del(_id){
	if(window.confirm('Are you sure you want to delete this?')){
		$.post('<?echo base_url("admin/metatag_del")?>',{id:_id},function(msg){
			if (String == msg.constructor) {      
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			if(json.status){
				$.each(json.ids,function(k,v){
					$('#id_'+v).remove();
				})
				alert('Successfully Deleted.');
			}
			else{
				alert(json.msg);
			}
		})
	}
}
$(function(){
	
	$(".submit-search").click(function() {
		var search = $('#search').val();
		var currentPage = window.location.href;	
		$form = $("<form id='frmlookup' method='post' action='<?php echo base_url('admin/metatag');?>'></form>");
		$form.append('<input type="hidden" name="search" id="search" value="'+search+'" />');		
		$('body').append($form);
		$('#frmlookup').submit();
	});
	$('#search').on('keypress', function (event) {
		 if(event.which == '13'){
			$(".submit-search").trigger('click');
		 }
	});
	
	
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
		}
		else{
			alert('Must check one item.');
			return;
		}
	});
	$('.delcat').click(function(){
		del([$(this).attr('mid')]);
	})

	$(".submit-lang").click(function() {
		var lang = $('#language').val();
		var currentPage = window.location.href;

		$form = $("<form id='userlang' method='post' action='"+currentPage+"'></form>");
		$form.append('<input type="hidden" name="langreq" id="langreq" value="'+lang+'" />');
		$('body').append($form);
		$('#userlang').submit();
	});
	
	$(".editmid").click(function() {
		 
		
		var id=[$(this).attr('editid')];
		var currentPage = '<?php echo base_url('admin/multi_edit/id')?>'+'/'+id;
		var previouspage= window.location.href;
		$form = $("<form id='useredit' method='post' action='"+currentPage+"'></form>");
		$form.append('<input type="hidden" name="langreq" id="langreq" value="'+previouspage+'" />');
		$('body').append($form);
		$('#useredit').submit(); 
	});
	
	
	$("#language").change(function() {
		$(".submit-lang").trigger('click');
	});	
})
</script>
<style>
.main_box_top h3{ width:96%;}
/*.data_table th, .data_table td {width:24%;}*/
.data_table tfoot .pagination{ width:940px;}
.pagination a{ float:left;  margin: 0;
    padding: 3px 5px;}
.pagination strong{ float:left;  margin: 0;
    padding: 3px 5px;}
</style>
</body>
</html>