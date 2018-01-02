<?php
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0'); // Proxies.


$multi_lang = 'en';
if(!isset($_SESSION)) {
     session_start();
}
if(isset($_SESSION['multi_lang']))
{
	$multi_lang = $_SESSION['multi_lang'];
}
else
{
	$multi_lang = 'en';	
}
$this->load->model(array('lookup_model')); 
$arrVal = $this->lookup_model->getValue('74', $multi_lang);
$beepbox = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('75', $multi_lang);
$newbeepmsg = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('76', $multi_lang);
$subjecttext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('77', $multi_lang);
$fromtxt = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('78', $multi_lang);
$datetxt = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('79', $multi_lang);
$deltext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('80', $multi_lang);
$applytxt = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('326', $multi_lang);
$lmsgsettings = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('988', $multi_lang);
$Confirm = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('801', $multi_lang);
$Areusure = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1030', $multi_lang);
$DeleteThis = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('412', $multi_lang);
$Cancel = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('479', $multi_lang);
$deleteSucc = $arrVal[$multi_lang];
?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
<?php $this->layout->appendFile('css',"css/search.css");?>
<?php 
// checks for quarantine users
if($profile['quarantine'] == 1){?>
	<script>
		alert("Your account has been made invisible to the membership. Either you have an incomplete profile (photo, video greeting, bio, rate, and open calendar sessions) or you have inappropriate content. Please edit so we can maintain a complete and professional profile for all visible tutors. Once updated, your profile may automatically become visible or else send an email to support@thetalklist.com.");
	</script>
	<style>
		.mod .bd{display:none;}
	</style>
<?php } ?>

<script>
function download(id)
{
	var url="<?php echo base_url('user/DownloadAttachment/')?>"+"/"+id;
	window.open(url);
 
}
</script>
<script>
	var inbTimer;
	function getUnreadInboxMessagesReal()
	{
		var lastInbId = $('#nbmesg tr:first').attr('inboxid');
		var i_page = '<?php echo $this->uri->segment(3); ?>'; 
		if(typeof lastInbId == 'undefined')
		{
			lastInbId = 0;
		}
		
		if(typeof lastInbId != 'undefined')
		{
			var aj1_uid = '<?php echo @$profile['uid']; ?>';
			var dataStringinb1 = '';
			dataStringinb1 +='lastid='+lastInbId+'&page='+i_page+'&uid='+aj1_uid;
			$.ajax({
				  type:'POST',
				  data:dataStringinb1,
				  url:'<?php echo base_url('user/get_unread_messages_real/');?>',
				  success:function(msg){
						if (String == msg.constructor)
						{
							var result;
							eval('result = ' + msg);
						} else {
							var result = msg;
						}
						
						if(result.status == 'success')
						{
							var row = result.row;
							
							if(row != '')
							{
								//alert('hi');
								var existsRows = $('#nbmesg').html();
								var newRows = row + existsRows;
								$('#nbmesg').html(newRows);
								
								var currentClass = $('.i_prof').attr('class');
								var addClass = currentClass + ' i_yic';
								$('.i_prof').addClass(addClass);
								
							}else{
								
							}
						}
						
				   } 
				
			});
			inbTimer = setTimeout('getUnreadInboxMessagesReal()',3000);
		}else{
			setTimeout('getUnreadInboxMessagesReal()',500);
		}
	}
	$(window).load(function () {
	  getUnreadInboxMessagesReal();
	});
</script>


<div class="baseBox baseBoxBg clearfix">
    	
        <div class="content_main fr">
        	<div class="main_inner">
                <?php if($this->session->userdata['roleId']==4){
                 echo organization_menu($linkType,'i_prof');
                 }
				 else if($this->session->userdata['roleId']==5){
				 echo Affiliate_menu($linkType,'i_prof');
				 }
				 {
			    echo profile_menu($linkType,'i_prof',$profile['uid']);
                }?>
                <!--/student_prof-->
                <div id="student_prof_Wp">
                    <div class="mod">
                       
                            <div class="content tle"><h2><?php echo $beepbox; ?> 
							 <span style="color:#3399CC;font-size:14px;margin-left:10px;"><?php echo $this->session->userdata('succsend');
							$this->session->set_userdata('succsend', '');
							?></span>
							<a style="font-size:14px;" class="msg-lnk" href="<?php echo base_url('user/message_setting');?>"><?php echo $lmsgsettings;?></a></h2></div>
                       
                        <div class="bd">
						<!--
                            <div class="inbox_mod">
                            	<div class="clearfix">
                                    <h3 class="fl">Message</h3>
                                    <div class="ico_message fr">
                                        <a href="#" class="ico_msg ico_msg_prev"></a>
                                        <a href="#" class="ico_msg ico_msg_nxt"></a>
                                        <a href="#" class="ico_msg ico_msg_del"></a>
                                    </div>
                                </div>
                                
                                <div class="inbox_list inbox_tle">
                                	<label>From:</label>
                                    <input type="text" class="inbox_ipt_text c037898" name="" value="Username" /> 
                                </div>
                                
                                <div class="inbox_list inbox_subject">
                                	<label>Subject:</label>
                                    <input type="text" class="inbox_ipt_text c000" name="" value="Subject Line" /> 
                                </div>
                                
                                <div class="inbox_subject">
                                	<label>Message:</label>
                                    <textarea class="inbox_textarea" style="width:600px;height:500px">
                                    </textarea>
                                </div>
                                
                            </div>
						-->
							<div class="search_rt_mid_t">
								<span class="search_rt_mid_t_lf lh30">
									<a class="aqua_btn_msg redRadiusBtn2 " style="color:white" href="<?php echo base_url('user/send_message');?>"><?php echo $newbeepmsg; ?></a>
								</span>
								<!--<span class="search_rt_mid_t_lf lh30">
									<a class="norBtn redRadiusBtn2 forwardmsg" style="color:white" href="javascript:void(0);">Forward Messages</a>
								</span>-->
								<div class="search_rt_mid_t_rt">
									<div class="v_ajax_page"><?php echo $pagination;?></div>
								</div>
							</div>
							<table class="history_table f14">
								<thead>
									<tr><th width="3%"><!--<input type="checkbox"  class="idAll">--></th><th><?php echo $subjecttext; ?></th><th><?php echo $fromtxt; ?></th><th><img style="width:14px;" src="<?php echo base_url('images/clip.png');?>" /></th><th><?php echo $datetxt; ?></th></tr>
								</thead>
								<tbody id="nbmesg">
									<?php
									$fullname = $profile['firstName'].''.$profile['uid'];
									foreach ($inboxs as $k=>$message):?>
									<tr class="read<?php echo $message['isRead'];?> " inboxId="<?php echo $message['id'];?>">
										<td><input type="checkbox" value="<?php echo $message["id"];?>" class="ids"></td>
										
										<td><a href="<?php echo base_url('user/view_message/id/'.$message['id']);?>" <?php if($message['isRead']) { echo "style='color:#000000;'"; } else{ echo "style='color:#000000;font-weight:bold;'"; } ?>><?php echo $message['subject'];?></a></td>
										<td>
											<?php if($message['fId'] == 1): ?>
											TalkMaster BlueBob
											<?php else:?>
											<p <?php if($message['isRead']) { echo "style='color:#000000;'"; } else{ echo "style='color:#000000;font-weight:bold;'"; } ?>><?php if($fullname==$message['username']){ echo 'TalkMaster BlueBob';}else{  echo $message['username'];}?></p>
											<!--<a href="<?php echo base_url('user/profile/uid/'.$message['fId']);?>" <?php if($message['isRead']) { echo "style='color:#000000;'"; } else{ echo "style='color:#000000;font-weight:bold;'"; } ?>><?php echo $message['username'];?></a>-->
											<?php endif; ?>
										</td>
										<td style="width:10px;"><?php if($message['attach'] !=''){?><img style="width:14px;cursor:pointer" onclick="download(<?php echo $message['id'];?>)" src="<?php echo base_url('images/clip.png');?>" /><?php }?></td>
										<td><div <?php if($message['isRead']) { echo "style='color:#000000;'"; } else{ echo "style='color:#000000;font-weight:bold;'"; } ?>><?php echo date( 'M d, Y | h:i a ' , outTime($message['createAt']) );?></div></td>
										
									<?php endforeach;?> 
								</tbody>
								<tfoot>
									<tr>
										<td colspan="4">
											<select id="applys" onchange="Myfucntion();">
												<option value="d"><?php echo $deltext; ?></option>
												<option value="s">Select all</option>
												<option value="u">Unselect all</option>
											</select>
											<a href="javascript:;"  class="aqua_apply_btn grayRadiusBtn delInbox" style="padding:0px 5px;line-height: 24px;height:24px"><?php echo $applytxt; ?></a>
										</td>
									</tr>
								</tfoot>	
							</table>
                        </div>
                    </div>
                </div>
                <!--/student_prof_Wp-->
            </div>
        </div>
        <!--/content_main-->
		<?php include dirname(__FILE__).'/leftSide.php';?>
    </div>
	
	<script>
	
	function Myfucntion()
	{
		if($('#applys').val() =='s'){
			$('.ids').each(function() { //loop through each checkbox
               // this.checked = true;  //select all checkboxes with class "checkbox1"              
			   $('.ids').attr("checked", "checked");
			   
            });
			
			}
			if($('#applys').val() =='u'){
			$('.ids').each(function() { //loop through each checkbox
               // this.checked = true;  //select all checkboxes with class "checkbox1"              
			   $('.ids').removeAttr("checked", "checked");
			   
            });
			
			}
	}
	</script>
	<script>
	window.delClickData = '';//save the param del data
	$(function(){
	
		$('a@[href=#]').attr('href','javascript:void(0)');
		$('.del').click(function(){
			
			//return false;
			var _tr = $(this).parents('tr');
			var _delId = _tr.attr('inboxId');
			var _data = {id:_delId}; 
			window.delTrObj = _tr;
			$('#dialog1').dialog({
			
				modal:true,
				resizable: false,
				buttons: {
					"<?php echo "Delete";?>": function() {
						delDo();
						$( this ).dialog( "close" );
					},
					<?php echo $Cancel;?>: function() {
						$( this ).dialog( "close" );
					}
				}
			})
		})
		$('.delInbox').click(function(){
		    
			
			if($('#applys').val() =='d'){
			
			
			window.delTrObjs = [];
			$('.ids:checked').each(function(){
				window.delTrObjs.push($(this).parents('tr'));
			});
			/*var _tr = $(this).parents('tr');
			var _delId = _tr.attr('inboxId');
			var _data = {id:_delId}; 
			window.delTrObj = _tr;*/
			$('#dialog1').dialog({
				modal:true,
				resizable: false,
				buttons: {
					"<?php echo "Delete";?>": function() {
				
						delDom();
						$( this ).dialog( "close" );
					},
					<?php echo $Cancel;?>: function() {
						$( this ).dialog( "close" );
					}
				}
			})
			
			}
			
		})
		
		$('.forwardmsg').click(function(){
			var _forId = [];
			$('.ids:checked').each(function(){
				//alert($(this).parents('tr').attr('inboxId'));
				_forId.push($(this).parents('tr').attr('inboxId'));
			});
			var _data = {id:_forId}; 
			$.post('<?php echo base_url("user/forward_messages");?>',_data,function(msg){
				if (String == msg.constructor) {      
					eval ('var json = ' + msg);
				} else {
					var json = msg;
				}
				if(json.status){
					$('#dialog').html('Forward Success to '+json.email);
					$('.ids:checked').each(function(){
						$('.ids').removeAttr('checked');
					});
					$('#dialog').dialog({modal:true});
					
				}
				else{				
					$('#dialog').html(json.msg);
					$('#dialog').dialog({modal:true});
				}
				
			})
			
			
		})
		
	})
	function delDom(){
		var _delId = [];
		$.each(window.delTrObjs,function(k,v){
			_delId.push(v.attr('inboxId'));
		})
		var _data = {id:_delId}; 
		//console.info(_data);return;
		$.post('<?php echo base_url("user/del_message");?>',_data,function(msg){
			if (String == msg.constructor) {      
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			if(json.status){
				$('#dialog').html('<?php echo $deleteSucc;?>');
				$('#dialog').dialog({modal:true,resizable: false,buttons: { "Ok": function() { $(this).dialog("close"); } } 
});
				//window.delTrObj.remove();
				$.each(window.delTrObjs,function(k,v){
					v.remove();
				})
				window.delTrObjs = [];
			}
			else{				
				$('#dialog').html(json.msg);
				$('#dialog').dialog({modal:true});
			}
			//$('#send').attr('buttontype','done');
		})	
	}
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
				$('#dialog').html('<?php echo $deleteSucc;?>');
				$('#dialog').dialog({modal:true,resizable: false});
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
	
	<div id="dialog1" title="<?php echo $Confirm;?>" style="display:none">
		<p><?php echo  "Please confirm deletion.";?></p>
	</div>
	
    <style>
	.read0 td a{color:#000;}
    .redRadiusBtn2 { padding:0 10px;}
    </style>
