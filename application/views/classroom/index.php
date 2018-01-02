<!DOCTYPE html>
<html>
<head>
<title>TheTalkList: Real people teaching real language</title>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" >
<meta name="robots" content="noindex,nofollow">
<!-- CSS START -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/testvs/html5reset-1.6.1.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/testvs/tools.css');?>">
<!-- CSS END -->
<!--[if lt IE 9]>
	<script src="js/html5.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/classroom-new.css');?>">
<style type="text/css">
 .popUpDiv{
        border-radius: 5px;
    }
.popup-close {
    width:30px;
    height:25px;
    padding-top:4px;
    display:inline-block;
    position:absolute;
    top:0px;
    right:-95px;
    transition:ease 0.25s all;
    -webkit-transform:translate(50%, -50%);
    transform:translate(50%, -50%);
    border-radius:1000px;
    background:rgba(0,0,0,0.8);
    font-family:Arial, Sans-Serif;
    font-size:20px;
    text-align:center;
    line-height:100%;
    color:white;
}
 
 .popup-close:hover {
   color: white !important;
}
</style>
<style type="text/css">
#Room_player1{width:160px;height:90px;border:1px solid;}
#audio_div{padding-left: 10px;padding-top: 150px; }
</style>
<script type="text/javascript" src="<?php echo base_url('js/jquery.1.7.2.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/popupnewlive.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery-jtemplates.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.placeholder.js');?>"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-ui.css');?>">
<script type="text/javascript">
$(function(){
	$('#Room_layer').height($(document).outerHeight());
	$("#Room_player1").css('position','absolute');
	$("#Room_player1").css('top',$('#sRoom_player').offset().top+333);
	$("#Room_player1").css('left',$('#sRoom_player').offset().left+0);
	//$("#Room_player1").css('left',$('#sRoom_player').width() - 483);
	$('.Room_wrap.posR .spc50').css('line-height','50px');
	$('.Room_wrap.posR .spc50').css('font-size','20px');
	$('.Room_wrap.posR .spc50').css('color','white');
});
</script>
<!--audio player start-->
<link href="<?php echo base_url('css/audioPlayer/jplayer.blue.monday.css');?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('js/audioPlayer/jquery.jplayer.min.js');?>"></script>
<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function(){
	jQuery.noConflict();
	jQuery("#jquery_jplayer_1").jPlayer({
		ready: function () {
			jQuery("#jquery_jplayer_1").jPlayer("setMedia", {
				mp3:"<?php echo base_url('css/audioPlayer/Blop.mp3');?>"
			}).jPlayer("play");
		},
		swfPath: "<?php echo base_url('js/audioPlayer/Jplayer.swf');?>",
		supplied: "mp3",
		wmode:"window",
		preload: "auto",
		errorAlerts: false,
		warningAlerts: false,
		solution: "html,flash",
		autoplay: true,
			
	});
});
//]]>
function playSound() {
	var soundfile = "<?php echo base_url('css/audioPlayer/Vee_session_tick.mp3');?>";
	var soudHTML = "<embed src=\""+soundfile+"\" hidden=\"true\" autostart=\"true\" loop=\"false\" />";
	$("#soundplayeach").html(soudHTML);
}

function playVeeSessionEndsound()
{
	$(".audioDemo").trigger('play');
}
</script>
<audio class="audioDemo" controls preload="none" style="display:none;"> 
   <source src="<?php echo base_url('css/audioPlayer/VeeSessionEnd.mp3');?>" type="audio/mpeg">
</audio>
<link rel="stylesheet"  href='<?php echo base_url('css/fileuploader.css');?>'  type="text/css" />
<script  src='<?php echo base_url('js/ajaxupload.3.6.js');?>'  type="text/javascript" ></script>
<!-- Opentok WebRTC js ---->
<!--<script src="https://static.opentok.com/webrtc/v2.0/js/TB.min.js" ></script>-->
<!--<script src="https://static.opentok.com/webrtc/v2.2/js/opentok.min.js"></script> -->
<script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
<!--<script src="https://static.opentok.com/webrtc/v2.6/js/opentok.min.js"></script>-->
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
$arrVal	= $this->lookup_model->getValue('1009', $multi_lang); $theveesession	= $arrVal[$multi_lang];
$arrVal	= $this->lookup_model->getValue('988', $multi_lang);  $confirm			= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1010', $multi_lang); $comforttutor		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1011', $multi_lang); $comfortstudent 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('719', $multi_lang);  $vupload			= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1012', $multi_lang); $hasgone			= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('390', $multi_lang);  $vsearch			= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1025', $multi_lang); $Shareit			= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1056', $multi_lang); $suretoleave		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1110', $multi_lang); $DragDrop			= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('429', $multi_lang);  $Submit			= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1111', $multi_lang); $RateTechnical	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1112', $multi_lang); $RatTutor			= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1113', $multi_lang); $ReportImport		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1114', $multi_lang); $WriteComm		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1115', $multi_lang); $SubmitedThnak	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1117', $multi_lang); $PleaseRateyour	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1130', $multi_lang); $TestScenario		= $arrVal[$multi_lang];
?>
<script type="text/javascript">
var apiKey			= '<?php echo $apiKey;?>';
var sessionId		= '<?php echo $sessionId;?>';
var token			= '<?php echo $token;?>';
var _startTime 		= <?php echo $_startTime;?>;
var _currentTime	= <?php echo $_startTime;?>;
var servertime		= '<? print time();?>' //PHP method of getting server date
var _endTime		= <?php echo $_endTime;?>;
var uid 			= '<?php echo $uid;?>';
var cid 			= '<?php echo $cid;?>';
var feedbacked		= '<?php echo $feedback;?>';
var user			= <?php echo json_encode($user);?>;
var _setintval		= '';
var initStatus		= false;
var _getedTime		= 0;
var getChatJqr		= '';
var getChatSetintval= '';
var roleId			= '<?php echo $this->session->userdata('roleId'); ?>';
var jp				= jQuery("#jquery_jplayer_1");
var profileImgNull	= '<?php echo base_url()."images/base/hd-pic.png"; ?>';
var _subConnected 	= 0;
var _pubConnected 	= 0;
var _sessionStarted	= 0;
var _clockDisplay	= 0;
<?php if(@$action['tutorConnected']): ?>
var _tutorConnected = <?php echo $action['tutorConnected']; ?>;
<?php else: ?>
var _tutorConnected = 0;
<?php endif; ?>
<?php if(@$action['studentConnected']): ?>
var _studentConnected = <?php echo $action['studentConnected']; ?>;
<?php else: ?>
var _studentConnected = 0;
<?php endif; ?>
window.atmpt		= 0;
window.isCanceled	= false;
var timthumbUrl		= '<?php echo base_url()."timthumb.php?src=";?>';
var isFree			='<?php echo $isFree;?>';
var statTimer;
	
function getChat()
{
	if (_endTime < -300) {
		clearInterval(getChatSetintval);
	}
	if (_endTime == 10) {
		_clockDisplay = 1;
	}
	if (_endTime == 1) {
		$('#fancyClock').css('display','none');
		$('#Room_player1').css('top','62px');
		_clockDisplay = 0;
	}
	if (typeof(getChatJqr.readyState) != 'undefined' && getChatJqr.readyState != 4) {
		return;
	}
	getChatJqr = $.get('<?php echo base_url('classroom/chatGet');?>',{classId:cid,time:_getedTime,t:Math.random()},function(result){
		if (String == result.constructor) {
			eval ('var result = ' + result);
		}
		if (result.error == 1) {
			alert(result.msg);
			if (result.msg.toLowerCase().indexOf('must login first') > -1) {
				clearInterval(getChatSetintval);
				document.location.href="<?php echo base_url('user/login');?>";
			}
		} else {
			if (typeof(result.isCanceled) != 'undefined' && result.isCanceled) {
				window.isCanceled = true;
			}
			if (typeof(result.rows) != 'undefined') {
				$.each(result.rows,function(k,v){
					$("#vuID").val(v.uid);
					if (v.uid != uid) {
						if (user.type == 's' ) {
							_type = 't';
						} else {
							_type = 's';
						}
						var _img = user.otherPic;
					} else {
						_type = user.type;
						var _img = user.pic;
					}
					addMsg(v.msg,_type,_img);
					_getedTime = v.time;
					
					if (v.uid != uid) {
						jpplay();
					}
				});
			}
		}
	})
}

function formatMinute(seconds){
	seconds = Math.abs(seconds);
	var _minutes = parseInt(seconds / 60);
	var _seconds = seconds % 60;
	return _minutes + 'Min ' + _seconds;
}

function showImage(src,width,height,obj){
	$('#dialog2').children('img').remove();
	$('#dialog2').children('p').remove();
	$('#dialog2').children('a').remove();
	$('#dialog2').append('<img/>');
	$('#dialog2').children('img').attr('src', src).width(width).height(height);
	$('#dialog2').append('<p>&nbsp;</p>');
	var _str = $("<div></div>").append($(obj).clone()).html();
	window.shareImage = _str;
	$('#dialog2').append('<a href="javascript:;" class=" Btn Btn_blue  w66" onclick="shareImageFunction();" ><?php echo $Shareit;?></a>');
	$('#dialog2').dialog({modal:true,width:'700',height:'500'});
}

mTimerClass = setTimeout('checkLockedClass();',5000);
function checkLockedClass()
{
	var classLockedTimer;
	var _id = cid;
	$.post('<?php echo base_url('user/checksessionLockedClass');?>',{id:_id},function(msg){
		mTimerClass = setTimeout('checkLockedClass();',5000);
		if (String == msg.constructor) {
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}
		var lockedclasses = json.classes;
		var lockedclass = '';
		var classId = '';
		var numClass =  json.count; 
		for(var i=0;i<numClass+1;i++)
		{
			if (typeof(lockedclasses[i]) != "undefined") {
				lockedclass = lockedclasses[i];
				classId = lockedclass['id'];
				var tooltipid = '#class_t_'+classId;
				var enableid = '#class_e_'+classId;
				var disableid = '#class_d_'+classId;

				$(tooltipid).show();
				$(disableid).show();
				$(enableid).hide();
			}
		}
	})
}
	
$(document).ready(function(){
	$(document).click(function(){
		$(".langList.from").hide();
		$(".langList.to").hide();
	});
	
	if (cid) {
		getChatSetintval = setInterval(getChat,1000);
	}
	getChat();
		
	$('.leaveVee').click(function(){
	
		//console.log(_endTime);
		//console.log("End" + formatMinute(_endTime));	
		if(_endTime > 0 && typeof(user.type)!='undefined' && user.type=='s' && !feedbacked &&!window.isCanceled ){
			$('#dialog3').dialog({
				modal:true,
				buttons: {
					"Yes": function() {
						$('#dialog3').dialog('close');
						_studentConnected = 0;							
						<?php
						$a=$this->session->userdata['uid'];
						$arg="Join";
						?>
						//$('.send_chat_ipt').val(user['name'] + ' is trying to login again.');
						//$('#chatSend').trigger('click');
						//$('#frmsnd').submit();
						//If Student or Tutor leaves Vee-session after saying 'yes' they intend to re-join, then send message to other party:
						$('.send_chat_ipt').val(user['name'] + ' has temporarily left and will be back. Hang on!');
						//$('#chatSend').trigger('click');
						jQuery('#chatSend').trigger('click');
						window.atmpt = 1;
						$.post('<?php echo base_url("classroom/UpdateIntendYes");?>',{clsid:cid});
						setTimeout(function(){
							document.location.href='<?php echo Base_url('user/calendar/uid/'.$a.'/'.$arg);?>';
						},200);							
					},
					'No': function() {
						if(_tutorConnected == 0){
							feedbacked=false;
							feedBack();
							return false;
						}
						
						$('#dialog3').dialog('close');
						_studentConnected = 0;							
						<?php
						$a=$this->session->userdata['uid'];
						$arg="Join";
						?>
						$.post('<?php echo base_url("classroom/updateLeaveStatus");?>',{clsid:cid});
						$.post('<?php echo base_url("classroom/UpdateIntendNo");?>',{clsid:cid});
						//alert(_endTime);
						if (_endTime > 1210) {
							/*$.post('<?php echo base_url("user/updatefreeSession");?>',{clsid:uid},function(result){
							});*/
							$('.send_chat_ipt').val('Due to technical difficulties, '+ user['name'] +' has chosen to cancel this session within free period. This will not count as a paid session. Please Beep a message to '+ user['name'] +' if you want to clarify or reschedule. ');
							jQuery('#chatSend').trigger('click');
							 
							var _data = {};
							_data['cid'] = cid;
							//$.post('<?php echo base_url('classroom/attend');?>',_data);
							$.post('<?php echo base_url("classroom/FreeBack");?>',{clsid:cid});	 
							setTimeout(function(){
								document.location.href='<?php echo Base_url('user/calendar/uid/'.$a.'/'.$arg);?>';
							},200);	
						} else {

							$('.send_chat_ipt').val("The student has decided to leave the session early. Don't worry, you will be paid for this session.");
							jQuery('#chatSend').trigger('click');
							if (_tutorConnected == 1) {
								if (isFree == 'y' ||isFree=='Y') {
								} else {
									//$('.send_chat_ipt').val("The Student has decided to leave the session early. But don't worry, tutor will still get paid for this session.");
									jQuery('#chatSend').trigger('click');
								}
								var _data = {};
								_data['cid'] = cid;
								$.post('<?php echo base_url('classroom/studentattend');?>',_data);									
							} else {
								$.post('<?php echo base_url("classroom/FreeBack");?>',{clsid:cid});	 
							}
						}
						window.atmpt = 1;
						setTimeout(function(){
							document.location.href='<?php echo Base_url('user/calendar/uid/'.$a.'/'.$arg);?>';
						},1000);
					},
					'Cancel': function() {
						$('#dialog3').dialog('close');
					}
				}
			});
		} else if(_endTime > 0 && typeof(user.type)!='undefined' && user.type=='t' &&!window.isCanceled ) {
			$('#dialog3').dialog({
				modal:true,
				buttons: {
					"Yes": function() {
						<?php
						$a=$this->session->userdata['uid'];
						$arg="Join";
						?>
						//If Student or Tutor leaves Vee-session after saying 'yes' they intend to re-join, then send message to other party:
						$('.send_chat_ipt').val(user['name'] + ' has temporarily left and will be back. Hang on!');
						jQuery('#chatSend').trigger('click');
						$('#frmsnd').submit();
						window.atmpt = 1;
						$.post('<?php echo base_url("classroom/UpdateIntendYes");?>',{clsid:cid});
						setTimeout(function(){
							document.location.href='<?php echo Base_url('user/calendar/uid/'.$a.'/'.$arg);?>';
						},200);							
					},
					'No': function() {
						<?php
						$a=$this->session->userdata['uid'];
						$arg="Join";?>
						if (_studentConnected != 0) {
							$.post('<?php echo base_url("classroom/UpdateIntendNo");?>',{clsid:cid});
						}
						var Chkfree = "<?php echo $this->session->userdata('free_session');?>";
						var _data = {};
						_data['cid'] = cid;
						//$.post('<?php echo base_url("classroom/FreeBack");?>',{clsid:cid},function(result));
						if (_studentConnected != 0 && _endTime < 0) {
							$('.send_chat_ipt').val('Due to technical difficulties, '+ user['name'] +' has chosen to cancel this session early. The good news is that your credits will be redeposited into your account. So please schedule again on a better connection.');
							jQuery('#chatSend').trigger('click');
						}

						if (_endTime >= 60 &&_endTime < 1210) {
							var _data = {};
							_data['cid'] = cid;
							$.post('<?php echo base_url('classroom/tutorearlyleave');?>',_data);
						}
						if (_endTime >= 60 && _endTime < 1500) {
							
							/*
							if (_studentConnected == 1) {
								//If Student or Tutor leaves Vee-session after saying 'yes' they intend to re-join, then send message to other party:
								$('.send_chat_ipt').val('Due to technical difficulties, '+ user['name'] +' has chosen to cancel this session early. The good news is that your credits will be redeposited into your account. So please schedule again on a better connection.');
								//$('#chatSend').trigger('click');
								jQuery('#chatSend').trigger('click');
								$.post('<?php echo base_url('classroom/GetTeacherResponse');?>',{classId:1,clsid:cid});
							} else {
								document.location.href='<?php echo Base_url('user/calendar/');?>';
							}
							if (Chkfree=='y' || Chkfree=='Y' && _studentConnected == 0) {	
								//$('.send_chat_ipt').val('Due to technical difficulties, '+ user['name'] +'  has chosen to cancel this session early. The good news is that your credits will be redeposited into your account. So please schedule again on a better connection.');
							} else {
								//$('.send_chat_ipt').val("Student was not able to attend.  The good news is that you will still be paid.");
							} */
							//jQuery('#chatSend').trigger('click');
							$.post('<?php echo base_url("user/updatefreeSession");?>',{clsid:cid, uid:<?php echo $uid;?>});
							$.post('<?php echo base_url("classroom/UpdateIntendNo");?>',{clsid:cid});
							$.post('<?php echo base_url('classroom/GetTeacherResponse');?>',{classId:1,clsid:cid},function(msg){
								var _data = {};
								_data['cid'] = cid;
								$.post('<?php echo base_url('classroom/refund');?>',_data,function(msg){
									document.location.href='<?php echo Base_url('user/calendar/');?>';
								});
							})
						}
						var a="<?php echo Base_url('user/send_message?message=');?>"+cid;
						$('#frmsnd').submit();
						window.atmpt = 1;
						setTimeout(function(){
							document.location.href = a;
							//document.location.href='<?php echo Base_url('user/calendar/');?>';
						},1000);
					},
					'Cancel': function() {
						$('#dialog3').dialog('close');
					}
				}
			});
		}/*
		else if(_endTime > 0 && typeof(user.type)!='undefined' && user.type=='s' && !feedbacked) {
			if(window.confirm('Are you sure you want to leave?')){
				document.location.href='<?php echo Base_url('user/calendar');?>';
			}
		}*/
		else {
			if (window.confirm('<?php echo $suretoleave;?>')) {
			<?php /*$a=$this->session->userdata['uid'];
						$arg="Join";*/ ?>
				//document.location.href='<?php echo Base_url('user/calendar/uid/'.$a.'/'.$arg);?>';
				
				/*var a="<?php echo Base_url('user/send_message?message=');?>"+cid;
				document.location.href = a;*/
				if (user.type =='s') {
					feedbacked=false;
					feedBack();
				} else {
					var a="<?php echo Base_url('user/send_message?message=');?>"+cid;
					document.location.href=a;
				}
			}
		}
	});

	$('.stars a').click(function(){
		var _aObj = $(this);
		var _star = _aObj.parent('.stars');
		var _index = _aObj.index() +1;
		setStars(_star,_index);
	})

	$('#rateButton').click(function(){
		var _data = {};
		$('.stars .on:last','.ratelist').each(function(){
			var _obj = $(this);
			_data[_obj.parent('.stars').attr('id')] = _obj.html();
		});
		_data['sendToAdmin'] = $('#sendToAdmin:checked').get(0)?1:0;
		_data['cid'] = cid;
		_data['msg'] = $('#msg').val();
		$.post('<?php echo base_url("classroom/feedback");?>',_data,function(result){
			if (String == result.constructor) {      
				eval ('var result = ' + result);
			}
			if (typeof(result.error) == 'undefined') {
				alert('Error..');
				return;
			} else if ( result.error) {
				alert(result.msg);
				return;
			} else {
				feedbacked = true;
				$('#dialog1').dialog('close');
				alert("<?php echo $SubmitedThnak;?>");
				if (isFree == 'y') {
					<?php echo $this->session->set_userdata('isFree','yes');?>
					document.location.href='<?php echo Base_url('user/account?pay=true');?>';
					 
				} else { document.location.href='<?php echo Base_url('user/calendar');?>'; }
				/*if(window.confirm("Submitted, Thank You!\r\nDo you want to Leave Vee-session?") ){
					window.atmpt = 1;
					<?php $a=$this->session->userdata['uid'];
						$arg="Join";
					?>
				document.location.href='<?php echo Base_url('user/calendar/uid/'.$a.'/'.$arg);?>';
				}*/
			}
		})
	});
	
	if (uid == '') {
		addMsg('You must login first.');
		setTimeout(function(){
			document.location.href="<?php echo base_url('user/login');?>";
		},3000);
		return;
	}
	
	if (sessionId == '') {
		addMsg('You do Not have class recent.');
		return;
	}
	
	_setintval = setInterval(checkStatus,1000);
	$('.Room_wrap.posR .spc50 .info').html('<?php echo $theveesession; ?> '+user['otherName'] +' ');
});

function sendAction(msg)
{
	$.post('<?php echo base_url('classroom/chatSend');?>',{msg:$('.send_chat_ipt').val(),classId:cid},function(msg){
		if (String == msg.constructor) {
			eval ('var json = ' + msg);
		} else {
			var json = msg;
		}
		if (json.error) {
			alert(json.msg);
		}
	});
}

function setStars(starObj,number){
	$('a',starObj).removeClass('off').removeClass('on').addClass('off');
	$('a:lt('+number+')',starObj).removeClass('off').addClass('on');
}

var showWithOutPay = false;
if (_startTime < -300 && _tutorConnected != 0) {
	showWithOutPay = true;
}

function checkStatus()
{
	var foo = new Date;
	var unixtime = parseInt(foo.getTime() / 1000);
	var unixtime_to_date = new Date(unixtime*1000);
	//var _startTime = _currentTime - unixtime;
	var _startTime = _currentTime - servertime;
	servertime++;
	//_startTime--; //--- Server time
	if (_startTime > 0) {
		$('.Room_wrap.posR .spc50 .start').html(' <?php 
			$arrVal			= $this->lookup_model->getValue('1013', $multi_lang);
			$willstartafter = $arrVal[$multi_lang];
			echo $willstartafter; ?> '+formatMinute(_startTime)+' sec.');
	} else {
		/*if (!initStatus) {
			connect();
			initStatus = true;
		}*/
		$('.Room_wrap.posR .spc50 .start').html(' <?php echo $hasgone; ?> '+ (formatMinute(_startTime)) +' sec.');
		if (_startTime <= -300 && _startTime >= -360 && showWithOutPay == false && (_tutorConnected == 1 || _studentConnected == 1)) {
			showWithOutPay = true;
			$('#showWithOutPay').dialog({
				modal:true,
				buttons: {
					"Yes": function() {
						$( this ).dialog( "close" );
					},
					'No': function() {
						$('.send_chat_ipt').val('Due to technical difficulties, '+ user['name'] +' has chosen to cancel this session within free period. This will not count as a paid session. Please Beep a message to '+ user['name'] +' if you want to clarify or reschedule. ');
						jQuery('#chatSend').trigger('click');
						var sa = $('#sa').val();
						window.atmpt = 1;
						$.post('<?php echo base_url("classroom/UpdateIntendNo");?>',{clsid:cid});
						setTimeout(function(){
							document.location.href= '<?php echo base_url('user/calendar');?>';
						},2000);
					}
				}
			});
		}
	}
	
	if (_endTime>0) {
		_endTime--;
		if (_endTime == 60) {
				addMsg('The session has ' + _endTime + ' sec remaining.');
				if (_endTime == 10) {
					var noConflict = jQuery.noConflict();
					noConflict('#fancyClock').css('display','');
					JBCountDown({
						secondsColor : "#0793DE",
						secondsGlow  : "none",
						startDate   : "1357034400",
						endDate     : "1386496800",
						now         : "1357034400"
					});
					noConflict('#Room_player1').css('top','274px');
				}
		}
	} else {
		if(typeof(session)!='undefined'){
			if(_startTime < -1800){feedBack();session.disconnect();}
		}
	}
	
	if (_tutorConnected == 1 && _studentConnected == 1) {
		//Anything after the 6min query will count as a full Vee Session
		if (_startTime == -360 && ( _tutorConnected == 1 && _studentConnected == 1 )) {
			if (sa != 2) {
				var msgSess = 'Session Approved';
				if (cid != '') {
					$.post('<?php echo base_url('classroom/chatSend');?>',{msg:msgSess,classId:cid},function(msg){
						if (String == msg.constructor) {
							eval ('var json = ' + msg);
						} else {
							var json = msg;
						}
						if (json.error) {
							alert(json.msg);
						}
					});
					var _data = {};
					_data['cid'] = cid;
					$.post('<?php echo base_url('classroom/attend');?>',_data);
				}
				$('#showWithOutPay').dialog('close');
			}
		}
	} else {
		if (_startTime == -240) {
			if (user.type == 's' && _tutorConnected == 0) {
				addMsg('We are really sorry, but your tutor did not show up, Please rate him accordingly and your credits will be redeposited into your account. Please try again as there are plenty of fun and reliable tutors to choose from.');
				var _data = {};
				_data['cid'] = cid;
				$.post('<?php echo base_url('classroom/refund');?>',_data,function(msg){
					//feedBack();
				});
				return false;
			}
			
			if (user.type == 't' && _studentConnected == 0) {
				if (cid !='') {

					$('.send_chat_ipt').val("Session Approved. Your student did not join this Vee-session in the allotted time. You may leave and if this was a paid session, your account will be credited for this session.");
					jQuery('#chatSend').trigger('click');
					var _data = {};
					_data['cid'] = cid;
					$.post('<?php echo base_url('classroom/attend');?>',_data);
				
					$.post('<?php echo base_url('classroom/chatSend');?>',{msg:msgSess,classId:cid},function(msg){
						if (String == msg.constructor) {
							eval ('var json = ' + msg);
						} else {
							var json = msg;
						}
						if (json.error) {
							alert(json.msg);
						}
					});
					var _data = {};
					_data['cid'] = cid;
					$.post('<?php echo base_url('classroom/attend');?>',_data);
				}
				window.atmpt = 1;
			}
		}
	}
}

function feedBack(){
	if (typeof(user.type) != 'undefined' && user.type=='s' && !feedbacked) {
		var _data = {};
		_data['cid'] = cid;
		$.post('<?php echo base_url('classroom/UpdateDisp');?>',_data);
		$('#dialog1').dialog({
			modal:true,
			width:'430px'
		});
	}
}

function profileImgChatThumb(src){
	if(src=='' || src=="\'\'" || src=="&#39;&#39;"){			
		//return timthumbUrl + profileImgNull + '&h=30&w=40&zc=0';
		return profileImgNull;
	}
	//return timthumbUrl + src + '&h=34&w=34&zc=0';
	return src;
}

function addMsg(msg,imgClass,img)
{
	var my = $('#vuID').val();
	if (typeof(imgClass) =='undefined') {
		imgClass = '';
	}
	if (typeof(img) =='undefined' || img == '') {
		img = '<?php echo Base_url('images/base/chat.png');?>';
	}
	if (msg =='Session Approved') {
		img = '<?php echo Base_url('images/base/chat.png');?>';
	}
	
	var isFound = (msg).search(/^(https:|http:)/i);
	if (my != uid &&  isFound == 0) {  
		var _str = '<li>';
		_str += '<span class="user_hdpic"><img src="'+profileImgChatThumb(img)+'" width="34" height="34" class="'+imgClass+'"/></span>';
		_str += '<span class="Room_feed"><span class="cent-bg"><p>';
		_str += '<a href="'+msg+'" target="_blank">'+msg+'</a>';
		_str += '</p></span><span class="botm-bg">&nbsp;</span>';
		_str+='</li>';
	}
	if (my == uid &&  isFound == 0) {
		var _str = '<li class="gary-row">';
		_str += '<span class="Room_feed"><span class="cent-bg"><p>';
		_str += '<a href="'+msg+'" target="_blank">'+msg+'</a>';
		_str += '</p></span><span class="botm-bg">&nbsp;</span></span><span class="user_hdpic"><img src="'+profileImgChatThumb(img)+'" width="34" height="34" class="'+imgClass+'"/></span>';
		_str+='</li>';
	}
	
	if (my != uid &&  isFound== -1) {
		var _str = '<li>';
		_str += '<span class="user_hdpic"><img src="'+profileImgChatThumb(img)+'" width="34" height="34" class="'+imgClass+'"/></span>';
		_str += '<span class="Room_feed"><span class="cent-bg"><p>';
		_str += msg;
		_str += '</p></span><span class="botm-bg">&nbsp;</span></span>';
		_str+='</li>'; 
	}

	if (my == uid &&  isFound == -1) { 
		var _str = '<li class="gary-row">';
		_str += '<span class="Room_feed"><span class="cent-bg"><p>';
		_str += msg;
		_str += '</p></span><span class="botm-bg">&nbsp;</span></span><span class="user_hdpic"><img src="'+profileImgChatThumb(img)+'" width="34" height="34" class="'+imgClass+'"/></span>';
		_str+='</li>';
	}
	
	$('.Room_chat_view ul').append(_str);;
	$(".Room_chat_view ").scrollTop($(".Room_chat_view ul").height()) ,$(".Room_chat_view ul").height();
	var elm = document.getElementById('TextArea1');
	try {
		elm.scrollTop = elm.scrollHeight;
	} catch(e) {
		var f = document.createElement("input");
		if (f.setAttribute) f.setAttribute("type","text")
		if (elm.appendChild) elm.appendChild(f);
		f.style.width = "0px";
		f.style.height = "0px";
		if (f.focus) f.focus();
		if (elm.removeChild) elm.removeChild(f);
	}
	playSound();
	jpplay();
}

function jpplay()
{	
	jQuery("#jquery_jplayer_1").jPlayer({
		ready: function () {
			jQuery("#jquery_jplayer_1").jPlayer("setMedia", {
				//mp3:"<?php echo base_url('css/audioPlayer/Blop.mp3');?>"
			}).jPlayer("play");
		},
		//swfPath: "<?php echo base_url('js/audioPlayer/Jplayer.swf');?>",
		supplied: "mp3",
		wmode:"window",
		preload: "auto",
		errorAlerts: false,
		warningAlerts: false,
		solution: "html,flash",
		autoplay: true,
	});
	
	setTimeout(function(){
		jQuery("#jquery_jplayer_1").jPlayer("play");
	}, 1500);
}

function exceptionHandler(event) {
	//alert("Exception:" + event.title + ". " + event.message);
}

function connect(){
	if(sessionId == ''){
		addMsg('You do Not have class recent.');
		return;
	}
	TB.setLogLevel(TB.DEBUG);
	TB.on("exception", exceptionHandler);
	session = TB.initSession(sessionId);
	session.on('sessionConnected', sessionConnectedHandler);
	session.on("streamCreated", streamCreatedHandler);
	session.on("streamDestroyed", streamDestroyedHandler);
	session.connect(apiKey, token);
}	
var publisher;
function sessionConnectedHandler(event) {
	// Put my webcam in a div
	//var publishProps = {height:240, width:320};
	var publishProps = {height:$('#Room_player1').height(), width:$('#Room_player1').width()};
	publisher = TB.initPublisher(apiKey, 'sRoom_player1', publishProps);
	// Send my stream to the session
	//session.publish(publisher.publishAudio(true));
	//session.publish(publisher.publishVideo(true));
	session.publish(publisher);		
	recheck("publisher");
	addMsg('connected to the server...');
	var stream = event.streams.shift();
	if (typeof(stream ) == 'undefined' || stream.connection.connectionId == session.connection.connectionId) {
		$('#sRoom_player').html('Waiting..');
		addMsg('Waiting for '+user['otherName']+' to connect...');
	} else {
		if (typeof($('#sRoom_player').get(0))=='undefined') {
			$('#Room_player').html('<div id="sRoom_player"></div>');
		}
		subscriber =	session.subscribe(stream, "sRoom_player", {height:$('#Room_player').height(), width:$('#Room_player').width()});
		subscriber.setAudioVolume(50);
		window.setInterval(function() {recheck("subscriber")}, 1000);
		addMsg(user['otherName']+' connected...');
	}
}

function streamCreatedHandler(event)
{
	var stream = event.streams.shift();
	if (stream.connection.connectionId == session.connection.connectionId) {
		window.setInterval(function() {recheck("publisher")}, 1000);
	} else {
		if ( typeof($('#sRoom_player').get(0)) == 'undefined') {
			$('#Room_player').html('<div id="sRoom_player"></div>')
		}
		session.subscribe(stream, "sRoom_player", {height:$('#Room_player').height(), width:$('#Room_player').width()});
		window.setInterval(function() {recheck("subscriber")}, 1000);
		addMsg(user['otherName']+' connected...');
	}
	updateToSessionStarted();
}

function streamDestroyedHandler(event)
{
	if (roleId != 0) {
		//addMsg('Student decided to terminate the session early. Your payment will still be rendered.');
	}
}

function recheck(type)
{
	if (type == "publisher") {
		if ($("object", "#Room_player1").length > 0) {
			var id = $("object", "#Room_player1").attr("id");
			checkP2P(id);
		}
		_pubConnected = 1;
	} else {
		if ($("object", "#Room_player").length > 0) {
			var id = $("object", "#Room_player").attr("id");
			checkP2P(id);
		}
		_subConnected = 1;
	}
	
	if (user.type == 't') {
		_tutorConnected = 1;
		$.post('<?php echo base_url('classroom/updateClassAction');?>',{tutorConnected:_tutorConnected,classId:cid});
	}
	
	if (user.type == 's') {
		_studentConnected = 1;
		$.post('<?php echo base_url('classroom/updateClassAction');?>',{studentConnected:_studentConnected,classId:cid});
	}
}

function checkP2P(object_id)
{
	var element = document.getElementById(object_id);
	if (element) {
		if (!element.fetchData) {
			//swf hasn't loaded completely, check again in .5 second
			setTimeout('checkP2P("' + object_id + '");', 1000);
			return;
		}
		var data = element.fetchData();
		var test = eval($(data).find("p2p").text()); //this will return true or false
		var new_status = "false";
		var new_color = "#ff7373";
		if (test) {
			new_status = "true"
			new_color = "#80ea69";
		}
		
		var status_container = $("#" + object_id).prev("div");
		status_container.text("P2P Status: " + new_status);
		status_container.css("background-color", new_color);
	}
}

function exceptionHandler(event) {
	//alert("Exception: " + event.code + "::" + event.message);
}

function updateToSessionStarted()
{
	$.get('<?php echo base_url('classroom/updateToSessionStarted');?>',{classId:cid},function(result){})
}

function turnOffMyVideo() 
{
	session.unpublish(publisher);
}

function turnOnMyVideo1() 
{
	var publishProps = {height:$('#Room_player1').height(), width:$('#Room_player1').width()};
	publisher = TB.initPublisher(apiKey, 'sRoom_player1', publishProps);
	session.publish(publisher);
	//var newDiv = document.createElement("div");
	//newDiv.id = "publisherContainer";
	//document.getElementById("Room_player").appendChild(newDiv);
}

function turnOnMyVideo()
{
	//addMsg('connecting wait...');
	//addMsg('connected to the server...');
	var browserName=navigator.appName;
	var det = IsGCFInstalled();
	if (browserName=="Microsoft Internet Explorer" && window.chrome == undefined) {
		alert('You must use one of the supported browsers to run our Vee-session:  Firefox, Chrome, or Opera.  If you continue with Internet Explorer, you will be prompted to install the Google Frame plugin.');
	} else {
		hideTest('sRoom_player');
		//addMsg('Please Click on allow to Test Video');
		var div = document.createElement('div');
		div.setAttribute('id', 'publisher');
		// checks for publisher container have or not
		if (document.getElementById('publisherContainer')) {
			var publisherContainer = document.getElementById('publisherContainer');  
			publisherContainer.appendChild(div);
		} else {
			var newDiv = document.createElement("div");
			newDiv.id = "publisherContainer";
			document.getElementById("Room_player").appendChild(newDiv);
			
			var publisherContainer = document.getElementById('publisherContainer');  
			publisherContainer.appendChild(div);
		}
		var publishProps = {height:452, width:671};
		publisher = TB.initPublisher(apiKey, 'publisherContainer', publishProps);
	}
}

function IsGCFInstalled() {
	try {
		var i = new ActiveXObject('ChromeTab.ChromeFrame');
		if (i) {
		  return true;
		}
	} catch(e) {
		//log('ChromeFrame not available, error:', e.message);
		// squelch
	}
	return false;
}

function turnOnMyAudio(){
	if (TB.checkSystemRequirements() != TB.HAS_REQUIREMENTS) {
		alert("You don't have the minimum requirements to run this application."
			  + "Please upgrade to the latest version of Flash.");
	} else {
		var parentDiv = document.getElementById("audPublisherContainer");
		var replacementDiv = document.createElement("div"); // Create a div for the publisher to replace
		replacementDiv.id = "opentok_publisher";
		parentDiv.appendChild(replacementDiv);
		var publisherProperties = {height:130, width:160};
		publisherProperties.publishVideo = false;
		//addMsg('Please Click on allow to Test Audio');
		
		//publisher = TB.initPublisher(replacementDiv.id);
		publisher = TB.initPublisher(apiKey, parentDiv.id, publisherProperties);
		//publisher.publishAudio(true);
		//publisher.detectMicActivity(true);
		publisher.on("devicesDetected", devicesDetectedHandler);
		publisher.on("microphoneActivityLevel", microphoneActivityLevelHandler);
		publisher.detectDevices();
		hideTest("manageDevicesBtn");
		//manageDevices();
	}
}

function turnOffMyAudio() 
{
	publisher.publishAudio(false);
	if (publisher) {
			session.unpublish(publisher);
		}
	publisher = null;
	//addMsg('disconnected...');
	//var newDiv = document.createElement("div");
	//newDiv.id = "audPublisherContainer";
	$('#call-status').after('<br /><br /><div id="audPublisherContainer" class="audPublisherContainer"></div>');
	//document.getElementById("Room_player").appendChild(newDiv);
	showTest('sRoom_player');
}

function devicesDetectedHandler(event) {
	var microphones = event.microphones;
	var micSelect = document.getElementById("mics");
	micSelect.innerHTML = "";
	for (i = 0; i < microphones.length; i++) {
		var micOption = document.createElement("option");
		var micName = microphones[i].name;
		micOption.setAttribute("value", micName);
		micOption.innerHTML = micName;
		micSelect.appendChild(micOption);
		if (micName == event.selectedMicrophone.name) {
			micSelect.selectedIndex = i;
		}
	}
	document.getElementById("call-status").innerHTML = "Devices detected.";
	//showTest("mics");
	//addMsg('Click on Manage Devices to See the Mic Activity');
	showTest("manageDevicesBtn");
}

function microphoneActivityLevelHandler(event)
{
	var volumeIndictatorMask = document.getElementById("volumeIndicatorMask");
	volumeIndictatorMask.style.width = (100 - event.value * microphoneGain / 100) + "%";
}
	
function detectDevices() {
	hideTest("mics");
	publisher.detectDevices();
}

// Called when the user clicks the manageDevicesBtn button
function manageDevicesmanageDevices() {
	showTest("manageDevicesDiv");
	publisher.detectMicActivity(true);
}

// Called when the user clicks the manageDevicesBtn button
function closeManageDevices() {
	publisher.detectMicActivity(false);
	hideTest("manageDevicesDiv");
}

function setMicrophone() {
	var micsSelect = document.getElementById("mics");
	var micName = micsSelect.options[micsSelect.selectedIndex].value;
	publisher.setMicrophone(micName);
}
		
function showPanel(id){
	$('.search_type').hide();
	$('#'+id).slideUp().show('slow');
}

function showTest(id){
	$('#'+id).show('slow');
}

function hideTest(id){
	$('#'+id).hide('slow');
}
</script>
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
$arrVal = $this->lookup_model->getValue('3', $multi_lang);   $vsearch		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('358', $multi_lang); $vleave		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('361', $multi_lang); $vchatwindow 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('34', $multi_lang);	 $vsend 		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('342', $multi_lang); $vtestinstructiondetails	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('354', $multi_lang); $vtranslate 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('355', $multi_lang); $vdictionary 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('352', $multi_lang); $vimages 		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('353', $multi_lang); $vsearchimage 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('356', $multi_lang); $vsearchdictionary = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('357', $multi_lang); $vdefine 		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('678', $multi_lang); $vnewsfeed 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('679', $multi_lang); $vsearchnews 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('680', $multi_lang); $vgetnews 		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('681', $multi_lang); $vdragdrop		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('682', $multi_lang); $vagenda 		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('683', $multi_lang); $vintroduction = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('684', $multi_lang); $vstudentrequest= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('685', $multi_lang); $vtutorapproach= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('686', $multi_lang); $vpolitetutor 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('687', $multi_lang); $vnextsteps 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('688', $multi_lang); $vhelp 		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('689', $multi_lang); $vhearingaudio = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('690', $multi_lang); $vaskpartner 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('691', $multi_lang); $vscreenfrozen = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('692', $multi_lang); $vreloadbrowser= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('693', $multi_lang); $vneedatemp 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('694', $multi_lang); $vchatyourintend = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('695', $multi_lang); $vnotseeingvideo = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('696', $multi_lang); $vchecktosee 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('697', $multi_lang); $vpersistening = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('698', $multi_lang); $vchromerecommend = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('699', $multi_lang); $vreschedule 	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('700', $multi_lang); $vwithinfirst3min = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1008', $multi_lang); $intendtorejoin= $arrVal[$multi_lang];
?>
<link href='https://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('js/timer/seconds/css/jbclock.css');?>" />
<script type="text/javascript" src="<?php echo base_url('js/timer/seconds/js/jbclock.js');?>"></script>
<script type="text/javascript">
function secondsTimeSpanToHMS(s) {
	var h = Math.floor(s/3600); //Get whole hours
	s -= h*3600;
	var m = Math.floor(s/60); //Get remaining minutes
	s -= m*60;
	return h+"-"+(m < 10 ? '0'+m : m)+"-"+(s < 10 ? '0'+s : s); //zero padding on minutes and seconds
}
</script>	
</head>
<body>
<div id="Room_layer12"></div>
<div class="Room_wrap posR">
<div class="blue-bg">
	<div class="Room_bd clearfix">
		<div class="str-info">
			<div class="spc50">
				<!--<div class="spc50" style="display:none;">-->
				<span class="info"></span>
				<span class="start"></span>
				<span class="end"></span>
				</div>
			</div>
			<div class="Room_view f1">
				<input type="hidden" value="" id="vuID" />
				<div id="Room_player">
					<div  id="sRoom_player">
						<img src="<?php echo Base_url('images/room_video.jpg');?>"/>
					</div>
				</div>
				<!--<div id="fancyClock" style="display:none;"><div class="clock" style="width:200px;"><div class="clock_seconds"><div class="bgLayer"><canvas id="canvas_seconds" width="122" height="122"></canvas><p class="val">0</p></div></div></div></div>-->
				<div class="leaveRoom">
					<a href="#" class="icon1 tooltip leaveVee">&nbsp;<span class="classic"><?php echo $vleave; ?></span></a>
				</div>
				<div class="vis-logo"><img alt="video-img" src="<?php echo Base_url('images'); ?>/ttl-vee-logo.png"></div>
				<div class="vis-usr-img onetoone_ses">
					<div id="Room_player1"  style="width:160;height:100px;text-align:center;">
						<div id="sRoom_player1">
							<img src="<?php echo Base_url('images/room_video.jpg');?>" width="160" height="100" />
						</div>
					</div>
				</div>
			</div>
			<div class="Room_chat_wp fr">
				<div class="Room_chat">
					<h2><?php echo $vchatwindow;?></h2>
					<div id="TextArea1" class="Room_chat_view">
						<ul></ul>
					</div>
					<div class="cht-snbtn">
						<form id="frmsnd" onsubmit="$('#chatSend').click(); return false;">
							<input id="chatSend_txt" type="text" class="send_chat_ipt" name="" />
							<span class="leaveRoom2">
								<a href="javascript:;" id="chatSend"><?php //echo $vsend; ?></a>
							</span>
						</form>
					</div>
				</div>
				<div class="Btn_wp agnR">
				<!--<a href="#" class="Btn_audio"></a>-->
				</div>
			</div>
			
			<script type="text/javascript">
			function shareImageFunction ()
			{
				$('.send_chat_ipt').val(window.shareImage);
				//$('#chatSend').trigger('click');
				$.post('<?php echo base_url('classroom/chatSend');?>',{msg:$('.send_chat_ipt').val(),classId:cid},function(msg){
					if (String == msg.constructor) {
						eval ('var json = ' + msg);
					} else {
						var json = msg;
					}
					
					if (json.error) {
						alert(json.msg);
					}
				});
				
				$('.send_chat_ipt').val('');
				$('#dialog2').dialog('close');
			}
			</script>
			
			<script type="text/javascript">
			$('#chatSend').click(function(){
				if (cid != '') {
					$.post('<?php echo base_url('classroom/chatSend');?>',{msg:$('.send_chat_ipt').val(),classId:cid},function(msg){
						if (String == msg.constructor) {
							eval ('var json = ' + msg);
						} else {
							var json = msg;
						}
						if (json.error) {
							alert(json.msg);
						}
					});
				} else {
					addMsg('You do Not have a Vee-session.');
				}

				$('.send_chat_ipt').val('');
				setTimeout(getChat,200);
			});
			
			$('#chatSend_txt').keypress(function(e) {
				if (e.keyCode==13) {
					//addMsg($('.send_chat_ipt').val(),user.type);
					if (cid !='') {
						$.post('<?php echo base_url('classroom/chatSend');?>',{msg:$('.send_chat_ipt').val(),classId:cid},function(msg){
							if (String == msg.constructor) {
								eval ('var json = ' + msg);
							} else {
								var json = msg;
							}
							if (json.error) {
								alert(json.msg);
							}
						});
					} else {		
						addMsg('You do Not have a Vee-session.');
					}

					$('.send_chat_ipt').val('');
					setTimeout(getChat,200);
				}
			});
			</script>
			<style type="text/css">
			div.ratelist {
				line-height: 31px;
				font-size: 14px;
				
			}
			.stars {
				margin-top: 5px;
			}
			.ratelist .title{
				width:320px
			}
			.clearer{clear:both}
			.stars a.on {
				background: url('http://www.ddxia.com/2012/images/star2.png');
			}
			.stars a.off {
				background: url('http://www.ddxia.com/2012/images/star2.png') 0 -18px;
			}
			.stars a {
				width: 16px;
				height: 16px;
				display: block;
				float: left;
				text-indent: -10000em;
			}
			.textareaMsg{width:340px;height:72px}
			</style>
			
			<style type="text/css">
			div.ratelist {
				line-height: 31px;
				font-size: 14px;
			}
			.stars {
				margin-top: 5px;
			}
			.ratelist .title{
				width:320px
			}
			.clearer{clear:both}
			.stars a.on {
				background: url('http://www.ddxia.com/2012/images/star2.png');
			}
			.stars a.off {
				background: url('http://www.ddxia.com/2012/images/star2.png') 0 -18px;
			}
			.stars a {
				width: 16px;
				height: 16px;
				display: block;
				float: left;
				text-indent: -10000em;
			}
			.textareaMsg{width:340px;height:72px}
			#Room_sear_result .Room_search_iView a{
				height:150px;
				width:auto;
			}
			</style>
			<div id="dialog2" title="" style="display:none;">
				<img src="<?php echo base_url('images/base/chat.png');?>" />
			</div>
			<textarea id="imageResultTemp" style="display:none"  rows="0" cols="0">
			{#foreach $T.rows as row}
			<a target="_blank" title="{$T.row.name}" onclick="showImage('{$T.row.webSearchUrl}',{#if $T.row.thumbnail.width>800}800{#else}{$T.row.thumbnail.thumbnail}{#/if},{#if $T.row.thumbnail.width>800}{ $T.row.thumbnail.height/($T.row.thumbnail.width/800) }{#else}{$T.row.thumbnail.height}{#/if},this)">
				<img src="{$T.row.thumbnailUrl}" height="{#if $T.row.thumbnail.height>150}150{#else}{$T.row.thumbnail.height}{#/if}px"/>
			</a>
			{#/for}
			</textarea>
			
			<div id="dialog3" title="<?php echo $vleave; ?>" style="display:None;">
				<?php echo $intendtorejoin; ?>
			</div>
			
			<div id="dialog1" title="<?php echo $PleaseRateyour;?>" style="display:None;">
				<div class="ratelist">
					<span class="title" style="float:left"><?php echo $RateTechnical;?></span>  
					<span class="stars" id="onTime" style="float:left">
						<a href="javascript:;" title="" class="on">1</a>
						<a href="javascript:;" title="" class="on">2</a>
						<a href="javascript:;" title="" class="on">3</a>
						<a href="javascript:;" title="" class="off">4</a>
						<a href="javascript:;" title="" class="off">5</a>
					</span>
					<p class="clearer"></p>
				</div>
				<div class="ratelist">
					<span class="title" style="float:left"><?php echo $RatTutor;?></span>  
					<span class="stars" id="clearReception" style="float:left">
						<a href="javascript:;" title="" class="on">1</a>
						<a href="javascript:;" title="" class="on">2</a>
						<a href="javascript:;" title="" class="on">3</a>
						<a href="javascript:;" title="" class="on">4</a>
						<a href="javascript:;" title="" class="off">5</a>
					</span>
					<p class="clearer"></p>
				</div>
				<!--<div><li>Rete your classroom experience.</li><li><span>11</span><span>11</span><span>11</span><span>11</span></li></div>
				<p><span>Rete your professor.</span><dl><span>11</span><span>11</span><span>11</span><span>11</span><span>11</span></dl></p>
				-->
				<p><input type="checkbox" value="1" id="sendToAdmin"> <?php echo $ReportImport;?></p>
				<p><?php echo $WriteComm;?></p>
				<p><textarea id="msg" class="textareaMsg"></textarea></p>
				<p><input type="button" value="<?php echo $Submit;?>" id="rateButton" class="blu-btn"/></p>
			</div>
			
			<div id="showWithOutPay" title="<?php echo $confirm;?>" style="display:None;">
				<?php
				$roleId = $this->session->userdata('roleId');
				if ($roleId != 0){?>
					<p style="font-size:14px;"><?php echo $comforttutor; ?></p>
				<?php
				} else {
				?>
					<p style="font-size:14px;"><?php echo $comfortstudent; ?></p>
				<?php
				}?>
			</div>
			
			<script type="text/javascript">
			$(function(){
				$('#searchImageButton').click(function(){
					var _q = $('#searchImageInput').val();
					if(_q.length < 2){
						alert('The keywords must have more than 2 characters.');
						return;
					}
					$(this).attr('buttonType','doing');
					$.get('<?php echo base_url("classroom/images");?>',{q:_q},function(result){
						
						$('#searchImageButton').attr('buttonType','done');
						if (String == result.constructor) {
							eval ('var result = ' + result);
						}
						
						if (result.error) { 
						} else {					
							$('#img_result').setTemplateElement('imageResultTemp').processTemplate(result);
						}
					});
				});
			});
			</script>
			<script src="https://jquery-ui.googlecode.com/svn/tags/latest/external/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>
			<script language="javascript" type="text/javascript">
			$(function() {
				$("#allfields li").draggable({
					appendTo: "body",
					helper: "clone",
					cursor: "select",
					revert: "invalid"
				});
				initDroppable($("#TextArea1"));
				
				function initDroppable($elements)
				{
					$elements.droppable({
						hoverClass: "textarea",
						accept: ":not(.ui-sortable-helper)",
						drop: function(event, ui) {
							$('#TextArea1').val('');
							var $this = $(this);
							var tempid = ui.draggable.text();
							var dropText;
							dropText = " " + tempid + " "+ "\r\n";
							var droparea = document.getElementById('TextArea1');
							var range1 = droparea.selectionStart;
							var range2 = droparea.selectionEnd;
							var val = droparea.value;
							var str1 = val.substring(0, range1);
							var str3 = val.substring(range1, val.length);
							droparea.value = str1 + dropText + str3;
							// $("#TextArea1").append(dropText);
							$.post('<?php echo base_url('classroom/chatSend');?>',{msg:dropText,classId:cid},function(msg){
								if (String == msg.constructor) {
									eval ('var json = ' + msg);
								} else {
									var json = msg;
								}
								if(json.error){
									alert(json.msg);
								}
							});
						}
					});
				}
			});
			</script>
			<div class="gray-panel">
				<div class="mn-cnt">
					<div id="TabbedPanels1" class="VTabbedPanels">
						<ul id="allTabs" class="TabbedPanelsTabGroup Room_slide fl">
							<!--<li class="TabbedPanelsTab one current" data-tab="tab-1"><a href="javascript:void(0)"><span><?php echo $vagenda; ?></span></a></li>-->
							<li class="TabbedPanelsTab four current" data-tab="tab-4"><a href="javascript:void(0)"><span><?php echo $vimages;?></span></a></li>
							<li class="TabbedPanelsTab eight" data-tab="tab-8"><a href="javascript:void(0)"><span><?php echo $TestScenario;?></span></a></li>
							<li class="TabbedPanelsTab five" data-tab="tab-5"><a href="javascript:void(0)"><span><?php echo $vtranslate; ?></span></a></li>							
							<li class="TabbedPanelsTab seven" data-tab="tab-7"><a href="javascript:void(0)"><span><?php echo $vnewsfeed;?></span></a></li>							
							<!--<li class="TabbedPanelsTab six" data-tab="tab-6"><a href="javascript:void(0)"><span><?php echo $vdictionary;?></span></a></li>-->
						</ul>
					</div>
					<div class="drg-txt"><a href="#"><?php echo $DragDrop;?></a></div>
					<div class="help-tip">
					<p>
						<?php echo "<b>".$vhearingaudio."</b>"; ?> - <?php echo $vaskpartner; ?><br><br>
						<?php echo "<b>".$vscreenfrozen."</b>"; ?> - <?php echo $vreloadbrowser; ?><br><br>
						<?php echo "<b>".$vneedatemp."</b>"; ?> - <?php echo $vchatyourintend; ?><br><br>
						<?php echo "<b>".$vnotseeingvideo."</b>"; ?> - <?php echo $vchecktosee; ?> <span class="red"><?php echo $vchromerecommend; ?></span><br><br>
						<?php echo "<b>".$vpersistening."</b>"; ?> - <?php echo $vreschedule; ?> <span class="red"><?php echo $vwithinfirst3min; ?></span><br><br>
					</p>
				</div>
					<div class="credit-rules"><a href="<?php echo base_url().'article/Credit-rules.pdf';?>"  target="_blank">
					<?php
					$arrVal= $this->lookup_model->getValue('1373', $multi_lang);
					echo $arrVal[$multi_lang]; //Credit Rules
					?>
					</a></div>
				</div>
			</div>
			</div>
		</div>
		<div class="white-bg">
			<div class="Room_tool">
				<div class="TabbedPanelsContentGroup">
					<!--<div class="TabbedPanelsContent current" id="tab-1">
						<div class="vstxt">
							<h2><?php echo $vagenda; ?></h2>
							<ul id="allfields">
								<li><?php echo $vintroduction; ?></li>
								<li><?php echo $vstudentrequest; ?></li>
								<li><?php echo $vtutorapproach; ?></li>
								<li><?php echo $vpolitetutor; ?></li>
								<li><?php echo $vnextsteps; ?></li>
							</ul>
						</div>
						<div class="vs-txt">
							<h2><?php echo $vhelp; ?></h2>
							<ul class="box2" id="allfields">
								<li><?php echo $vhearingaudio; ?> </li>
								<li class="rght-li"><span><?php echo $vaskpartner; ?></span></li>
								
								<li><?php echo $vscreenfrozen; ?> </li>
								<li class="rght-li"><span><?php echo $vreloadbrowser; ?> </span></li>
								
								<li><?php echo $vneedatemp; ?></li>
								<li class="rght-li"><span><?php echo $vchatyourintend; ?></span></li>
								
								<li><?php echo $vnotseeingvideo; ?></li>
								<li class="rght-li"><span><?php echo $vchecktosee; ?>&nbsp;&nbsp;<span class="red"><?php echo $vchromerecommend; ?></span></span>
								</li>
								
								<li><?php echo $vpersistening; ?></li>	
								<li class="rght-li"><span><?php echo $vreschedule; ?> &nbsp;&nbsp;<span class="black"><?php echo $vwithinfirst3min; ?></span></span>                     </li>	
							</ul>
						</div>
					</div>-->      
					<div class="TabbedPanelsContent blu-bgexpnd current" id="tab-4">
						<div id="search_img" class="search_type">
							<div class="blubg-inr">
								<div class="bludv-cnt">
									<div class="Room_sear_wp">
										<form onsubmit="$('#searchImageButton').click();return false;">
											<input type="text" id="searchImageInput" class="Room_search_ipt" placeholder="<?php echo $vsearchimage; ?>" />								
											<span class="leaveRoom2 Btn-blue fl-left"><a href="javascript:void(0)" id="searchImageButton" ><?php echo $vsearch; ?></a></span>
										</form>
										<span class="leaveRoom2 Btn-blue">
										<a class="" id="profile_vedio_upload_true_test" href="javascript:void(0)" ><?php echo $vupload;?></a>
										</span>
									</div>
								</div>
							</div>
							<div class="whitdv-cnt">
							<div id="Room_sear_result">
								<div id="img_result" class="Room_search_iView">
									<?php foreach($myContents->value as $imageContent): ?>
									<?php $height = "150"; ?>
									<img src="<?php echo $imageContent->thumbnailUrl;?>" height="<?php echo $height;?>px" />
									<?php
								//	if($imageContent->thumbnail > 150){
											//$height = 150;
								//	}
								//	else{
								//		$height = 150;
								//	}//echo '<pre>';var_dump($gImage);//link image link?>
								<!--	<a href="<?php// echo $imageContent->thumbnail;?>" target="_blank" title="<?php //echo $imageContent->name;?>">
										<img src="<?php //echo $imageContent->thumbnailUrl;?>" height="<?php//echo $height;?>px" />
									</a> -->
									<?php endforeach;?>
									
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="TabbedPanelsContent blu-bgexpnd" id="tab-5">
					<div id="gt-form-c" class="search_type">
						<div class="blubg-inr">
							<div class="bludv-cnt">
								<div class="Room_sear_wp">
									<div id="gt-langs">
										<div  class="from_lang langs g-inline-block" onClick="showlng1();">
											<span dataid="" class="lang_op">From: Detect language</span>
											<s class="ico_arr ico_arr_down"></s>
										</div>
										<div id="transFrom2to" class="ico_trans g-inline-block">
											<s class="ico_arr_trans"></s>
										</div>
										<div class="to_lang langs g-inline-block" onClick="showlng2();">
											<span dataid="en" class="lang_op">TO: English</span>
											<s class="ico_arr ico_arr_down"></s>
										</div>
										<div id="gt-lang-submit" class="Btn-blue">
											<a href="javascript:void(0)" class=" Btn Btn_blue w66" id="gt-submit"><?php echo $vtranslate; ?></a>
										</div>
									</div>
								</div>
								<div style="display:none;" class="langList from langListfrom">
									<!----<span class="langItem" dataid="">Detect language</span>-->
									 <?php foreach($gLangs['languages'] as $k=>$v):?>
									<span dataId="<?php echo $v['language'];?>"  class="langItem"><?php echo $v['name'];?></span><br>
								<?php endforeach;?>
								</div>
								<div style="display: none;" class="langList to langListto">
									<?php foreach($gLangs['languages'] as $k=>$v):?>
										<span dataId="<?php echo $v['language'];?>" class="langItem"><?php echo $v['name'];?></span><br>
									<?php endforeach;?>
								</div>
							</div>
						</div>
						<div class="whitdv-cnt">
							<div id="gt-text-source">
								<div class="lang-option">
									<div dataid="no" class="lang-inline-block selected lng-opp-sub">English</div>
								</div>
								<div id="source-wrap" class="lng-tetxarea">
									<textarea id="source-textarea" name=""></textarea>
								</div>
							</div>
							<div id="gt-text-target">
								<div class="lang-option">
									<div dataid="en" class="lang-inline-block lng-opp-sub selected">English</div>
									<div dataid="en" class="lang-inline-block lng-opp-sub selected"></div>
									
								</div>
								<div id="target-wrap" class="lng-tetxarea">
									<textarea id="target-textarea" name=""></textarea>
								</div>
							</div>
						</div>
					</div>
					
					<!--for translate script-->
					<script type="text/javascript">
					$(function(){
						$('.from_lang').toggle(function(){
								$('.langList.from').show()
							},
							function(){
								$('.langList.from').hide()
							}
						)
						$('.langList.from').hover(function(){
							
							},
							function(){
								//$('.from_lang').trigger('click');
							}
						)
						$('.langList.from .langItem').click(function(){
							var _clickObj = $(this);
							var _name = _clickObj.html();
							var _lang = _clickObj.attr('dataId');
							//$('.from_lang').trigger('click');
							$('.langList.from').hide()
							$('.from_lang .lang_op').html('FROM: '+_name).attr('dataId',_lang);
							var newLangSector = $('[dataId='+_lang+']','#gt-text-source .lang-option');
							
							$('#gt-text-source .lang-inline-block.selected').removeClass('selected');
							if(typeof(newLangSector.get(0))!='undefined'){
								newLangSector.addClass('selected');
							}
							else{
								var _listLength = $('#gt-text-source .lang-option .lang-inline-block').length;
								if(_listLength >=0){
									$('.lang-inline-block:lt('+(_listLength - 0)+')','#gt-text-source .lang-option').remove()
								}
								$('#gt-text-source .lang-option').append('<div class="lang-inline-block selected" dataId="'+_lang+'" >'+_name+'</div>');
							}
						})

						$('.to_lang').toggle(function(){
								$('.langList.to').show()
							},
							function(){
								$('.langList.to').hide()
							}
						)
						$('.langList.to').hover(function(){
							
							},
							function(){
								//$('.to_lang').trigger('click');
							}
						)
						$('.langList.to .langItem').click(function(){
							var _clickObj = $(this);
							var _name = _clickObj.html();
							var _lang = _clickObj.attr('dataId');
							//$('.from_lang').trigger('click');
							$('.langList.to').hide()
							$('.to_lang .lang_op').html('TO: '+_name).attr('dataId',_lang);
							var newLangSector = $('[dataId='+_lang+']','#gt-text-target .lang-option');
							$('#gt-text-target .lang-inline-block.selected').removeClass('selected');
							if(typeof(newLangSector.get(0))!='undefined'){
								newLangSector.addClass('selected');
							}
							else{
								var _listLength = $('#gt-text-target .lang-option .lang-inline-block').length;
								if(_listLength >=0){
									$('.lang-inline-block:lt('+(_listLength - 0)+')','#gt-text-target .lang-option').remove()
								}
								
								$('#gt-text-target .lang-option').append('<div class="lang-inline-block selected" dataId="'+_lang+'" >'+_name+'</div>');
							}
						})
						//do translate
						$('#gt-submit').click(function(){
							var _q = $('#source-textarea').val();
							var _from = $('.lang-inline-block.selected','#gt-text-source').attr('dataId');
							var _to = $('.lang-inline-block.selected','#gt-text-target').attr('dataId');
							if(_q == '' ){
								alert('The word can not be empty.');
								return;
							}
							$.get('<?php echo base_url('classroom/translate');?>',{q:_q,from:_from,to:_to},function(result){
								if (String == result.constructor) {      
									eval ('var result = ' + result);
								}
								if (result.error) {
									alert(result.error);
								} else {
									if (typeof(result.rows.translations[0].detectedSourceLanguage)!='undefined') {
										 $('.langItem[dataId='+result.rows.translations[0].detectedSourceLanguage+']','.langList.from').trigger('click');
									}
									$('#target-textarea').val(result.rows.translations[0].translatedText);
								}
							})
						})

						$('#transFrom2to.ico_trans').click(function(){
							var _from = $('.from_lang .lang_op').attr('dataId');
							var _to = $('.to_lang .lang_op').attr('dataId');
							 $('.langItem[dataId='+_from+']','.langList.to').trigger('click');
							 $('.langItem[dataId='+_to+']','.langList.from').trigger('click');
						})
					})
					</script>
					<!--for translate script end-->
				</div>
				
				<div class="TabbedPanelsContent blu-bgexpnd" id="tab-6">
					<div id="search_dict" class="search_type">
						<div class="blubg-inr">
							<div class="bludv-cnt">
								<div class="Room_sear_wp">
									<form onsubmit="$('#gd-submit-dict').click();return false;">
										<input type="text"   class="Room_search_ipt" placeholder="<?php echo $vsearchdictionary; ?>" id="dictFrom"/>
										<span class="leaveRoom2 Btn-blue"><a id="gd-submit-dict" class=" Btn Btn_blue w66" href="javascript:void(0)"><?php echo $vdefine; ?></a></span>
									</form>
								</div>
							</div>
						</div>
						<div class="whitdv-cnt">
							<div id="Room_sear_result_dict" class="srch-result"></div>
						</div>
					</div>
					
					<!--for dict script-->
					<script type="text/javascript">
					$(function(){
						$('#gd-submit-dict').click(function(){
							var _q = $('#dictFrom').val();
							if (_q == '') {
								alert('Enter a word to define.');
								return;
							}
							$.getJSON('https://api.pearson.com/v2/dictionaries/entries?headword='+_q,function(result){
								if (String == result.constructor) {
									eval ('var s = ' + result);
								} else {
									var s = result;
								}
								var _html ="";
								_html ="<b>Word: </b>"+_q;
								if (s.results.length == 0) {
									_html += '<div>';
									_html ="<b>Word: </b>"+_q +" not found in the dictionary.";
									_html += '</div>';
									$('#Room_sear_result_dict').html(_html);
								}
								
								for (var i = 0;  i < 100; i++) {
									if (s.results[i]['senses'][0]['definition']!=undefined) {
										_html += '<div>';
										_html += '<ul type="square"><img src="../../../../images/bullet_black.png" alt="Smiley face" > <span>'+s.results[i]['senses'][0]['definition']+'</span></li></ul>';
										_html += '</div>';
									}
									$('#Room_sear_result_dict').html(_html);
								}
							});
						});
					});
					</script>
					<!--for dict script end-->
				</div>
				
				<div class="TabbedPanelsContent blu-bgexpnd" id="tab-7">
					<div class="search_type">
						<div class="blubg-inr">
							<div class="bludv-cnt">
								<div class="Room_sear_wp">
									<form onsubmit="$('#gd-submit-feed').click();return false;">
										<input type="text" name="country" id="country" class="Room_search_ipt" placeholder="<?php echo $vsearchnews; ?>"  />
										<span class="leaveRoom2 Btn-blue"><a id="gd-submit-feed" class=" Btn Btn_blue w66" href="javascript:void(0)"><?php echo $vgetnews; ?></a></span>
									</form>
								</div>
							</div>
						</div>
						<div class="whitdv-cnt">
							<div id="Room_sear_result_feed"></div>
						</div>
					</div>
				</div>
				
				<!-- Test Scenario Widget Start-->
				<div class="TabbedPanelsContent test-scenarios" id="tab-8">
					<p class="">
						<span class="">Language</span>
						<select name="lang" id="lang"  onchange="searchscenario();">
							<option value="3">English</option>
							<option value="1">CN Simplified</option>
							<option value="2">CN Traditional</option>
							<option value="5">Japanese</option>
							<option value="6">Korean</option>
							<option value="7">Portuguese</option>
							<option value="8">Spanish</option>
							<option value="4">French</option>
						</select> 
						<span style="margin-left:50px;">Categories</span>
						<select name="categories" id="categories" onchange="searchscenario();">
							<!--<option value="sel"> Select</option>-->
							<?php for($i=0;$i<count($cat);$i++) {?>
								<option value="<?php echo $cat[$i]['guide_categories_id'];?>">
									<?php echo $cat[$i]['name']?></option>
							<?php }?>
						</select>
						<div id="dynamictest">
							<ul id="testscn">
								<?php
								if (count($testScenario)>0) {
									for($i=0;$i<count($testScenario);$i++){
										$pdf = base_url('uploads');
										$pdfurl = $pdf.'/testscenario/'.$testScenario[$i]['pfile'];?>
										<li><a target='_blank' href="<?php echo $pdfurl; ?>"><?php echo $testScenario[$i]['Title']?></a></li>
										<p><?php echo $testScenario[$i]['Description']?></p>
								<?php }
								}?>
							</ul>
						</div>
				</div>
				<!-- Test Scenario Widget end-->
			</div>
		</div>
	</div>
</div>
<div id="jquery_jplayer_1" class="jp-jplayer"></div>
<script type="text/javascript">
function searchscenario()
{
	var lang=$('#lang').val();
	var cat=$('#categories').val();
	var pattern ='lang='+lang + "&cat="+cat;
	$.ajax({
		type:'POST',
		dataType: 'html',
		url:'<?php echo base_url('testveesession/getDynamicscenario');?>',
		data:pattern,
		success:function(msg){
			if (String == msg.constructor) {
				var result;
				eval('result = ' + msg);
			} else {
				var result = msg;
			}
			$('#dynamictest').empty();

			if (result.length > 0) {	
				for (var i = 0;  i < (result.length); i++)
				{
					var title=result[i]['Title'];
					var file=result[i]['pfile'];
					var pdf="<?php echo base_url('uploads');?>";
					var link=pdf+"/testscenario/"+file; 
					var disc=result[i]['Description'];
					$("#dynamictest").append('<ul><li><a target="_blank" href='+link+'>'+title+'</a></li><p>'+disc+'</p></ul>'); 
				}
			} else {
				$("#dynamictest").append('<ul>no record found</ul>');
			}
		} 
	});
}
</script>
<script type="text/javascript">
$(function(){
	
	$('#dismissforever').click(function(){
		
		var pattern ='uid='+uid;
		$('#basicDemo').hide();
		$.ajax({
			type:'POST',
			dataType: 'html',
			url:'<?php echo base_url('classroom/updatedismiss');?>',
			data:pattern,
			success:function(msg){
				
			} 
		});
	});
	
	//$('#Room_sear_result_feed').css('overflow-y','auto');
	$('#gd-submit-feed').click(function(){
		var _q = $('#country').val();
		if (_q == '') {
			alert('Enter Search Word');
			return;
		}
		var _data = {};
		_data["country"] = _q;
		$(this).attr('buttonType','doing');
		
		$.ajax({
			url: "<?php echo base_url("classroom/getnewsfeed");?>",
			type: 'GET',
			data: _data,
			dataType: 'html',
			cache: false,
			success: function (msg){
				if (String == msg.constructor) {
					var result;
					eval('result = ' + msg);
				} else {
					var result = msg;
				}
				
				$('#gd-submit-feed').attr('buttonType','done');
				var _html = result.html;
				var noScrol = 0;
				if (_html == '') {
					_html = '<div style="margin:20px;font-weight: bold;font-size: 16px;" >No Records Found</div>';
					noScrol = 1;
				}
				
				$('#Room_sear_result_feed').html('<ul><li>'+_html+'</ul></li>');
				if (_html.len < 0) {
					//$('#Room_sear_result_feed').css('overflow-y','auto');
				} else {
					//$('#Room_sear_result_feed').css('overflow-y','scroll');
				}
				
				if (noScrol == 1) {
					//$('#Room_sear_result_feed').css('overflow-y','auto');
				}
			}
		});
	});

	//upload document function
	var button1 = $('#profile_vedio_upload_true_test'), interval1;
	s = new AjaxUpload(button1,{
		action: '<?php echo Base_url('user/upload_vee_chat_document');?>', 
		enable:true,
		name: 'userfile',
		onSubmit : function(file, ext){
			if (typeof(this._input.files) != 'undefined') {
				if (typeof(this._input.files[0])!='undefined' && typeof(this._input.files[0].size)!='undefined' && this._input.files[0].size != '') {
					if (this._input.files[0].size > 20971520) {
						alert('Filesize too large, please use a video less than 20mb. Converting to MP4 can reduce filesize considerably.');
						return false;
					}
				}
			}
			
			if (ext == 'jpg'|| ext == 'jpef' || ext == 'png'|| ext == 'gif'|| ext == 'bmp'|| ext == 'txt'|| ext == 'xls'|| ext == 'rtf' || ext == 'doc') {
				
			} else {
				$( "#dialog p").html('The file can not be supported.');
				$( "#dialog" ).dialog({
					modal: true
				});
				return false;
			}		
			// change button text, when user selects file
			$( "#dialog p").html('Uploading.');
			$( "#dialog" ).dialog({
				modal: true
			});
			this.disable();
			interval1 = window.setInterval(function(){
				var text = $( "#dialog p").html();
				if (text.length < 13) {
					$( "#dialog p").html(text + '.');
				} else {
					$( "#dialog p").html('Uploading');				
				}
			}, 200);
		},
		onComplete: function(file, response){
			$( "#dialog p").html('Uploaded');
			$( "#dialog").dialog('close');
			window.clearInterval(interval1);
			this.enable();
			//response = JSON.parse(response);
			if (String == response.constructor) {
				eval ('var jsonres = ' + response);
			} else {
				var jsonres = response;
			}
			
			if (jsonres.filetype == 'image') {
				var link = jsonres.source;
				var onclick = "showImage('"+jsonres.source+"','','450',this)";
				var html = '<a class="hdshareimg" target="_blank" title="Share Image" onclick="'+onclick+'" ><img src="'+link+'" alt="image" /></a>';
				var pic = '<?php echo $user["pic"]; ?>';
				$.post('<?php echo base_url('classroom/chatSend');?>',{msg:html,classId:cid},function(msg){
					if (String == msg.constructor) {
						eval ('var json = ' + msg);
					} else {
						var json = msg;
					}
					
					if (json.error) {
						alert(json.msg);
					}
				});
				document.getElementById('hidden_documents').innerHTML = html;
			} else {
				var link = jsonres.source;
				var html = '<a class="hdshareimg" target="_blank" href="'+link+'" ><img src="<?php echo Base_url('images/document.jpg'); ?>" alt="document" /></a>';
				var pic = '<?php echo $user["pic"]; ?>';
				$.post('<?php echo base_url('classroom/chatSend');?>',{msg:html,classId:cid},function(msg){
					if (String == msg.constructor) {
						eval ('var json = ' + msg);
					} else {
						var json = msg;
					}
					if (json.error) {
						alert(json.msg);
					}
				});
				document.getElementById('hidden_doc').innerHTML = html;
			}
		}
	});
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	$('ul.TabbedPanelsTabGroup li').click(function(){
		var tab_id = $(this).attr('data-tab');
		$('ul.TabbedPanelsTabGroup li').removeClass('current');
		$('.TabbedPanelsContent').removeClass('current');
		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	});
});
</script>
<input type="hidden" name="sa" id="sa" value="2">
<div class="spc20"></div>
<div id="hidden_document" style="display:none;">
	<div id="hidden_documents"></div>
	<div id="hidden_doc" ></div>
</div>
<style type="text/css">
#hiddenshare img {max-height:82px;}
.Room_feed a img {max-height:82px;}
.hdshareimg img{max-height:82px;}
.OT_publisher .OT_edge-bar-item.OT_mode-on, .OT_subscriber .OT_edge-bar-item.OT_mode-on, .OT_publisher .OT_edge-bar-item.OT_mode-auto.OT_mode-on-hold, .OT_subscriber .OT_edge-bar-item.OT_mode-auto.OT_mode-on-hold, .OT_publisher:hover .OT_edge-bar-item.OT_mode-auto, .OT_subscriber:hover .OT_edge-bar-item.OT_mode-auto, .OT_publisher:hover .OT_edge-bar-item.OT_mode-mini-auto, .OT_subscriber:hover .OT_edge-bar-item.OT_mode-mini-auto {
opacity: 0 !important;
top: 0;
cursor:default !important;
</style>
<?php  if($checkdismiss->dismissforever == 0){ ?>
<li id="open" class="basicDemo_open"></li>
<div  id="basicDemo" class="popUpDiv" style="opacity: 0.6 !important; height:310px; width: 500px;"/> 
	<img src="<?php echo base_url('images/OverlayGraphic2.png');?>" width="620px;">
	<div style='color:#FFF;margin-top:-145px;margin-left:470px;cursor:pointer;width:200px;' id='dismissforever'>Dismiss Forever</div>
 <br />    
    <a class="popup-close basicDemo_close" style="text-decoration:none" data-popup-close="popup-1" href="">x</a>
</div>
<div id="basicDemo_background" class="popup_background" style="background-color: none !important;"></div>
<?php } ?>
 <style>
.help-tip{
position: absolute;
top: 600px;
right: 200px;
text-align: center;
background-color: #BCDBEA;
border-radius: 50%;
width: 24px;
height: 24px;
font-size: 14px;
line-height: 26px;
cursor: default;
}

.help-tip:before{
content:'?';
font-weight: bold;
color:#fff;
}

.help-tip:hover p{
display:block;
transform-origin: 100% 0%;

-webkit-animation: fadeIn 0.3s ease-in-out;
animation: fadeIn 0.3s ease-in-out;

}

.help-tip p{
display: none;
text-align: left;
background-color: #1E2021;
padding: 20px;
width: 300px;
position: absolute;
border-radius: 3px;
box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.2);
right: -4px;
color: #FFF;
font-size: 13px;
line-height: 1.4;
}

.help-tip p:before{
position: absolute;
content: '';
width:0;
height: 0;
border:6px solid transparent;
border-bottom-color:#1E2021;
right:10px;
top:-12px;
}

.help-tip p:after{
width:100%;
height:40px;
content:'';
position: absolute;
top:-40px;
left:0;
}

</style>

</body>
</html>
<script type="text/javascript">
$(window).load(function () {
	if (_startTime > 0) {
		//addMsg("Session will start soon. When both parties arrive, feel free to chat while you wait for the timer to countdown.");
		<?php
		$arrVal			= $this->lookup_model->getValue('1388', $multi_lang);
		$defaultChatMsg = $arrVal[$multi_lang]; 
		// During your pre-session time, say hello and ensure that your camera, mic, text are working
		?>
		addMsg("<?php echo $defaultChatMsg;?>"); // Set Default Chat Msg
	}
	
	if (user.type == 't') {
		_tutorConnected = 1;
		$.post('<?php echo base_url('classroom/updateClassAction');?>',{tutorConnected:_tutorConnected,classId:cid});
	}
	if (user.type == 's') {
		_studentConnected = 1;
		$.post('<?php echo base_url('classroom/updateClassAction');?>',{studentConnected:_studentConnected,classId:cid});
	}
});
_tutorConnected =12;
</script>
<script type="text/javascript">
$(document).ready(function(){
	<?php  if($checkdismiss->dismissforever == 0){ ?>
		$('#basicDemo').popup();
	<?php } ?>
	$("#categories option:first").attr("selected","selected");
	searchscenario();	
});

// Apply all condition related to Start Time
function startTimeConditions()
{
	var objdate = new Date;
	var unixtime = parseInt(objdate.getTime() / 1000);
	var unixtime_to_date = new Date(unixtime*1000);
	var _startTime = _currentTime - unixtime;
	
	if (_startTime == -240) {
		
		// IF STUDENT NOT PRESENT TILL 4 MIN
		if (user.type =='t' && _studentConnected == 0) {
			//-- commented on 03-11-2015
			$('.send_chat_ipt').val("Session Approved. Your student did not join this Vee-session in the allotted time. You may leave and if this was a paid session, your account will be credited for this session.");
			jQuery('#chatSend').trigger('click');
			var _data = {};
			_data['cid'] = cid;
			$.post('<?php echo base_url('classroom/attend');?>',_data);
		}
	}
	
	// checks for on 6 minute period if tutor does not entered. 
	if (_startTime < -480) {
		if (user.type == 't' && _studentConnected == 0) {
			/*alert('It seems that you have arrived late to your session which is now locked. Please send a Beepbox message to your conversation partner and try to schedule another session.');
			window.location.href="<?php echo base_url().'user/calendar' ?>";*/
		}
		
		if(user.type == 's' && _tutorConnected == 0) {
			//alert('It seems that you have arrived late to your session which is now locked. Please send a Beepbox message to your conversation partner and try to schedule another session.');
			//window.location.href="<?php echo base_url().'user/calendar' ?>";
		}
	}
	//alert(_startTime);
	if (_startTime <= -1500 && _startTime >= -1510) {
		playVeeSessionEndsound();
		//playSound();
		$('.send_chat_ipt').val('Vee-session ended.');
		jQuery('#chatSend').trigger('click');
	}
	
	if (_startTime < -1500) {
		playSound();
		$(".info").text("Vee-session ENDED.");
		$(".start").text("");
		feedbacked = false;
		
		if (typeof(session) != 'undefined') {
			if (_startTime < -1800) {
				feedBack();
				session.disconnect();
			}
		}
	}

	if (_startTime == -1790) {
		$('.send_chat_ipt').val('Bye Bye.');
		jQuery('#chatSend').trigger('click');
	}
}

// Check Both Party Status
function chkBothPartyStatus()
{
	var res;
	$.ajax({
		type:'POST',
		url: '<?php echo base_url(); ?>classroom/getConnectedStatus',
		data: {'cid':cid},
		dataType: "json",
		success: function(res){
			if (res.studentConnected == '1') {
				_studentConnected = 1;
			}
			if (res.tutorConnected == '1') {
				_tutorConnected = 1;
			}
		}
	});
	
	if (_tutorConnected == 1) {
		if (!initStatus) {
			connect();
			initStatus = true;
		}
	}
	
	if (_studentConnected == 1 && _tutorConnected == 1) {
		_subConnected = 1;
		_pubConnected = 1;
	}
	
	// Apply all condition related to Start Time
	startTimeConditions();
}
setInterval(chkBothPartyStatus,10000);
</script>