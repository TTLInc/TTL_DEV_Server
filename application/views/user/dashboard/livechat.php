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
$arrVal = $this->lookup_model->getValue('270', $multi_lang);
$lchatinvite = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('34', $multi_lang);
$lsend = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('262', $multi_lang);
$llivechat = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('294', $multi_lang);
$lgroupname = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('295', $multi_lang);
$lownermessage = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('296', $multi_lang);
$lcreatechatgroup = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('297', $multi_lang);
$lback = $arrVal[$multi_lang];
?>
<script src="<?php echo base_url('js/chat.js');?>"></script>
<div id="currentlivechat">
	<div class="box-tle gray-ttl"><div class="leftbg ttl6"><span><?php echo $llivechat;?></span></div></div>
	<div class="box-cont border-all div_chat-div">
		
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
				
				
				<a href="javascript:void(0);" id="createchatgroup" class="link btn_send_chat" ><?php echo $lchatinvite;?></a>
				
				<!--<a href="<?php echo base_url(); ?>user/chat_groups" class="link">Your group</a>-->
			</form>
	   </div> 
	   </div>
	   <!-- main live chat container end --->
		<!-- create your group container start -->
		<div id="createyourgroupcontainer" style="display:none;" >
            <div class="box-cont border-all div_chat-div">
                <div class="inbox_mod">
                    <div class="inbox_list inbox_tle">
                        <label><?php echo $lgroupname;?>:</label>
                        <input type="text" class="inbox_ipt_text c037898 crt-textbox" value="<?php echo $chat_name;?>" id="chat_name" placeholder="Group Name" /> 
                        <span></span>
                    </div>
                    
                    <div class="inbox_list inbox_ownermessage">
                        <label><?php echo $lownermessage;?>:</label>
                        <input type="text" class="inbox_ipt_text c000 crt-textbox" name="owner_message" value="<?php echo $owner_message;?>" id="owner_message" placeholder="Owner Message" /> 
                    </div>
                    
                    
                    
                </div>
            </div>
			<!--<div class="agnR">
					<a href="#" class="norBtn redRadiusBtn2  w96" id="send">Create Group</a>
			</div>-->
		</div>
		<!-- create your group container end -->
		
	   
	   <!--<h2 class="invitations" id="invlbl" style="display:none;">Invitations</h2>
	   <div id="invitations"></div>-->
	</div>
</div>
<div class="owngroup" id="owngroup" style="display:none;">		
	<div class="das-box das-box2 no-bor" style="width:345px">							
		<div id="student_prof_Wp">
				<div class="box-tle gray-ttl"><div class="leftbg ttl6"><span>Create Chat Group</span></div></div>
				<div class="box-cont border-all div_chat-div">
                    <div class="inbox_mod">
                        <div class="inbox_list inbox_tle">
                            <label><?php echo $lgroupname;?>:</label>
                            <input type="text" class="inbox_ipt_text c037898 crt-textbox" value="" id="chat_name1" placeholder="Group Name" /> 
                            <span></span>
                        </div>
                        <div class="inbox_list inbox_ownermessage">
                            <label><?php echo $lownermessage;?>:</label>
                            <input type="text" class="inbox_ipt_text c000 crt-textbox" name="owner_message" value="" id="owner_message1" placeholder="Owner Message" /> 
                        </div>
                    </div>
                    <div class="agnR">
                            <a href="#" class="norBtn redRadiusBtn2  w96" id="sendtext"><?php echo $lsend;?></a>
                             <a href="javascript:void(0);" id="backlivechat" class="link"><?php echo $lback;?></a>
                    </div>
                   
                </div>
		</div>
	</div>
</div>												
<script>
function sendMessage1(){
	var _groupname = $('#chat_name1').val();
	var _ownermessage = $('#owner_message1').val();

	if(!_groupname){
		$('#dialog').html('The group name can not be empty!.');
		$('#dialog').dialog({modal:true});
		return;
	}
	if(!_ownermessage){
		$('#dialog').html('Please enter owner message!.');
		$('#dialog').dialog({modal:true});
		return;
	}
	

	$(this).attr('buttontype','doing');
	var _data = {groupname:_groupname,ownermessage:_ownermessage};
	$.getJSON('<?php echo base_url("user/chat_save_group");?>',_data,function(msg){
	
		if (String == msg.constructor) {
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}
		if(json.status){
		
			//$('#dialog').html('Send Success..');
			//$('#dialog').dialog({modal:true});
			$('#chat_name').val('');
			$('#owner_message').val('');

			//var HOST = 'http://localhost/dev.thetalklist.com/';
			//document.location.href = '<?php echo base_url('user/chat_group/gid/');?>' + '/' + json.gid;
			
			
			
			$('#owngroup').load('<?php echo base_url("user/chat_group/gid/");?>' + '/' + json.gid);
			//$(".owngroup").load(HOST+'user/chat_group/gid/' + json.gid);
		}
		else{
			$('#dialog').html(json.msg);
			$('#dialog').dialog({modal:true});
		}
		$('#send').attr('buttontype','done');
	})
}
	
function deletegroup()
{
	var id = document.getElementById('grps').value;
	//alert(id)
	if(id)
	{
		$.getJSON("<?php echo base_url();?>user/chat_delete_group",{
					gid: id
				}, function(msg) {
					
					if(msg.result == 'success')
					{
						window.location.href="<?php echo base_url();?>user/dashboard/";
					}
					
		});
	}
	//document.getElementById('currentgroupid').value = '1';
}
</script>