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

$arrVal = $this->lookup_model->getValue('81', $multi_lang);
$cmsgtext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('83', $multi_lang);
$msgtext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('77', $multi_lang);
$fromtext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('76', $multi_lang);
$subjecttext = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('784', $multi_lang);
$reply = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('785', $multi_lang);
$forward = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('786', $multi_lang);
$prev = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('787', $multi_lang);
$next = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('788', $multi_lang);
$delete = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('801', $multi_lang);
$areyousure = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('802', $multi_lang);
$messagedeleted = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1036', $multi_lang);
$waiting = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('412', $multi_lang);			$lCANCEL   						= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1216', $multi_lang);
$noreply = $arrVal[$multi_lang];
/*$arrVal = $this->lookup_model->getValue('1225', $multi_lang);
$DeleteItem = $arrVal[$multi_lang];*/

$arrVal 		= $this->lookup_model->getValue('243', $multi_lang);			$DeleteItem  						= $arrVal[$multi_lang];

$arrVal 		= $this->lookup_model->getValue('298', $multi_lang);			$cancelbutton  						= $arrVal[$multi_lang];

?>
<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");?>
<?php $this->layout->appendFile('css',"css/search.css");?>
<?php $fullname = $profile['firstName'].' '.$profile['lastName'];?>
<script>
function download(id)
{
	var url="<?php echo base_url('user/DownloadAttachment/')?>"+"/"+id;
	window.open(url);
 
}
</script>
<script>
function cancelInfo(){
	 window.location.href="<?php echo base_url('user/inbox');?>";
		//$('#cancelInfoFrm').submit();
	}
</script>
 <div class="baseBox baseBoxBg clearfix">
        <div class="content_main fr">
        	<div class="main_inner">
			<?php //echo $linkType;?>
                <!--<ul class="student_prof teacher_prof">-->
                    <?php //echo profile_menu($linkType,'s_prof',$profile['uid']);?>
					  
                <!--</ul>-->
                <!--/student_prof-->
                <div id="student_prof_Wp">
                    <div class="mod">
                        <div class="hd">
                            <div class="pro_tle tle"><h3 style="margin-top:0px;">Beepbox</h3></div>
                        </div>
						
                        <div class="bd">
                            <div class="inbox_mod">
                            	<div class="clearfix">
                                    <h3 class="fl"><?php echo $msgtext; ?></h3>
                                    <div class="ico_message fr">
                                    	<a href="#" class="ico_msg ico_msg_reply" title="<?php echo $reply;?>" onclick="reply()"></a>
                                    	<a href="#" class="ico_msg ico_msg_forward" title="<?php echo $forward;?>"  onclick="forward()"></a>
                                        <a href="#" class="ico_msg ico_msg_prev" title="<?php echo $prev; ?>"  onclick="prev()"></a>
                                        <a href="#" class="ico_msg ico_msg_nxt" title="<?php echo $next;?>"  onclick="next()"></a>
                                        <a href="#" class="ico_msg ico_msg_del" title="<?php echo $delete;?>"  onclick="del()"></a>
                                    </div>
                                </div>
								<div class="inbox_subject">
                                <?php if($message['attach'] !=''){?>	<br><label><?php echo ""; ?><img style="width:14px;" src="<?php echo base_url('images/clip.png');?>"></label><span id="message"><span style="width:14px;cursor:pointer" onclick="download(<?php echo $message['id'];?>)"  /><?php echo $message['attach']."&nbsp;(".$Size.")";?></span><?php } ?></span>
                                </div>
                                <div class="inbox_list inbox_tle">
									<label><?php echo $fromtext;?>:</label>
									<?php if($message['fId'] == 1): ?>
									<span id="from">TalkMaster BlueBob</span>
									<?php else:?>
									<span id="from_firstname"><?php if($fullname==@$fresult['firstName']. ' ' .@$fresult['lastName']){ echo 'TalkMaster BlueBob';}else{  echo @$fresult['firstName'].''.@$fresult['uid'];}?><?php //echo @$fresult['firstName']. ' ' .@$fresult['lastName']  ;?></span>
									<input type="hidden" id="from" value="<?php echo $message['username'];?>" />
									<input type="hidden" id="uid" value="<?php echo $fresult['id'];?>" />
									<?php endif; ?>
                                	
                                </div>
                                <span id="email" style="display:none;"><?php echo $message['fId'];?></span>
                                <div class="inbox_list inbox_subject">
                                	<label><?php echo $subjecttext;?>:</label><span id="subject"><?php echo $message['subject'];?></span>
                                </div>
                                <div class="inbox_subject">
                                	<label><?php echo $msgtext; ?>:</label><span id="message"><?php echo $message['message'];?></span>
                                </div>
								
								
								<input type="button"  value="<?php echo $lCANCEL;?>" class="blu-btn" onclick="cancelInfo();">
								
								<input type="hidden" id="messageid" value="<?php echo $message['id'];?>" />
                            </div>
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
	var showId = '<?php echo $message["id"];?>';
	function prev(){		
		$('#dialog').html('<?php echo $waiting; ?>');
		$('#dialog').dialog({modal:true});
		var _data = {id:showId,type:'prev'};
		$.post('<?php echo base_url("user/message_view_next");?>',_data,function(msg){
			if (String == msg.constructor) {
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			if(json.status){
				$('#dialog').dialog('close');
				$('#from').html(json.username);
				$('#subject').html(json.subject);
				$('#message').html(json.message);
				showId = json.id;
			}
			else{
				$('#dialog').html(json.msg);
				$('#dialog').dialog({modal:true});
			}
		})
	}

	function next(){
		$('#dialog').html('<?php echo $waiting; ?>');
		$('#dialog').dialog({modal:true});
		var _data = {id:showId,type:'next'};
		$.post('<?php echo base_url("user/message_view_next");?>',_data,function(msg){
			if (String == msg.constructor) {
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			if(json.status){
				//$('#dialog').html('Send Success..');
				$('#dialog').dialog('close');
				//$('#dialog').close();
				$('#from').html(json.username);
				$('#subject').html(json.subject);
				$('#message').html(json.message);
				//$('#message_id').val(json.id);
				showId = json.id;
			}
			else{
				$('#dialog').html(json.msg);
				$('#dialog').dialog({modal:true});
			}
		})
	}
	function del(){
		$('#dialog1').dialog({
			modal:true,
			buttons: {
				"<?php echo $DeleteItem; ?>": function() {
					delDo();
					$( this ).dialog( "close" );
				},
				<?php echo $cancelbutton ;?>: function() {
					$( this ).dialog( "close" );
				}
			}
		})
	}
	function delDo(){
		var _data = {id:showId}; 
		$.post('<?php echo base_url("user/del_message");?>',_data,function(msg){
			if (String == msg.constructor) {
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			if(json.status){
				$('#dialog').html('<?php echo $messagedeleted; ?>');
				$('#dialog').dialog({modal:true});
				document.location.href = '<?php echo base_url('user/inbox');?>';
				//_tr.remove();
			}
			else{				
				$('#dialog').html(json.msg);
				$('#dialog').dialog({modal:true});
			}
			//$('#send').attr('buttontype','done');
		})
	}
	function reply(){
		//var _username = $('#from').val().trim();
		//alert(_username);
		//return false;
		var _uid = $('#uid').val().trim();
		var from=$('#from').text().trim();
		if(from=="TalkMaster BlueBob")
		{
			alert('<?php echo $noreply;?>');
			return false;
		}
		var _messageid = $('#messageid').val().trim();
		//alert(_uid);return false;
		var _subject = $('#subject').html().trim();
		var _email = $('#email').html().trim();		
		//alert(_email);
		//return false;
		//document.location.href = '<?php echo base_url('user/send_message');?>/uid/'+encodeURI(_uid)+'/email/'+encodeURI(_email)+'/subject/'+encodeURI('RE: '+_subject);
		document.location.href = '<?php echo base_url('user/send_message');?>/muid/'+encodeURI(_uid)+'/message/'+encodeURI(_messageid);
	}

	function forward(){
		document.location.href = '<?php echo base_url('user/send_message');?>/mid/'+showId;
	}
	$(function(){
		$('a@[href=#]').attr('href','javascript:void(0)');
	})
	</script>
	<div id="dialog1" title="Confirm" style="display:none">
		<p><?php echo $areyousure; ?></p>
	</div>
<style>
.inbox_tle label{ float:left; width:12%;}
	.inbox_list{ margin:0px; border-bottom:0px solid #dddbdb;}
	.inbox_list .input{ border:1px solid #dddbdb; width:250px; margin-top:3px; height:28px;  padding:2px 10px; color:#999; font-size:12px;}
	.blu-btn
	{
	background: url("<?php echo base_url();?>images/search-btn.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    color: #fff;
    cursor: pointer;
    float: right;
    height: 34px;
     
    text-align: center;
    width: 83px;
	}
	</style>