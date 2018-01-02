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
//$arrVal 	= $this->lookup_model->getValue('460', $multi_lang);	$lSUBJECT_LINE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('794', $multi_lang);	$sentsuccess   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('1197', $multi_lang);	$validuname   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1198', $multi_lang);	$validsubject   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1199', $multi_lang);	$validContent   	= $arrVal[$multi_lang];


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
                 
                <?php //echo profile_menu($linkType,'i_prof');?>
                 
                <!--/student_prof-->
				<form method="post" action="<?php echo base_url('user/message_send');?>" name="myformsendmsg" id="myformsendmsg" enctype="multipart/form-data">
                <div id="student_prof_Wp">
                    <div class="mod">
                        <div class="hd">
                            <div class="content tle" style="padding-top:0px;"><h2><?php echo $composetxt;?></h2></div>
							<?php //echo "<pre>"; print_r($message);die;?>
                            <div class="inbox_mod">
                            	<div class="inbox_list inbox_tle">
                                	<label><?php echo $totxt;?>:</label>
									<?php									
									$subject;
									$find = "Forward";
									$pos = strpos($subject, $find);
									?>
                                    <input type="text" class="input" name="keyword"  id="keyword" value="<?php if($pos !== FALSE){echo "";}else{echo @$fresult['firstName'] ;} ?>" >
                                    
									<div class="autosug" id="ajax_response"  >
										<div class="wrapper systemError" id="nameErrorBox" style="display: none;"></div>
									</div>
									<?php 
									//print_r($fresult[0]['email']);
									if(@$fresult == '') {
									//echo 'sdfsdf';exit;
									?>
									<input type="hidden" name="email" value="<?php echo @$email;?>" id="email"  /> 
									<?php
									} else {
										//echo $fresult['email'];exit;
									?>
									<?php //echo $fresult[0]['email'];?>
									<input type="hidden"  name="email" value="<?php echo @$fresult['email'];?>" id="email"  /> 
									<?php } ?>
									<input type="hidden" name="uidurl"  value="<?php echo $uidurl;?>" id="uidurl"  /> 
									<span></span>
									<img src="<?php echo base_url();?>images/clip.png" style="width:20px;cursor:pointer;vertical-align:middle;" id="attachFile">
									  <input type="file" class="" style="display:none;" id="attach" name="attach" value=""/> 
									 <span id="upval" style="margin-left:97px;"> <?php echo  $attachment;?></span> 
									 <input type="hidden" <?php if($attachment !=''){ ?> value="<?php echo $messId;?>" <?php  }?> name="isAttached">
                                </div>
                                
                                <div class="inbox_list ">
                                	<label><?php echo $subjecttext;?>:</label>
                                    <input type="text" class="inbox_ipt_text c000" name="subject" value="<?php echo htmlentities($subject);?>" id="subject" /> 
                                </div>
                                
                                <div class="inbox_subject">
                                	<label><?php echo $msgtext; ?>:</label>
                                    <textarea class="inbox_textarea " name="message" id="message" autofocus="autofocus" ><?php echo $message= preg_replace('#<br\s*/?>#i', "\n",$message);?></textarea>
                                </div>
								
								 
                                
                            </div>
							<div class="agnR">
									<a href="<?php echo base_url('user/inbox');?>" class="norBtn whiteRadiusBtn w96" id="discard"><?php echo $discardtext; ?></a>
                                    <a onclick="sendMessage();" class="aqua_btn_msg redRadiusBtn2  w96" id="send"><?php echo $sendtext; ?></a>
								  <!-- <input type="button" onclick="sendMessage()" value="<?php //echo $sendtext; ?>" class="aqua_btn_msg redRadiusBtn2  w96">-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--/student_prof_Wp-->
                </form>
            </div>
        </div>
        <!--/content_main-->
		<?php include dirname(__FILE__).'/leftSide.php';?>
    </div>
	

	
	<script>
/*	$('#message').focus(function(){
       $(this).text(text)
    })
*/	/*
	$('#subject').focus(function(){
       $(this).text(text)
    })*/
	
	
/* $('#attachFile').click(function(){
			
			 $('input[type=file]').css('display','block')
			  
		});*/
		

$( "#attachFile" ).click(function() {
$( "#attach" ).click();
 var a=$('input[type=file]').val();

 
});
  document.getElementById('attach').onchange = function () {
  var a=this.value;
   $("#upval").text(a);
};
	function sendMessage(){
		//var _username = $('#username').val();
		var _myusername = $('#keyword').val();
		var _username = $('#email').val();
		<?php if(@$fresult['email'] != ''): ?>
			var _username = '<?php echo $fresult['email']; ?>';
		<?php endif;?>
		
		var _uidurl = $('#uidurl').val();
		
		//alert(_username)
		var _subject = $('#subject').val();
		var _message = $('#message').val();
		var attach = $('#attach').val();
		if(_uidurl !=0)
		{
			var _username = '0'; 
		}
		
		if(!_username && !_myusername){
			$('#dialog').html('<?php echo $validuname;?>');
			$('#dialog').dialog({modal:true});
			return;
		}
		if(!_subject){
			$('#dialog').html('<?php echo $validsubject;?>');
			$('#dialog').dialog({modal:true});
			return;
		}
		if(!_message){
			$('#dialog').html('<?php echo $validContent;?>');
			$('#dialog').dialog({modal:true});
			return;
		}
		/*
		if(!_username){
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
		$(this).attr('buttontype','doing');
		$('#myformsendmsg').submit();
		var _data = {uname:_username,subject:_subject,message:_message,uidurl:_uidurl,attachfile:attach};
		/*$.post('<?php echo base_url("user/message_send");?>',_data,function(msg){
		
			if (String == msg.constructor) {      
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			if(json.status){
				alert('<?php echo $sentsuccess; ?>');
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
		})*/
	}
	$(function(){
		$('a@[href=#]').attr('href','javascript:void(0)');
		//username = false;
		$('#username').blur(function(){
			//checkUsername();
		});
		$('#send').click(function(){
			sendMessage();
		});
		$('#discard').click(function(){
			document.location.href = '<?php echo base_url('user/inbox');?>';
			$('#username').val('');
			$('#subject').val('');
			$('#message').val('');
		})
	})
	function setemail(email)
	{
		//alert(email)
		$('#email').val(email);
	}
	
	$(function(){
  $('#message').focus();
});
	</script>
    <style>
	.inbox_tle label{ float:left; width:12%;}
	.inbox_list{ margin:0px; border-bottom:0px solid #dddbdb;}
	.inbox_list .input{ border:1px solid #dddbdb; width:250px; margin-top:3px; height:28px;  padding:2px 10px;}
	.inbox_list .inbox_ipt_text{ border:1px solid #dddbdb; width:84%;  height:28px; padding:2px 10px;}
	.inbox_subject{ margin:10px 0; padding:0px;}
	.inbox_subject .inbox_textarea{border:1px solid #dddbdb; width:588px; height:150px; padding:2px 10px;}
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