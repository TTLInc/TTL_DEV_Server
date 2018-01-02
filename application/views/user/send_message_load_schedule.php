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
$composetxt = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('82', $multi_lang);
$totxt = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('76', $multi_lang);
$subjecttext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('83', $multi_lang);
$msgtext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('84', $multi_lang);
$discardtext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('34', $multi_lang);
$sendtext = $arrVal[$multi_lang];

$arrVal = $this->lookup_model->getValue('298', $multi_lang);
$discardtext = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('460', $multi_lang);	$lSUBJECT_LINE   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('464', $multi_lang);	$lBEGINNER   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('465', $multi_lang);	$lINTERMEDIATE   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('466', $multi_lang);	$lADVANCED   		= $arrVal[$multi_lang];

?>

<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
<?php $this->layout->appendFile('css',"css/search.css");?>

<?php $this->layout->appendFile('css',"css/auto.css");?>
<?php $this->layout->appendFile('javascript',"js/auto.js");?>
<input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url();?>" />
 <div class="baseBox baseBoxBg clearfix">
    	
        <div class="content_main fr">
        	<div class="main_inner">
                 
                <?php echo profile_menu($linkType,'i_prof');?>
                 
                <!--/student_prof-->
                <div id="student_prof_Wp">
                    <div class="mod">
                        <div class="hd">
                            <!--<div class="content tle"><h2><?php //echo $composetxt;echo $st ;?></h2></div> -->
							<div class="content tle"><h2>Request for schedule </h2></div>

                            <div class="inbox_mod">
                            	<div class="inbox_list inbox_tle">
                                	<label><?php echo $totxt;?>:</label>
									<?php									
									$subject;
									$find = "Forward";
									$pos = strpos($subject, $find);
									?>
                                    <input type="text"  class="input" name="keyword" id="keyword" tabindex="0"  autocomplete="off" value="<?php if($pos !== FALSE){echo "";}else{echo @$fresult['firstName']. ' '.@$fresult['lastName'] ;} ?>" >
									<div class="autosug" id="ajax_response"  >
										<div class="wrapper systemError" id="nameErrorBox" style="display: none;"></div>
									</div>
									<?php 
									//print_r($fresult[0]['email']);
									if(@$fresult == '') {
									//echo 'sdfsdf';exit;
									?>
									<input type="hidden" value="<?php echo @$email;?>" id="email"  /> 
									<?php
									} else {
										//echo $fresult['email'];exit;
									?>
									<?php //echo $fresult[0]['email'];?>
									<input type="hidden" value="<?php echo @$fresult['email'];?>" id="email"  /> 
									<?php } ?>
									<input type="hidden" value="<?php echo $uidurl;?>" id="uidurl"  /> 
									<span></span>
                                </div>
                                
                                <div class="inbox_list ">
                                	<label>Topic<?php //echo //$subjecttext;?>:</label>
                                    <input type="text" class="inbox_ipt_text c000" name="" value="<?php echo htmlentities($subject);?>" id="subject" placeholder="<?php echo $lSUBJECT_LINE;?>" /> 
                                </div>
                                
                                <!-- <div class="inbox_subject">
                                	<label>Speaking level:<?php //echo $msgtext; ?>:</label>
                                    <textarea class="inbox_textarea" id="message"><?php echo $message;?></textarea>
                                </div>--->
                                <div><span style="float:left;width:252px;"><select id="sessionLevelType" name="sessionLevelType"><option value="Beginner"><?php echo $lBEGINNER;?></option><option value="Intermediate"><?php echo $lINTERMEDIATE;?></option><option value="Advanced"><?php echo $lADVANCED;?></option></select>
		</span>
                            </div>
							<div class="agnR">
									<a href="#" class="norBtn whiteRadiusBtn w96" id="discard"><?php echo $discardtext; ?></a>
                                    <a href="#" class="aqua_btn_msg redRadiusBtn2  w96" id="send"><?php echo $sendtext; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/student_prof_Wp-->
            </div>
        </div>
        <!--/content_main-->
		<?php //include dirname(__FILE__).'/leftSide.php';?>
    </div>
	
	<script>
	function sendMessage(){
	//alert('koo');
		//var _username = $('#username').val();
		//var _username = $('#email').val();
		<?php if(@$fresult['email'] != ''): ?>
			//var _username = '<?php echo $fresult['email']; ?>';
		<?php endif;?>
		var _sid = '<?php echo $this->session->userdata('uid');?>';
		var _uidurl = $('#uidurl').val();
		
		//alert(_username)
		var _subject = $('#subject').val();
		var _message = $('#message').val();
		
		if(_uidurl !=0)
		{
			var _username = '0'; 
		}
		
		/*if(!_username){
			$('#dialog').html('The username can not be empty!.');
			$('#dialog').dialog({modal:true});
			return;
		}
		if(!_subject){
			$('#dialog').html('Please enter email subject.');
			$('#dialog').dialog({modal:true});
			return;
		}
		if(!_message){
			$('#dialog').html('Please enter email content.');
			$('#dialog').dialog({modal:true});
			return;
		}*/
		//alert(_uidurl);return false;
		
		$(this).attr('buttontype','doing');
		//var _data = {uname:_username,subject:_subject,message:_message,uidurl:_uidurl,sid:_sid};
		var _data = {uidurl:_uidurl,sid:_sid};
		//alert(_data.uname);return false;
		$.post('<?php echo base_url("user/addSlotTimebyst");?>',_data,function(msg){
		
			if (String == msg.constructor) {      
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			//return false;
			if(json.status){
				//$('#dialog').html('Send Success..');
				alert('Sent successfully');
				//$('#dialog').dialog({modal:true});
				$('#username').val('');
				$('#subject').val('');
				$('#message').val('');
				document.location.href = '<?php echo base_url('user/inbox');?>';
			}
			else{				
				$('#dialog').html(json.msg);
				$('#dialog').dialog({modal:true});
			}
			$('#send').attr('buttontype','done');
		})
	}
	$(function(){
	//alert('ol');
		$('a@[href=#]').attr('href','javascript:void(0)');
		
		//username = false;
		$('#username').blur(function(){
			//checkUsername();
		});
		$('#send').click(function(){
		//alert('here');
			sendMessage();
		});
		$('#discard').click(function(){
			//document.location.href = '<?php echo base_url('user/inbox');?>';
			//document.location.href="<?php echo base_url('user/calendar/uid/850');?>";
			//$('#username').val('');
			//$('#subject').val('');
			//$('#message').val('');
			$('#sendMessageView').hide();
		})
	})
	function setemail(email)
	{
		//alert(email)
		$('#email').val(email);
	}
	</script>
    <style>
	.inbox_tle label{ float:left; width:12%;}
	.inbox_list{ margin:0px; border-bottom:0px solid #dddbdb;}
	.inbox_list .input{ border:1px solid #dddbdb; width:250px; margin-top:3px; height:28px;  padding:2px 10px; color:#999; font-size:12px;}
	.inbox_list .inbox_ipt_text{ border:1px solid #dddbdb; width:84%;  height:28px; padding:2px 10px; color:#999; font-size:12px;}
	.inbox_subject{ margin:10px 0; padding:0px;}
	.inbox_subject .inbox_textarea{border:1px solid #dddbdb; width:588px; height:150px; padding:2px 10px; color:#999; font-size:12px;}
	.autosug{ width:266px !important; border:1px solid #dddbdb !important; overflow:hidden !important;}
	.autosug ul li{ margin:5px 0;}
	.autosug ul li a{ width:100% !important; font-weight:normal; font-size:13px; font-weight:bold; padding:3px 0; height:30px;}
	.autosug ul li a img{ width:30px !important; height:30px !important; float:left; margin:0 10px 0 3px;}
	.autosug ul li a span.bold{ color:#658D97;}
	.selected{ color:#000;}
	.selected span.bold{ color:#fff !important;}
	</style>
	<?php 
	if(@$fresult['email'] != '')
	{
		echo '<script>setemail("'.$fresult['email'].'");</script>';
	}
	?>