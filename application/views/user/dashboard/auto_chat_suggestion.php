<?php 
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Expires: -1" );
?>
<?php
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
$arrVal = $this->lookup_model->getValue('301', $multi_lang);
$linvite = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('262', $multi_lang);
$luserhasbeeninvited = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('262', $multi_lang);
$lnorecordsfound = $arrVal[$multi_lang];
?>
						<div id="section1">
                                     <?php 
												if(@$onlineUsers): 
												foreach($onlineUsers as $online): ?>
                                                <?php 
													//print_r($online);exit;
												?>
													<div class="chatitems"> 
														<div class="chatimg">
														<?php if($online["pic"] !='') :?>
															<img src="<?php echo base_url().'uploads/images/thumb/'.$online['pic']; ?>" alt="No Image" width="50" height="50">
														<?php else: ?>
															<img src="<?php echo base_url('images/header.jpg');?>" width="50" height="50" alt="021" />
														<?php endif; ?>	
														</div>
														<div class="chatuser">
															<!--<span><?php echo $online['welcomeuser']; ?></span>-->
															<span><?php echo $online['welcomeuser']."".$online['uid'].""; ?></span>
														</div>
														<?php //if($online['invitationStatus'] == 0): ?>
														
														<div class="online_join">
															<?php if(@$online['chatInvitationStatus'] == ''):?>
															<div class="blue-btn" id="invite_<?php echo $online['uid']; ?>">
																<a  href="javascript:void(0);" onclick="inviteuser('<?php echo $online['uid']; ?>');"><span><?php echo $linvite; ?></span></a>
															</div>
															<?php endif;?>
															<?php if(@$online['chatInvitationStatus'] == 'invited' || @$online['chatInvitationStatus'] == 'accepted'):?>
															<div class="grp-btn" id="invited_<?php echo $online['uid']; ?>" >
																<span><?php echo $luserhasbeeninvited; ?></span>
															</div>
															<?php else: ?>
															<div class="grp-btn" id="invited_<?php echo $online['uid']; ?>" style="display:none;" >
																<span><?php echo $luserhasbeeninvited; ?></span>
															</div>
															<?php endif;?>
														</div>
														<?php //endif; ?>
													</div>
                                                
                                                <?php 
													endforeach; 
													else:
													echo "<br>No Records Found";
													endif; 
												?>
</div>
<script language="JavaScript" type="text/javascript">
			$( document ).ready(function() {
				startChat();
				var chatgroupid = document.getElementById('currentgroupid').value;
			});
			
			$('#privatechat').click(function(){
				
				$('#section1').hide();
				
					$.ajax({
					url: "<?php echo base_url('user/private_chat/');?>",
					data: '',
					success: function(msg){
				
					if(msg.length >0) {
						$('#privates').fadeIn();
						$('#privateList').html(msg);
					}
					}
					});
				});
			
			var sendReq = getXmlHttpRequestObject();
			var receiveReq = getXmlHttpRequestObject();
			var lastMessage = 0;
			var mTimer;
			
			//Function for initializating the page.
			function startChat() {
				//Set the focus to the Message Box.
				//document.getElementById('txt_message').focus();
				//Start Recieving Messages.
				getChatText();
			}
			function inviteuser(userid)
			{
				var _groupname = userid;
				var _ownermessage = userid;

				$(this).attr('buttontype','doing');
				var dataStringGroup = "groupname="+_groupname+"&ownermessage="+_ownermessage;
				$.ajax({
						url: "<?php echo base_url("user/chat_save_group");?>",
						type: 'GET',
						data: dataStringGroup,
						dataType: 'json',
						cache: false,
						success: function (msg){
							if (String == msg.constructor) {
								eval ('var json = ' + msg);
							} else {
								var json = msg;
							}
							
							var chatgroupid = json.gid;
							dataString = "chat="+chatgroupid+"&userid="+userid;
							$.ajax({
								url: "<?php echo base_url();?>user/chat_invite_user",
								type: 'GET',
								data: dataString,
								dataType: 'json',
								cache: false,
								success: function (xml){
									if(xml.status == 'success')
									{
										var tmp = 'invite_'+userid;
										document.getElementById(tmp).style.display = 'none';
										var tmp = 'invited_'+userid;
										document.getElementById(tmp).style.display = '';
									}
								}
							});
						}
				});
			}
</script>