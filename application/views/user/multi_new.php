<!DOCTYPE html>
<html>
<head>
<title>TheTalkList - Your Social e-Learning Network</title>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex,nofollow">

<script type="text/javascript">
	//<![CDATA[
	//jQuery(document).ready(function(){
		//jQuery.noConflict();
		
	//});
	//]]>
</script>
<script src="http://static.opentok.com/webrtc/v2.4/js/opentok.min.js"></script> 
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/testvs/html5reset-1.6.1.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/testvs/tools.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/classroom-new.css');?>">
<style>
	#Room_player1{width:160px;height:90px;border:1px solid;}
	#audio_div{padding-left: 10px;padding-top: 150px; }
</style>
<script type="text/javascript" src="<?php echo base_url('js/jquery.1.7.2.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery-jtemplates.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/jquery.placeholder.js');?>"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.17/jquery-ui.min.js"></script>
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('js/audioPlayer/jquery.jplayer.min.js');?>"></script>

<!-- auto logout after 2 hours -->
<script>
var timer = 0;
function set_interval() 
{ 
  // the interval 'timer' is set as soon as the page loads
	timer = setInterval("auto_logout()", 
	72000000);
  // the figure '10000' above indicates how many milliseconds the timer be set to.
  // Eg: to set it to 5 mins, calculate 5min = 5x60 = 300 sec = 300,000 millisec.
  // So set it to 300000
}

function reset_interval() 
{
  if (timer != 0) 
  {
		clearInterval(timer);
		timer = 0;
		timer = setInterval("auto_logout()", 10000);
  }
}

function auto_logout() 
{
 
	window.location.href = '<?php echo base_url('user/slogout');?>';
}
</script>

<!--end code -->
<script type="text/javascript">
//<![CDATA[
		jQuery(document).ready(function(){ 
			jQuery.noConflict();
			jQuery("#jquery_jplayer_1").jPlayer({
					ready: function () {
						//alert('ready');
						jQuery("#jquery_jplayer_1").jPlayer("setMedia", {
					//	m4a: "http://www.jplayer.org/audio/m4a/Miaow-07-Bubble.m4a",
						//oga: "http://www.jplayer.org/audio/ogg/Miaow-07-Bubble.ogg",
						}).jPlayer("play");
					},
					swfPath: "<?php echo base_url('js/audioPlayer/Jplayer.swf');?>",
					supplied: "mp3",
					//supplied: "m4a,oga",
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
	var soundfile = "<?php echo base_url('css/audioPlayer/VeeSessionEnd.wav');?>";
	var soudHTML = "<embed src=\""+soundfile+"\" hidden=\"true\" autostart=\"true\" loop=\"false\" />";
	$("#soundplayeach").html(soudHTML); 
}
</script>
<link rel="stylesheet"  href='<?php echo base_url('css/fileuploader.css');?>'  type="text/css" />
<script  src='<?php echo base_url('js/ajaxupload.3.6.js');?>'  type="text/javascript" ></script>
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
$arrVal 	= $this->lookup_model->getValue('1009', $multi_lang);
$theveesession	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('988', $multi_lang);
$confirm	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1010', $multi_lang);
$comforttutor	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1011', $multi_lang);
$comfortstudent	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('719', $multi_lang);
$vupload	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1012', $multi_lang);
$hasgone	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1013', $multi_lang);
$willstartafter	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('390', $multi_lang);
$vsearch	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('1025', $multi_lang);
$Shareit	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('1056', $multi_lang);
$suretoleave	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1110', $multi_lang);
$DragDrop	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('429', $multi_lang);
$Submit	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1111', $multi_lang);
$RateTechnical	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1112', $multi_lang);
$RatTutor	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1113', $multi_lang);
$ReportImport	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1114', $multi_lang);
$WriteComm	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1115', $multi_lang);
$SubmitedThnak	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1117', $multi_lang);
$PleaseRateyour	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1130', $multi_lang);
$TestScenario = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1215', $multi_lang);
$VeeSessionEnd = $arrVal[$multi_lang];
?>
<script type="text/javascript">
$(window).load(function() {
	 
		 $.post('<?php echo base_url('multi/checkisSent');?>',{classId:cid},function(msg){
			if (String == msg.constructor)
					{
						var result;
						eval('result = ' + msg);
					} else {
						var result = msg;
					}
					if(result.success==true || result.success=='true')
					{
						addMsg("Session will start soon.Feel free to chat while you wait for the timer to countdown.");
						jQuery('#chatSend').trigger('click');
					}
		 })
	});
</script>
<script type="text/javascript">
	
	var apiKey = '<?php echo $apiKey;?>';
    var sessionId = '<?php echo $sessionId;?>';
    var token = '<?php echo $token;?>';
	var _startTime = <?php echo $_startTime;?>;
	var _currentTime = <?php echo $_startTime;?>;
	var _endTime = <?php echo $_endTime;?>;
	var uid = '<?php echo $uid;?>';
	var cid = '<?php echo $cid;?>';
	var feedbacked = '<?php echo $feedback;?>';
	var user = <?php echo json_encode($user);?>;
	var _setintval = '';
	var initStatus = false;
	var _getedTime = 0;
	var getChatJqr = '';
	var getChatSetintval = '';
	var roleId = <?php echo $this->session->userdata('roleId'); ?>;
	var jp = jQuery("#jquery_jplayer_1");
	var profileImgNull = '<?php echo base_url()."images/base/hd-pic.png"; ?>';
	var _subConnected = 0;
	var _pubConnected = 0;
	var _sessionStarted = 0;
	var _clockDisplay = 0;
	var _studentConnected = 0;		
	var _tutorConnected=0;
	var studentConnected=0;
	//alert(_startTime);
	<?php if(@$action['SID3Connected']): ?>
	var _SID3Connected = <?php echo $action['SID3Connected']; ?>;
	<?php else: ?>
	var _SID3Connected = 0;
	<?php endif; ?>
	<?php if(@$action['SID2Connected']): ?>
	var _SID2Connected = <?php echo $action['SID2Connected']; ?>;
	<?php else: ?>
	var _SID2Connected = 0;
	<?php endif; ?>
	<?php if(@$action['SID1Connected']): ?>
	var _SID1Connected = <?php echo $action['SID1Connected']; ?>;
	<?php else: ?>
	var _SID1Connected = 0;
	<?php endif; ?>
	window.atmpt = 0;
	window.isCanceled  = false;
	var timthumbUrl = '<?php echo base_url()."timthumb.php?src=";?>';
	var isFirst='<?php echo $isFirst;?>';
	var statTimer;
	var isPirmary=<?php echo $isPrimary; ?> 
	 
	$(window).load(function () {
		 
			if(user.type == 's')
			{
				_stuconnected = 1;
				$.post('<?php echo base_url('multi/updateClassAction');?>',{studentconnected:_stuconnected,classId:cid},function(msg){})
			}
			if(user.type == 't')
			{
				_tutorconnected = 1;
				$.post('<?php echo base_url('multi/updateClassAction');?>',{tutorconnected:_tutorconnected,classId:cid},function(msg){})
				//location.reload();
			}
			 if(user.type == 't')
			{
				
				$('#cnuser').show();
				getStTtConnectedStatus();
			}
	});
	 function getStTtConnectedStatus()
	{ 
		var foo = new Date;
		var unixtime = parseInt(foo.getTime() / 1000);
		var unixtime_to_date = new Date(unixtime*1000);
		var _startTime = _currentTime - unixtime;
		 
		if(_startTime <= -1)
		{
			var res;
			var dataStringinbAj3 = '';
			dataStringinbAj3 +='cid='+cid ;
			var pUrl = '<?php echo base_url(); ?>multi/GetconnectedUser';
			$.ajax({
				type:'POST',
				async:false,
				url: pUrl,
				data: dataStringinbAj3,
				success: function(msg){       
					if (String == msg.constructor)
					{
						var result;
						eval('result = ' + msg);
					} else {
						var result = msg;
					}
					 $('.onlineusr_listing').empty();
					$(".onlineusr_listing").append('<h2>Online Users</h2>');
					for (var i = 0;  i < (result.length); i++)
					{
					 
					var a ="<?php echo base_url('/uploads/images/thumb/');?>";
					var dimage="<?php echo base_url('images/header.jpg');?>";
					var uid=result[i]['uid'];
					var img;
					var name=result[i]['fname'];
					if(result[i]['pic']=='')
					{
					  img=dimage;
					}
					else
					{
					img=a+"/"+result[i]['pic'];
					}
					var user="javascript:void(0)" ;
					$(".onlineusr_listing").append('<ul><li><span><img  src='+img+'></span><p>'+name+'</p></li></ul>');
					
					}
				}
			});
		}
		statTimer = setTimeout('getStTtConnectedStatus()',10000);
	 }
	 function getChat(){
	 
		if(_endTime < -300){
			clearInterval(getChatSetintval);
		}
		if(_endTime == 10)
		{
			_clockDisplay = 1;
		}
		if(_endTime == 1)
		{
			$('#fancyClock').css('display','none');
			$('#Room_player1').css('top','62px');
			_clockDisplay = 0;
		}
		if(typeof(getChatJqr.readyState)!='undefined' && getChatJqr.readyState != 4)
		{
			return;
		}
		 getChatJqr = $.get('<?php echo base_url('multi/chatGet');?>',{classId:cid,time:_getedTime,t:Math.random(),tid:isPirmary},function(result){
		 if (String == result.constructor) 
			{
				eval ('var result = ' + result);
			}
			if(result.checkPrimary == 'true' || result.checkPrimary == true)
			{
				alert('Admin has changed Primary tutor for this session. You will be able to see video of a new tutor in few seconds.');
				location.reload();
			}  
			if(result.checkConnected == 'true' || result.checkConnected == 'true')
			{
				  if(user.type == 's')
				{
					setTimeout(function(){
								 location.reload();
							},8000);
				}
				
			}
			if(result.error == 1)
			{
				alert(result.msg);
				if(result.msg.toLowerCase().indexOf('must login first') > -1)
				{
					clearInterval(getChatSetintval);
					document.location.href="<?php echo base_url('user/login');?>";
				}
			}
			else 
			{
				if(typeof(result.isCanceled)!='undefined' && result.isCanceled)
				{
					window.isCanceled = true;
				}
				if(typeof(result.rows)!='undefined') 
				{
					$.each(result.rows,function(k,v){
					 $("#vuID").val(v.uid);
						if(v.uid != uid){
							if(user.type == 's' ){
								_type = 't';
							}
							else {
								_type = 's';
							}
					 	}
						else{
							_type = user.type;
						}
						var _img = v.pic;
						var uname=v.firstName+v.uid;
						addMsg(v.msg,_type,_img,uname);
						_getedTime = v.time;
						
						if(v.uid != uid){
							//alert('hi');
							jpplay();
						}
						
						var usermsg = v.msg;
						var indx = usermsg.indexOf("redeposited"); 
						if(indx > 0)
						{
							if(_type == 't')
							{
							}
						}
						
					})
				}
			}
		})
	}
	function formatMinute(seconds){
		//console.info(seconds);
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
 $(document).ready(function(){
		$(document).click(function()
		{
				$(".langList.from").hide();
				$(".langList.to").hide();
		});
		if(cid)
		{
			getChatSetintval = setInterval(getChat,1000);
		}
		getChat();
		 $('.leaveVee').click(function()
		 {
			 if(_endTime > 0 && typeof(user.type)!='undefined' && user.type=='s' && !feedbacked &&!window.isCanceled ){
				 $('#dialog3').dialog({
					modal:true,
					buttons: {
						"Yes": function() {
							$('#dialog3').dialog('close');
							_studentConnected = 0;							
							<?php $a=$this->session->userdata['uid'];
					     	$arg="Join";
						?>
						window.atmpt = 1;	
							 	
							setTimeout(function(){
								document.location.href='<?php echo Base_url('user/dashboard');?>';
							},200);							
						},
						'No': function() {
							 
							$('#dialog3').dialog('close');
							_studentConnected = 0;							
							<?php $a=$this->session->userdata['uid'];
					     	$arg="Join";
						?>
						 if(_endTime > 1210 && _tutorConnected == 1){
							var _data = {};
								_data['cid'] = cid;
								
							}else{
							var _data = {};
								_data['cid'] = cid;
								
							}
							$('#chatSend').trigger('click');
							 

							 /* remove user from session  */
							 $.post('<?php echo base_url("multi/removestu");?>',{groupid:cid},function(result){
								});
								 
							/*end code  */
							
							window.atmpt = 1;
							jQuery('#chatSend').trigger('click');
							 setTimeout(function(){
								document.location.href='<?php echo Base_url('user/dashboard');?>';
								
							},200); 
							
							 },
						'Cancel': function() {
							$('#dialog3').dialog('close');
						}
					}
				});
			}
			else if(_endTime > 0 && typeof(user.type)!='undefined' && user.type=='t'){
				$('#dialog3').dialog({
					modal:true,
					buttons: {
						"Yes": function() {
						<?php $a=$this->session->userdata['uid'];
					     	$arg="Join";
						?> $('.send_chat_ipt').val('tutor has temporarily left and will be right back…');
						 
							jQuery('#chatSend').trigger('click');
						 
							setTimeout(function(){
								document.location.href='<?php echo Base_url('user/dashboard');?>';
							},200);							
						},
						'No': function() {
						
					
							<?php $a=$this->session->userdata['uid'];
					     	$arg="Join";
						?>if(_endTime >= 60 && _endTime < 1140)
							{
						 
								 document.location.href='<?php echo Base_url('user/dashboard/');?>';
								
							}
							window.atmpt = 1;
							setTimeout(function(){
								document.location.href='<?php echo Base_url('user/dashboard/');?>';
							},200);
						},
						'Cancel': function() {
							$('#dialog3').dialog('close');
						}
					}
				});
			} 
			else{
			
			if(isFirst == "newtutor")
					{
						 
						<?php echo $this->session->set_userdata('Iscompleted','yes');?>
					}
					else
					{
						 
						<?php echo $this->session->set_userdata('Iscompleted','no');?>
					}
				if(window.confirm('<?php echo $suretoleave;?>')){
					if(user.type =='s')
					{	feedbacked=false;
						feedBack();
					}else
					{
						var a="<?php echo Base_url('user/dashboard');?>";
						document.location.href=a;
					}
				}
			}
		})

		$('.stars a').hover(function(){
			var _aObj = $(this);
			var _star = _aObj.parent('.stars');
			var _index = _aObj.index() +1;
			 setStars(_star,_index);
		})

		$('#rateButton').click(function(){
		var _data = {};
			$('.stars .on:last','.ratelist').each(function(){
				var _obj = $(this);
				//console.info(_obj.parent('.stars').attr('id'));
				_data[_obj.parent('.stars').attr('id')] = _obj.html();
			});
			_data['sendToAdmin'] = $('#sendToAdmin:checked').get(0)?1:0;
			_data['cid'] = cid;
			_data['msg'] = $('#msg').val();
			 
			$.post('<?php echo base_url("multi/feedback");?>',_data,function(result){
				if (String == result.constructor) {      
					eval ('var result = ' + result);
				}
				if(typeof(result.error) == 'undefined'){
					alert('Error..');
					return;
				}
				else if( result.error){
					alert(result.msg);
					return;
				}
				else{ 
					feedbacked = true;
					$('#dialog1').dialog('close');
					alert("<?php echo $SubmitedThnak;?>");
					$.post('<?php echo base_url("multi/UpdateGroup");?>',_data,function(result){
					})
					if(isFirst == 'none')
					{
						
						document.location.href='<?php echo Base_url('user/dashboard');?>';
						 
					}
					else if(isFirst == 'nestu')
					{
						<?php echo $this->session->set_userdata('isGroup','yes');?>
						document.location.href='<?php echo Base_url('user/account?first=yes');?>';
						 
					}
					else if(isFirst == 'newtutor')
					{
						<?php echo $this->session->set_userdata('Iscompleted','yes');?>
						document.location.href='<?php echo Base_url('user/dashboard?first=yes');?>';
						 
					}
					else{document.location.href='<?php echo Base_url('user/dashboard');?>';}
					 
				}
			})
		})
		if(uid == ''){
			addMsg('You must login first.');
			setTimeout(function(){
				document.location.href="<?php echo base_url('user/login');?>";
			},3000)
			return;
		}
		if(sessionId == ''){
			addMsg('Waiting for tutor to connect...');
			return;
		}
		_setintval = setInterval(checkStatus,1000);
		$('.Room_wrap.posR .spc50 .info').html('<?php echo "The free group Vee-session "; ?>');
		//console.info(_setintval);
	})
	function sendAction(msg)
	{
		 
		$.post('<?php echo base_url('multi/chatSend');?>',{msg:$('.send_chat_ipt').val(),classId:cid},function(msg){
			
		 
			
			if (String == msg.constructor) {
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}
			if(json.error){
				alert(json.msg);
			}
		})
	}
	function setStars(starObj,number){
		$('a',starObj).removeClass('off').removeClass('on').addClass('off');
		$('a:lt('+number+')',starObj).removeClass('off').addClass('on');
	}
	var showWithOutPay = false;
	if(_startTime < -300){
		showWithOutPay = true;
	}
	function checkStatus(){
	 
	 /*
		var foo = new Date;
	 
		var unixtime = parseInt(foo.getTime() / 1000);
		var unixtime_to_date = new Date(unixtime*1000);
		var _startTime = _currentTime - unixtime;
		*/
		_startTime--;
		
		if(_startTime > 0){
			$('.Room_wrap.posR .spc50 .start').html('  <?php echo $willstartafter; ?> '+formatMinute(_startTime)+' sec.');
		 }
		else{
			if(!initStatus){
				 connect();
				 if(user.type=='t')
				 {
				 initStatus = true;}else{initStatus = false;}
			}
			$('.Room_wrap.posR .spc50 .start').html(' <?php echo $hasgone; ?> '+ (formatMinute(_startTime)) +' sec.');
			 if(_startTime <= -300 && _startTime >= -360 && showWithOutPay == false && (_SID1Connected == 1 || _SID2Connected == 1 || _SID3Connected)){
				showWithOutPay = true;
				$('#showWithOutPay').dialog({
					modal:true,
					buttons: {
						"Yes": function() {
							$( this ).dialog( "close" );
						},
						'No': function() {
						var sa = $('#sa').val();
							window.atmpt = 1;
							 setTimeout(function(){
								document.location.href= '<?php echo base_url('user/dashboard');?>';
								
							},2000);
							
						}
					}
				});
			}
		}
		
		if(_endTime>0){
			_endTime--;
	 
				if(_endTime == 60)
				{
					addMsg('The session has ' + _endTime + ' sec remaining.');
					if(_endTime == 10){
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
				  
		 }
		else{
			 if(typeof(session)!='undefined'){
				if(_startTime < -1800){session.disconnect();}
			}
			
		}
		if(_startTime < -1500)
		{ 
			 playVeeSessionEndsound();
			 //clearInterval(_setintval);
			 $(".info").text("<?php echo $VeeSessionEnd;?>");
			 $(".start").text("");
				if(_startTime == -1790)
		{
				addMsg('Bye Bye.');	
		} 
			
			feedbacked = true;
			if(typeof(session)!='undefined'){
				if(_startTime < -1800){session.disconnect();}
				 
			}
			_clockDisplay = 0;
		}
		 if(_SID1Connected == 1 && _SID2Connected == 1 && _SID3Connected == 1 )
		{
		 if(_startTime == -360 && ( _SID1Connected == 1 && _SID2Connected == 1 && _SID3Connected ==1 ))
			{
			if(sa!=2){
				var msgSess = 'Session Approved';
				if(cid !=''){
					$.post('<?php echo base_url('multi/chatSend');?>',{msg:msgSess,classId:cid},function(msg){
				 if (String == msg.constructor) {
							eval ('var json = ' + msg);
						} else {
							var json = msg;
						}
						if(json.error){
							alert(json.msg);
						}
					})
					
					var _data = {};
					_data['cid'] = cid;
					$.post('<?php echo base_url('multi/attend');?>',_data,function(msg){
					});
					
					
				}
				$('#showWithOutPay').dialog('close');
								
			}
		}
		}else{ 
			if(_startTime == -150)
			{
				if(user.type == 's' && _tutorConnected == 0)
				{ window.atmpt = 1;
				 }
				if(user.type == 't' && _studentConnected == 0)
				{
					 window.atmpt = 1;
				 }
			}
		}
		 
	 }
	
	function feedBack()
	{
		if(typeof(user.type)!='undefined' && user.type=='s' && !feedbacked) 
		{
			var _data = {};
				_data['cid'] = cid;
				 
				$('#dialog1').dialog({
						modal:true,
						width:'430px'
				});
		}
	}
	 
	function profileImgChatThumb(src)
	{
		 if(src=='' || src=="\'\'" || src=="&#39;&#39;")
		 {			
			 return profileImgNull;
		}
		 return src;
	}
	function addMsg(msg,imgClass,img,uname)
	{ 
		var my = $('#vuID').val();
		if(typeof(uname) =='undefined')
		{
			uname = '';
		}
	 if(typeof(imgClass) =='undefined'){
			imgClass = '';
		}
		if(typeof(img) =='undefined' || img == ''){
			img = '<?php echo Base_url('images/base/chat.png');?>';
		}
		if(msg =='Session Approved'){
			img = '<?php echo Base_url('images/base/chat.png');?>';
		}
		
		var isFound = (msg).search(/^(https:|http:)/i);
		  if(my != uid &&  isFound == 0)
		{ 
		var _str = '<li>';
		_str += '<span class="user_hdpic"><img src="'+profileImgChatThumb(img)+'" width="34" height="34" class="'+imgClass+'"/><span style="margin-top:0px;font-size:12px;";>'+uname+'</span></span>';
		_str += '<span class="Room_feed"><span class="cent-bg"><p>';
		_str += '<a href="'+msg+'" target="_blank">'+msg+'</a>';
		_str += '</p>'+uname+'</span><span class="botm-bg">&nbsp;</span>';
		_str+='</li>';
		}
		 if(my == uid &&  isFound == 0)
		{  
		var _str = '<li class="gary-row">';
		_str += '<span class="Room_feed"><span class="cent-bg"><p>';
		_str += '<a href="'+msg+'" target="_blank">'+msg+'</a>';
		_str += '</p></span><span class="botm-bg">&nbsp;</span></span><span class="user_hdpic"><img src="'+profileImgChatThumb(img)+'" width="34" height="34" class="'+imgClass+'"/></span>';
		//_str += '</span>';
		_str+='</li>';
		}
		
		 if(my != uid &&  isFound== -1)
		//if (count % 2 === 0)
		{ /* chage by haren for IE issue */
	 
		var _str = '<li>';
		_str += '<div style="float:left;width:50px;"><span style="margin-top:0px;float:left;margin-bottom:10px;font-size:11px;">'+uname+'</span><span class="user_hdpic"><img src="'+profileImgChatThumb(img)+'" width="34" height="34" class="'+imgClass+'"/></span></div>';
		_str += '<span class="Room_feed"><span class="cent-bg"><p>';
		_str += msg;
		_str += '</p></span><span class="botm-bg">&nbsp;</span></span>';
		_str+='</li>';
		}
		if(my == uid &&  isFound == -1)
		{
			 
		var _str = '<li class="gary-row">';
		_str += '<span class="Room_feed"><span class="cent-bg"><p>';
		_str += msg;
		_str += '</p></span><span class="botm-bg">&nbsp;</span></span><div style="float:right;width:35px;"><span style="margin-top:0px;float:right;margin-bottom:10px;font-size:11px;">'+uname+'</span><span class="user_hdpic"><img src="'+profileImgChatThumb(img)+'" width="34" height="34" class="'+imgClass+'"/></span></div>';
		//_str += '</span>';
		_str+='</li>';
		}
		
		 $('.Room_chat_view ul').append(_str);;
		$(".Room_chat_view ").scrollTop($(".Room_chat_view ul").height()) ,$(".Room_chat_view ul").height();
		
		var elm = document.getElementById('TextArea1');
	try
		{
		elm.scrollTop = elm.scrollHeight;
		}
	catch(e)
		{
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
				//alert('ready');
				jQuery("#jquery_jplayer_1").jPlayer("setMedia", {
					//mp3:"<?php echo base_url('css/audioPlayer/Blop.mp3');?>"
					m4a: "http://www.jplayer.org/audio/m4a/Miaow-07-Bubble.m4a",
					oga: "http://www.jplayer.org/audio/ogg/Miaow-07-Bubble.ogg"
					
				}).jPlayer("play");
			},
			swfPath: "<?php echo base_url('js/audioPlayer/Jplayer.swf');?>",
			supplied: "m4a,oga",
			wmode:"window",
			preload: "auto",
			errorAlerts: false,
			warningAlerts:false,
			solution: "html,flash",
			autoplay: true,
			
		});
		setTimeout(function(){
			jQuery("#jquery_jplayer_1").jPlayer("play");
		}, 1500);
		 }

	function exceptionHandler(event) {
	 }
	function connect(){ 
		if(sessionId == ''){
			return;
		}
		 
		TB.setLogLevel(TB.DEBUG);
		TB.addEventListener("exception", exceptionHandler);
		session = TB.initSession(sessionId);
		session.connect(apiKey, token);
		session.addEventListener('sessionConnected', sessionConnectedHandler);
			//  session.addEventListener('connectionCreated', connectionCreatedHandler);
		session.addEventListener("streamCreated", streamCreatedHandler);
		  
	}	
    var publisher;
	var subscribers = {};
 
    function sessionConnectedHandler(event) 
	{
		for (var i = 0; i < event.streams.length; i++) 
		{
			addStream(event.streams[i]);
		}	
		var publishProps = {height:$('#publisherContainer').height(), width:$('#publisherContainer').width()};
		subscribeToStreams(event.streams);	
		if(user.type=='t')
		{	
			publisher = TB.initPublisher(apiKey, 'publisherContainer', publishProps);
		} 		
		session.publish(publisher);	
		subscribeToStreams(event.streams);	
		console.log("1");
		subscriber = session.subscribe(event.stream,'subscriber_container', {insertMode: 'append'});
		console.log("mytest"+event.streams.name);
		recheck("publisher");
		recheck("subscriber");
		var stream = event.streams.shift();
		if(typeof(stream ) == 'undefined' || stream.connection.connectionId == session.connection.connectionId)
		{
			$('#subscriber').html('Waiting..');
		}
	 }
 function addStream(stream) 
 {  

	if (stream.connection.connectionId == session.connection.connectionId) 
	{
		return;
	}
	var subscriberDiv = document.createElement('div'); // Create a div for the subscriber 	to replace
	subscriberDiv.setAttribute('id', stream.streamId); // Give the replacement div the id of the stream as its id.
	document.getElementById('subscriber_container').appendChild(subscriberDiv);
	session.subscribe(stream, subscriberDiv.id);
	console.log("2");
 }
function subscribeToStreams(streams) 
{
    for (var i = 0; i < streams.length; i++) 
	{
      var stream = streams[i];
	  if (stream.connection.connectionId != session.connection.connectionId) {
        var newDiv = document.createElement("div");
        newDiv.id = "subscriber_replace";
        document.getElementById("subscriber_container").appendChild(newDiv);
        subscriber = session.subscribe(stream, "subscriber_replace", {width: 350, height: 200});
        console.log("3");
		subscriber.subscribeToAudio(true);
        subscriber.setAudioVolume(100);
        //alert(session.connection.data + " " + " has joined the room");
      }
    } 
}
	function streamCreatedHandler(event) 
	{
		console.log("4");
		var newDiv = document.createElement("div");
        newDiv.id = "subscriber_replace";
        document.getElementById("subscriber_container").appendChild(newDiv);
        subscriber = session.subscribe(event.stream, "subscriber_replace", {width: 350, height: 200});
	}
		 
	
	function streamDestroyedHandler(event) {
		if(roleId != 0)
		{
		}
	}
	
	function recheck(type) {
	 
			var parentDiv = document.getElementById('myCamera');
			var publisherDiv = document.createElement('div'); // Create a div for the publisher to replace
			var publisherProperties = {};
			publisherProperties.name = 'A web-based OpenTok client';
			publisherDiv.setAttribute('id', 'opentok_publisher');
			parentDiv.appendChild(publisherDiv);
			publisher = session.publish(publisherDiv.id, publisherProperties);
			_pubConnected = 1;
		 
 }
	
	function checkP2P(object_id) {
		 
		var element = document.getElementById(object_id);
		if (element)
		{
			if (!element.fetchData)
			{
				//swf hasn't loaded completely, check again in .5 second
				setTimeout('checkP2P("' + object_id + '");', 1000);
				return;
			}
			var data = element.fetchData();
			var test = eval($(data).find("p2p").text()); //this will return true or false
			var new_status = "false";
			var new_color = "#ff7373";
			if (test)
			{
				new_status = "true"
				new_color = "#80ea69";
			}
			var status_container = $("#" + object_id).prev("div");
			status_container.text("P2P Status: " + new_status);
			status_container.css("background-color", new_color);
		}
		else
		{
			
		}
	}
	
	function exceptionHandler(event) {
	}
	function turnOffMyVideo() 
	{
		session.unpublish(publisher);
	}
	
	function turnOnMyVideo1() 
	{
		var publishProps = {height:$('#publisherContainer').height(), width:$('#publisherContainer').width()};
		publisher = TB.initPublisher(apiKey, 'publisherContainer', publishProps);
		session.publish(publisher);
	}
	
	function turnOnMyVideo() {
		var browserName=navigator.appName;
		var det = IsGCFInstalled();
		if(browserName=="Microsoft Internet Explorer" && window.chrome == undefined)
		{
			alert('You must use one of the supported browsers to run our Vee-session:  Firefox, Chrome, or Opera.  If you continue with Internet Explorer, you will be prompted to install the Google Frame plugin.');
		
		}else{
		
			hideTest('sRoom_player');
			var div = document.createElement('div');
			div.setAttribute('id', 'publisher');
			if(document.getElementById('publisherContainer'))
			{
				var publisherContainer = document.getElementById('publisherContainer');  
				publisherContainer.appendChild(div);
			}else{
				var newDiv = document.createElement("div");
				newDiv.id = "publisherContainer";
				document.getElementById("publisherContainer").appendChild(newDiv);
				
				var publisherContainer = document.getElementById('publisherContainer');  
				publisherContainer.appendChild(div);
			}
			var publishProps = {height:652, width:771};
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
			}

		  return false;
}
	
	function turnOnMyAudio(){
		//alert('hi');
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
			publisher = TB.initPublisher(apiKey, parentDiv.id, publisherProperties);
			publisher.addEventListener("devicesDetected", devicesDetectedHandler);
			publisher.addEventListener("microphoneActivityLevel", microphoneActivityLevelHandler)
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
		 $('#call-status').after('<br /><br /><div id="audPublisherContainer" class="audPublisherContainer"></div>');
    	showTest('sRoom_player');
	}
	function devicesDetectedHandler(event) 
	{
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
		 showTest("manageDevicesBtn");
	}
	function microphoneActivityLevelHandler(event) 
	{
	
		var volumeIndictatorMask = document.getElementById("volumeIndicatorMask");
		volumeIndictatorMask.style.width = (100 - event.value * microphoneGain / 100) + "%";
	}
		
	function detectDevices() 
	{
		hideTest("mics");
		publisher.detectDevices();
	}
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
$arrVal 	= $this->lookup_model->getValue('3', $multi_lang);
$vsearch	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('358', $multi_lang);
$vleave = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('361', $multi_lang);
$vchatwindow = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('34', $multi_lang);
$vsend = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('342', $multi_lang);
$vtestinstructiondetails	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('354', $multi_lang);
$vtranslate = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('355', $multi_lang);
$vdictionary = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('352', $multi_lang);
$vimages = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('353', $multi_lang);
$vsearchimage = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('356', $multi_lang);
$vsearchdictionary = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('357', $multi_lang);
$vdefine = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('678', $multi_lang);
$vnewsfeed = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('679', $multi_lang);
$vsearchnews = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('680', $multi_lang);
$vgetnews = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('681', $multi_lang);
$vdragdrop = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('682', $multi_lang);
$vagenda = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('683', $multi_lang);
$vintroduction = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('684', $multi_lang);
$vstudentrequest = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('685', $multi_lang);
$vtutorapproach = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('686', $multi_lang);
$vpolitetutor = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('687', $multi_lang);
$vnextsteps = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('688', $multi_lang);
$vhelp = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('689', $multi_lang);
$vhearingaudio = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('690', $multi_lang);
$vaskpartner = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('691', $multi_lang);
$vscreenfrozen = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('692', $multi_lang);
$vreloadbrowser = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('693', $multi_lang);
$vneedatemp = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('694', $multi_lang);
$vchatyourintend = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('695', $multi_lang);
$vnotseeingvideo = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('696', $multi_lang);
$vchecktosee = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('697', $multi_lang);
$vpersistening = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('698', $multi_lang);
$vchromerecommend = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('699', $multi_lang);
$vreschedule = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('700', $multi_lang);
$vwithinfirst3min = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1008', $multi_lang);
$intendtorejoin = $arrVal[$multi_lang];

?>
<link href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
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
	
	var clockTimer;
	 </script>
	
</head>
<body onload="set_interval()" onmousemove="reset_interval()" onclick="reset_interval()"
onkeypress="reset_interval()"
onscroll="reset_interval()">
<!-- Google Tag Manager -->
 
 
<!-- End Google Tag Manager -->
<div id="Room_layer12"></div>
<div class="Room_wrap posR">

	
    	<div class="blue-bg">
        	<div class="Room_bd clearfix">
            	 <div class="str-info" style="width:546px;">
				<div class="spc50">
	<!--<div class="spc50" style="display:none;">-->
		<span class="info"></span>
		<span class="start"></span>
		<span class="end"></span>
	</div></div>
                <div class="Room_view f1">
                	<input type="hidden" value="" id="vuID" />
					 <div id="Room_player">
						<div  id="sRoom_player">
							<img src="<?php echo Base_url('images/room_video.jpg');?>"/>
						</div>
						<div id="myCamera" class="publisherContainer"></div>
						<div id="subscriber_container" >
                        <div id="subscriber_replace"  ></div>
                      </div>
					</div>
					<div id="fancyClock" style="display:none;"><div class="clock" style="width:200px;"><div class="clock_seconds"><div class="bgLayer"><canvas id="canvas_seconds" width="122" height="122"></canvas><p class="val">0</p></div></div></div></div>
                    <div class="leaveRoom">
                    	<a href="#" class="icon1 tooltip leaveVee">&nbsp;<span class="classic"><?php echo $vleave; ?></span></a>
                    </div>
                    <div class="vis-logo"><img alt="video-img" src="<?php echo Base_url('images'); ?>/ttl-vee-logo.png"></div>
                    <div class="vis-usr-img" style="border:0px !important;"><div id="Room_player1"  style="width:160;height:100px;text-align:center;border;">
						<div  id="sRoom_player1">
						
						</div>
					</div></div>
                </div>
                <div class="Room_chat_wp fr">
                        <div class="Room_chat">
                        <h2><?php echo $vchatwindow;?></h2>
                        <div id="TextArea1" class="Room_chat_view">
                            <ul>
                                
                            </ul>
                        </div>
						<div class="cht-snbtn">
							<form id="frmsnd" onsubmit="$('#chatSend').click();$('#chatSend_txt').click();return false;">
                    <input id="chatSend_txt" type="text" class="send_chat_ipt" name="" />
                    <span class="leaveRoom2"><a href="javascript:;"  id="chatSend"><?php //echo $vsend; ?></a></span>                                   
                	</form>
						</div>
                    </div>
					
					<div class="Btn_wp agnR">
            	<!--<a href="#" class="Btn_audio"></a>-->
			
            </div>
                </div>
	<div id="signals"></div>
				
				<script>
		function shareImageFunction (){
		
	     //alert(window.shareImage);
			$('.send_chat_ipt').val(window.shareImage);
			//$('#chatSend').trigger('click');
			
			$.post('<?php echo base_url('multi/chatSend');?>',{msg:$('.send_chat_ipt').val(),classId:cid},function(msg){
					//alert(msg.constructor);
						if (String == msg.constructor) {
							eval ('var json = ' + msg);
							 
						} else {
							var json = msg;
						 
						}
						if(json.error){
							alert(json.msg);
						 
						}
					})
			$('.send_chat_ipt').val('');
			$('#dialog2').dialog('close');
			
		}
    </script>
	<script>
			$('#chatSend').click(function(){
		 
				if(cid !=''){
					$.post('<?php echo base_url('multi/chatSend');?>',{msg:$('.send_chat_ipt').val(),classId:cid},function(msg){
					//alert(msg.constructor);
						if (String == msg.constructor) {
							eval ('var json = ' + msg);
						} else {
							var json = msg;
						}
						if(json.error){
							alert(json.msg);
						}
					})
				}
				else{
					 
				}

				$('.send_chat_ipt').val('');
				setTimeout(getChat,200);
			})
			$('#chatSend_txt').click(function(){
				//addMsg($('.send_chat_ipt').val(),user.type);
				if(cid !=''){
					$.post('<?php echo base_url('multi/chatSend');?>',{msg:$('.send_chat_ipt').val(),classId:cid},function(msg){
						
						
						if (String == msg.constructor) {
							eval ('var json = ' + msg);
						} else {
							var json = msg;
						}
						if(json.error){
							alert(json.msg);
						}
					})
				}
				else{		
					 
				}

				$('.send_chat_ipt').val('');
				setTimeout(getChat,200);
			})
		</script>
		<style>
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
	<style>
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

.TabbedPanelsTabGroup li.six a{background: url(images/testvs/site-img.png) -660px -368px no-repeat;}
.TabbedPanelsTabGroup li.six:hover a{background:url(images/testvs/site-img.png) -660px -478px no-repeat;}
	</style>

				<div id="dialog2" title="" style="display:none;">
		<img src="<?php echo base_url('images/base/chat.png');?>"/>
	</div>	
	
				<textarea id="imageResultTemp" style="display:none"  rows="0" cols="0">
		{#foreach $T.rows as row}
		<a target="_blank" title="{$T.row.htmlTitle}" onclick="showImage('{$T.row.link}',{#if $T.row.image.width>800}800{#else}{$T.row.image.width}{#/if},{#if $T.row.image.width>800}{ $T.row.image.height/($T.row.image.width/800) }{#else}{$T.row.image.height}{#/if},this)">
			<img src="{$T.row.image.thumbnailLink}" height="{#if $T.row.image.thumbnailHeight>150}150{#else}{$T.row.image.thumbnailHeight}{#/if}px" />
		</a>
		{#/for}

	</textarea>
	 <div id="dialog3" title="<?php echo $vleave; ?>" style="display:None;">
			<?php echo $intendtorejoin; ?>
		</div>
		<div id="dialog1" title="<?php echo $PleaseRateyour;?>" style="display:None;" >
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
					<a href="javascript:;" title="" class="off">4</a>
					<a href="javascript:;" title="" class="off">5</a>
				</span>
				<p class="clearer"></p>
			</div>
			 <p> <input type="checkbox" value="1" id="sendToAdmin"> <?php echo $ReportImport;?></p>
			<p><?php echo $WriteComm;?></p>
			<p><textarea id="msg" class="textareaMsg"></textarea></p>
			<p><input type="button" value="<?php echo $Submit;?>" id="rateButton" class="blu-btn"/></p>
		</div>
 <div id="showWithOutPay" title="<?php echo $confirm;?>" style="display:None;">
			<?php
			$roleId = $this->session->userdata('roleId');
			if($roleId != 0){
			?>		
			<p style="font-size:14px;"><?php echo $comforttutor; ?></p>
			<?php
			}else{
			?>
			<p style="font-size:14px;"><?php echo $comfortstudent; ?></p>
			<?php
			}
			?>
		</div>
		<script>
		$(function(){
			$('#searchImageButton').click(function(){
			
				var _q = $('#searchImageInput').val();
				
				//alert(_q);
				
				if(_q.length < 2){
					alert('The keywords must have more than 2 characters.');
					return;
				}
				
				  
				$(this).attr('buttonType','doing');
				 
				$.get('<?php echo base_url("multi/images");?>',{q:_q},function(result){
				$('#searchImageButton').attr('buttonType','done');
					if (String == result.constructor) {
						eval ('var result = ' + result);
					}
					if(result.error){
					}
					else{
						$('#img_result').setTemplateElement('imageResultTemp').processTemplate(result);
					}
				})
			})
		})
		</script>
		<script src="http://jquery-ui.googlecode.com/svn/tags/latest/external/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>		         
        <script language="javascript" type="text/javascript">
            $(function() {
			  $("#allfields li").draggable({
				
                    appendTo: "body",
                    helper: "clone",
                    cursor: "select",
                    revert: "invalid"
					 
                });
             initDroppable($("#TextArea1"));
				//initDroppable($("#chatSend_txt"));
                function initDroppable($elements) { 
				 $elements.droppable({
				   hoverClass: "textarea",
                        accept: ":not(.ui-sortable-helper)",
                        drop: function(event, ui) {
 
						$('#TextArea1').val('');;
						
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
							 $.post('<?php echo base_url('multi/chatSend');?>',{msg:dropText,classId:cid},function(msg){
						if (String == msg.constructor) {
							eval ('var json = ' + msg);
						} else {
							var json = msg;
						}
						if(json.error){
							alert(json.msg);
						}
					})
						  }
                    });
                }
            });
        </script>
		<div class="gray-panel">
                	<div class="mn-cnt">
                    	<div id="TabbedPanels1" class="VTabbedPanels">
                        	<ul id="allTabs" class="TabbedPanelsTabGroup Room_slide fl">
                            	<li class="TabbedPanelsTab one current" data-tab="tab-1"><a href="javascript:void(0)"><span><?php echo $vagenda; ?></span></a></li>                                
                                <li class="TabbedPanelsTab four" data-tab="tab-4"><a href="javascript:void(0)"><span><?php echo $vimages;?></span></a></li>
                                <li class="TabbedPanelsTab five" data-tab="tab-5"><a href="javascript:void(0)"><span><?php echo $vtranslate; ?></span></a></li>
                                <li class="TabbedPanelsTab six" data-tab="tab-6"><a href="javascript:void(0)"><span><?php echo $vdictionary;?></span></a></li>
                                <li class="TabbedPanelsTab seven" data-tab="tab-7"><a href="javascript:void(0)"><span><?php echo $vnewsfeed;?></span></a></li>
								<li class="TabbedPanelsTab eight" data-tab="tab-8"><a href="javascript:void(0)"><span><?php echo $TestScenario;?></span></a></li>
                            </ul>
                        </div>
                        <div class="drg-txt">
                        	<a href="#"><?php echo $DragDrop;?></a>
                        	<div id="cnuser" style="display:none;" class="online-user"><span>Connected Users</span></div>
                        </div>
                         <div class="onlineusr_listing">
                        	<h2>Online Users</h2>
                        	<ul>
                            	<li>
                                	<span><img alt="video-img" src="<?php echo Base_url('images'); ?>/onlineuser.jpg"></span>	
                                    <p>test fvrferg tvbtfgbv...</p>
                                </li>
                                <li>
                                	<span><img alt="video-img" src="<?php echo Base_url('images'); ?>/onlineuser.jpg"></span>	
                                    <p>test fvrferg tvbtfgbv...</p>
                                </li>
                             
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="white-bg">
        	<div class="Room_tool">
            	<div class="TabbedPanelsContentGroup">
                	<div class="TabbedPanelsContent current" id="tab-1">
                    	
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
                    </div>                   
                    <div class="TabbedPanelsContent blu-bgexpnd" id="tab-4">
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
                                	<?php foreach($gImages as $k=>$gImage):
							if($gImage['image']['thumbnailHeight'] > 150){
								$height = 150;
							}
							else{
								$height = $gImage['image']['thumbnailHeight'];
							}//echo '<pre>';var_dump($gImage);//link image link?>
							<a href="<?php echo $gImage['image']['contextLink'];?>" target="_blank" title="<?php echo $gImage['htmlTitle'];?>">
								<img src="<?php echo $gImage['image']['thumbnailLink'] ;?>" height="<?php echo $height;?>px" />
							</a>
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
                                    <div  class="from_lang langs g-inline-block">
                                        <span dataid="" class="lang_op">From: Detect language</span>
                                        <s class="ico_arr ico_arr_down"></s>
                                    </div>
                                    <div id="transFrom2to" class="ico_trans g-inline-block">
                                        <s class="ico_arr_trans"></s>
                                    </div>
                                    <div class="to_lang langs g-inline-block" >
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
                                </div>
                                <div id="target-wrap" class="lng-tetxarea">
                                    <textarea id="target-textarea" name=""></textarea>
                                </div>
							</div>
                            </div>
                        </div>
						
						<!--for translate script-->
            <script>
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
						//console.info(_name,_lang);
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
						//console.info(_name,_lang);
						$('.to_lang .lang_op').html('TO: '+_name).attr('dataId',_lang);
						var newLangSector = $('[dataId='+_lang+']','#gt-text-target .lang-option');
						//console.info(newLangSector,'#gt-text-target .lang-option[dataId='+_lang+']');
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
						$.get('<?php echo base_url('multi/translate');?>',{q:_q,from:_from,to:_to},function(result){
							if (String == result.constructor) {      
								eval ('var result = ' + result);
							}
							//console.info(result);
							if(result.error){
								alert(result.error);
							}
							else{
								if(typeof(result.rows.translations[0].detectedSourceLanguage)!='undefined'){
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
                            <div id="Room_sear_result_dict" class="srch-result">
                            	
                            </div>
                            </div>
                        </div>
						
						
						<!--for dict script-->
			<script>
				$(function(){
					$('#gd-submit-dict').click(function(){
					
						var _q = $('#dictFrom').val();
						if(_q==''){
							alert('Enter a word to define.');
							return;
						}
						
						$.getJSON('https://api.pearson.com/v2/dictionaries/entries?headword='+_q,function(result){
							
							 if (String == result.constructor) {      
						eval ('var s = ' + result);
					} else {
						var s = result;
					}
				//alert(s.results.length)
				 var _html ="";
				 _html ="<b>Word: </b>"+_q;
				 
				  if(s.results.length == 0)
				 {
				 _html += '<div>';
				  _html ="<b>Word: </b>"+_q +" not found in the dictionary.";
				 _html += '</div>';
				 $('#Room_sear_result_dict').html(_html);
				 }
				 
				for (var i = 0;  i < 100; i++) {
				if(s.results[i]['senses'][0]['definition']!=undefined)
				{
   _html += '<div>';
_html += '<ul type="square"><img src="../../../images/bullet_black.png" alt="Smiley face" > <span>'+s.results[i]['senses'][0]['definition']+'</span></li></ul>';
_html += '</div>';
}
$('#Room_sear_result_dict').html(_html);
}
				
				})
					})
				})
			</script>
            <!--for dict script end-->
					</div>
                    <div class="TabbedPanelsContent blu-bgexpnd" id="tab-7">
                    	<div  class="search_type">
                        	<div class="blubg-inr">
							<div class="bludv-cnt">
                    		<div class="Room_sear_wp">
                            	<form onsubmit="$('#gd-submit-feed').click();return false;">
							 <input type="text" name="country" id="country" class="Room_search_ipt" placeholder="<?php echo $vsearchnews; ?>"  />
							 <span class="leaveRoom2 Btn-blue"><a id="gd-submit-feed" class=" Btn Btn_blue w66" href="javascript:void(0)"><?php echo $vgetnews; ?></a>
					 
                            	                 </span>
                                </form>
                            </div>
                            </div>
                            </div>
                            <div class="whitdv-cnt">
                            <div id="Room_sear_result_feed" >
                            	
                            </div>
							</div>
                        </div>
						</div>
						
						<div class="TabbedPanelsContent test-scenarios" id="tab-8">
                    	
						<h1><?php echo $TestScenario; ?></h1>
						<p class="">
						 <span class="">Language</span>
									
									<select name="lang" id="lang"  onchange="searchscenario();">
									
									<option value="1">English</option>
									<option value="7">Español</option>
									<option value="8">Français</option>
									<option value="3">简体中文</option>
									<option value="6">繁體中文</option>
									<option value="4">日本語</option>
									<option value="2">한국어</option>
									<option value="5">Português</option>
									</select> 
							<span style="margin-left:20px;">Categories</span>
						 
	
								<select name="categories" id="categories" onchange="searchscenario();">
								<option value="sel"> Select</option>
								<?php for($i=0;$i<count($cat);$i++)
								{?>
								<option value="<?php echo $cat[$i]['guide_categories_id'];?>"> <?php echo $cat[$i]['name']?></option>
								<?php }?>
								</select></p>
						<div id="dynamictest">	
                       <ul id="testscn">
                        <?php if(count($testScenario)>0){?>
						<?php for($i=0;$i<count($testScenario);$i++){?>
                        
						<?php 
							$pdf=base_url('uploads');
							$pdfurl=$pdf.'/testscenario/'.$testScenario[$i]['pfile'];
						?>
                        <li><a target='_blank' href="<?php echo $pdfurl; ?>"><?php echo $testScenario[$i]['Title']?></a></li>
						<p><?php echo $testScenario[$i]['Description']?> </p>
						<?php }?>
						<?php }?>	
						</ul>
						</div>
                    </div>
						</div>
						</div>
						 </div>
						
						 
						 </div>
						 <div id="jquery_jplayer_1" class="jp-jplayer"></div>
						 
<script>						 
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
					  if (String == msg.constructor)
					{
						var result;
						
						eval('result = ' + msg);
					} else {
						var result = msg;
					}
					$('#dynamictest').empty();
					
					if(result.length > 0)
					{	
						for (var i = 0;  i < (result.length); i++)
						{
						 var title=result[i]['Title'];
						 var file=result[i]['pfile'];
						 var pdf="<?php echo base_url('upload');?>";
						 var link=pdf+"/testscenario/"+file; 
						 var disc=result[i]['Description'];
						$("#dynamictest").append('<ul><li><a target="_blank" href='+link+'>'+title+'</a></li><p>'+disc+'</p></ul>'); 
					 
						}
					}	
					else
					{
						$("#dynamictest").append('<ul>no record found</ul>');
					} 
				 } 
			});
	}
	</script>							 
<script>
//alert('ok');
		//var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
		
		$(function(){
			//$('#Room_sear_result_feed').css('overflow-y','auto');	
			$('#gd-submit-feed').click(function(){
				//alert('hi');
				
				var _q = $('#country').val();
				if(_q==''){
					//alert('Select Country');
					alert('Enter Search Word');
					return;
				}
				var _data = {};
				_data["country"] = _q;
				
				$(this).attr('buttonType','doing');
				
				$.ajax({
						url: "<?php echo base_url("multi/getnewsfeed");?>",
						type: 'GET',
						data: _data,
						dataType: 'html',
						cache: false,
						success: function (msg){
						//alert(msg);
								if (String == msg.constructor) {
									var result;
									 
									eval('result = ' + msg);
								} else {
									var result = msg;
								}
								$('#gd-submit-feed').attr('buttonType','done');
								var _html = result.html;
								//alert(_html);
								var noScrol = 0;
								if(_html == ''){
									_html = '<div style="margin:20px;font-weight: bold;font-size: 16px;" >No Records Found</div>';
									noScrol = 1;
								}
								//alert(_html);
								$('#Room_sear_result_feed').html('<ul><li>'+_html+'</ul></li>');
								if(_html.len < 0)
								{
									//$('#Room_sear_result_feed').css('overflow-y','auto');
								}else{
									//$('#Room_sear_result_feed').css('overflow-y','scroll');
								}
								if(noScrol == 1)
								{
									//$('#Room_sear_result_feed').css('overflow-y','auto');
								}
						}
					 });
			})
			//upload document function 
			var button1 = $('#profile_vedio_upload_true_test'), interval1;
			s = new AjaxUpload(button1,{
				action: '<?php echo Base_url('user/upload_vee_chat_document');?>', 
				enable:true,
				name: 'userfile',
				onSubmit : function(file, ext){
					if(typeof(this._input.files)!='undefined')
					{		
						if(typeof(this._input.files[0])!='undefined' && typeof(this._input.files[0].size)!='undefined' && this._input.files[0].size != ''){
							if(this._input.files[0].size > 20971520){
								alert('Filesize too large, please use a video less than 20mb.  Converting to MP4 can reduce filesize considerably.');
								return false;
							}
						}
					}	
					if(ext == 'jpg'|| ext == 'jpef' || ext == 'png'|| ext == 'gif'|| ext == 'bmp'|| ext == 'txt'|| ext == 'xls'|| ext == 'rtf' || ext == 'doc'){
					}
					else{
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
						if (text.length < 13){
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
					//alert(jsonres.filetype)
					if(jsonres.filetype == 'image')
					{
					
						var link = jsonres.source;
						var onclick = "showImage('"+jsonres.source+"','800','450',this)";
						var html = '<a class="hdshareimg" target="_blank" title="Share Image" onclick="'+onclick+'" ><img src="'+link+'" alt="image" /></a>';
						var pic = '<?php echo $user["pic"]; ?>';
				$.post('<?php echo base_url('multi/chatSend');?>',{msg:html,classId:cid},function(msg){
				
						if (String == msg.constructor) {
							eval ('var json = ' + msg);
						} else {
							var json = msg;
						}
						if(json.error){
							alert(json.msg);
						}
					})
				document.getElementById('hidden_documents').innerHTML = html;
						setTimeout(function() {
						 }, 2000);
					}else
					{
						var link = jsonres.source;
						var html = '<a class="hdshareimg" target="_blank" href="'+link+'" ><img src="<?php echo Base_url('images/document.jpg'); ?>" alt="document" /></a>';
						
						var pic = '<?php echo $user["pic"]; ?>';
					$.post('<?php echo base_url('multi/chatSend');?>',{msg:html,classId:cid},function(msg){
						if (String == msg.constructor) {
							eval ('var json = ' + msg);
						} else {
							var json = msg;
						}
						if(json.error){
							alert(json.msg);
						}
					})
						document.getElementById('hidden_doc').innerHTML = html;
						setTimeout(function() {
						}, 2000);
					}
					
				}
			});
		})
    </script>
<script>
$(document).ready(function(){

$('ul.TabbedPanelsTabGroup li').click(function(){
var tab_id = $(this).attr('data-tab');

$('ul.TabbedPanelsTabGroup li').removeClass('current');
$('.TabbedPanelsContent').removeClass('current');

$(this).addClass('current');
$("#"+tab_id).addClass('current');
})

})
$(".langListfrom").mouseleave(function(){
 // $(".langListfrom").css("display","none");
});

$(".langListto").mouseleave(function(){
  //$(".langListto").css("display","none");
});

$(".online-user span").click(function(){
  $(".onlineusr_listing").toggle();});
  
</script>
<input type="hidden" name="sa" id="sa" value="2">
 <div class="spc20"></div>
	<div id="hidden_document" style="display:none;">
		<div id="hidden_documents" ></div>
		<div id="hidden_doc" ></div>
		
	</div>
	<style>
	#publisherContainer{display:none !important;}
	#hiddenshare img {max-height:82px;}
	.Room_feed a img {max-height:82px;}
	.hdshareimg img{max-height:82px;}
	.OT_publisher .OT_edge-bar-item.OT_mode-on, .OT_subscriber .OT_edge-bar-item.OT_mode-on, .OT_publisher .OT_edge-bar-item.OT_mode-auto.OT_mode-on-hold, .OT_subscriber .OT_edge-bar-item.OT_mode-auto.OT_mode-on-hold, .OT_publisher:hover .OT_edge-bar-item.OT_mode-auto, .OT_subscriber:hover .OT_edge-bar-item.OT_mode-auto, .OT_publisher:hover .OT_edge-bar-item.OT_mode-mini-auto, .OT_subscriber:hover .OT_edge-bar-item.OT_mode-mini-auto {
    opacity: 0 !important;
    top: 0;
	cursor:default !important;
	}
	</style>
</body>
</html>