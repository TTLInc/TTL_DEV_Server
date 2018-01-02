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
$arrVal = $this->lookup_model->getValue('55', $multi_lang);
$loverallrating = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('298', $multi_lang);
$discardtext = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('40', $multi_lang);
$lratings = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('54', $multi_lang);
$lsessions = $arrVal[$multi_lang];
?>

<?php $this->layout->appendFile('javascript',"js/jquery-jtemplates.js");?>
<?php $this->layout->appendFile('javascript',"js/jquery.poshytip.min.js");?>
<?php $this->layout->appendFile('css',"css/cupertino/theme.css");?>
<?php $this->layout->appendFile('css',"css/search.css");?>

<input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url();?>" />
 <div class="baseBox baseBoxBg clearfix">
    	
        <div class="content_main fr" style="border-radius:30px">
        	<div class="main_inner">
                 <!--/student_prof-->
                <div id="student_prof_Wp">
                   <div class="mod">
                        <div class="hd">
                            <div class="content tle rating">
                            	<h2><?php echo $lratings;?>
                            		<div class=" fr">
										<span style="margin-right: 40px"><?php echo $lsessions;?>: <?php echo $sessionCount;?></span>
										<span><?php echo $loverallrating;?>:</span>
										<span><a id="closebeep" style="cursor:pointer;" onclick="return discard();"><img src="<?php echo base_url('images/cbtn.jpg');?>"></a></span>
										<div class="ratings_score_b fr" id="" style="margin-top: 1px;">
											<s class="ratings_score_yellow star<?php echo $avgRate;?>"></s>
											
										</div>
									</div>
                            	</h2>
                            </div>
                        </div>
                        	
                        <div class="bd">
                          	<ul class="ratings_list">
								<?php foreach ($ratings as $k=>$rate):?>
								<li>
                                	<div class="header_pic_L fl">
                                    	<div class="header_pic">
                                        	<img src="<?php echo profile_image($rate['pic']);?>" width="78" height="80" />
                                        </div>
                                        <div class="hd_pic_name"><?php echo $rate['firstName'],' ',$rate['lastName'];?></div>
                                    </div>
                                    <div class="rating_ct">
										<?php
											$rateScore = intval( ($rate['onTime']+$rate['clearReception'])/2 );
										?>
                                    	<div class="ratings_score" id=""><s class="ratings_score_yellow star<?php echo $rateScore;?>"></s></div>
                                		<div class="ratings_txt"><?php echo $rate['msg'];?></div>
                                        <div class="rating_date">
                                        	<em><?php echo date( 'h:i a, M d, Y' , outTime($rate['create_at']));?></em>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach;?>
                          	</ul>
                        </div>
						<div class="agnR">
									<a class="norBtn whiteRadiusBtn w96" id="discard" onclick="return discard();"><?php echo $discardtext; ?></a>
                                    
                            </div>
                    </div>
                </div>
                <!--/student_prof_Wp-->
            </div>
        </div>
        
    </div>
	
	<script>
	function discard() {
		$('#username').val('');
			$('#subject').val('');
			$('#message').val('');
			$('#sendMessageView').html('');
			$('#sendMessageView').hide();
	}
	function sendMessage(){
		//var _username = $('#username').val();
		var _username = $('#email').val();
		<?php if(@$fresult['email'] != ''): ?>
			var _username = '<?php echo $fresult['email']; ?>';
		<?php endif;?>
		
		var _uidurl = $('#uidurl').val();
		
		//alert(_username)
		var _subject = $('#subject').val();
		var _message = $('#message').val();
		
		if(_uidurl !=0)
		{
			var _username = '0'; 
		}
		
		if(!_username){
			$('#err_username').html('The username can not be empty!.');
			$('#err_username').show();
			return;
		}else{
			$('#err_username').hide();
		}
		if(!_subject){
			$('#err_subject').html('Please enter email subject.');
			$('#err_subject').show();
			return;
		}else{
			$('#err_subject').hide();
		}
		if(!_message){
			$('#err_message').html('Please enter email content.');
			$('#err_message').show();
			return;
		}else{
			$('#err_message').hide();
		}
		//alert(_uidurl);return false;
		
		$('#send').attr('buttontype','doing');
		var _data = {uname:_username,subject:_subject,message:_message,uidurl:_uidurl};
		//alert(_data.uname);return false;
		$.post('<?php echo base_url("user/message_send");?>',_data,function(msg){
		
			if (String == msg.constructor) {      
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			//return false;
			if(json.status){
				
				alert('Sent successfully');
				
				$('#username').val('');
				$('#subject').val('');
				$('#message').val('');
				$('#sendMessageView').html('');
				$('#sendMessageView').hide();
			}
			else{
				alert(json.msg)
				//$('#dialog').html(json.msg);
				//$('#dialog').dialog({modal:true});
			}
			$('#send').attr('buttontype','done');
		})
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
	.error{color:red;margin-left: 83px;display:none;}
	.pro_tle h1{font-size:15px;}
	</style>
	<?php 
	if(@$fresult['email'] != '')
	{
		echo '<script>setemail("'.$fresult['email'].'");</script>';
	}
	?>