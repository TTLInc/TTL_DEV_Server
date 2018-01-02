/**
* Script for livechat
* SKVIRJA - 25 June 2013
*/			
			$(document).ready(function() {
				//setTimeout("h2()", 3000);
				var siturljs = window.hostname;
			alert(siturljs);
				h2();
				
			});
			function h2()
			{
				//alert('h2');
				var chatgroupid = document.getElementById('currentgroupid').value;
				startChat();
				//checkAcceptedInvitations();
			}
			
			var lastMessage = 0;
			var mTimer;
			
			function startChat() {
				getChatText();
			}		
			
			function checkAcceptedInvitations()
			{
				/*
				var chatstartedvalue = 0;
				$.get("<?php echo base_url();?>user/chat_check_to_start",{
							chatstarted: chatstartedvalue
							
						}, function(msg) {
							if(msg.gid)
							{
								$.get("<?php echo base_url();?>user/chat_check_to_start_update",{
											chatstarted: chatstartedvalue,
											chatid: msg.gid
										}, function(msg1) {
										document.getElementById('cancelchat').style.display = '';
										changegroup(msg.gid);	
											
								});
								
							}
							
				});
				mTimer = setTimeout('checkAcceptedInvitations();',2000); 
				*/
			}
			
			
			
			function getChatText() {
				var chatgroupid = document.getElementById('currentgroupid').value;
				var lastMessage = document.getElementById('lastmessage').value;
				//checks for exists group chat
				if(chatgroupid != 1)
				{
					$.get("<?php echo base_url();?>user/chat_check_exists_group",{
								chat: chatgroupid
							}, function(st) {
								if(st.status == 'no')
								{
									//alert('leaves the group!')
									changegroup('1');
								}
					});
					document.getElementById('createchatgroup').style.display = 'none';
					
				}
				$.get("<?php echo base_url();?>user/chat_get_message",{
							chat: chatgroupid,
							last: lastMessage
						}, function(xml) {
							addMessages(xml);
							//setTimeout('addMessages('+xml+')',200); 
				});
				if(document.getElementById('invitations').innerHTML == '')
				{
					$.get("<?php echo base_url();?>user/chat_get_invitation",{
								chat: 1,
								last: lastMessage
							}, function(xml) {
								addInvitations(xml);
								
					});
				}
				// checks for accepted invitation 
				var chatstartedvalue = 0;
				$.get("<?php echo base_url();?>user/chat_check_to_start",{
							chatstarted: chatstartedvalue
						}, function(msg) {
							if(msg.gid)
							{
								$.get("<?php echo base_url();?>user/chat_check_to_start_update",{
											chatstarted: chatstartedvalue,
											chatid: msg.gid
										}, function(msg1) {
										document.getElementById('cancelchat').style.display = '';
										changegroup(msg.gid);	
											
								});
								
							}
							
				});
				
				
			}
			function addMessages(xml)
			{
				clearTimer();
				var chat_div = document.getElementById('div_chat');
				var xmldoc = xml;
				var message_nodes = xmldoc.getElementsByTagName("message"); 
				var n_messages = message_nodes.length
				for (i = 0; i < n_messages; i++) {
					var user_node = message_nodes[i].getElementsByTagName("user");
					var text_node = message_nodes[i].getElementsByTagName("text");
					var time_node = message_nodes[i].getElementsByTagName("time");
					var msgid = message_nodes[i].getElementsByTagName("msgid");
					
					var user_id = message_nodes[i].getElementsByTagName("user_id");
					var user_img = message_nodes[i].getElementsByTagName("user_img");
					
					var imgsrc =  user_img[0].firstChild.nodeValue;
					var userprofilelink = '';
					
					var tmpmsgid = 'chatmsgitems_'+msgid;
					//alert(document.getElementById(tmpmsgid))
					
					if(document.getElementById(tmpmsgid))
					{
						chat_div.innerHTML += '';
					}else{
						chat_div.innerHTML += '';
						chat_div.innerHTML += '<div class="chatitems" id="chatmsgitems_'+msgid[0].firstChild.nodeValue+'">'+ '<div class="chat_time">' + time_node[0].firstChild.nodeValue + '</div>' + '<div class="chatimg"><a href="<?php echo base_url();?>user/profile/uid/'+user_id[0].firstChild.nodeValue+'"><img src="'+imgsrc+'" height="30px" width="30px" /></a></div>' + '<div class="chatuser">' + '<span><a href="<?php echo base_url();?>user/profile/uid/'+user_id[0].firstChild.nodeValue+'">' + user_node[0].firstChild.nodeValue + '</a>:</span>' +     text_node[0].firstChild.nodeValue + '</div></div>';
					
					}
					
					//chat_div.innerHTML += '';
					//chat_div.innerHTML += '<div class="chatitems">'+ '<div class="chat_time">' + time_node[0].firstChild.nodeValue + '</div>' + '<div class="chatimg"><a href="<?php echo base_url();?>user/profile/uid/'+user_id[0].firstChild.nodeValue+'"><img src="'+imgsrc+'" height="30px" width="30px" /></a></div>' + '<div class="chatuser">' + '<span><a href="<?php echo base_url();?>user/profile/uid/'+user_id[0].firstChild.nodeValue+'">' + user_node[0].firstChild.nodeValue + '</a>:</span>' +     text_node[0].firstChild.nodeValue + '</div></div>';
					
					chat_div.scrollTop = chat_div.scrollHeight;
					lastMessage = (message_nodes[i].getAttribute('id'));
					document.getElementById('lastmessage').value = lastMessage;
				}
				mTimer = setTimeout('getChatText();',2000); 
			}
			
			function addInvitations(xml)
			{
				var invitation_div = document.getElementById('invitations');
				var xmldoc = xml;
				var message_nodes = xmldoc.getElementsByTagName("message"); 
				var n_messages = message_nodes.length
				var invcheck = 0;
				for (i = 0; i < n_messages; i++) {
					var user_node = message_nodes[i].getElementsByTagName("user");
					var chatid = message_nodes[i].getElementsByTagName("chatid");
					var user_id = message_nodes[i].getElementsByTagName("user_id");
					var user_img = message_nodes[i].getElementsByTagName("user_img");
					var invid = message_nodes[i].getElementsByTagName("invid");
					
					var imgsrc = user_img[0].firstChild.nodeValue;
					
					
					var tmpinvid = 'chatitems_'+invid;
					if(document.getElementById(tmpinvid))
					{
						invitation_div.innerHTML += '';
					}else{
						invitation_div.innerHTML += '';
						invitation_div.innerHTML += '<div class="chatitems" id="chatitems_'+invid[0].firstChild.nodeValue+'" >' + '<div class="chatimg"><a href="<?php echo base_url();?>user/send_message"><img src="'+imgsrc+'" height="50px" width="50px" /></a></div>' + '<div class="chatuser">' + user_node[0].firstChild.nodeValue + '</div>'  + '<div class="chattext"><div class="grp-btn"><a href="#" onclick="joingroup('+chatid[0].firstChild.nodeValue+');"><span>Join</span></a><a href="#" onclick="deleteinvitation('+chatid[0].firstChild.nodeValue+','+invid[0].firstChild.nodeValue+');" style="margin-left:10px;"><span>Delete</span></a></div></div></div>';
					
					}
					
					invitation_div.scrollTop = invitation_div.scrollHeight;
					lastMessage = (message_nodes[i].getAttribute('id'));
					
					invcheck = 1;
				}
				if(invcheck == 1)
				{
					document.getElementById('invlbl').style.display = '';
				}
				
			}
			function joingroup(chatid)
			{
				$.get("<?php echo base_url();?>user/chat_update_invitation",{
							chat: chatid
													
						}, function(msg) {
							document.getElementById('invitations').innerHTML = '';
							$('.invitations').hide();
							//window.location.href="<?php echo base_url();?>user/invite/gid/"+chatid;
							document.getElementById('currentgroupid').value = chatid;
							document.getElementById('cancelchat').style.display = 'block';
							changegroup(chatid);
				});
			}
			//Add a message to the chat server.
			function sendChatText() {
				//clearTimeout(mTimer);
				
				var chatgroupid = document.getElementById('currentgroupid').value;
				var lastMessage = document.getElementById('lastmessage').value;
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
							/*alert(msg);
							return false;*/
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
							//document.getElementById('lastmessage').value = lastMessage + 1;
							
							setTimeout('getChatText();',3000); //getChatText();
				});		
				
				document.getElementById('txt_message').value = '';
				document.getElementById('txt_message').innerHTML = '';
			}
			function deletegroup()
			{
				var id = document.getElementById('grps').value;
				if(id)
				{
					$.getJSON("<?php echo base_url();?>user/chat_delete_group",{
								gid: id						
							}, function(msg) {
								
								if(msg.result == 'success')
								{
									window.location.reload();
								}
								
					});
				}
				//document.getElementById('currentgroupid').value = '1';
			}
			function deleteinvitation(gid,invid)
			{
				
				if(gid)
				{
					$.getJSON("<?php echo base_url();?>user/chat_delete_invitation",{
								gid: gid						
							}, function(msg) {
								
								if(msg.result == 'success')
								{
									var tmpid = 'chatitems_'+invid;
									document.getElementById(tmpid).innerHTML = '';
								}
								
					});
				}
				//document.getElementById('currentgroupid').value = '1';
			}
			function changegroup(gid)
			{
				//alert(gid);
				document.getElementById('currentgroupid').value = gid;
				document.getElementById('lastmessage').value = 0;
				document.getElementById('div_chat').innerHTML = '';
				
				if(gid != 1)
				{
					document.getElementById('createchatgroup').style.display = 'none';
				}
				
				getChatText();
			}
			
			function sendChatTextForm()
			{
				sendChatText();
				return false;
			}
			
			function cancelprivatechat()
			{
				
				var id = document.getElementById('currentgroupid').value;
				if(id)
				{
					$.getJSON("<?php echo base_url();?>user/chat_delete_invitation",{
										gid: id						
																
									}, function(msg) {
									document.getElementById('cancelchat').style.display = 'none';
									if(document.getElementById('privatechat'))
									{
										document.getElementById('privatechat').style.display = 'none';
									}
									changegroup('1');
					});
				}
			}
			function clearTimer()
			{
				clearTimeout(mTimer);
			}
/**
* End live chat script
* Script for livechat
*/	