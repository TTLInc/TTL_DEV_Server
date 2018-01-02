<?php
/*
* @autor TECHNO-SANJAY
* @package student private dashboard
* @date 10 May 2013
**/
$basePath =  substr(BASEPATH,0,-7); 
?>
<?php $this->layout->appendFile('javascript',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js");?>

<script language="JavaScript" type="text/javascript">
			$( document ).ready(function() {
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
					var imgsrc = user_img[0].firstChild.nodeValue;
					
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
				if(document.getElementById('txt_message').value == '') {
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
								alert("You can't enter abuse word ");
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
<style>
.chatimg{ width:50px; margin-right:10px;}
.online-user .box-cont .online_join{ float:right;}
.online-user .div_chat-div{ width:95% !important;}
</style>
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
$arrVal = $this->lookup_model->getValue('34', $multi_lang);
$lsend = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('262', $multi_lang);
$llivechat = $arrVal[$multi_lang];
?>
 <div class="baseBox baseBoxBg clearfix">
 
		<?php include dirname(__FILE__).'/../leftSide.php';?>
        <div class="content_main fr">
        	<div class="main_inner">
                <ul class="student_prof">
                    <?php echo profile_menu('s_private','p_dasb',$profile['uid']);?>
                </ul>
                <!--/student_prof-->
                <div id="student_prof_Wp">
                	<div class="mod">
                        <div class="hd">
                            <div class="pro_tle tle"><h3></h3></div>
                        </div>
						
                        <div class="bd">
							<!--- dashboard integration code start --->
							
							<!--raxa code strat-->
                           	<div class="dasbord">
								<?php if($gid == '' || $gid == 1): ?>
								<input type="hidden" name="currentgroupid" id="currentgroupid" value="<?php echo $myGroups[0]['chat_id']; ?>" />
                            	<?php else: ?>
								<input type="hidden" name="currentgroupid" id="currentgroupid" value="<?php echo $gid; ?>" />
								
                                <?php endif; ?>
                                <div class="box-row">
									<?php //if($gid == '' || $gid == 1): ?>
                                	<div class="das-box online-user no-bor" style="width:347px; ">
                                    	
                                    	<div class="box-tle gray-ttl">
                                            <div class="leftbg ttl6">
                                            <span>Private User</span></div></div>
                                        <div class="box-cont border-all div_chat-div">
											<?php 
											/*	if($onlineUsers): 
												foreach($onlineUsers as $online):*/ ?>
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
															<span><?php echo $privateUser['firstName']; ?></span>
														</div>
														
													</div>
                                                
                                                <?php 
												/*	endforeach; 
													endif; */
												?>
                                                </div>
                                    </div>
									<?php //endif; ?> 
                                   <div class="das-box das-box2 das-box-teh  no-bor" style="width:345px; float:right;">
                                    	<div class="box-tle gray-ttl"><div class="leftbg ttl2"><span style="width:93.5%;"><?php echo $llivechat;?></span></div></div>
                                        <div class="box-cont border-all div_chat-div" style="width:92.5% !important;" >
											  
											<div id="div_chat" class=" no-bor" style="width:320px;"> 
			 
											</div>
											<form id="frmmain" name="frmmain" onsubmit="return blockSubmit();">
											
												<!--<input type="button" name="btn_get_chat" id="btn_get_chat" value="Refresh Chat" onclick="javascript:getChatText();" />-->
												<input type="text" id="txt_message" name="txt_message" style="width: 311px;height:35px;margin-top:5px;padding:3px;"/> 
												<input type="button" name="btn_send_chat" id="btn_send_chat" value="<?php echo $lsend;?>" style="width:85px;margin-top:5px;" onclick="javascript:sendChatText();" />
												<input type="hidden" name="chatstatus" id="chatstatus" value="1" />
											</form>
											
										</div>
                                    </div>
                                </div>
                                
                                
                                
                                
							</div>
                           <!--raxa code end-->
							
							<!-- dashboard integration code end --->
		
							
                        </div>
                    </div>
					
                </div>
                <!--/student_prof_Wp-->
            </div>
        </div>
        <!--/content_main-->
    </div>
	
