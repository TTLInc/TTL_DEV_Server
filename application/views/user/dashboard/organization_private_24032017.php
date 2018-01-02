<?php
/*
* @autor TECHNO-SANJAY
* @package student private dashboard
* @date 10 May 2013
**/
header("Cache-Control: no-cache,no-store, must-revalidate" ); 
header("Pragma: no-cache" );
header("Expires: -1" );

?>
<?php $this->layout->appendFile('javascript',"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js");?>
<?php $this->layout->appendFile('javascript',"js/chat.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $basePath =  substr(BASEPATH,0,-7);  

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

$arrVal = $this->lookup_model->getValue('524', $multi_lang);
$linvitetxt = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('525', $multi_lang);
$lenternametxt = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('439', $multi_lang);	
$ltypemessage = $arrVal[$multi_lang];
// checks for quarantine users
if($profile['quarantine'] == 1){?>
	<script>
		//alert("Your account has been quarantined possibly due to inappropriate content. Please remove from Profile or Video Lessons and send message to support@thetalklist.com to reinstate your account.");
		alert("Your account has been made invisible to the membership. Either you have an incomplete profile (photo, video greeting, bio, rate, and open calendar sessions) or you have inappropriate content. Please edit so we can maintain a complete and professional profile for all visible tutors. Once updated, your profile may automatically become visible or else send an email to support@thetalklist.com.");
	</script>
	<style>
		.from {display:none;}
	</style>
<?php } ?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/palyerTheme/style.css">
<script type="text/javascript" src="<?php echo base_url();?>js/projekktor-1.2.26r246.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>js/banner.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/buzzword_medium.js"></script>



    <script src="<?php echo base_url();?>js/bjqs-1.3.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>css/bjqs.css">
<link rel="stylesheet" href="<?php echo base_url();?>css/demo.css">

<script language="JavaScript" type="text/javascript">
<?php if(@$classes[0]['startTime']): ?>
var _currentTime = <?php echo strtotime($classes[0]['startTime']);?>;
<?php else: ?>
var _currentTime = 0;
<?php endif; ?>
//alert(_currentTime)
var _setintvalNextSession = setInterval(checkNextSession,1000);
function checkNextSession(){
	var foo = new Date;
	var unixtime = parseInt(foo.getTime() / 1000);
	var unixtime_to_date = new Date(unixtime*1000);
	var _startTime = _currentTime - unixtime;
	if(_startTime <= 1)
	{
		$('.classTimer').css('color','#333333');
		$('.classTimer').html('None');
	}else{
		$('.classTimer').css('color','red');
		$('.classTimer').html('  will start after '+formatMinute(_startTime)+' sec.');
	}
	
}
function formatMinute(seconds){
	seconds = Math.abs(seconds);
	var _minutes = parseInt(seconds / 60);
	var _seconds = seconds % 60;
	return _minutes + 'Min ' + _seconds;
}
/**
* Script for livechat
* SKVIRJA - 25 June 2013
*/
			var timthumbUrl = '<?php echo base_url()."timthumb.php?src=";?>';
			var profileImgPath = '<?php echo base_url("uploads/images/thumb/");?>';
			var profileImgNull = '<?php echo profile_image("");?>';
			
			function profileImgChatThumb(src){
				if(src=='' || src=="\'\'" || src=="&#39;&#39;"){
					
					//return timthumbUrl + profileImgNull + '&h=30&w=30&zc=0';
					return profileImgNull + '';
				}
				return src + '';
			}
			function profileImgChatThumbInv(src){
				if(src=='' || src=="\'\'" || src=="&#39;&#39;"){
					
					return profileImgNull + '';
				}
				return src + '';
			}
			
			$(document).ready(function() {
				h2();
				
				$("span.dasinvchat").hover(function () {
					$(this).append('<div class="dasinvchat-tooltip"><p><?php echo $linvitetxt; ?></p></div>');
				}, function () {
					$("div.dasinvchat-tooltip").remove();
				});
				$("span.daschatsug").hover(function () {
					$(this).append('<div class="tooltipusr"><p><?php echo $lenternametxt; ?></p></div>');
				}, function () {
					$("div.tooltipusr").remove();
				});
			});
			function h2()
			{
				var chatgroupid = document.getElementById('currentgroupid').value;
				var lastMessage  = 0;
				document.getElementById('lastmessage').value = 0;
				startChat();
			}
			
			var lastMessage = 0;
			var mTimer;
			
			function startChat() {
				getChatText();
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
					//var msgid = message_nodes[i].getElementsByTagName("msgid");
					var msgid = message_nodes[i].getAttribute( 'id' );
					var user_id = message_nodes[i].getElementsByTagName("user_id");
					var user_img = message_nodes[i].getElementsByTagName("user_img");
					
					var user_id_role = message_nodes[i].getElementsByTagName("user_roleId");
					
					if(user_id_role[0].firstChild.nodeValue == 0)
					{
						var imgclass = "stimg";
					}else{
						var imgclass = "ttimg";
					}
					
					// get online user status
					var user_online = message_nodes[i].getElementsByTagName("online");
					var online = user_online[0].firstChild.nodeValue;
					 
					if(online == 1)
					{
						var onlineclass = "stonline";
					}else{
						var onlineclass = "stoffline";
					}
					
					var imgsrc =  user_img[0].firstChild.nodeValue;
					var userprofilelink = '';
					
					var tmpmsgid = 'chatmsgitems_'+msgid;
					//alert(document.getElementById(tmpmsgid))
					
					if(document.getElementById(tmpmsgid))
					{
						chat_div.innerHTML += '';
					}else{
						chat_div.innerHTML += '';
						chat_div.innerHTML += '<div class="chatitems" id="chatmsgitems_'+msgid+'">'+ '<div class="chat_time">' + time_node[0].firstChild.nodeValue + '</div>' + '<div class="chatimg '+imgclass+'"><span class="grn-dot"> </span><img src="'+profileImgChatThumb(imgsrc)+'" width="30" height="40"/></div>' + '<div class="chatuser">' + '<span>' + user_node[0].firstChild.nodeValue + ':</span>' +     text_node[0].firstChild.nodeValue + '</div></div>';
					
					}
					
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
						invitation_div.innerHTML += '<div class="chatitems" id="chatitems_'+invid[0].firstChild.nodeValue+'" >' + '<div class="chatimg"><a href="<?php echo base_url();?>user/send_message"><img src="'+profileImgChatThumbInv(imgsrc)+'" width="50" height="50" /></a></div>' + '<div class="chatuser">' + user_node[0].firstChild.nodeValue + '</div>'  + '<div class="chattext"><div class="grp-btn"><a href="#" onclick="joingroup('+chatid[0].firstChild.nodeValue+');"><span class="red-btn">Join</span></a><a href="#" onclick="deleteinvitation('+chatid[0].firstChild.nodeValue+','+invid[0].firstChild.nodeValue+');" style="margin-left:10px;"><span class="blu-btn">Delete</span></a></div></div></div>';
					
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
							/*var chat_div = document.getElementById('div_chat');
							chat_div.innerHTML += 'HAS ENTERED';*/
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
							setTimeout('getChatText();',3000); 
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
				
			}
			function deleteinvitation(gid,invid)
			{
				
				if(gid)
				{
					var ddataStringinvt = "gid="+gid;
					$.ajax({
						url: "<?php echo base_url();?>user/chat_delete_invitation",
						type: 'POST',
						data: ddataStringinvt,
						dataType: 'json',
						cache: false,
						success: function (msg){
							if(msg.result == 'success')
							{
								var tmpid = 'chatitems_'+invid;
								document.getElementById(tmpid).innerHTML = '';
								$('#invitations').hide();
								$('.invitations').hide();
								
							}
							
						}
					});
					
					
				}
				
			}
			function changegroup(gid)
			{
				document.getElementById('currentgroupid').value = gid;
				document.getElementById('lastmessage').value = 0;
				document.getElementById('div_chat').innerHTML = '';
				
				dataString = "gid="+gid;
				if(gid != 1)
				{
					if(document.getElementById('createchatgroup'))
					{
						document.getElementById('createchatgroup').style.display = 'none';
					}
				}else{
					if(document.getElementById('createchatgroup'))
					{
						document.getElementById('createchatgroup').style.display = '';
					}
					if(document.getElementById('cancelchat'))
					{
						document.getElementById('cancelchat').style.display = 'none';
					}
				}
				
				$.ajax({
					url: "<?php echo base_url("user/groupname");?>",
					type: 'POST',
					data: dataString,
					dataType: 'json',
					cache: false,
					success: function (msg){
					userid = msg.results.uid;
					suserid = msg.sresults.uid;
					var profileid = <?php echo $profile['uid']; ?>;
						if(profileid == userid){
							var chat_div = document.getElementById('div_chat');
							chat_div.innerHTML += msg.sresults.firstName + ' has entered private chat room.';
						}else{
							var chat_div = document.getElementById('div_chat');
							chat_div.innerHTML += msg.results.firstName + ' has entered private chat room.';
						}
					}
				});
				
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
					var didataString = "gid="+id;
					$.ajax({
						url: "<?php echo base_url();?>user/chat_delete_invitation",
						type: 'POST',
						data: didataString,
						dataType: 'json',
						cache: false,
						success: function (msg){
							document.getElementById('currentgroupid').value = '0';
							if(document.getElementById('cancelchat'))
							{
								document.getElementById('cancelchat').style.display = 'none';
							}
							if(document.getElementById('privatechat'))
							{
								document.getElementById('privatechat').style.display = 'none';
							}
							if(document.getElementById('createchatgroup'))
							{
								document.getElementById('createchatgroup').style.display = '';
							}
							changegroup('1');
						}
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
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=638391592856781";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>
</script>

<?php
$arrVal = $this->lookup_model->getValue('34', $multi_lang);
$lsend = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('259', $multi_lang);
$ldashboard = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('260', $multi_lang);
$lnextsession = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('261', $multi_lang);
$lmessages = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('262', $multi_lang);
$llivechat = $arrVal[$multi_lang];


if($multi_lang != 'ch'){ 
$arrVal = $this->lookup_model->getValue('264', $multi_lang);
$lfacebookfeed = $arrVal[$multi_lang];
}else{
$lfacebookfeed = 'Sina Weibo Feed';
} 


$arrVal = $this->lookup_model->getValue('265', $multi_lang);
$lcompletedsessions = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('270', $multi_lang);
$lchatinvite = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('272', $multi_lang);
$lstudentstatistics = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('293', $multi_lang);
$linviteonlineuser = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('283', $multi_lang);
$lok = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('298', $multi_lang);
$lcancel = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('299', $multi_lang);
$lprivatechatinvitations = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('300', $multi_lang);
$lendprivatechat = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('824', $multi_lang);
$cbooking = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('886', $multi_lang);
$buzzword = $arrVal[$multi_lang];
?>
 <div class="baseBox baseBoxBg clearfix">
		<?php include dirname(__FILE__).'/../leftSide.php';?>
        <div class="content_main fr">
        	<div class="main_inner">
                <ul class="student_prof">
                <?php echo organization_menu('o_private','p_dasb',$profile['uid']);?>
                   
                </ul>
                <!--/student_prof-->
                <div id="student_prof_Wp">
                	<div class="mod">
					
					
                        <div class="hd">
                            <div class="content"><h2><?php echo $ldashboard;?></h2></div>
                        </div>





						
                        <div class="bd">
							<!--- dashboard integration code start --->
							<!--raxa code strat-->
                           	<div class="dasbord">
								<?php 
								$cnt1 = count($result1);
								if($cnt1 > 0){
									$cgid = $result1[0]['chatid'];
								}else{
									$cgid = 1;
								}
								?>
								<input type="hidden" name="currentgroupid" id="currentgroupid" value="<?php echo $cgid; ?>" />
								<input type="hidden" name="lastmessage" id="lastmessage" value="" />
                            	<div class="das-tle">
                                	<div class="col1" style="font-size:16px;">
									<?php 
									$base = base_url();
									echo anchor($base.'user/account/',$cbooking.':', 'title='.$cbooking);
									
									?>
									<span>
																	
									<?php if($tutor[0]['total'] == ''){ echo "0";} else echo $tutor[0]['total'];?></span>
									</div>
                                    <div class="col2" style="font-size:16px;">
									<?php
									echo anchor($base.'user/inbox/', $lmessages.':', 'title="Messages"');
									?>
									<span><?php echo $msgcnt; //if($classes != 0){echo $classes[0]['alerted']; }  else { echo "0"; } ?></span></div>
                                    
									<div class="col3" style="font-size:16px;"><?php //echo $lcompletedsessions;?> 
<?php
									echo anchor($base.'user/history/uid/'.$profile['uid'], $lcompletedsessions.':', 'title="Messages"');
									?>									
									<!--<span><?php if($tutor[0]['total'] == ''){ echo "0";} else echo $tutor[0]['total'];?></span></div>-->
									<span><?php echo $completedSessions;?></span></div>
                                </div>
                                
                                <div class="box-row">
									<div class="das-box das-box1 das-box7 no-bor" style="width:347px; ">
                                    	<div class="dboard_box_tle golden-ttl">
										<div class="leftbg ttl5">
										<span class="dboard_box_title">TheTalkList <?php echo $lmessages;?></span>
										</div>
										</div>
                                        <div class="dboard_box_border-none sponsor" style="overflow:hidden; width:345px; margin-top:-1px !important;">
										<div id="img-grp-wrap">
											<div class="img-wrap">
											
												<?php
																							
													if($tmessages): 
													foreach($tmessages as $tmessage): ?>					
															<?php 
															if($tmessage["image"] != ''):
															if(file_exists($basePath.'uploads/images/'.$tmessage["image"])): ?>											
																<img src="<?php echo base_url('uploads/images/'.$tmessage["image"]); ?>" alt="01"  width="300" height="auto"/>					
															<?php endif;
																endif;
														endforeach; 
														endif; 
													?>
											</div>    
											<img src="<?php echo base_url('/images/next.png'); ?>" class="next" alt="Next"/> 
											<img src="<?php echo base_url('/images/prv.png'); ?>" class="prev" alt="Previous"/>
										</div>
										</div>
										
                                    </div>
                                    
                                    
									<div class="das-box das-box2 no-bor" style="width:345px">
										<div id="currentlivechat">
											<div class="dboard_box_tle golden-ttl"><div class="leftbg ttl6"><span class="dboard_box_title"><?php echo $llivechat;?></span></div></div>
                                            
                                            
											<div class="box-cont border-all div_chat-div">
												
												<!--- main live chat container --> 
												<div id="chatcontainer" >
												<div id="div_chat" class="div_chat">
												</div>
												<div class="from">
													<form autocomplete="off" id="frmmain" name="frmmain" onSubmit="javascript:return false;" >
													
														
														<input type="text" onblur="this.value=!this.value?'<?php echo $ltypemessage;?>':this.value;" onfocus="this.select()" onclick="if (this.value=='<?php echo $ltypemessage;?>')this.value='';" value="<?php echo $ltypemessage;?>" id="txt_message" name="txt_message" style="width: 317px;height:35px;margin-top:5px;padding:3px;" autocomplete="off" onKeydown="Javascript: if (event.keyCode==13) sendChatTextForm();" />
														<input type="button" name="btn_send_chat" id="btn_send_chat" value="<?php echo $lsend;?>" onClick="javascript:sendChatText();" class="aqua_btn" />
														<input type="hidden" name="chatstatus" id="chatstatus" value="1" />
														<!--<a href="<?php echo base_url(); ?>user/chat_create_group" class="link">Create chat Group</a>-->
														<!--<a href="javascript:void(0);" id="crgroupid" class="link">Create chat Group</a>-->													
														
														
														<!--<a href="javascript:void(0);" id="createchatgroup" class="link btn_send_chat aqua_btn" ><span class="dasinvchat"><?php echo $lchatinvite;?><span></a>-->
                                                      
                                                      <a href="javascript:void(0);" id="createchatgroup" class="link btn_send_chat aqua_btn" ><span><?php echo $lchatinvite;?><span></a>
                                                        
                                                        
														<?php
														$cnt = count($result1);
														if($cnt > 0){
														?>
														<!--<a href="<?php echo base_url(); ?>user/invite" id="privatechat" class="link">Private Chat</a>-->
														<!--<a href="javascript:void(0);" onclick="cancelprivatechat();"  id="privatechat" class="link btn_send_chat">End Private Chat</a>-->
														<?php
														}
														?>
														<a href="javascript:void(0);" style="display:none;" onclick="cancelprivatechat();" id="cancelchat" class="link btn_send_chat"><?php echo $lendprivatechat;?></a>
														<!--<a href="<?php echo base_url(); ?>user/chat_groups" class="link">Your group</a>-->
													</form>
											   </div> 
											   </div>
											   <!-- main live chat container end --->
												<!-- create your group container start -->
														
												<!-- create your group container end -->
												
											   
											   <!--<h2 class="invitations" id="invlbl" style="display:none;">Invitations</h2>
											   <div id="invitations"></div>-->
											</div>
                                            
                                            
                                            
										</div>
										<div class="owngroup" id="owngroup" style="display:none;">		
											<div class="das-box das-box2 no-bor" style="width:345px">
												
												<div id="student_prof_Wp">
														<div class="dboard_box_tle golden-ttl"><div class="leftbg ttl6"><span><?php echo $lchatinvite;?></span></div></div>
														
														<div class="box-cont dboard_box_border-none div_chat-div">
															<div class="inbox_mod">
																<div id="suggest">
																	<span style="float:left;"><?php echo $linviteonlineuser;?>:</span> <span class="daschatsug"><img src="<?php echo Base_url('images/arrow.png') ?>" style="float:left;" /></span> <br />
																	<input type="text" size="25" value="" id="country" onkeyup="suggest(this.value);" onblur="fill();fillId();" class="" />
																	<input type="hidden" name="country_id" id="country_id" value="" />
																	<div id="suggestions" style="display: none;"> <div id="suggestionsList"> &nbsp; </div>
																	</div>
																</div>
																
															</div>
															<div>
															<a href="javascript:void(0);" id="cancellivechat" class="btn_send_chat"><?php echo $lcancel;?></a>
															<a href="javascript:void(0);" id="backlivechat" class="btn_send_chat"><?php echo $lok;?></a>
															
															
															</div>
														</div>
												</div>
											</div>
										</div>
									</div>
                                    
                                    
                                    
                                    <h2 class="invitations" id="invlbl" style="display:none;"><?php echo $lprivatechatinvitations;?></h2>
									<div id="invitations"></div>
                                </div>
                                
                                <div class="box-row">
                                	<div class="das-box das-box3 das-box-teh2 no-bor" style="border:0 none;">
                                    	<div class="box-tle gray-ttl"><div class="dboard_box_title ttl3"><span><?php echo $lfacebookfeed;?></span></div></div>
                                        <div class="box-cont  fb-cont" style="margin:0px;padding:0px;">
                                            <div class="all-txt">
												<!--
												<fb:activity site="www.technoinfonet.com" app_id="598282750195467" width="348" height="480" header="true" font="arial" recommendations="true" ref="www.facebook.com/TheTalkList"></fb:activity>
												
												<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FTheTalkList&amp;width=348&amp;height=590&amp;show_faces=true&amp;colorscheme=light&amp;stream=true&amp;show_border=false&amp;header=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:348px; height:590px;" allowTransparency="true"></iframe>
												-->
<?php  if($multi_lang != 'ch'){ ?>
<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FTheTalkList&amp;width=348&amp;height=590&amp;show_faces=true&amp;colorscheme=light&amp;stream=true&amp;show_border=false&amp;header=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:348px; height:590px;" allowTransparency="true"></iframe>
<?php }else{ ?>
<iframe src="http://v.t.sina.com.cn/widget/widget_blog.php?uid=2952211760&height=590&skin=wd_01&showpic=1" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:348px; height:590px;" allowTransparency="true"></iframe>
<?php } ?>													<!--<div class="fb-activity" data-site="https://www.facebook.com/TheTalkList" data-app-id="518334924886670" data-action="https://www.facebook.com/TheTalkList" data-width="348" data-height="480" data-header="true" data-font="lucida grande" data-recommendations="true"></div>-->
											</div>
                                      </div>
                                    </div>
                                    <div class="das-box das-box4  no-bor">
                                    	<div class="box-tle gray-ttl"><div class="dboard_box_title ttl4"><span><?php echo $buzzword;?></span></div></div>
										<div id="chart_div1" class="box-cont" >
										<div id="medo_buzzword" style=" width:336px;height:301px;"></div>
										<!--<img src="<?php echo base_url('images/StudentMap_Final.png'); ?>">-->
										<div id="chartholder" style="font-size:10px !important;"></div>
										<!-- chages on 20-5-2013 -->
													<?php 
													
													/*	$totalSt = 0;
											
														foreach($tutorChatData as $chatdata):
															$totalSt = $totalSt + $chatdata['numofst'];
														endforeach;*/
														//echo count($tutorChatData);exit;
													?>		 

												<script type="text/javascript" src="https://www.google.com/jsapi"></script>
											<!--	<script type="text/javascript">
												  google.load("visualization", "1", {packages:["corechart"]});
												  google.setOnLoadCallback(drawChart);
												  function drawChart() {
													 
													<?php if(count($tutorChatData) == 8): ?>	 
													var data = google.visualization.arrayToDataTable([
														['Score', '<?php echo $tutorChatData[0]['country'] ?>','<?php echo $tutorChatData[1]['country'] ?>','<?php echo $tutorChatData[2]['country'] ?>','<?php echo $tutorChatData[3]['country'] ?>','<?php echo $tutorChatData[4]['country'] ?>','<?php echo $tutorChatData[5]['country'] ?>','<?php echo $tutorChatData[6]['country'] ?>','<?php echo $tutorChatData[7]['country'] ?>'],
														  ['',  <?php echo $tutorChatData[0]['numofst'];?>,null ,null,null,null,null,null,null],
														  ['',  null,<?php echo $tutorChatData[1]['numofst'];?>,null,null,null,null,null,null],
														  ['',  null,null,<?php echo $tutorChatData[2]['numofst'];?>,null,null,null,null,null],
														  ['',  null,null,null,<?php echo $tutorChatData[3]['numofst'];?>,null,null,null,null],
														  ['',  null,null,null,null,<?php echo $tutorChatData[4]['numofst'];?>,null,null,null],
														  ['',  null,null,null,null,null,<?php echo $tutorChatData[5]['numofst'];?>,null,null],
														  ['',  null,null,null,null,null,null,<?php echo $tutorChatData[6]['numofst'];?>,null],
														  ['',  null,null,null,null,null,null,null,<?php echo $tutorChatData[7]['numofst'];?>]
													]);
													<?php endif; ?>
													<?php if(count($tutorChatData) == 7): ?>
													var data = google.visualization.arrayToDataTable([
														['Score', '<?php echo $tutorChatData[0]['country'] ?>','<?php echo $tutorChatData[1]['country'] ?>','<?php echo $tutorChatData[2]['country'] ?>','<?php echo $tutorChatData[3]['country'] ?>','<?php echo $tutorChatData[4]['country'] ?>','<?php echo $tutorChatData[5]['country'] ?>','<?php echo $tutorChatData[6]['country'] ?>'],
														  ['',  <?php echo $tutorChatData[0]['numofst'];?>,null ,null,null,null,null,null],
														  ['',  null,<?php echo $tutorChatData[1]['numofst'];?>,null,null,null,null,null],
														  ['',  null,null,<?php echo $tutorChatData[2]['numofst'];?>,null,null,null,null],
														  ['',  null,null,null,<?php echo $tutorChatData[3]['numofst'];?>,null,null,null],
														  ['',  null,null,null,null,<?php echo $tutorChatData[4]['numofst'];?>,null,null],
														  ['',  null,null,null,null,null,<?php echo $tutorChatData[5]['numofst'];?>,null],
														  ['',  null,null,null,null,null,null,<?php echo $tutorChatData[6]['numofst'];?>],
														  ['',  null,null,null,null,null,null,null]
													]);
													<?php endif; ?>

													var options = {
																title: '',
																hAxis: {title: '<?php echo 'Total Students '.$totalSt;?>', titleTextStyle: {color: 'black',fontSize: 15}},
																vAxes:[
																		{}, // Nothing specified for axis 0
																		{title:'Losses',textStyle:{color: 'red'}} // Axis 1
																	  ],
																titleTextStyle: {color: 'black', fontName: 'arial', fontSize: 11},
																width: 310, height: 300,
																chartArea: {left:0,width:"200" ,height:"200"},
																	'colors' : [ 'green', 'blue','purple','black','yellow','red','pink'],
																	isStacked: true 
																};
																
																
																
			
			
																var chart = new google.visualization.ColumnChart(document.getElementById('chartholder'));
																chart.draw(data, options);
																							
												  }
												  
												  													google.load("visualization", "1", {packages:["corechart"]});
			google.setOnLoadCallback(drawChart);
			function drawChart() {
			
			<?php if(count($tutorChatData) == 8): ?>	 
				var data = google.visualization.arrayToDataTable([
					['Score', '<?php echo $tutorChatData[0]['country'] ?>','<?php echo $tutorChatData[1]['country'] ?>','<?php echo $tutorChatData[2]['country'] ?>','<?php echo $tutorChatData[3]['country'] ?>','<?php echo $tutorChatData[4]['country'] ?>','<?php echo $tutorChatData[5]['country'] ?>','<?php echo $tutorChatData[6]['country'] ?>','<?php echo $tutorChatData[7]['country'] ?>'],
					  ['',  <?php echo $tutorChatData[0]['numofst'];?>,null ,null,null,null,null,null,null],
					  ['',  null,<?php echo $tutorChatData[1]['numofst'];?>,null,null,null,null,null,null],
					  ['',  null,null,<?php echo $tutorChatData[2]['numofst'];?>,null,null,null,null,null],
					  ['',  null,null,null,<?php echo $tutorChatData[3]['numofst'];?>,null,null,null,null],
					  ['',  null,null,null,null,<?php echo $tutorChatData[4]['numofst'];?>,null,null,null],
					  ['',  null,null,null,null,null,<?php echo $tutorChatData[5]['numofst'];?>,null,null],
					  ['',  null,null,null,null,null,null,<?php echo $tutorChatData[6]['numofst'];?>,null],
					  ['',  null,null,null,null,null,null,null,<?php echo $tutorChatData[7]['numofst'];?>]
				]);
			<?php endif; ?>
			<?php if(count($tutorChatData) == 7): ?>
			var data = google.visualization.arrayToDataTable([
				['Score', '<?php echo $tutorChatData[0]['country'] ?>','<?php echo $tutorChatData[1]['country'] ?>','<?php echo $tutorChatData[2]['country'] ?>','<?php echo $tutorChatData[3]['country'] ?>','<?php echo $tutorChatData[4]['country'] ?>','<?php echo $tutorChatData[5]['country'] ?>','<?php echo $tutorChatData[6]['country'] ?>'],
				  ['',  <?php echo $tutorChatData[0]['numofst'];?>,null ,null,null,null,null,null],
				  ['',  null,<?php echo $tutorChatData[1]['numofst'];?>,null,null,null,null,null],
				  ['',  null,null,<?php echo $tutorChatData[2]['numofst'];?>,null,null,null,null],
				  ['',  null,null,null,<?php echo $tutorChatData[3]['numofst'];?>,null,null,null],
				  ['',  null,null,null,null,<?php echo $tutorChatData[4]['numofst'];?>,null,null],
				  ['',  null,null,null,null,null,<?php echo $tutorChatData[5]['numofst'];?>,null],
				  ['',  null,null,null,null,null,null,<?php echo $tutorChatData[6]['numofst'];?>],
				  ['',  null,null,null,null,null,null,null]
			]);
			<?php endif; ?>

			/*var options = {
			  title: 'Score Meter',
			  hAxis: {title: 'T', titleTextStyle: {color: 'red', fontSize:12}},
			  'colors' : [ 'green', 'blue','purple'],
			   width: 350, height: 250,
			};
			*/
			var options = {
				title: '',
				 hAxis: {title: '<?php echo 'Total Students '.$totalSt;?>', titleTextStyle: {color: 'red', fontSize:12}},
			  'colors' : [ 'green', 'blue','purple'],
			   width: 350, height: 250,
			   legendFontSize: 9,
				
					'colors' : [ '#CCFFCC', 'blue','purple','#66CCFF','yellow','orange','pink'],
					isStacked: true 
				};
																
																
			var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
			chart.draw(data, options);
			}
												</script> -->
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
	
<style>
	.d-textbox{border:1px solid red;font-siz:15px;padding:5px;}
	.d-ads{border:1px solid red;font-siz:15px;padding:5px; width:200px;margin-top:5px;}
	.d-livechat{border:1px solid red;font-siz:15px;padding:5px; width:200px;margin-top:5px;float:left;}
	.d-newtutors{border:1px solid red;font-siz:15px;padding:5px; width:200px;margin-top:5px;float:left;}
	#div_chat{ height:285px;}
</style>	
	

<style>
.das-box-teh{ width:346px !important; }
.das-box-teh .box-tle{width:94.5% !important}

.chatimg {margin-right:5px;}
.das-box-teh2{ width:348px !important;  overflow-x: hidden;}
.fb-cont{ height:323px; overflow-y: scroll;  overflow-x: hidden; width:99% !important;}
.das-box-teh2 .box-tle{width:94.5% !important}
a.p_dasb span{ background-position:21px 13px !important;}

#chart_div>div{ margin-left:-45px !important; /*width:338px !important;*/ background:none !important;}
.div_chat-div{ width:93% !important;}
.gray-ttl .ttl6 span{ width:94%;} 
#mygallery2{ overflow:visible!important;}

.inbox_mod{ height:315px;}
a.btn_send_chat{ margin-left:15px;}

.panel .box-cont{ padding:0px !important; width:100%  !important;}
.das-box1 .box-cont{ height:350px;}
.das-box1 .box-cont img{ width:326px;}

span.dasinvchat {
  cursor: pointer;
  display: inline-block;
  color: White;
  border-radius: 8px;
  position: relative;
}
span.daschatsug {
  cursor: pointer;
  display: inline-block;
  border-radius: 8px;
  position: relative;
}


	div.dasinvchat-tooltip {
	  background-color: #037898;
	  color: White;
	  position: absolute;
	  left: -250px;
	  top: -15px;
	  z-index: 1000000;
	  width: 230px !important;
	  border-radius: 5px; word-wrap:break-word;
	}
	
	div.dasinvchat-tooltip p{ font-size:12px; font-family:Arial, Helvetica, sans-serif; line-height:14px; font-weight:normal; padding:8px; color: White;}
	
	div.dasinvchat-tooltip:before {
	  border-color: transparent #037898 transparent transparent;
	  border-left: 6px solid #037898;
	  border-style: solid;
	  border-width: 6px 0px 6px 6px;
	  content: "";
	  display: block;
	  height: 0;
	  width: 0;
	  line-height: 0;
	  position: absolute;
	  top: 40%;
	  right: -6px !important;
	}
	
	div.tooltipusr {
	  background-color: #037898;
	  color: White;
	  position: absolute;
	  left: -232px;
	  top: -20px;
	  z-index: 1000000;
	  width: 230px !important;
	  border-radius: 5px; word-wrap:break-word;
	}
	
	div.tooltipusr p{ 
		font-size:12px; 
		font-family:Arial, Helvetica, sans-serif; 
		line-height:14px; 
		font-weight:normal; 
		 color: White;
		padding:8px;
	}
	
	div.tooltipusr:before {
	  border-color: transparent #037898 transparent transparent;
	  border-left: 6px solid #037898;
	  border-style: solid;
	  border-width: 6px 0px 6px 6px;
	  content: "";
	  display: block;
	  height: 0;
	  width: 0;
	  line-height: 0;
	  position: absolute;
	  top: 40%;
	  right: -6px !important;
	}
	div.tooltip p{ font-size:12px; line-height:14px; font-weight:normal; font-family:Arial, Helvetica, sans-serif;}
	.div_chat-div {overflow:visible !important;}
</style>
<script class="secret-source">
        jQuery(document).ready(function($) {
          
          $('#mygallery2').bjqs({
            animtype      : 'slide',
            height        : 320,
            width         : 620,
            responsive    : true,
            randomstart   : true
          });
          
        });
      </script>
      
<script>
function suggest(inputString){

if(inputString.length == 0) {
$('#suggestions').fadeOut();
} else {
$.ajax({
url: "<?php echo base_url('user/auto_chat_suggestion/');?>",
data: 'act=autoSuggestUser&queryString='+inputString,
success: function(msg){

if(msg.length >0) {
$('#suggestions').fadeIn();
$('#suggestionsList').html(msg);
$('#country').removeClass('load');
}
}
});
}
}
</script>
<?php
$cnt = count($result1);
if($cnt > 0){
	//echo '1';
?>
<!--<a href="<?php echo base_url(); ?>user/invite" id="privatechat" class="link">Private Chat</a>-->
<!--<a href="javascript:void(0);" onclick="cancelprivatechat();"  id="privatechat" class="link btn_send_chat">End Private Chat</a>-->
	<script type="text/javascript">
		if(document.getElementById('cancelchat')){
			document.getElementById('cancelchat').style.display = '';
		}
	</script>
<?php
}
?>


<script>
$('.img-wrap img:gt(0)').hide();

$('.next').click(function() {
    $('.img-wrap img:first-child').fadeOut().next().fadeIn().end().appendTo('.img-wrap');
});

$('.prev').click(function() {
    $('.img-wrap img:first-child').fadeOut();
    $('.img-wrap img:last-child').prependTo('.img-wrap').fadeOut();
    $('.img-wrap img:first-child').fadeIn();
});
</script>
<style>
#img-grp-wrap {
    position: relative;
    width: 180px;
    height: 180px;
    margin: 100px auto;
}

.img-wrap {
    position: relative;
    border: 0px solid #CCC;
    width: 180px;
    height: 180px;
}

.img-wrap img {
    position: absolute;
    top: -90px;
    left: -70px;
    -moz-box-shadow: 1px 1px 4px #CCC;
    padding: 0px;
}

.next, .prev {
    position: absolute;
    cursor: pointer;
    top: 250px;
}

.next {
    right: -70px;
}

.prev {
    left: -80px;
}
</style>