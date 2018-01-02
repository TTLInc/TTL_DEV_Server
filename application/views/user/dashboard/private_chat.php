 
												<!--- main live chat container -->
												<div id="chatcontainer" >
												<div id="div_chat" class="div_chat">
												</div>
												<div class="from">
													<form autocomplete="off" id="frmmain" name="frmmain" onSubmit="return sendChatTextForm();">
													
														
														<input type="text" onblur="this.value=!this.value?'Type message':this.value;" onfocus="this.select()" onclick="this.value='';" value="Type message" id="txt_message" name="txt_message" style="width: 317px;height:35px;margin-top:5px;padding:3px;" autocomplete="off" />
														<input type="button" name="btn_send_chat" id="btn_send_chat" value="Send" onClick="javascript:sendChatText();" />
														<input type="hidden" name="chatstatus" id="chatstatus" value="1" />
														<!--<a href="<?php echo base_url(); ?>user/chat_create_group" class="link">Create chat Group</a>-->
														<!--<a href="javascript:void(0);" id="crgroupid" class="link">Create chat Group</a>-->
														<!--<a href="<?php echo base_url(); ?>user/chat_groups" class="link">Your group</a>-->
													</form>
											   </div> 
											   </div>
											   <!-- main live chat container end --->
												<!-- create your group container start -->
														
												<!-- create your group container end -->
												
											   
											   <!--<h2 class="invitations" id="invlbl" style="display:none;">Invitations</h2>
											
										<div class="owngroup" id="owngroup" style="display:none;">		
											<div class="das-box das-box2 no-bor" style="width:345px">
												<a href="javascript:void(0);" id="backlivechat" class="link">Back</a>
												<div id="student_prof_Wp">
														<div class="box-tle gray-ttl"><div class="leftbg ttl6"><span>Chat Invite</span></div></div>
														<div class="box-cont border-all div_chat-div">
															<div class="inbox_mod">
																<div id="suggest">Invite Online User: <br />
																	<input type="text" size="25" value="" id="country" onkeyup="suggest(this.value);" onblur="fill();fillId();" class="" />
																	<input type="hidden" name="country_id" id="country_id" value="" />
																	<div id="suggestions" style="display: none;"> <div id="suggestionsList"> &nbsp; </div>
																	</div>
																</div>
																
															</div>
															<div>
															
															</div>
														</div>
												</div>
											</div>
										</div>
									</div>