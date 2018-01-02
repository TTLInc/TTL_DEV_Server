<?php $this->layout->setLayoutData('content_for_layout_title','Message list');?>
<?php $this->layout->setLayoutData('content_for_layout_links','<a href="'.base_url('admin/dashboardmessages_add').'">Add new Message</a>');?>

<table class="data_table">
    <thead>
        <tr>
            <th><input type="checkbox" class="check-all" /></th>
            <th>Id</th>
            <th>Text</th>
            <th>Image</th>
            <th>Status</th>
            
           
        </tr>
    </thead>

    <tbody>
    <?php $j = 0; foreach ($messages as $key => $val) :?>
        <tr id="id_<?php echo $val['id'];?>">
            <td><input type="checkbox" name="ids[]" value="<?php echo $val['id'];?>" /></td>
            <td><?php echo $val['id'];?></td>
            <td><?php echo $val['text'];?></td>
             <td><?php echo $val['image'];?></td>
			 <td><?php echo $val['status'];?></td>
            <td>
            <a href="<?php echo base_url('admin/dashboardmessages_edit/id/'.$val['id']);?>"><img alt="Edit" src="<?php echo base_url('/images/cm_pencil.png');?>" /></a>
            <a href="javascript:void(0);" class="delcat" mid="<?php echo $val['id']; ?>"><img alt="delete" src="<?php echo  base_url('images/cm_cross.png')?>" /></a> 
            </td>
        </tr>
	<?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6">
            <div class="bulk-actions align-left">
            <select name="dropdown" id="action">
                <option value="0">Choose an action...</option>
                <option value="1">Delete</option>
             </select> 
             <a href="javascript:void(0);" id="apply" class="button">Apply to selected</a></div>

            <div class="pagination">
            
            </div>
            <!-- End .pagination -->
            <div class="clear"></div>
            </td>
        </tr>
    </tfoot>
</table>
<script type="text/javascript">
setTimeout('showmenu("pcontent",8)',1000);
function del(_id){
	if(window.confirm('Are you sure you want to delete this?')){
		$.post('<?php echo Base_url("admin/dashboardmessages_del")?>',{id:_id},function(msg){
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


<script>
	function createVideo(poster,videoPath,title){
		$('#player_a').parent('#player_b').empty().append($('<div id="player_a" class="video_Wp posR projekktor"></div>')); 
		proje = '';
		proje = projekktor('#player_a', {
			title: title,
			debug: false,
			poster: poster,
			width: 719,
			height: 397,
			playerFlashMP4:'<?php echo Base_url("vedio/jarisplayer.swf");?>',
			playerFlashMP3:'<?php echo Base_url("vedio/jarisplayer.swf");?>',
			//plugin_display: {
			//	logoImage: '<?php echo Base_url("images/header.jpg");?>',
			//	logoDelay: 5
			//},
			controls: true,
			playlist: [
				{
					0: {src:videoPath+'.ogv', type:'video/ogv'},
					1: {src:videoPath+'.ogg', type:'video/ogg'},
					2: {src:videoPath+'.mp4', type:'video/mp4'}
				}
			] 
		});
	}
	$(function(){
		$('a@[href=#]').attr('href','javascript:void(0)');
		
		var _firstLesson = $('.list dl:first');
		if( typeof(_firstLesson.get(0)) == 'undefined' || _firstLesson.attr('source')==''){
			createVideo('<?php echo profile_video("");?>','<?php echo profile_video("","");?>','Default vedio');
			$('.nowTitle').html($('.sTitle',_firstLesson).html());
			$('.description').html($('.sDesc',_firstLesson).html());
		}
		else {
			var _source = _firstLesson.attr('source');
			createVideo(_source.replace('__PATH__','uploads/video/images/')+'.jpg',_source.replace('__PATH__','uploads/video/'),_firstLesson.find('.lname').html());
			
			$('.nowTitle').html($('.sTitle',_firstLesson).html());
			//console.info($('.sDesc',_firstLesson).html());
			$('#howUpTitle').html($('.sTitle',_firstLesson).html());
			$('.description').html($('.sDesc',_firstLesson).html());
		}


		$('.showVideo').click(function(){
			var _clickEl = $(this);
			var _li = _clickEl;//.parents('li.lesson');
			var _source =  _li.attr('source');
			//console.info(_source.replace('__PATH__','uploads/video/images/')+'.jpg');
			createVideo(_source.replace('__PATH__','uploads/video/images/')+'.jpg',_source.replace('__PATH__','uploads/video/'),_li.find('.lname').html());
			$('.nowTitle').html($('.sTitle',_li).html());
			$('#howUpTitle').html($('.sTitle',_li).html());
			$('.description').html($('.sDesc',_li).html());
			document.location.href = '#top';
		})
	})

</script>


</body>
</html>
