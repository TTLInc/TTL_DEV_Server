<?php
/*
* @autor TECHNO-SANJAY
* @package student private dashboard
* @date 10 May 2013
**/
$basePath =  substr(BASEPATH,0,-7); 
?>


<script language="JavaScript" type="text/javascript">
			$( document ).ready(function() {
				<?php if($gid): ?>
					document.getElementById('currentgroupid').value = '<?php echo $gid; ?>';
				<?php endif; ?>
				startChat();
				var chatgroupid = document.getElementById('currentgroupid').value;
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
			//Gets the browser specific XmlHttpRequest Object
			function getXmlHttpRequestObject() {
				if (window.XMLHttpRequest) {
					return new XMLHttpRequest();
				} else if(window.ActiveXObject) {
					return new ActiveXObject("Microsoft.XMLHTTP");
				} else {
					document.getElementById('p_status').innerHTML = 'Status: Cound not create XmlHttpRequest Object.  Consider upgrading your browser.';
				}
			}
			
			//Gets the current messages from the server
			function getChatText() {
				var chatgroupid = document.getElementById('currentgroupid').value;
				
				$.get("<?php echo base_url();?>user/chat_get_message",{
							chat: chatgroupid,
							last: lastMessage
							
						}, function(xml) {
							if(xml != '')
							{
								addMessages(xml);
							}
				});
				
			}
			function addMessages(xml)
			{
				var chat_div = document.getElementById('div_chat');
				var xmldoc = xml;
				var message_nodes = xmldoc.getElementsByTagName("message"); 
				var n_messages = message_nodes.length
				for (i = 0; i < n_messages; i++) {
					var user_node = message_nodes[i].getElementsByTagName("user");
					var text_node = message_nodes[i].getElementsByTagName("text");
					var time_node = message_nodes[i].getElementsByTagName("time");
					
					var user_id = message_nodes[i].getElementsByTagName("user_id");
					var user_img = message_nodes[i].getElementsByTagName("user_img");
					var imgsrc = '<?php echo base_url();?>uploads/images/' + user_img[0].firstChild.nodeValue;
					
					
					chat_div.innerHTML += '';
					//chat_div.innerHTML += '<div class="chatitems">'+ '<div class="chat_time">' + time_node[0].firstChild.nodeValue + '</div>' + '<div class="chatimg"><a href="<?php echo base_url();?>user/send_message"><img src="'+imgsrc+'" height="50px" width="50px" /></a></div>' + '<div class="chatuser">' + user_node[0].firstChild.nodeValue + '</div>'  + '<div class="chattext">' + text_node[0].firstChild.nodeValue + '</div></div>';
					chat_div.innerHTML += '<div class="chatitems">'+ '<div class="chat_time">' + time_node[0].firstChild.nodeValue + '</div>' + '<div class="chatimg"><a href="<?php echo base_url();?>user/profile/uid/'+user_id[0].firstChild.nodeValue+'"><img src="'+imgsrc+'" height="30px" width="30px" /></a></div>' + '<div class="chatuser">' + '<span>' + user_node[0].firstChild.nodeValue + ':</span>' +     text_node[0].firstChild.nodeValue + '</div></div>';
					
					chat_div.scrollTop = chat_div.scrollHeight;
					lastMessage = (message_nodes[i].getAttribute('id'));
				}
				mTimer = setTimeout('getChatText();',2000); //Refresh our chat in 2 seconds
			}
			//Add a message to the chat server.
			function sendChatText() {
				var chatgroupid = document.getElementById('currentgroupid').value;
				if(document.getElementById('txt_message').value == '' || document.getElementById('txt_message').value == 'Type Message') {
					alert("You have not entered a message");
					return;
				}
				
				$.getJSON("<?php echo base_url();?>user/chat_update",{
							chat: chatgroupid,
							last: lastMessage,							
							message: document.getElementById('txt_message').value,							
							name: 'test name'						
						}, function(msg) {
							
							if(msg.blocked == 'blocked')
							{
								alert('You are blocked from chat please contact administrator');
								return false;
							}
							if(msg.banded == 'banded')
							{
								alert("You have typed an offensive word in your message. Please rephrase.");
								return false;
							}
							getChatText();
							
					
				});		
				document.getElementById('txt_message').value = '';
				document.getElementById('txt_message').innerHTML = '';
			}
			
						
			//When our message has been sent, update our page.
			function handleSendChat() {
				//Clear out the existing timer so we don't have 
				//multiple timer instances running.
				clearInterval(mTimer);
				getChatText();
			}
			//Function for handling the return of chat text
			function handleReceiveChat() {
				if (receiveReq.readyState == 4) {
					var chat_div = document.getElementById('div_chat');
					var xmldoc = receiveReq.responseXML;
					var message_nodes = xmldoc.getElementsByTagName("message"); 
					var n_messages = message_nodes.length
					for (i = 0; i < n_messages; i++) {
						var user_node = message_nodes[i].getElementsByTagName("user");
						var text_node = message_nodes[i].getElementsByTagName("text");
						var time_node = message_nodes[i].getElementsByTagName("time");
						
						chat_div.innerHTML += '<div class="chat_time">' + time_node[0].firstChild.nodeValue + '</div>';
						chat_div.innerHTML += user_node[0].firstChild.nodeValue + '&nbsp;';
						chat_div.innerHTML += text_node[0].firstChild.nodeValue + '<br />';
						chat_div.scrollTop = chat_div.scrollHeight;
						lastMessage = (message_nodes[i].getAttribute('id'));
					}
					mTimer = setTimeout('getChatText();',2000); //Refresh our chat in 2 seconds
				}
			}
			//This functions handles when the user presses enter.  Instead of submitting the form, we
			//send a new message to the server and return false.
			function blockSubmit() {
				sendChatText();
				return false;
			}
			//This cleans out the database so we can start a new chat session.
			function resetChat() {
				if (sendReq.readyState == 4 || sendReq.readyState == 0) {
					sendReq.open("POST", 'getChat.php?chat=1&last=' + lastMessage, true);
					sendReq.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
					sendReq.onreadystatechange = handleResetChat; 
					var param = 'action=reset';
					sendReq.send(param);
					document.getElementById('txt_message').value = '';
				}							
			}
			//This function handles the response after the page has been refreshed.
			function handleResetChat() {
				document.getElementById('div_chat').innerHTML = '';
				getChatText();
			}
			startChat();
			
			function inviteuser(userid)
			{
				var chatgroupid = document.getElementById('currentgroupid').value;
				$.get("<?php echo base_url();?>user/chat_invite_user",{
							chat: chatgroupid,
							userid: userid
							
						}, function(xml) {
							//alert(xml.status)
							if(xml.status == 'success')
							{
								var tmp = 'invite_'+userid;
								document.getElementById(tmp).style.display = 'none';
								var tmp = 'invited_'+userid;
								document.getElementById(tmp).style.display = '';
							}
				});
			}
			
</script>
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
$arrVal = $this->lookup_model->getValue('302', $multi_lang);
$linvited = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('262', $multi_lang);
$llivechat = $arrVal[$multi_lang];
?>
									<?php //if($gid == '' || $gid == 1): ?>
                                	<div class="das-box das-box2 no-bor" style="width:345px">
                                    	<div class="box-tle gray-ttl">
                                            <div class="leftbg ttl6">
                                            <span>Online Users</span></div></div>
                                        <div class="box-cont border-all div_chat-div">
											<?php 
												if($onlineUsers): 
												foreach($onlineUsers as $online): ?>
                                                <?php 
													//print_r($online);exit;
												?>
													<div class="chatitems">
														<div class="chatimg">
														<?php if(file_exists(base_url('uploads/images/'.$online["pic"]))): ?>
															<img src="<?php echo base_url().'timthumb.php?src='.base_url().'uploads/images/'.$online['pic'].'&w=50&h=50&zc=0'; ?>"/ alt="No Image">
														<?php else: ?>
															<img src="<?php echo base_url('images/header.jpg');?>" width="50" height="50" alt="021" />
														<?php endif; ?>	
														</div>
														<div class="chatuser">
															<span><?php echo $online['welcomeuser']; ?></span>
														</div>
														<?php if($online['invitationStatus'] == 0): ?>
														<div class="online_join">
															<?php if($online['chatInvitationStatus'] == ''):?>
															<div class="blue-btn" id="invite_<?php echo $online['uid']; ?>">
																<a  href="javascript:void(0);" onclick="inviteuser('<?php echo $online['uid']; ?>');"><span><?php echo $linvite;?></span></a>
															</div>
															<?php endif;?>
															<?php if($online['chatInvitationStatus'] == 'invited'):?>
															<div class="grp-btn" id="invited_<?php echo $online['uid']; ?>" >
																<a  href="javascript:void(0);" ><span><?php echo $linvited;?></span></a>
															</div>
															<?php else: ?>
															<div class="grp-btn" id="invited_<?php echo $online['uid']; ?>" style="display:none;" >
																<a  href="javascript:void(0);" ><span><?php echo $linvited;?></span></a>
															</div>
															<?php endif;?>
														</div>
														<?php endif; ?>
													</div>
                                                
                                                <?php 
													endforeach; 
													endif; 
												?>
                                                <div class="live-cht-btn"><a href="<?php echo Base_url("user/dashboard");?>"><?php echo $llivechat;?></a></div>
                                                </div>
                                </div>
							
							<script src="<?php echo base_url('js/jquery.1.7.2.min.js');?>"></script>