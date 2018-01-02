<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
<?php $this->layout->appendFile('css',"css/search.css");?>
 <div class="baseBox baseBoxBg clearfix">
    	
		<?php include 'application/views/user/leftSide.php';?>
        <div class="content_main fr">
        	<div class="main_inner">
                 
                <?php echo profile_menu($linkType,'p_dasb');?>
                 
                <!--/student_prof-->
                <div id="student_prof_Wp">
                    <div class="mod">
                        <div class="hd">
                            <div class="pro_tle tle"><h3>Create your group</h3></div>
	
    						<div class="box-cont border-all div_chat-div">
                                <div class="inbox_mod">
                                    <div class="inbox_list inbox_tle">
                                        <label>Group Name:</label>
                                        <input type="text" class="inbox_ipt_text c037898 crt-textbox" value="<?php echo $chat_name;?>" id="chat_name" placeholder="Group Name" /> 
                                        <span></span>
                                    </div>
                                    
                                    <div class="inbox_list inbox_ownermessage">
                                        <label>Owner Message:</label>
                                        <input type="text" class="inbox_ipt_text c000 crt-textbox" name="owner_message" value="<?php echo $owner_message;?>" id="owner_message" placeholder="Owner Message" /> 
                                    </div>
                                    
                                    
                                    
                                </div>
                                <div class="agnR">
                                        <a href="#" class="norBtn redRadiusBtn2  w96" id="send">Send</a>
                                </div>
							</div>
							
                        </div>
                    </div>
                </div>
                <!--/student_prof_Wp-->
            </div>
        </div>
        <!--/content_main-->
    </div>
	
	<script>
	function sendMessage(){
		var _groupname = $('#chat_name').val();
		var _ownermessage = $('#owner_message').val();
		
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
				$('#dialog').html('Send Success..');
				$('#dialog').dialog({modal:true});
				$('#chat_name').val('');
				$('#owner_message').val('');
				
				document.location.href = '<?php echo base_url('user/chat_group/gid/');?>' + '/' + json.gid;
			}
			else{				
				$('#dialog').html(json.msg);
				$('#dialog').dialog({modal:true});
			}
			$('#send').attr('buttontype','done');
		})
	}
	$(function(){
		$('a@[href=#]').attr('href','javascript:void(0)');
		//username = false;
		$('#chat_name').blur(function(){
			//checkGroupname();
		});
		$('#send').click(function(){
			sendMessage();
		});
		
	})
	</script>
