<!doctype html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=8" >
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=8" >
<![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php getmeta();?>
<link type="image/x-icon" href="<?php echo base_url('talklist.ico');?>" rel="shortcut icon">
<?php /*?>
<link type="text/css" media="all" href="css/home_style.css" rel="stylesheet" />
<script src="<?php echo base_url('js/jquery.1.7.2.min.js');?>"  type="text/javascript" ></script>
<script src="<?php echo base_url('js/jquery.placeholder.js');?>"  type="text/javascript" ></script>
<script src="<?php echo base_url('js/projekktor-1.1.00r107.min.js');?>"  type="text/javascript" ></script>
<script src="<?php echo base_url('js/contentslider.js');?>" type="text/javascript" ></script>
<script src="<?php echo base_url('css/palyerTheme/style.css');?>"  type="text/javascript" ></script>
<?php */?>
<!--CSS START -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/home/html5reset-1.6.1.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/home/tools.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/home/style.css');?>">
<!--CSS END -->
<!--[if lt IE 9]><script src="<?php echo base_url('js/home/html5.js');?>"></script><![endif]-->
<!--HTML 6 VIDEO START -->
<link href="//vjs.zencdn.net/4.2/video-js.css" rel="stylesheet">
<script src="//vjs.zencdn.net/4.2/video.js"></script>
<!--HTML 6 VIDEO END -->
<link href='http://fonts.googleapis.com/css?family=Lato:400,100,300,400italic,700,900' rel='stylesheet' type='text/css'>


<script>
$(function(){
	$('input[placeholder]').placeholder();
});
</script>
<link type="text/css" media="all" href="css/contentslider.css" rel="stylesheet" />
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
			url: "<?php echo Base_url();?>user/ajaxLang/",
			data: { multiLang: multiLang}
		    }).done(function( msg ) { 
				location.reload();
			  });
	});
  });*/
  
</script>
</head>
<body><?php include_once FCPATH."idle/idle.php";?>
	<!--/wrap-->
	<?php echo $content_for_layout?>
	<!--footer end-->
	<?php if($this->session->userdata('roleId') == 0): ?>
	<script type="text/javascript">
	// skvirja 01 Oct 2013 
	// checks for tutors that confirm class
	var mTimerClass;
	getStatusClassConfirm();
	function getStatusClassConfirm()
	{
		$.get("<?php echo base_url();?>user/checkClassConfirmed",{
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
						setTimeout(function(){window.location.href = '<?php echo base_url(); ?>'+'classroom/index/cid/'+result.cid;},10000);
					}else if(result.tutorNotConfirmed == true){
						$('#dialog').html('Tutor was unable to confirm this appointment, try booking another tutor who is Available NOW.');
						$('#dialog').dialog({modal:true});
					}
				}
		});
	}
	</script>
	<?php endif; ?>
	<?php if($this->session->userdata('roleId') != 0): ?>
	<script>
		var booknowexpiryTimer;
		<?php if($this->session->userdata('booknowexp')): ?>
		var booknowexpTime = <?php echo $this->session->userdata('booknowexp'); ?>;
		<?php else:?>
		var booknowexpTime = 0;
		<?php endif; ?>
		var attemptBookNowForm = 0;
		window.strtime = 0;
		if(booknowexpTime>0)
		{
			booknowexpiryCheck();
		}
		function booknowexpiryCheck()
		{
			var currentUTCBooknowStr = getCurrentTime();
			var timeout = booknowexpTime - currentUTCBooknowStr;
			if(timeout<=0 && attemptBookNowForm == 0)
			{
				attemptBookNowForm = 1;
				$('#booknowPopup').show();
			}
			booknowexpiryTimer = setTimeout('booknowexpiryCheck()',5000);
		}
		function getCurrentTime()
		{
			var crtime = 0;
			$.ajax({
				url: "<?php echo base_url();?>user/getCurrentUTCtimeString",
				type: 'POST',
				dataType: 'json',
				cache: false,
				success: function (msg){
					window.strtime = msg.time;
				}
			});
			crtime = window.strtime;
			return crtime;
		}
		function booknowyes()
		{
			attemptBookNowForm = 0;
			booknowexpTime = getCurrentTime() + 7200;
			$('#booknowPopup').hide();
			var ddataStringChecked = "readytotalk=1";
			$.ajax({
				url: "<?php echo base_url();?>user/reopenReadyToTalkSession",
				type: 'POST',
				data: ddataStringChecked,
				dataType: 'json',
				cache: false,
				success: function (msg){
					booknowexpiryCheck();
				}
			});
		}
		function booknowno()
		{
			$('#booknowPopup').hide();
			$('#readytotalk').attr('checked',false);
			var ddataStringChecked = "readytotalk=0";
			$.ajax({
				url: "<?php echo base_url();?>user/readytotalkUpdate",
				type: 'POST',
				data: ddataStringChecked,
				dataType: 'json',
				cache: false,
				success: function (msg){
				}
			});
		}
	</script>
	<?php endif; ?>
	<script>	
		//broser close event - logout
		var validNavigation = false;
		//var lgbycls = '<?php echo base_url();?>user/logoutByBroserClose';
		function wireUpEvents() 
		{
			window.addEventListener('beforeunload',function u(e)
			{
			 if (!validNavigation) {
				window.onbeforeunload = null;
				$.ajax({
				  dataType:'json',
				  type: 'GET',
				  url: "<?php echo base_url();?>user/logoutByBroserClose",
				  success: function(data, textStatus, jqXHR) {
					alert(data);
					// `data` contains parsed JSON
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
			self.location.href = "<?php echo base_url();?>user/logout";
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
	<script src="<?php echo base_url('js/home/jquery-1.7.1.min.js');?>"></script>
	<script src="<?php echo base_url('js/home/global.js');?>"></script>
	<script src="js/global.js"></script>
	<!--JQUERY END -->
	<!--JQUERY TESTIMONIALS START -->
	<script src="<?php echo base_url('js/home/jquery.cycle.lite.js');?>"></script>
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
	</script>
	<!--JQUERY TESTIMONIALS END -->
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
			
			//Show signup_form
			var signup_form = $('#signup_form');
			var register_btn  = $('#register_btn');
			register_btn.click(function(){
				if(signup_form.is(':hidden')){
					$("html, body").animate({ scrollTop: 550 }, 800);
					signup_form.slideDown(300);
				}else{
					signup_form.slideUp(300);
				}
				
				return false;
			})
			
	    });
	/* spp,change laguage start 02 Dec 13 */
	$('.multi_lang_change').css('cursor', 'pointer');
	function changeLanguage(lang){
	    if(lang==''){
	    	return false;
	    }
		multiLang = lang;
		$.ajax({
			type: "POST",
			url: "<?php echo Base_url();?>user/ajaxLang/",
			data: { multiLang: multiLang}
		}).done(function( msg ) {
			str = self.location.href;
			existLng = '<?php echo $this->uri->segment(0);?>';
			if(jQuery.inArray(existLng,<?php echo json_encode($this->config->item('lang_uri_abbr'));?>)>=0){
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
	
	<script type="text/javascript" src="http://wcs.naver.net/wcslog.js"> </script> 
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
			event.preventDefault();
			var error 			= false;
			var $form 			= $( this );
			//var url 			= $form.attr( "action" );
			var url 			= window.location+'/user/registerDo';
			url = url.replace("/ppc/naver1", "");
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
</script>	
	

<script>
$(function(){
	//$('input[placeholder]').placeholder();
	$('#registerButton').click(function(){
		//alert('iiii');
		$('#registerForm').submit();
	});
});
(function(d){
    var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement('script'); js.id = id; js.async = true;
    js.src = "//connect.facebook.net/en_US/all.js";
    ref.parentNode.insertBefore(js, ref);
}(document));
window.fbAsyncInit = function() {
    FB.init({
        appId      : '564390540302547', // App ID
        channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File
        status     : true, // check login status
        cookie     : true, // enable cookies to allow the server to access the session
        xfbml      : true  // parse XFBML
    });
    $('.fb_connect').click(function(){
        FB.login(function(){
            document.location.href = '<?php echo base_url('user/register');?>';
        },{scope: 'email,user_likes,user_location,user_religion_politics'});
    })
        
};
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
	<noscript>
	    <div style="background: none repeat scroll 0 0 #CCCCCC;float: left;height: 100%;opacity: 0.5;position: fixed;top: 0;width: 100%;z-index: 999999;">&nbsp;</div>
		<div style="border: 1px solid #AAAAAA;margin: 0 36%;position: absolute;top: 300px;width: 400px;z-index: 9999999;background:#fff;" class="ui-dialog ui-widget ui-widget-content ui-corner-all">
			<div style="background: url('images/ui-bg_highlight-soft_75_cccccc_1x100.png') repeat-x scroll 50% 50% #CCCCCC;border: 1px solid #AAAAAA;border-radius: 4px;color: #222222;font-weight: bold;padding: 5px 7px;">Activate Javascript</div>
			<div style="padding: 10px;">
				This web site needs javascript activated to work properly. Please activate it. Thanks!
			</div>		
		</div>
	</noscript>
<?php if(isset($_SESSION['isRegError']) && $_SESSION['isRegError'] == TRUE){ ?>
<script type="text/javascript">

		var signup_form = $('#signup_form');
		var register_btn  = $('#register_btn');
			//var eMessage = 'Email already exists';
			var eMessage = "<?php echo $_SESSION['regError'];?>";
			
			$('#email_invalid').css('display','block');
			$('#email_invalid').html(eMessage);
			
			if(signup_form.is(':hidden')){
				$("html, body").animate({ scrollTop: 550 }, 800);
				signup_form.slideDown(300);
			}else{
				signup_form.slideUp(300);
			}

			
</script>


<?php $_SESSION['isRegError'] == FALSE; unset($_SESSION['isRegError']);
 }  ?>	
</body>
</html>