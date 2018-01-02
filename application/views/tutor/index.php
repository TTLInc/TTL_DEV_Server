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
$this->load->helper('cookie');

$arrVal 	= $this->lookup_model->getValue('1463', $multi_lang);	$welcometo   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1135', $multi_lang);	$viewprofile   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1439', $multi_lang);	$tutorsonthe   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1441', $multi_lang);	$itscoolest   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('871', $multi_lang);	$signup   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1440', $multi_lang);	$thetalklistalways   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1464', $multi_lang);	$makemoney   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1465', $multi_lang);	$viewvideo   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1442', $multi_lang);	$asatutor   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1443', $multi_lang);	$increaseyour   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1444', $multi_lang);	$yourregistration   	= $arrVal[$multi_lang];

?>

<!doctype html>
<html lang="en">

<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Want to make money by tutoring online? TheTalklist.com matches students and tutors from around the world in live video conversations.">
	<meta name="keywords" content="">
	<title>Earn a tutoring income</title>
	<link type="image/x-icon" href="https://www.thetalklist.com/en/talklist.ico" rel="shortcut icon">
<!--CSS START -->

<!--CSS END -->
<!--[if lt IE 9]><script src="https://www.thetalklist.com/js/home/html5.js"></script><![endif]-->
<!--HTML 6 VIDEO START -->
<link href="//vjs.zencdn.net/4.2/video-js.css" rel="stylesheet">
<script src="//vjs.zencdn.net/4.2/video.js"></script>
<script>videojs.options.flash.swf = "https://www.thetalklist.com/vedio/video-js.swf"</script>

<!--HTML 6 VIDEO END -->
<link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,400italic,700,900' rel='stylesheet' type='text/css'>


<script>
$(function(){
	$('input[placeholder]').placeholder();
});
</script>
<link type="text/css" media="all" href="<?php echo base_url('css/contentslider.css'); ?>" rel="stylesheet" />
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-42821485-1', 'thetalklist.com');
  ga('send', 'pageview');

  /*$(document).ready(function(){
	 $("#multi_lang_change").change(function(){
		var multiLang = $("#multi_lang_change").val();
		$.ajax({
			type: "POST",
			url: "https://www.thetalklist.com/user/ajaxLang/",
			data: { multiLang: multiLang}
		    }).done(function( msg ) { 
				location.reload();
			  });
	});
  });*/
  
</script>


<!--RESPONSIVE START -->
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/home/responsive.css');?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<script src="<?php echo base_url('js/home/jquery-1.8.2.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/home/responsive.js');?>"></script> -->
<!--RESPONSIVE END -->

<!-- 40Nuggets Starts -->
<script type="text/javascript">
var _40nmcid = '40NM-11497-1';
(function() {
var nm = document.createElement('script'); nm.type = 'text/javascript'; nm.async = true;
nm.src = ('https:' == document.location.protocol ? 'https://' : 'https://') +
'40nuggets.com/widget/js/track/track-'+_40nmcid+'.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(nm,s);
})();
</script>
<!-- 40Nuggets Ends -->
</head>

<body onLoad="wireUpEvents()" class="schhool-pg">
<style type="text/css">
#idletimeout { background:#CC5100; border:3px solid #FF6500; color:#fff; font-family:arial, sans-serif; text-align:center; font-size:12px; padding:10px; position:relative; top:0px; left:0; right:0; z-index:100000; display:none; }
#idletimeout { background:#CC5100; border:3px solid #FF6500; color:#fff; font-family:arial, sans-serif; text-align:center; font-size:12px; padding:10px; position:relative; top:0px; left:0; right:0; z-index:100000; display:none; }
#idletimeout a { color:#fff; font-weight:bold }
#idletimeout span { font-weight:bold }
</style>
<!-- <link rel="stylesheet" type="text/css" href="https://www.thetalklist.com/idle/examples.css" /> -->
<div id="idletimeout">
	You will be logged off in <span><!-- countdown place holder --></span>&nbsp;seconds due to inactivity. 
	<a id="idletimeout-resume" href="#">Click here to continue using this web page</a>.
</div>
<!--<script src="<?php echo base_url('idle/jquery.idletimer.js');?>" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url('idle/jquery.idletimeout.js');?>" type="text/javascript" charset="utf-8"></script> -->
<script type="text/javascript">
</script>	
   
<!--CSS END -->
<script src="<?php echo base_url('js/home/html5.js');?>"></script>
<!--HTML 6 VIDEO START -->
<script src="https://api.html5media.info/1.1.6/html5media.min.js"></script>
<link href="https://vjs.zencdn.net/4.2/video-js.css" rel="stylesheet">
<script src="https://vjs.zencdn.net/4.2/video.js"></script>

<!--[if lt IE 9]>
   <script>
      document.createElement('header');
      document.createElement('nav');
      document.createElement('section');
      document.createElement('article');
      document.createElement('aside');
      document.createElement('footer');
   </script>
<![endif]-->
<script>

$(document).ready(function() {
    $("html,body").scrollTop(0);
});
/* 
$(window).load(function() {
 
  $(window).scrollTop(0);
  $("html,body").scrollTop(0);
  
  
	 var isnewone="";
	 if(isnewone !='')
		{
 			
			 $('#confirmaccountDialog').dialog({
					modal:true,
					width:'300px'
			});
			 
			$(".ui-dialog").addClass("regpopup2");
			window.scrollTo(0,0);
	 	}	

})
function closeConfirm()
{
	$('#confirmaccountDialog').dialog('close');
} */
</script>
<!--<SCRIPT>

var _setintvalNextSession = setInterval(ChecknextGroup,1000);
function ChecknextGroup()
{

 	/*var foo = new Date;
	var unixtime = parseInt(foo.getTime() / 1000);
	var unixtime_to_date = new Date(unixtime*1000);*/
 
var _cid = ;
 

	$.ajax({
         url: "<?php echo base_url; ?>/user/CheckDiffrence/cid/"+_cid,
        type: "post",
        success: function(msg){
		if (String == msg.constructor) {
				eval ('var json = ' + msg);
			} else {
				var json = msg;
			}

			if(json.success == "true" || json.success ==true)
			{
				if(json.NoofParticipant > 20)
				{
					$("#myfreegroup").attr("onclick", "openfullDialog();",false);
					$('#myfreegroup').css('background-color', '#ff7029'); 
					$('#chkPopup').css('background-color', '#ff7029'); 
					$('#textNext').text('In Progress');
				}
				else
				{
					$("#myfreegroup").attr("href", "<?php echo base_url('/multi?id='); ?>");
					$('#myfreegroup').css('background-color', '#ff7029'); 
					$('#chkPopup').css('background-color', '#ff7029'); 
					if(json.diff > 0)
					{	
						var nxt="04:00 pm"+"(Sign in Now)";
						$('#textNext').text(nxt);
					}
					else				
					{  
						 $('#textNext').text('In Progress');
					}
				} 
			}
			else
			{
				$("#myfreegroup").attr("href", "javascript:void(0)");
				$('#myfreegroup').css('background-color', '#ff7029'); 
				  $('#chkPopup').css('background-color', '#ff7029'); 
					var nxt="04:00 pm, Dec 31, 1969"
					
					$('#textNext').text(nxt);			  
					
					
			}
		 }
	});
}
function openfullDialog()
{
	  $('#fullDialog').dialog({
				modal:true,
				width:'300px'
			}); 
}
function closeFullpopup()
{
	$('#fullDialog').dialog('close');
}
</SCRIPT>  -->
<script>
/*$(document).ready(function() {
	$("span.NextGroup").hover(function () { 
				 $(this).append('<div class="tooltipusr"><p>Must be within 15 min of session to join session and see a live preview of learning environment.</p> </div>');
				 }, function () {
					$("div.tooltipusr").remove();
				});
				});*/
</script>
<style>
span.NextGroup {
	color: #FFFFFF;
	display: inline-block;
	padding: 0 10px;
	text-align: center;
	text-shadow: none;
	vertical-align: middle;
}
div.tooltipusr p {
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
div.tooltip p {
	font-size:12px;
	line-height:14px;
	font-weight:normal;
	font-family:Arial, Helvetica, sans-serif;
}
.class_two {
	border:1px solid red;
	border-radius: 10px;
}
p.tooltip-chkPopup {
	font-size:12px;
	font-family:Arial, Helvetica, sans-serif;
	line-height:14px;
	font-weight:normal;
	color: White;
	padding:8px;
	background:#3399cc;
	width:250px;
	border-radius:7px;
	margin:-40px 300px 0 -150px;
	float:left;
}
p.tooltip-chkPopup:before {
	border-color: transparent #3399cc transparent transparent;
	border-right: 6px solid #3399cc;
	border-style: solid;
	border-width: 6px 6px 6px 0px;
	content: "";
	display: block;
	height: 0;
	width: 0;
	line-height: 0;
	position: absolute;
	top: 40%;
	left: -6px !important;
}
p.tooltip-chkPopup span {
	margin: 10px;
	color: White;
	line-height:18px;
	font-size:13px;
	text-align:left;
}
.regpopup {
	top:500px !important
}
.bx-controls{
	display:none;
}
</style>
<script>
$(document).ready(function () {
/*$(".chk-tooltip").hover(function () {
$(this).append("<p class='tooltip-chkPopup'><span>Preview our learning environment where you can see/hear the tutor and they can&apos;t see you.  Text chats are OK.</span></p>");
}, function () {
$("p.tooltip-chkPopup").remove();
});

$(".JoinSess").hover(function () {
$(this).append("<p class='tooltip-chkPopup'><span>Preview our learning environment where you can see/hear the tutor and they can&apos;t see you.  Text chats are OK.</span></p>");
}, function () {
$("p.tooltip-chkPopup").remove();
});
*/

$(".chk-tooltip").click(function(){ 
    $(".ui-dialog").addClass("regpopup");
	window.scrollTo(0,200);
}); 

$(".JoinSess").click(function(){ 
    $(".ui-dialog").addClass("regpopup");
	window.scrollTo(0,200);
}); 

});
</script>
<script>
function chngname(s)
{
if(s == 'roleId_input_4' || s == 'roleId1_input_4')
{
$('#firstName').attr("placeholder","School Name");
$('#firstName1').attr("placeholder","School Name");
}
else if(s == 'roleId_input_5' || s == 'roleId1_input_5')
{

$('#firstName').attr("placeholder","Affiliate name");
$('#firstName1').attr("placeholder","Affiliate name");
}
else
{
$('#firstName1').attr("placeholder","First Name"); 
$('#firstName').attr("placeholder","First Name");
 
}

}

function validateFrm()
{

	/*
	if( $('#roleId').val() == '9')
	{
			document.getElementById('rselect1').className += ' class_two';	
			document.getElementById('rid').style.display = 'block';
			return false;
	}
	else
	{
		document.getElementById("rselect1").style.border="none";
		document.getElementById('rid').style.display = 'none';
	}
	*/
	if( $('#firstName').val() == '')
	{
		document.getElementById('redfname').className += ' class_two';	
		document.getElementById('fname').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById("redfname").style.border="none";
		document.getElementById('fname').style.display = 'none';
	}
	if( $('#mail').val() == '')
	{
		document.getElementById('redmail').className += ' class_two';		
		document.getElementById('email_taken1').style.display = 'none';
		document.getElementById('vremail').style.display = 'none';
		document.getElementById('remail').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById('remail').style.display = 'none';
	}
	var mail=($('#mail').val());
	var re = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(! re.test(mail))
    {
	document.getElementById('redmail').className += ' class_two';	
	document.getElementById('email_taken1').style.display = 'none';	
	 document.getElementById('vremail').style.display = 'block';
	return false;
	}
	else
	{
	$.ajax({
				  type:     "GET",
				  url: '<?php echo base_url('/user/ajax_checkjp'); ?>',
				  //data: { multiLang: multiLang},
				  data: {name: mail},
				  dataType: "jsonp",
				   jsonp: 'callback',
					jsonpCallback: 'chekEmailTaken',
				  success: function(msg){
					  if(msg.success==false || msg.success=='false')
					{
						document.getElementById('vremail').style.display = 'none';
						document.getElementById('redmail').className += ' class_two';	
						document.getElementById('vremail1').style.display = 'none';
						document.getElementById('email_taken1').style.display = 'block';
					}
					else
					{
							chekEmailTaken(msg);
					}	
				 }
				});
			 return  ;
	}
}

function chekEmailTaken(data){ 
  if(data.success == true || data.success=='true')
  { 
						document.getElementById("ered").style.border="none";
						$('#redmail').removeClass('class_two');
						 
						document.getElementById('vremail1').style.display = 'none';
						document.getElementById('email_taken1').style.display = 'none';
						passCheck1();
  }
  else
  { 
				document.getElementById('vremail').style.display = 'none';
				document.getElementById('redmail').className += ' class_two';	
				document.getElementById('vremail1').style.display = 'none';
				document.getElementById('email_taken1').style.display = 'block';
  }
}
function passCheck1()
{  
	if( $('#password').val() == '')
	{
		document.getElementById('rpass').className += ' class_two';	
		document.getElementById('pass').style.display = 'block';
		document.getElementById('passlong1').style.display = 'none';
		return false;
	}
	else
	{
		//document.getElementById("rpass").style.border="none";	
		document.getElementById('pass').style.display = 'none';
	}
	var k=$('#password').val().length;
	if(k < 6)
	{
		document.getElementById('rpass').className += ' class_two';
		document.getElementById('passlong1').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById("rpass").style.border="none";	
		document.getElementById('passlong1').style.display = 'none';
	} 
	if( $('#confirm_password').val() == '')
	{
		document.getElementById('rcpass').className += ' class_two';	
		document.getElementById('cpass12').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById('cpass12').style.display = 'none';
	}
	var a=$('#password').val();
	var b=$('#confirm_password').val();
	
	if(a != b)
	{
		document.getElementById('rcpass').className += ' class_two';
		document.getElementById('cpass12d').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById("rcpass").style.border="1px solid red";	
		document.getElementById('cpass12d').style.display = 'none';
	}
	$('#registerFormindx').submit();
}

 
 
</script>
<!-- added by haren for firm submit on key -->
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-ui.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/sc_style.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/sc_responsive.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/school_homepage.css');?>">
<!-- <script type="text/javascript">
$(function(){
    $('input').keydown(function(e){
        if (e.keyCode == 13) {
			validateFrm();
             
        }
    });
	$('#chkPopup').click(function() { 
	 //window.scrollTo(0,50);
	  $('#isgroup').val("yes");
			 $('#gsessionDialog').dialog({
					modal:true,
					width:'300px'
			});
	});
	
}); 

function chktool()
{
	 $('#preventdialog').dialog({
					modal:true,
					width:'300px'
			});
}
function closePrevent()
{
	$('#preventdialog').dialog('close');
	
}
/*raxa text wrap*/
jQuery(document).ready(function($) {
  $('.cercal1').rotate(-24);
});
/*raxa text wrap*/
</script>  -->
<!--HOMEPAGE BANNER START -->
<div class="index-banner" style="">
	
	<div class="tutcontainer" style="position:relative;">
		<img src="<?php echo base_url("images/Tutor1.jpg"); ?>" width="100%" style="margin-top:-12px;">
        <div class="banner_content_main" style=" position:absolute; top:70%; left:0%; margin:0 auto; width:100%;">
			<div class="banner_slogan_1"><?php echo $welcometo; ?></div>	
			</div>	
			<a href="https://www.thetalklist.com/en/search/search"><button style="left: 43%" class="banner_links_btn_1_tu"><?php echo $viewprofile; ?></button></a>
	   
    </div>
	<div class="school_content"><?php echo $tutorsonthe; ?>
	</div>
	 
	<div class="tutcontainer" style="position:relative">
		<img src="<?php echo base_url("images/Tutor2.jpg"); ?>" width="100%">
		<div class="banner_content_main" style=" margin:0 auto; ">
			<div class="banner_slogan_3_tu" ><?php echo $itscoolest; ?></div>
		</div>
		<a href="javascript:void(0)" class="popup-sign sigup-stnt"><button onclick="scrollWin()" class="banner_links_btn_3_tu"><?php echo $signup; ?></button></a>
	</div>
	<div class="school_content" ><?php echo $thetalklistalways; ?>
	</div>
	
	<div class="tutcontainer" style="position:relative">
		<img src="<?php echo base_url("images/Tutor3.jpg"); ?>" width="100%">
		<div class="banner_content_main" style=" margin:0 auto; ">
			<div class="banner_slogan_3_tu2" ><?php echo $makemoney; ?></div>
		</div>
		<a href="https://youtu.be/F1fwfaK2pTg"><button  class="banner_links_btn_2_tu"><?php echo $viewvideo; ?></button></a>
	   </div>
	<div class="school_content"><?php echo $asatutor; ?>
	</div>
	<div style= "color:black;font-size:42px;text-align:center" class="school_content" ><?php echo $increaseyour; ?></div>
	<div class="tutcontainer" style="position:relative">
		
		<img src="<?php echo base_url("images/Tutor4.jpg"); ?>" width="100%">
		   </div>
		   
	<div style="padding-top :0" class="school_content"><?php echo $yourregistration; ?>
	</div>

</div>
<!--
<script type="text/javascript">
// skvirja 01 Oct 2013 
// checks for tutors that confirm class
var mTimerClass;
getStatusClassConfirm();
function getStatusClassConfirm()
{
	$.get("<?php echo base_url('/user/checkClassConfirmed'); ?>",{
				chat: 1,
				last: 1
			}, function(msg) {
			mTimerClass = setTimeout('getStatusClassConfirm();',1000);	
			if (String == msg.constructor)
			{
				var result;
				eval('result = ' + msg);
			} else {
				var result = msg;
			}
			if(result.status == 'success' ){
				if(result.redirect == true){
					$('#dialog').html('Your tutor has arrived and you will automatically be launched into your session in 10 seconds.');
					$('#dialog').dialog({modal:true});
					setTimeout(function(){window.location.href = 'https://www.thetalklist.com/'+'classroom/index/cid/'+result.cid;},10000);
				}else if(result.tutorNotConfirmed == true){
					$('#dialog').html('Tutor was unable to confirm this appointment, try booking another tutor who is Available NOW.');
					$('#dialog').dialog({modal:true});
				}
			}
	});
}
</script>
<script>	
	//broser close event - logout
	var validNavigation = false;
	//var lgbycls = 'https://www.thetalklist.com/user/logoutByBroserClose';
	function wireUpEvents() 
	{
		window.addEventListener('beforeunload',function u(e)
		{
		 if (!validNavigation) {
			window.onbeforeunload = null;
			$.ajax({
			  dataType:'json',
			  type: 'GET',
			  url: "<?php echo base_url; ?>/user/logoutByBroserClose",
			  success: function(data, textStatus, jqXHR) {
				alert(data);
				// `data` contains parsed JSON

				//---R&D : JAN-22-2014
					var currentDomain = $('#xOutUser').attr('href');
					if(currentDomain == 'https://techno-sanjay/dev.thetalklist.com/user/logout'){
					}else if(currentDomain == '<?php echo base_url; ?>/user/logout'){
						$.ajax({
							type: "POST",
							url: '<?php echo base_url; ?>/user/logout',
							data: { }
						}).done(function( msg ) {
					});
					}else{
						$.ajax({
							type: "POST",
							url: '<?php echo base_url; ?>/user/logout',
							data: { }
						}).done(function( msg ) {
						});
					}
				//---R&D : JAN-22-2014
			  },
			  error: function(jqXHR, textStatus, errorThrown) {
				 // Handle any errors
			  }
			});
			//$.get(lgbycls,function(data, textStatus, jqXHR) {});
			 window.removeEventListener('beforeunload',u,false);
			  //endSession();
			  setTimeout(function(){
				 window.dispatchEvent( new Event('beforeunload'));
			  },100)
			 
		  }
		 },false);
		
		// Attach the event keypress to exclude the F5 refresh
		$(document).bind('keypress', function(e) {
			if (e.keyCode == 116 || e.keyCode == 112 || e.keyCode == 114){
			  validNavigation = true;
			}
		});
		document.onkeydown = checkKeycode;
		// Attach the event click for all links in the page
		$("a").bind("click", function() {
			var idm = $(this).attr('id');
			if(typeof(idm) != 'undefined')
			{
				if(idm == 'SocialPromoteNo' || idm == 'SocialPromoteYes')
				{
					validNavigation = false;
				}else{
					validNavigation = true;
				}
			}else{
				validNavigation = true;
			}
		});
		// Attach the event submit for all forms in the page
		$("form").bind("submit", function() {
			validNavigation = true;
		});
		// Attach the event click for all inputs in the page
		$("input[type=submit]").bind("click", function() {
			validNavigation = true;
		});
	}
	// Wire up the events as soon as the DOM tree is ready
	$(document).ready(function() {
		wireUpEvents();  
	}); 
	function checkKeycode(e) {
        var keycode;
        if (window.event)
            keycode = window.event.keyCode;
        else if (e)
            keycode = e.which;

        // Mozilla firefox
        if ($.browser.mozilla) {
            if (keycode == 116 ||(e.ctrlKey && keycode == 82)) {
                if (e.preventDefault)
                {
					//alert('f');
                    validNavigation = true;
					
                }
            }
        } 
        // IE
        else if ($.browser.msie) {
            if (keycode == 116 || (window.event.ctrlKey && keycode == 82)) {
               validNavigation = true;
            }
        }
    }
	// set system timeout and logout user
	var timer_logout;
	function timeHasElapsed1(tm) {
		self.location.href = "<?php echo base_url('/user/logout'); ?>";
	}
	$( "body" ).mousemove(function( event ) {
		if (!timer_logout)
		{
			clearTimeout(timer_logout);
			timer_logout=setTimeout(function(){
					timeHasElapsed1('12');
				},1000*7200);
		}
		else {
			
			clearTimeout(timer_logout);
			timer_logout=setTimeout(function(){
				timeHasElapsed1();
				},1000*7200);
		}
	});		
</script>
<!-- Naver Analytics code -->

<!-- new layout start js -->
<!--JQUERY START -->
<!--<script src="<?php echo base_url('js/home/jquery-1.7.1.min.js');?>"></script>
<script src="<?php echo base_url('js/home/global.js');?>"></script>
<script src="<?php echo base_url('js/global.js');?>"></script> -->
<!--JQUERY END -->
<!--JQUERY TESTIMONIALS START -->
<!--<script src="<?php echo base_url('js/home/jquery.cycle.lite.js');?>"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#testimonials').cycle({
		fx: 'fade'
	});
});

/*$(function(){
	$("input[name='signup']").on("click", function(){
		$('#registerForm').submit();
	});
});*/
</script> -->
<!--JQUERY TESTIMONIALS END -->

<!-- <script>
$(function(){
	$('.popup-sign').click(function(){
		//alert('iiii');
		$('.signup-top').slideDown();
	});
	$('.close_btn').click(function(){
		//alert('iiii');
		$('.signup-top').slideUp();
	});
	
});

</script> -->


<!-- new layout end js -->
<!-- new layout start js -->
<!--JQUERY SELECTBOX START -->
<script src="<?php echo base_url('js/home/selectbox.js');?>"></script>
<script src="<?php echo base_url('js/home/clearinputs.js');?>"></script>
<script>
        $(document).ready(function() {
            $('.cu_dds').selectbox('', 'searchbox');
			
			//Empty Input Boxes
			$('.fake_password').focus(function() {
				$(this).css({'display':'none'});
				$('.password').css({'display':'block'});
				$('.password').focus();
			})
			$('.password').blur(function(){
				var curr_val = $(this).val();
				if (curr_val == ''){
					$(this).css({'display':'none'});
					$('.fake_password').css({'display':'block'});
				}
			})
			$('.fake_password_1').focus(function() {
				$(this).css({'display':'none'});
				$('.password_1').css({'display':'block'});
				$('.password_1').focus();
			})
			$('.password_1').blur(function(){
				var curr_val = $(this).val();
				if (curr_val == ''){
					$(this).css({'display':'none'});
					$('.fake_password_1').css({'display':'block'});
				}
			})
			$('#fake_confirm_password').focus(function() {
				$(this).css({'display':'none'});
				$('#confirm_password').css({'display':'block'});
				$('#confirm_password').focus();
			})
			$('#confirm_password').blur(function(){
				var curr_val = $(this).val();
				if (curr_val == ''){
					$(this).css({'display':'none'});
					$('#fake_confirm_password').css({'display':'block'});
				}
			})
			
			//signup_form_floating
			var signup_form_floating = $('#signup_form_floating');
			var show_signup = function(){
				var scrollTop = $(window).scrollTop();
				if(scrollTop > 100){
					signup_form_floating.fadeIn(300);
				}else{
					signup_form_floating.fadeOut(300);
				}
			}
			
			show_signup();
        });
        
/* spp,change laguage start 02 Dec 13 */
var type = window.location.hash.substr(1);
if(type==''){
}else{
	$('html, body').animate({
		scrollTop: $("#"+type).offset().top - 75
	}, 500);
}
/*
function showContent(id){
	if(id==''){
		return false;
	}
	$('html, body').animate({
		scrollTop: $("#"+id).offset().top - 75
	}, 500);
} */
function showContent(id){
	var padding = 90;
	if(id==''){
		return false;
	}else if(id!='' && id=='guarantee'){
		$('html, body').animate({
			scrollTop: $("#"+id).offset().top
		}, 500);
	}
	else{
		$('html, body').animate({
			scrollTop: $("#"+id).offset().top - 75
		}, 500);
	}
}

$('.multi_lang_change').css('cursor', 'pointer');
function changeLanguage(lang){
	//var ajaxBaseUrl = document.baseURI;
	//var ajaxLangUrl = ajaxBaseUrl+'/user/ajaxLang/';
	//alert(ajaxLangUrl);
    if(lang==''){
    	return false;
    }
	multiLang = lang;
	$.ajax({
		type: "POST",
		url: "<?php echo base_url;?>/user/ajaxLang/",
		data: { multiLang: multiLang}
	}).done(function( msg ) {
		str = self.location.href;
		existLng = 'en';
		if(jQuery.inArray(existLng,["en","es","fr","ch","tw","jp","kr","pt"])>=0){
			relocateto = str.replace('/'+existLng, '/'+lang);
		} else {
			relocateto = self.location.href+lang;
		}
		self.location.href = relocateto;
		//location.reload();
  	});
}
/* spp,change laguage end 02 Dec 13 */
</script>
<!--JQUERY SELECTBOX END -->
<!-- new layout end js -->

<script type="text/javascript" src="https://wcs.naver.net/wcslog.js"> </script> 
<script type="text/javascript"> 
if (!wcs_add) var wcs_add={};
wcs_add["wa"] = "s_15f3d51a6740";
if (!_nasa) var _nasa={};
wcs.inflow();
wcs_do(_nasa);
</script>
<script type="text/javascript"> 
	$(function() {
		$('.support-nav').hover(function() { 
			$('.support-drp').show(); 
		}, function() { 
			$('.support-drp').hide(); 
		});
	});
</script>
<script type="text/javascript">
		//---FormValidation - R&D@Dec-12-2013
		
		
		//---FormValidation - R&D@Dec-12-2013
		function emailValidate(a){var b="";var c=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/; if(a.search(c)==-1){b="error"}return b}
		function isAlphabets(sText) {	
		var ValidChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'-";
		var IsAlphabet=true;
		var Char;
		for (i = 0; i < sText.length && IsAlphabet == true; i++) { 
		Char = sText.charAt(i);		
		if(Char != ' ') {
		if (ValidChars.indexOf(Char) == -1) {
		IsAlphabet = false;
		}		
		}
		}
		return IsAlphabet;   
		}
		
		$( "#registerForm" ).submit(function( event ) {
		return true;
			event.preventDefault();
			var error 			= false;
			var $form 			= $( this );
			//var url 			= $form.attr( "action" );
			var url 			= window.location+'/user/registerDo';
			
			
			url = url.replace("/tutor/index#overview", "");
			url = url.replace("/tutor/index#become_trust", "");
			url = url.replace("/tutor/index#levels", "");
			url = url.replace("/tutor/index#make_money", "");
			url = url.replace("/tutor/index#market_yourself", "");
			url = url.replace("/tutor/index", "");

			var className 		= $('#roleId_input_-1').attr('class');
			var roleId       	= $('.selected').attr('id');
			if(roleId == 'roleId_input_1') {us_roleId=1;} else {us_roleId=0;}
			var us_firstName 	= $form.find( "input[name='firstName']" ).val();
			var us_email 		= $form.find( "input[name='email']" ).val();
			var us_password 	= $('#password').val();
			
			/*
			if( className == "selected"){ $('#roleId_required').css('display','block'); error = true; }else { $('#roleId_required').css('display','none'); error = false;}
			if( us_firstName == ""){ $('#firstName_required').css('display','block');error = true; }else { $('#firstName_required').css('display','none'); error = false;}
			if( us_email == ""){ $('#email_required').css('display','block'); error = true;}else { $('#email_required').css('display','none'); error = false;}
			if(us_firstName !=""  && isAlphabets(us_firstName) == false){	
				$('#firstName_invalid').css('display','block');error = true;
			}else{
				$('#firstName_invalid').css('display','none');error = false;
			}
			if(us_email !=""  && emailValidate(us_email) != ""){	
				$('#email_invalid').css('display','block');error = true;
			}else{
				$('#email_invalid').css('display','none');error = false;
			}
			*/
			if(error == false){
				var posting = $.post( url, { 
					roleId: us_roleId,
					firstName: us_firstName,
					email: us_email,
					password: us_password,
					regPage: 'ppc'
				});
				posting.done(function( data ) {
					if (String == data.constructor) {
						eval ('var json = ' + data);
					} else {
						var json = data;
					}
					if(json.success){
						document.location.href = json.redirect;
					}
					if(json.message == "Email already exists."){
						$('#email_invalid').css('display','block');
						$('#email_invalid').html(json.message);
						error = true;
					}else{
						$('#email_invalid').css('display','none');error = false;
						document.location.href = json.redirect;
					}
				});
			}
		});
		
		//---FormValidation - R&D@Dec-12-2013
		
//----xOutUser
$('#xOutUser').click(function(){
var currentDomain = $('#xOutUser').attr('href');
if(currentDomain == 'https://techno-sanjay/dev.thetalklist.com/user/logout'){
}else if(currentDomain == '<?php echo base_url('/user/logout'); ?>'){
	$.ajax({
		type: "POST",
		url: 'https://cdn-dev.thetalklist.com/user/logout',
		data: { }
	}).done(function( msg ) {
});
}else{
	$.ajax({
		type: "POST",
		url: '<?php echo base_url('/user/logout');?>',
		data: { }
	}).done(function( msg ) {
  	});
}
});
//----xOutUser		
		
</script>

<div id="booknowPopup" style="display:none;" class="ui-dialog ui-widget ui-widget-content ui-corner-all">
<div class="header-pop">Book Now Timeout</div>
<div class="sr-pop-cnt">
	Do you want to still be available NOW?
	<br/>
	<input type="button" value="Yes" onClick="return booknowyes();" id="booknow_yes" style="cursor:pointer;" class="blu-btn">
	<input type="button" value="No" onClick="return booknowno();" id="booknow_no" style="cursor:pointer;" class="blu-btn">
</div>		
</div>
<script>
function scrollWin() {
window.scrollBy(0,-1000); 
    
}
</script>
<noscript>
    <div style="background: none repeat scroll 0 0 #CCCCCC;float: left;height: 100%;opacity: 0.5;position: fixed;top: 0;width: 100%;z-index: 999999;">&nbsp;</div>
	<div style="border: 1px solid #AAAAAA;margin: 0 36%;position: absolute;top: 300px;width: 400px;z-index: 9999999;background:#fff;" class="ui-dialog ui-widget ui-widget-content ui-corner-all">
		<div style="background: url('images/ui-bg_highlight-soft_75_cccccc_1x100.png') repeat-x scroll 50% 50% #CCCCCC;border: 1px solid #AAAAAA;border-radius: 4px;color: #222222;font-weight: bold;padding: 5px 7px;">Activate Javascript</div>
		<div style="padding: 10px;">
			This web site needs javascript activated to work properly. Please activate it. Thanks!
		</div>		
	</div>
</noscript>
</body>
</html>