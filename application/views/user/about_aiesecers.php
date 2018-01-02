<!doctype html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" >
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" >
<![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-control" content="no-cache">
<meta http-equiv="Expires" content="0">

<?php
 

if(! defined('ALLOW_ALL_EXTERNAL_SITES') ) define ('ALLOW_ALL_EXTERNAL_SITES', TRUE);
$multi_lang = 'en';
if(isset($_SESSION['multi_lang'])){
	$multi_lang = $_SESSION['multi_lang'];
}else{
	$multi_lang = 'en';	
}
$this->load->model(array('lookup_model'));
$arrVal 	= $this->lookup_model->getValue('37', $multi_lang);
$lprivacy_policy = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('133', $multi_lang);
$lterms		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('10', $multi_lang);
$lcontact	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('17', $multi_lang);
$labout		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('157', $multi_lang);
$lsite		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('158', $multi_lang);
$lfollowus	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('5', $multi_lang);
$llogin		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('238', $multi_lang);
$lforget	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1', $multi_lang);
$lhome		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('2', $multi_lang);
$lmyprofile	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('140', $multi_lang);
$lsearch	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('4', $multi_lang);
$lhowitworks	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('209', $multi_lang);
$lhave_questions= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('290', $multi_lang);
$lcopyright = @$arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('291', $multi_lang);
$lallrightreserve = @$arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('314', $multi_lang);
$lwelcome = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('323', $multi_lang);
$vsearch = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('315', $multi_lang);
$llogout = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('330', $multi_lang);
$lmypages = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('420', $multi_lang);
$lSUPPORT   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('387', $multi_lang);
$lFORUM   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('388', $multi_lang);
$lTUTOR_RESOURCES   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('417', $multi_lang);
$lSTUDENT_RESOURCES   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('414', $multi_lang);
$lFAQ   = @$arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('470', $multi_lang);	$lEMAIL   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('471', $multi_lang);	$lPASSWORD   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('472', $multi_lang);	$lFIRSTNAME   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('473', $multi_lang);	$lIM_STUDENT   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('474', $multi_lang);	$lIM_TUTOR   	= $arrVal[$multi_lang];


/** added 25 Nov 13 */
/*$SIGN_IN = "Sign In";
$lSIGN_IN = "signin";
$lBUYING_CREDITS = "Buying Credits";
$lSPEAK_EN_LIKE_NATIVE = "Speak English Like a Native";
$lCONNNECT_WITH_US = "Connect with us";
$lSITE_MAP = "Site Map";
$lStudents = "Students";
$lTutors = "Tutors";
$lLang = "Language";*/

$arrVal 	= $this->lookup_model->getValue('546', $multi_lang);	$SIGN_IN   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('547', $multi_lang);	$lSIGN_IN   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('548', $multi_lang);	$lBUYING_CREDITS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('544', $multi_lang);	$lSPEAK_EN_LIKE_NATIVE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('549', $multi_lang);	$lCONNNECT_WITH_US   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('550', $multi_lang);	$lSITE_MAP   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('551', $multi_lang);	$lStudents   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('552', $multi_lang);	$lTutors   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('553', $multi_lang);	$lLang   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('554', $multi_lang);	$lSELECTING_TUTOR   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('555', $multi_lang);	$lBUYING_CREDITS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('556', $multi_lang);	$lGUARANTEE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('557', $multi_lang);	$lOVERVIEW   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('558', $multi_lang);	$lBECOME_TUTOR   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('559', $multi_lang);	$lLEVELS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('560', $multi_lang);	$lMAKE_MONEY   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('561', $multi_lang);	$lMARKET_YOURSELF   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('670', $multi_lang);	$lREG_SELECT_TYPE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('671', $multi_lang);	$lREG_FIRSTNAME_REQ   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('672', $multi_lang);	$lREG_FIRSTNAME_INVALID = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('673', $multi_lang);	$lREG_EMAIL_REQ   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('674', $multi_lang);	$lREG_EMAIL_INVALID   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('675', $multi_lang);	$lREG_PASSWORD   		= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('726', $multi_lang);	$school   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('840', $multi_lang);	$comunity   		= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('889', $multi_lang);	$viewsite   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('816', $multi_lang);	$affiliate   		= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('922', $multi_lang);	$TutorUnable   		= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('111', $multi_lang);$student =  $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('110', $multi_lang);$tutor = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('541', $multi_lang);	$lIAMA   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('236', $multi_lang);	$iamaa   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('926', $multi_lang);	$stu   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('927', $multi_lang);	$PROGRAM   	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('665', $multi_lang);$lSPEAK_ENGLISH =  $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('666', $multi_lang);$lLIKE_A_NATIVE = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('977', $multi_lang);$schools = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('727', $multi_lang);$schoolname = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('816', $multi_lang);$affiliate = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('823', $multi_lang);$affiliatename = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('221', $multi_lang);
$lsign_up = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('939', $multi_lang);
$cnglang= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('540', $multi_lang);	$lCPASSWORD   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('1015', $multi_lang);	$schoolProgram   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('1016', $multi_lang);	$selectuser   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1017', $multi_lang);	$enterfname   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1018', $multi_lang);	$emailTaken  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1019', $multi_lang);	$enteremail   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1020', $multi_lang);	$entervalidemail   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1021', $multi_lang);	$enterpass   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1022', $multi_lang);	$sixmin   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1023', $multi_lang);	$confpass   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1024', $multi_lang);	$passmissmatch   	= $arrVal[$multi_lang];

/* milestone 2 */

$arrVal 	= $this->lookup_model->getValue('1211', $multi_lang);	$areyoualready   	= $arrVal[$multi_lang];
/* end milestone2 */
$arrVal = $this->lookup_model->getValue('1232', $multi_lang);$member = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('1231', $multi_lang);	$lIM_MEMBER= $arrVal[$multi_lang];
?>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/home/style.css');?>">
<!--CSS END -->
<!--[if lt IE 9]><script src="<?php echo base_url('js/home/html5.js');?>"></script><![endif]-->
<!--HTML 6 VIDEO START -->


<!--HTML 6 VIDEO END -->
<link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,400italic,700,900' rel='stylesheet' type='text/css'>
<script src="<?php echo base_url('js/home/jquery-1.8.2.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/jquery.placeholder.js');?>" type="text/javascript"></script>


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
$(window).load(function() {
						
	 $("html,body").scrollTop(0);
						
      var langs="<?php echo $_SESSION['multi_lang'] ;?>";
	  //alert(langs);
	  if(langs=="en")
	  {
		$("body").addClass('en');
	  }
	   if(langs=="es")
	  {
		$("body").addClass('ess');
	  }
	  if(langs=="ch")
	  {
		$("body").addClass('ch');
	  }
	  if(langs=="tw")
	  {
		$("body").addClass('tw');
	  }
	  if(langs=="jp")
	  {
		$("body").addClass('japan');
	  }
	  if(langs=="kr")
	  {
		$("body").addClass('kr');
	  }
	  if(langs=="pt")
	  {
		$("body").addClass('pt');
	  }
	   if(langs=="fr")
	  {
		$("body").addClass('fr');
	  }
});
</script>
<style>
.class_two
{
	border:1px solid red;
	border-radius: 10px;
}
</style>
<script>
$(function(){
	
	
	$('input[placeholder]').placeholder();
});

function chngname(s)
{
}


function frmvalidate()
{
	if( $('#roleId1').val() == '9')
	{
		document.getElementById('rselect').className += ' class_two';	
		//document.getElementById('rid1').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById("rselect").style.border="none";
		//document.getElementById('rid1').style.display = 'none';
	}
	if( $('#firstName1').val() == '')
	{
		document.getElementById('fnamered').className += ' class_two';
		document.getElementById('fname1').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById("fnamered").style.border="none";
		document.getElementById('fname1').style.display = 'none';
	}
	var mail=($('#email1').val());
	var re = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if( $('#email1').val() == '')
	{
		document.getElementById('ered').className += ' class_two';
		document.getElementById('vremail1').style.display = 'none';
		document.getElementById('email_taken').style.display = 'none';
		document.getElementById('remail1').style.display = 'block';
		return false;
	}
	else
	{
		document.getElementById('remail1').style.display = 'none';
	}
	
	  if(! re.test(mail))
		{
		 document.getElementById('ered').className += ' class_two';	
		 document.getElementById('vremail1').style.display = 'block';
		return false;
		}
		else
		{
			$.ajax({
				  type: "GET",
				  url: '<?php echo Base_url("user/ajax_checkjp");?>',
				  //data: { multiLang: multiLang},
				  data: {name: mail},
				  dataType: "jsonp",
				   jsonp: 'callback',
					jsonpCallback: 'chekEmailTaken12',
				  success: function(msg){ 
					if(msg.success==false || msg.success=='false')
					{
						//document.getElementById('ered').className += ' class_two';	
						//document.getElementById('vremail1').style.display = 'none';
						//document.getElementById('email_taken').style.display = 'block';
					}
					else
					{
						//document.getElementById("ered").style.border="none";
						//document.getElementById('vremail1').style.display = 'none';
						chekEmailTaken12(msg);
					}				
				 }
			});
			return;
		}
}


function chekEmailTaken12(data){
 
  if(data.success)
  { 
	  document.getElementById("remail1").style.border="none";
	  document.getElementById('email_taken').style.display = 'none';
	  laypassCheck(); 	
  }
  else
  { 				 
	document.getElementById('ered').className += ' class_two';	
	document.getElementById('vremail1').style.display = 'none';
	document.getElementById('email_taken').style.display = 'block';
  }
}
function laypassCheck()
{

		if( $('#password1').val() == '')
		{
			document.getElementById('passred').className += ' class_two';
			document.getElementById('pass1').style.display = 'block';
			return false;
		}
		else
		{
		document.getElementById('pass1').style.display = 'none';
		}
		var k=$('#password1').val().length;
		if(k < 6)
		{
			document.getElementById('passred').className += ' class_two';
			document.getElementById('passlong').style.display = 'block';
			return false;
		}
		else
		{
			document.getElementById("passred").style.border="none";
			document.getElementById('passlong').style.display = 'none';
		} 
		if( $('#fake_confirm_password1').val() == '')
		{
			document.getElementById('cpassred').className += ' class_two';
			document.getElementById('cpassconf').style.display = 'block';
			return false;
		}
		else
		{
			document.getElementById("cpassred").style.border="none";
			document.getElementById('cpassconf').style.display = 'none';
		}
		var a=$('#password1').val();
		var b=$('#fake_confirm_password1').val();
		if(a != b)
		{
			document.getElementById('cpassred').className += ' class_two';
			document.getElementById('cpassconf1').style.display = 'block';
			return false;
		}
		else
		{
			document.getElementById("cpassred").style.border="none";
			document.getElementById('cpassconf1').style.display = 'none';
		}
		$('#registerForm1').submit();
}

function passCheck()
{
		if( $('#password1').val() == '')
		{
			document.getElementById('passred').className += ' class_two';
			document.getElementById('pass1').style.display = 'block';
			return false;
		}
		else
		{
		document.getElementById('pass1').style.display = 'none';
		}
		var k=$('#password1').val().length;
		if(k < 6)
		{
			document.getElementById('passred').className += ' class_two';
			document.getElementById('passlong').style.display = 'block';
			return false;
		}
		else
		{
			document.getElementById("passred").style.border="none";
			document.getElementById('passlong').style.display = 'none';
		} 
		if( $('#fake_confirm_password1').val() == '')
		{
			document.getElementById('cpassred').className += ' class_two';
			document.getElementById('cpassconf').style.display = 'block';
			return false;
		}
		else
		{
			document.getElementById("cpassred").style.border="none";
			document.getElementById('cpassconf').style.display = 'none';
		}
		var a=$('#password1').val();
		var b=$('#fake_confirm_password1').val();
		if(a != b)
		{
			document.getElementById('cpassred').className += ' class_two';
			document.getElementById('cpassconf1').style.display = 'block';
			return false;
		}
		else
		{
			document.getElementById("cpassred").style.border="none";
			document.getElementById('cpassconf1').style.display = 'none';
		}
		$('#registerForm1').submit();
}
</script>
<script type="text/javascript">
$(function(){
    $('input').keydown(function(e){
        if (e.keyCode == 13) {
			frmvalidate()
             
        }
    });
}); 
</script> 



<!-- added by haren for firm submit on key -->

  <?php
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
    //echo 'Internet explorer';
	$browser = 1;
	 if(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE)
   // echo 'Internet explorer';
	$browser = 11;
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
    //echo 'Mozilla Firefox';
	$browser = 2;
    if(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
    //echo 'Google Chrome';
	$browser = 3;
     
    ?>
	<?php if(@$browser==2 || @$browser==3){?>
<script language="javascript" type="text/javascript">
	var isClose = false;
	function bodyUnload() {
		if(isClose)
		{
		//  alert('hi');
			  var request = GetRequest();
			  request.open("GET", "<?php echo base_url('user/slogout');?>", true);
			  request.send();
		}
	}
	function GetRequest() {
		var request = null;
		if (window.XMLHttpRequest) {
			//incase of IE7,FF, Opera and Safari browser
			request = new XMLHttpRequest();
		}
		else {
			//for old browser like IE 6.x and IE 5.x
			request = new ActiveXObject('MSXML2.XMLHTTP.3.0');
		}
		return request;
	}

    //]]>
</script>
<?php }?>

 
<script type="text/javascript">
function goLogin()
	{
		window.scrollTo(-10,0);
		$('#gsessionDialog').dialog('close');
		$( "#signin_btn" ).trigger( "click" );
	}
	function GoRegister()
	{
		$('#gsessionDialog').dialog('close');
		$( "#register_btn" ).trigger( "click" );
	}
window.onbeforeunload = function() {
    window.location.href = '<?php echo base_url('user/slogoutByBroserClose');?>';   
};
</script>

<!--<script src="<?php //echo base_url('js/home/jquery-1.8.2.js');?>" type="text/javascript"></script>-->
<script src="<?php echo base_url('js/home/jquery.bxslider.min.js');?>" type="text/javascript"></script>

<style>
 .ui-widget-overlay{position:relative !important;}
.ui-widget-content{border: 4px solid #0087d0;    border-radius: 0 !important; background:#fff; padding:15px;}
.ui-widget-header{ background:none; border:0 none !important;}
 #gsessionDialog
 {
	min-height:82px !important;
	background-color:white;
 }
 #buttonOk
 {
	background: url("<?php echo base_url();?>images/test-vs-btn.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: medium none;
    box-shadow: none !important;
    color: #ffffff;
    cursor: pointer;
    font-size: 14px;
    height: 34px;
    line-height: 32px;
    margin-top: 4px !important;
    outline: medium none;
    text-align: center;
    text-decoration: none;
    width: 110px;
 }
 #ButtonCancel
 {
		background: url("<?php echo base_url();?>images/test-vs-btn.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: medium none;
    box-shadow: none !important;
    color: #ffffff;
    cursor: pointer;
    font-size: 14px;
    height: 34px;
    line-height: 32px;
    margin-top: 4px !important;
    outline: medium none;
    text-align: center;
    text-decoration: none;
    width: 110px;
 }
 
	.ui-dialog .ui-dialog-titlebar
	{
    padding: 0.0em 1em !important;
    position: relative;
}
.ui-helper-clearfix:before, .ui-helper-clearfix:after {
    content: "";
    display: none !important;
}
</style>

<!--RESPONSIVE START -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/home/responsive.css');?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<script src="<?php echo base_url('js/home/responsive.js');?>"></script>
<!--RESPONSIVE END -->
<!--Bing code Start -->
<meta name="msvalidate.01" content="25F7B9DF78B781297C03C29CF0CF118B" />
<!--Bing code End -->

<!-- New Home page Layout -->
<link href="<?php echo base_url('css/home/new-style.css');?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/home/new-responsive.css');?>" rel="stylesheet" type="text/css">
<!-- end -->
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
 
<body onLoad="wireUpEvents()" class="ly-index">
 
 <?php include_once FCPATH."idle/idle.php";?>
 
<div id="gsessionDialog" style="display:None;">
			<div class="ratelist">
				<span class="title" style="float:left;margin-top:10px;margin-bottom:15px;font-size:16px;"><?php echo $areyoualready;?></span>  
			</div>
			<br><br><br>
			<p><input type="button" value="Yes" onClick="goLogin();" id="buttonOk" class="blu-btn"/>
			<input type="button" value="No" onClick="GoRegister();" id="ButtonCancel"  class="blu-btn"/>
			</p>
		</div>
		
		
	
 <!-- Google Tag Manager -->
 

<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-T8WV8L"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T8WV8L');</script>
<script type="text/javascript">
olark('api.chat.updateVisitorNickname', {
    snippet: "Virang1"
});
</script>
<!-- End Google Tag Manager -->
<!-- riveted js -->

<script>riveted.init();</script>
<!-- End -->
	<!--HEADER START -->
	    
	<?php if(!$login):?>
	
    <div class="header_login" id="header_login">
    	<div class="wrapper">
    		<form action="<?php echo Base_url("user/login");?>" method="post" id="formLogin">
        	<div class="top_login clearfix">
            	<span class="log_text"><!--Sign In--><?php echo $SIGN_IN;?></span>
                <div class="log_input"><input name="email" placeholder="<?php echo $lEMAIL;?>" type="text" id="email"></div>
                <div class="log_input">
					<input name="password"  placeholder="<?php echo $lPASSWORD;?>"  type="password" size="25" class="iposition fake_password_1">
                	<input name="password" type="password" size="25" class="iposition password_1" style="display:none;">
					<input type="hidden" value="no" name="isgroup" id="isgroup">
					</div>                
                <input type="submit" value="<?php echo $llogin;?>" name="login" class="signin">
                <a href="<?php echo base_url('user/forget');?>" class="forgot_pass"><!--Forgot password--><?php echo $lforget;?></a>
                <a href="#" class="close_btn" id="close_btn"></a>
            </div>
            </form>
        </div>
    </div>
    <?php endif;?>

    <?php $current_uri1 = $this->uri->segment(2);?>
    <!--SIGNUP FORM START -->
	<?php if(!$login):?>
    <div class="floating_form signup-top" id="signup_form_floating">
        <div class="signup_form" id="signup_form1">
            <div class="sf_padding">
	    		<div class="sf_txt"><?php echo $lsign_up;?>: </div>
	            <form style="display:block;" action="<?php echo Base_url('user/registerDo');?>" method="POST" id="registerForm1">
	            	<div class="sf_select" id="rselect">
						<input type="hidden" name="roleId" id="roleId1" value='0'>
		            	<!--<span class="select_box_holder sel_width_215">
		                    <select id="roleId1" name="roleId" class="cu_dds">
		                        <option value="9"><?php echo $lIAMA;?></option>
                                <option value="0"><?php echo $member;?></option>
								<option value="4"><?php echo $school;?></option>
								<option value="5"><?php echo $affiliate;?></option>
		                    </select>
		                </span>
						<span id="roleId_required" style="color:red;display:none;"><b>Select</b></span>
						<span style="color:red;display:none;font-size:14px;margin-top:40px;" id="rid1"><?php echo $selectuser; ?></span>-->
					</div>
		            <div class="sf_input" id="fnamered">
		            	<!--<input name="username" type="text" value="First Name" size="25" class="txtbox">-->
		            	<input id="firstName1" type="text" value="" name="firstName" placeholder="<?php echo $lFIRSTNAME;?>" size="25" class="txtbox" />
						<span id="firstName_required" style="color:red;display:none;"><b>Firstname is required</b></span>
						<span style="color:red;display:none;font-size:14px;margin-top:10px;" id="fname1"><?php echo $enterfname;?></span>	

					</div>
		            <div class="sf_input" id="ered">
		            	<!--<input name="username" type="text" value="Email" size="25" class="txtbox">-->
		            	<input id="email1" type="text" value="" name="email" placeholder="<?php echo $lEMAIL;?>" size="25" class="txtbox"/>
            		<span id="email_required" style="color:red;display:none;"><b>Email is required</b></span>
            		<span id="email_invalid" style="color:red;display:none;"><b>Email is invalid</b></span>
					<span id="email_taken" style="color:red;display:none;font-size:14px;margin-top:10px;"><b><?php echo $emailTaken;?></b></span>
					<span style="color:red;display:none;font-size:14px;margin-top:10px;" id="remail1"><?php echo $enteremail;?></span>
					<span style="color:red;display:none;font-size:14px;margin-top:10px;" id="vremail1"><?php echo $entervalidemail;?></span>	
					</div>
		            <div class="sf_input sf_input_pass" id="passred">
	                  	<input autocomplete="off" type="text" value="" name="password" placeholder="<?php echo $lPASSWORD;?>" size="25" class="txtbox iposition fake_password"/>
		            	<!--<input name="username" type="text" value="Password" size="25" class="txtbox iposition fake_password">-->
		                <input autocomplete="off" id="password1" name="password" type="password" size="25" class="txtbox iposition password" style="display:none;">
						<span style="color:red;display:none;font-size:14px;margin-top:40px;" id="pass1"><?php echo $enterpass;?></span>
						<span style="color:red;display:none;font-size:14px;margin-top:40px;" id="passlong"><?php echo $sixmin;?></span>
		            </div>
		            <div class="sf_input sf_input_pass" id="cpassred">
		            	<input autocomplete="off" type="password" value="" name="cpassword" placeholder="<?php echo $lCPASSWORD;?>" size="25" class="txtbox iposition" id="fake_confirm_password1"/>
		            	<!--<input name="username" type="text" value="Confirm Password" size="25" class="txtbox iposition" id="fake_confirm_password">-->
		                <input autocomplete="off" name="cpassword" type="password" size="25" class="txtbox iposition" id="confirm_password1" style="display:none;">
		                <input autocomplete="off" name="cpassword" type="password" size="25" class="txtbox iposition" id="confirm_password111" style="display:none;">
						<span style="color:red;display:none;font-size:14px;margin-top:42px;" id="cpassconf"><?php echo $confpass;?></span>
						<span style="color:red;display:none;font-size:14px;margin-top:42px;" id="cpassconf1"><?php echo $passmissmatch;?></span>
		            </div>
		            
		            <input name="signup" onClick="return frmvalidate();" type="button" value="<?php echo $lsign_up;?>" class="signup_btn" id="registerButton1" >
				<input type="hidden" name="regPage"   value="ppc">
				<input type="hidden" name="regReturn" value="<?php echo Base_url();//echo Base_url('index/index');?>">
					<input type="hidden" name="refid"   value="u2x223w274">
				
				</form>
                <a href="#" class="close_btn" id="close_btn"></a>
	        </div>
        </div>
    </div>
	<?php endif;?>
    <!--SIGNUP FORM END -->
    
	<?php //echo $current_uri2 = $this->uri->segment(2);die;?>
    
    <div class="header">
    	<div class="wrapper clearfix">
        	<div class="hdr-wdt">
        	<a href="<?php echo base_url();?>"><img src="<?php echo Base_url("images/main/logo-big.gif");?>" alt="TheTalkList" title="TheTalkList" class="logo"></a>
            <a id="nav-toggle" href="#"><span></span></a>
            <?php
			$arrVal 	= $this->lookup_model->getValue('1236', $multi_lang);		$BE_A   		= $arrVal[$multi_lang];
			?>
            <div class="top_navi">
            	<!-- <div class="navi_col top_link_hover">
                	<ul id="top_navi" class="tpNav1">
	                	<li><a href="<?php echo Base_url("students/index");?>" class="top_link students"><!--Students--><?php //echo $BE_A; ?><!--<span><?php //echo $stu;?></span></a>
                        	
                        </li>
                    </ul>
                </div>  -->
				
				<div class="navi_col navi_col2">
					<ul id="top_navi">
						<li>
							<a href="<?php echo Base_url("students/index");?>" class="top_link students"><!--Students--><?php echo $BE_A; ?><span><?php echo $stu;?></span></a>
						</li>
					</ul>
				</div>
            	<div class="navi_col">
                	<ul id="top_navi" class="tpNav2">
	                	<li><a href="<?php echo Base_url("tutor/index");?>" class="top_link tutors"><!--Tutors--><?php //echo $lTutors;?><?php echo $BE_A; ?><span><?php echo $tutor;?></span></a>
                        
                        </li>
                    </ul>
                </div>
				
								<!-- add new menu organization  haren -->
				
			<div class="navi_col">
                	<ul id="top_navi" class="tpNav3">
	                	<li><a href="<?php echo Base_url("school/index");?>" class="top_link school"><span><?php echo $schoolProgram; ?></span></a>
                        	
                        </li>
                    </ul>
                </div>
					
				
                <?php if(!$login):?>
                <div class="navi_col signinbtn">
						
                	<input name="signin" type="submit" value="<?php echo $lSIGN_IN;?>" class="signin" id="signin_btn">
                     <?php if(!$login):?>
				<a style="cursor:pointer" class="signup popup-sign"><?php echo $lsign_up;?> >></a>
                <?php endif;?>
					<ul id="top_navi" class="tpNav3">
	                	<li><a style="margin-left:30px;color:#3399CC;"  class="viewsite"><?php //echo $viewsite;?><?php echo $cnglang ?>></a>
	                		<ul style="font-size:1em; position:absolute; background:#666; width:100%; left:0; top:21px; display:none;">
                                <li><a onClick="changeLanguage('en');" class="multi_lang_change">English</a></li>
                                <li><a onClick="changeLanguage('es');" class="multi_lang_change">Español</a></li>
								<li><a onClick="changeLanguage('fr');" class="multi_lang_change">Français</a></li>
                                <li><a onClick="changeLanguage('ch');" class="multi_lang_change">简体中文</a></li>
                                <li><a onClick="changeLanguage('tw');" class="multi_lang_change">繁體中文</a></li>
                                <li><a onClick="changeLanguage('jp');" class="multi_lang_change jp">日本語</a></li>
                                <li><a onClick="changeLanguage('kr');" class="multi_lang_change">한국어</a></li>
                                <li><a onClick="changeLanguage('pt');" class="multi_lang_change">Português</a></li>
								
                        	</ul>
	                	</li>
                    </ul>
                </div>
                <?php else:?>
				<div class="navi_col signinbtn">
					<div class="welcome_sec">
					<?php if($this->session->userdata['roleId']==5){?>
					<a href="<?php echo Base_url("user/Affiliate");?>"><?php echo $lwelcome; ?>, <?php echo ucfirst($this->session->userdata['welcomeuser']);?>  </a><em><br></em>  <a id="xOutUser" href="<?php echo Base_url("user/slogout");?>"><?php echo $llogout?></a>
					<?php }else {?>
					<a href="<?php echo Base_url("user/dashboard");?>"><?php echo $lwelcome; ?>, <?php echo ucfirst($this->session->userdata['welcomeuser']);?>  </a><em><br></em>  <a id="xOutUser" href="<?php echo Base_url("user/slogout");?>"><?php echo $llogout?></a>
				 <?php }?>	
					</div>
					<ul id="top_navi" class="tpNav3">
	                	<li><a style="margin-left:20px;color:#3399CC;margin-top:-21px;"  class="viewsite"><?php //echo $viewsite;?><?php echo $cnglang ?>></a>
	                		<ul style="font-size:1em; position:absolute; background:#666; width:100%; left:0; top:21px; display:none;">
                                <li><a onClick="changeLanguage('en');" class="multi_lang_change">English</a></li>
                                <li><a onClick="changeLanguage('es');" class="multi_lang_change">Español</a></li>
								<li><a onClick="changeLanguage('fr');" class="multi_lang_change">Français</a></li>
                                <li><a onClick="changeLanguage('ch');" class="multi_lang_change">简体中文</a></li>
                                <li><a onClick="changeLanguage('tw');" class="multi_lang_change">繁體中文</a></li>
                                <li><a onClick="changeLanguage('jp');" class="multi_lang_change jp">日本語</a></li>
                                <li><a onClick="changeLanguage('kr');" class="multi_lang_change">한국어</a></li>
                                <li><a onClick="changeLanguage('pt');" class="multi_lang_change">Português</a></li>
								 
							</ul>
	                	</li>
                    </ul>
					
				</div>
                <?php endif;?>
            </div>
            </div>
       	</div>
       
    </div>
    <!--HEADER END -->
	<?php  echo $content_for_layout?>

	<!--FOOTER START -->
   
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
			//--R&D@Jan-24	:	AutoUpdate BookNow status
			$('#booknowPopup').show();
			setTimeout(function(){ booknowno();},300000);
			window.location.href = '<?php echo base_url('user/slogout');?>';
			//--R&D@Jan-24	:	AutoUpdate BookNow status
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
		booknowexpTime = getCurrentTime() + 2;
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
	//var lgbycls = '<?php echo base_url();?>user/slogoutByBroserClose';
	function wireUpEvents(){
		//alert('Helllo');
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
		//alert(validNavigation);
		
		window.addEventListener('beforeunload',function u(e){
		 if (!validNavigation) {
		 		$.get("<?php echo base_url();?>user/slogoutByBroserClose");
				//alert(validNavigation);
				window.onbeforeunload = null;
				$.ajax({
					  dataType:'json',
					  type: 'GET',
					  url: "<?php echo base_url();?>user/slogoutByBroserClose",
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
	}
	// Wire up the events as soon as the DOM tree is ready
	$(document).ready(function() {
		//wireUpEvents();  
	}); 
	$(window).load(function() {
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
		self.location.href = "<?php echo base_url();?>user/slogout";
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
<script src="<?php echo base_url('js/home/global.js');?>"></script>
<!--JQUERY END -->
<!--JQUERY TESTIMONIALS START -->
<script src="<?php echo base_url('js/home/jquery.cycle.lite.js');?>"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#testimonials').cycle({
		fx: 'fade'
	});
});

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
		var register_btn  = $('#register_btn, .register_btn2');
		register_btn.click(function(){
			<?php 
			 if(isset($deviceType) and ($deviceType == "phone")) {?>
				self.location.href = "<?php echo base_url()."user/signup";?>"; 
				return true;
			 <?php } else {?>
				if(signup_form.is(':hidden')){
					$("html, body").animate({ scrollTop: 124 }, 800);
					signup_form.slideDown(300);
				}else{
					signup_form.slideUp(300);
				}
				return false;
			 <?php }?>
		})
		
		
		
		//---FormValidation - R&D@Dec-12-2013
		function emailValidate(a){var b="";var c=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/; if(a.search(c)==-1){b="error"}return b}
		function isAlphabets(sText) {	
			var ValidChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'-";
			var IsAlphabet=true;
			var Char;
			for (i = 0; i < sText.length && IsAlphabet == true; i++) { 
				Char = sText.charAt(i);		
				if(Char != ' ') {
					if (ValidChars.indexOf(Char) == -1) { IsAlphabet = false; }		
				}
			}
			return IsAlphabet;   
		}
		$( "#registerForm" ).submit(function( event ) {
		    return true;
			event.preventDefault();
			
			var error 			= false;
			var $form 			= $( this );
			var newUrl          = window.location+'user/registerDo';
			var url 			= $form.attr( "action" );
			//var url 			= window.location+'user/registerDo';
			//var url 			= '<?php echo Base_url("user/registerDo");?>';
			

			var className 		= $('#roleId_input_-1').attr('class');
			var roleId       	= $('.selected').attr('id');
			if(roleId == 'roleId_input_1') {us_roleId=1;} else {us_roleId=0;}
			var us_firstName 	= $form.find( "input[name='firstName']" ).val();
			var us_email 		= $form.find( "input[name='email']" ).val();
			var us_password 	= $('#password').val();
			
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
		url: '<?php echo Base_url("user/ajaxLang");?>',
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

<?php if(isset($_SESSION['isRegError']) && $_SESSION['isRegError'] == TRUE){ ?>

<?php $_SESSION['isRegError'] == FALSE; unset($_SESSION['isRegError']); }  ?>


<!--JQUERY SELECTBOX END -->

<!-- new layout end js -->
<script type="text/javascript"> 
	$(function() {
		$('.support-nav').hover(function() { 
			$('.support-drp').show(); 
		}, function() { 
			$('.support-drp').hide(); 
		});
	});
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

<script>
$(function(){
	$('input[placeholder]').placeholder();
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
        appId      : '1444248622514714', // App ID
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

//----xOutUser
$('#xOutUser').click(function(){
var currentDomain = $('#xOutUser').attr('href');
if(currentDomain == 'https://techno-sanjay/dev.thetalklist.com/user/slogout'){
}else if(currentDomain == 'https://dev.thetalklist.com/user/slogout'){
	$.ajax({
		type: "POST",
		url: 'https://cdn-dev.thetalklist.com/user/slogout',
		data: { }
	}).done(function( msg ) {
});
}else{
	$.ajax({
		type: "POST",
		url: 'https://dev.thetalklist.com/user/slogout',
		data: { }
	}).done(function( msg ) {
  	});
}
});
//----xOutUser

//window.onbeforeunload = function()  {$.get("<?php echo base_url();?>user/slogoutByBroserClose");return true;}

</script>
<script>
$('.bxslider').bxSlider({
  auto: true,
  autoControls: true,
  pause:9000,
  setInterval:9000
});
</script>  
<script>
$(function(){
	$('#register_btn, .register_btn2').click(function(){
		//alert('iiii');
		$('.banr-pro1').hide();
		$('.banr-pro2').show();
		$('.hw-rgt h3').show();
		
	});
});

$("#register_btn, .register_btn2").click(function(){
  $(".how_it_works").addClass("signup-show");
}); 
</script> 
<script>
$(function(){
	$('.popup-sign').click(function(){
		 //alert('iiii');
		 window.scrollTo(0,0);

		 <?php 
		 if(isset($deviceType) and ($deviceType == "phone")) {?>
			self.location.href = "<?php echo base_url()."user/signup";?>"; 
			return true;
		 <?php } else {?>
			$('#signup_form_floating').slideDown();
		 <?php }?>
	});
	$('.close_btn').click(function(){
		//alert('iiii');
		$('#signup_form_floating').slideUp();
		$('#signup_form').slideUp();
	});	
	
});


$(".tpNav1 li a").hover(function(){
    $(".tpNav1 li a").next("ul").show();
	//$('.top_navi .navi_col #top_navi li > ul').show();
},function(){
    $(".tpNav1 li a").next("ul").hide();
});
$(".tpNav2 li a").hover(function(){
    $(".tpNav2 li a").next("ul").show();
},function(){
    $(".tpNav2 li a").next("ul").hide();
});
/*$(".tpNav3 li a.school").hover(function(){
    $(".tpNav3 li a.school").next("ul").show();
},function(){
    $(".tpNav3 li a.school").next("ul").hide();
});*/
$(".signinbtn .tpNav3 li a").hover(function(){
    $(".signinbtn .tpNav3 li a").next("ul").show();
},function(){
    $(".signinbtn .tpNav3 li a").next("ul").hide();
});


</script>
<!-- new exit popup code start-->
<script type="text/javascript">
    (function(e,a){
        var t,r=e.getElementsByTagName("head")[0],c=e.location.protocol;
        t=e.createElement("script");t.type="text/javascript";
        t.charset="utf-8";t.async=!0;t.defer=!0;
        t.src=c+"//front.optimonk.com/public/"+a+"/js/preload.js";r.appendChild(t);
    })(document,"12495");
</script>
<!-- new exit popup code end-->

</body>
</html>
<?php
if($this->session->userdata("registermsg")){
	$this->session->unset_userdata('registermsg');	 
	$arrVal 	= $this->lookup_model->getValue('1313', $multi_lang);	$lngregSucMsg  	= $arrVal[$multi_lang];
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#dialog").html('<h2 class="txtblue martoppl10"><?php echo $lngregSucMsg;?></h2><a href="#" class="go-btn">Go</a>');
	$("#dialog").dialog({modal: true,title:" ",resizable:false});
	$(".go-btn").click(function(){
		//location.reload();
		$('#dialog').dialog('close');
	});
});
</script>
<?php 
}

?>






























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
$arrVal 	= $this->lookup_model->getValue('234', $multi_lang);
$lspeak_english = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('472', $multi_lang);	$lFIRSTNAME   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1017', $multi_lang);	$enterfname   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('470', $multi_lang);	$lEMAIL   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1019', $multi_lang);	$enteremail   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1020', $multi_lang);	$entervalidemail   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1018', $multi_lang);	$emailTaken  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('471', $multi_lang);	$lPASSWORD   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1021', $multi_lang);	$enterpass   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1022', $multi_lang);	$sixmin   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('540', $multi_lang);	$lCPASSWORD   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1023', $multi_lang);	$confpass   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1024', $multi_lang);	$passmissmatch   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('221', $multi_lang);
$lSIGN_UP = $arrVal[$multi_lang];
?>
<!--CSS END -->
<script src="<?php echo base_url('js/home/html5.js');?>"></script>
<!--HTML 6 VIDEO START -->
<script src="https://api.html5media.info/1.1.6/html5media.min.js"></script>
<link href="https://vjs.zencdn.net/4.2/video-js.css" rel="stylesheet">
<script src="https://vjs.zencdn.net/4.2/video.js"></script>
<style>
.class_two{
	border:none;
}
.header{
	display:none;
}
.page_title{
	display:none;
}
.footer{
	display:none;
}
.top_image{
	width:30%;
}
.top_image_left{
	width:40%;
}
.header_top{
	width:33%; 
}
.banner_content_main{
	top:88% !important;
	padding-bottom:0px;
}
.information{
	font-size:20px;
}
.footer_image{
	width:14%;
}
.sc_info_image{
	width:38%;
} 
.after_banner_left{
	font-size:40px;
	padding-top:8px;
}
.after_content{
	font-size:24px;
}
.index-banner{
	min-height:600px;
}
@media only screen and (max-width: 767px){
.banner_content_main h1{
	font-size: 18px;
	padding:1px;
	
}
.index-banner{
	min-height:100%;
}
.banner_slogan_1{
	font-size:15px !important;;
	left:0% !important;
	top:3% !important;
}
.banner_content_main{
	top:60% !important;
}
.header_top{
	width:100%; 
	padding:5%;
}
.information{
	font-size:16px;
}
.footer_image{
	width:40%;
}
.top_image_left{
	width:50%;
}
.top_image{
	width:40%;
}
.footer_info{
	margin-top:20px;
}
.sc_info_image{
	width:45%;
	height:auto;
} 
.after_banner_left{
	font-size:22px;
}
.after_content{
	font-size:16px;
}
}
@media only screen and (max-width: 321px){
.banner_content_main h1{
	font-size: 14px;
	padding:1px;

}
.banner_content_main{
	top:60% !important;
}
.information{
	font-size:14px;
}
.after_banner_left{
	font-size:22px;
}
}
</style>
<script>

$(document).ready(function() {
    $("html,body").scrollTop(0);
});

$(window).load(function() {
 
  $(window).scrollTop(0);
  $("html,body").scrollTop(0);
})
function closeConfirm()
{
	$('#confirmaccountDialog').dialog('close');
}
</script>
<script>
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
				  url: '<?php echo Base_url("user/ajax_checkjp");?>',
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
		document.getElementById("rcpass").style.border="0px solid red";	
		document.getElementById('cpass12d').style.display = 'none';
	}
	$('#registerFormindx').submit();
}

 
 
</script>
<!-- added by haren for firm submit on key -->
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/jquery-ui.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/school_homepage.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/sc_style.css');?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/sc_responsive.css');?>">
<script type="text/javascript">
$(function(){
    $('input').keydown(function(e){
        if (e.keyCode == 13) {
			validateFrm();
             
        }
    });
}); 
jQuery(document).ready(function($) {
  $('.cercal1').rotate(-24);
});
</script>
<div style="width:100%; text-align:center; padding-top:10px;">
		<h2 style="font-size:32px; color:#3399CC"><i>An International Education Partnership</i></h2>
</div>
	<div style="width:100%; margin:0 auto; padding:10px;">

		<div class="header_top"  style="text-align:center; margin: 0 auto;">
		<img src="<?php echo base_url("images/youth4globalgoals.png"); ?>" class="top_image_left" style="width:31%;">
		<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url("images/main/logo.gif"); ?>" class="top_image" style="margin-bottom:4%; width:34%; margin-left:21%;"></a>
		</div>
		
	</div>
<div class="index-banner">
	<div class="container" style="max-width:100%; float:left;  position:relative">
	<div class="stucontainer" style="position:relative;">
		<img src="<?php echo base_url("images/BannerImg.jpg"); ?>" width="100%" style="border-top:4px solid #d7bc4d; ">
       
	</div>
	 
	<div class="information" style="text-align:center; width:100%; padding-bottom:20px; color:#fff; background-color:#52565E">
	<div style="left:0; float:left; width:100%;  margin-top:-4px; ">
			<h1 class="banner_slogan_1" style="font-size:36px; background-color:#037EF3; padding:12px; border-bottom:4px solid #d7bc4d;">Your educational talents and donations benefit our educational programs.</h1>

        </div>
		<div style="width:33%; float:left; color:#fff; background-color:#52565E; border-right:4px solid #d7bc4d;"> 
			<h1 class="after_banner_left">500,000</h1>
			<p style="color:#fff; padding-bottom:20px; padding-top:0px; font-size:16px;">Project Hours</p>
		</div>
		<div style="width:34%; float:left; color:#fff; background-color:#52565E; border-right:4px solid #d7bc4d;"> 
			<h1 class="after_banner_left">2700</h1>
			<p style="color:#fff;  padding-bottom:20px; padding-top:0px; font-size:16px;">Volunteers</p>
		</div>
		<div style="width:33%; float:left; color:#fff; background-color:#52565E"> 
			<h1 class="after_banner_left">20</h1>
			<p style="color:#fff;  padding-bottom:20px; padding-top:0px; font-size:16px;">Countries</p>
		</div>
	</div>
	<div style="width:100%;">
		<div style="width:100%; text-align:center;">
			<input style="background-color:#E26A09; cursor:pointer; height:50px; border:none; width:34%; margin:1% auto; color:#fff;" name="signup" type="button" value="<?php echo $lSIGN_UP;?>" class="signup_btn popup-sign" id="registerButton" >
		</div>
		<div class="after_banner_left" style="width:100%; color:#333; padding-top:0px; text-align:center; margin:0 auto 2% auto;">
			Let's bring education to all!
		</div>
		<div class="after_content" style="width:100%; text-align:center;   color:#333; margin:0 auto 1%; auto">
			Education projects that AIESEC enables when you donate your credits.
		</div>
		<div style="width:100%; float:left">
			<div style="width:33%; float:left">
				<img src="<?php echo base_url("images/img1_2nd.png"); ?>" style="width:99%;">
			</div>
			<div style="width:33%; float:left">
			<img src="<?php echo base_url("images/img2_2nd.png"); ?>" style=" width:99%;">
			</div>
			<div style="width:34%; float:left">
				<img src="<?php echo base_url("images/img3_about.png"); ?>" style="width:100%;">
			</div>
		</div>
	
	</div>
		
		<div class="footer_info" style="width:100%; float:left; margin-top: -3px;">
			<div style="text-align:center;float:left;background-color:#037EF3;width: 100%;margin-bottom: 15px;padding: 10px;">
			<img src="<?php echo base_url("images/aisec_footer.png"); ?>" class="footer_image" >
			
			</div>
		</div>
		
<!--		<table>
			<tr height="10px">
				<td></td>
			</tr>
			<tr>
				<td width="50%">
					<table>
						<tr><td colspan=3 style="font-size:24px;">Learn about our peer to peer educational model. You ask your students to sign up, and we handle all the backend details.</td></tr>
						<tr><td><img src=''></td><td><img src=''></td><td><img src=''></td></tr>
					</table>
				</td>
				<td>
					<table colspan="5" style="background-color:#000;" width="80%">
						<tr height="30px">
							<td>Sign up and we'll start a brainstorm.</td>
						</tr>
						<tr>
							<td>
							<form style="display:block;" action="<?php echo Base_url('user/registerDo');?>" method="POST" id="registerFormindx">
								<div class="sf_select" id="rselect1">
									<input type="hidden" name="roleId" id="roleId" value='0'>
								</div>
								<div class="sf_input" id="redfname">
									<input id="firstName" type="text" value="" name="firstName" placeholder="<?php echo $lFIRSTNAME;?>" size="25" class="txtbox" />
									<span style="color:red;display:none;font-size:17px;padding-top:10px;" id="fname"><?php echo $enterfname;?></span> <span id="firstName_required" style="color:#DFC964;font-size:15px;display:none;"><b><?php echo $enterfname;?></b></span> </div>
								<div class="sf_input" id="redmail">
								<input id="mail" type="text" value="" name="email" placeholder="<?php echo $lEMAIL;?>" size="25" class="txtbox"/>
								<span id="email_required" style="color:#DFC964;font-size:15px;font-size:15px;display:none;padding:1em"><b><?php echo $enteremail;?></b></span> <span id="email_invalid" style="color:#DFC964;display:none;padding:1em"><b><?php echo $entervalidemail;?></b></span> <span style="color:red;display:none;font-size:17px;margin-top:10px;" id="remail"><?php echo $enteremail;?></span> <span style="color:red;display:none;font-size:17px;margin-top:10px;" id="vremail"><?php echo $entervalidemail;?></span> <span id="email_taken1" style="color:red;display:none;font-size:17px;margin-top:10px;"><b><?php echo $emailTaken;?></b></span> </div>
							  <div class="sf_input sf_input_pass" id="rpass">
								<input type="text" value="" name="password" placeholder="<?php echo $lPASSWORD;?>" size="25" class="txtbox iposition fake_password"/>
								<input autocomplete="off" id="password" name="password" type="password" size="25" class="txtbox iposition password" style="display:none;">
								<span style="color:red;display:none;font-size:17px;margin-top:40px;" id="pass"><?php echo $enterpass;?></span> <span style="color:red;display:none;font-size:17px;margin-top:42px;" id="passlong1"><?php echo $sixmin;?></span> </div>
							  <div class="sf_input sf_input_pass" id="rcpass">
								<input autocomplete="off" type="password" value=""  id="confirm_password" name="cpassword" placeholder="<?php echo $lCPASSWORD;?>" size="25" class="txtbox iposition" id="fake_confirm_password12"/>
								<input autocomplete="off" name="cpassword" type="password" size="25" class="txtbox iposition" id="confirm_password12" style="display:none;">
								<span style="color:red;display:none;font-size:17px;margin-top:40px;" id="cpass12"><?php echo $confpass;?></span> <span style="color:red;display:none;font-size:17px;margin-top:33px;" id="cpass12d"><?php echo $passmissmatch;?></span> </div>
							  <input name="signup" type="button" onclick="return validateFrm();" value="<?php echo $lSIGN_UP;?>" class="signup_btn" id="registerButton" >
							  <input type="hidden" name="regPage"   value="ppc">
							  <input type="hidden" name="refid"   value="<?php echo $current_uri1 ;?>">
							  <input type="hidden" name="regReturn" value="<?php echo Base_url();//echo Base_url('index/index');?>">
							</form>
							</td>
						</tr>
						
					</table>
				</td>
			</tr>
		</table>   -->
	</div>
</div>