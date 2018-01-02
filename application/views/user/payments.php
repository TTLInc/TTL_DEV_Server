<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
<?php $this->layout->appendFile('css',"css/search.css");?>
 <div class="baseBox baseBoxBg clearfix">
    	
        <div class="content_main fr">
        	<div class="main_inner">
                <ul class="student_prof teacher_prof">
                    <?php echo profile_menu($linkType,'i_prof');?>
                </ul>
                <!--/student_prof-->
                <div id="student_prof_Wp">
                    <div class="mod">
                       <div class="pro_tle tle"><h3> Under Construction</h3></div>
					</div>
                </div>
                <!--/student_prof_Wp-->
            </div>
        </div>
        <!--/content_main-->
		<?php include dirname(__FILE__).'/leftSide.php';?>
    </div>
	
	<script>
	window.delClickData = '';//save the param del data
	$(function(){
		$('a@[href=#]').attr('href','javascript:void(0)');
		$('.del').click(function(){
			var _tr = $(this).parents('tr');
			var _delId = _tr.attr('inboxId');
			var _data = {id:_delId}; 
			window.delTrObj = _tr;
			$('#dialog1').dialog({
				modal:true,
				buttons: {
					"Delete the item": function() {
						delDo();
						$( this ).dialog( "close" );
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
			})
		})
	})
	function delDo(){
				
		var _delId = window.delTrObj.attr('inboxId');
		var _data = {id:_delId}; 
		
		$.post('<?php echo base_url("user/del_message");?>',_data,function(msg){
			if (String == msg.constructor) {      
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			if(json.status){
				$('#dialog').html('Del Success..');
				$('#dialog').dialog({modal:true});
				window.delTrObj.remove();
			}
			else{				
				$('#dialog').html(json.msg);
				$('#dialog').dialog({modal:true});
			}
			//$('#send').attr('buttontype','done');
		})		
	}
	</script>
	
	<div id="dialog1" title="Comfirm" style="display:none">
		<p>Are you sure to delete it?.</p>
	</div>
