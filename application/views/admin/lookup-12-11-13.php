<?php 
$this->layout->setLayoutData('content_for_layout_title','Text List <div style="float:right;margin-left: 250px;font-weight:bold;"><span style="font-size:13px;">Pickup language :</span> '.$langSelect.'<a href="javascript:void(0);" class="button submit-lang" style="height:17px;line-height:19px;display:none;">Submit</a> </div>');?>

<?php if(@$errormsg):?>
 <div class="notice_4" id="errormsg">
	<span class="notice_icon"></span> 
	<a class="close" href="javascript:void(0);" onclick="$('#errormsg').hide()">
		<img src="<?php echo base_url('images/cross_grey_small.png');?>" />
	</a>
	<p><?php echo $errormsg; ?></p>
</div>
<?php endif;?>
<table class="data_table" border=0>
    <thead>
        <tr>
	    <!--<th>Id</th>-->
            <th>Name</th>
            <th>English</th>			
			<th><?php echo $selectedLang['value']; ?></th>
			<!--<th>Chinese</th>
			<th>Japanese</th>
			-->			
		<th>Options</th>
        </tr>
    </thead>
    <tbody>
    <?php
	foreach ($lookup as $key => $val) {
	    $val_en	= strip_tags($val['en']);
	    $val_kor	= strip_tags($val['kr']);
	    $val_ch	= strip_tags($val['ch']);
	    $val_jp	= strip_tags($val['jp']);
	    
	    if(strlen($val_en) > 100){
		$english = substr($val_en,0,100)."...";
	    } else {
		$english = $val_en;
	    }
	    
	    if(strlen($val_kor) > 100){
		$korea = substr($val_kor,0,100)."...";
	    } else {
		$korea = $val_kor;
	    }
	    
	    if(strlen($val_ch) > 100){
		$chinese = substr($val_ch,0,100)."...";
	    } else {
		$chinese = $val_ch;
	    }
	    
	    if(strlen($val_jp) > 100){
		$japan = substr($val_jp,0,100)."...";
	    } else {
		$japan = $val_jp;
	    }
    ?>
        <tr id="id_<?php echo $val['id'];?>">
	    <!--<td><?php echo $val['id'];?></td>-->
            <td style="width:100px;"><?php echo $val['name'];?></td>
	    <td style="width:100px;"><?php echo $english;?></td>
	    <td style="width:100px;">
			<?php 
				$selLang = $selectedLang['id'];
				$val_lang = strip_tags($val[$selLang]);;
				if(strlen($val_lang) > 100){
				$langvalue = substr($val_lang,0,100)."...";
				} else {
				$langvalue = $val_lang;
				}
				echo $langvalue;
				
			?>
		</td>
	    
		<!--
		<td><?php echo $chinese;?></td>
	    <td><?php echo $japan;?></td>
		-->
            <td align="center" style="width:100px;">
            <a href="<?php echo base_url('admin/multi_edit/id/'.$val['id']);?>"><img alt="Edit" src="<?php echo base_url('/images/cm_pencil.png');?>" /></a>
            <!--<a href="javascript:void(0);" class="delcat" mid="<?php echo $val['id']; ?>"><img alt="delete" src="<?php echo  base_url('images/cm_cross.png')?>" /></a>-->
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
setTimeout('showmenu("langs",0)',1000);
function del(_id){
	if(window.confirm('Are you sure you want to delete this?')){
		$.post('<?echo base_url("admin/del_multi")?>',{id:_id},function(msg){
			if (String == msg.constructor) {      
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			if(json.status){
				$.each(json.ids,function(k,v){
					$('#id_'+v).remove();
				})
				alert('sccueed.');
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
	
	$("#language").change(function() {
		$(".submit-lang").trigger('click');
	});
	
})
</script>
<style>
.main_box_top h3{ width:96%;}
.data_table th, .data_table td {width:24%;}
</style>
</body>
</html>
