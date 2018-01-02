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

<div class="index-banner" style="min-height:600px;">
	<div class="container" style="max-width:100%; position:relative">
		<img src="<?php echo base_url("images/dreamstime_xxl_69006964-x1600-blur.png"); ?>" width="100%">
        <div class="banner_content_main" style="right:0;left:inherit;">
			
        </div>
		<h1 class="school_about">We amplify vibrant student communities.</h1>

		<div class="school_main">
			<div class="school_left">
				<div class="school_content_signin">					
					Learn about our peer to peer educational model. You ask your students to sign up, and we handle all the backend details.
				</div>
				
				<div class="school_content_info">
					<div class="sc_info">
					 <!--  <button style="padding:10px; background-color:#32CD32; border:none;">Payments</button>  -->
						<img src="<?php echo base_url("images/c3.png"); ?>">
						<h4 style="margin-top:10px;">Payments</h4>
					</div>
					<div class="sc_info">
					<!--	<button style="padding:10px; background-color:#32CD32; border:none;">Quality</button> -->
						<img src="<?php echo base_url("images/c2.png"); ?>">	
						<h4>Quality</h4>
					</div>
					<div class="sc_info">
					<!--	<button style="padding:10px; background-color:#32CD32; border:none;">Reports</button> -->					
						<img src="<?php echo base_url("images/c1.png"); ?>">
						<h4 style="margin-top:10px;">Reports</h4>
					</div>
				
				</div>
			</div>
			
			
			<div class="school_right">
				<div class="school_right_content">
					<div class="sc_information">
						<h3 style="margin-left:3%; margin-top:2%;">
							Sign up and we'll start a brainstorm.
						</h3>
					</div>
					<div class="school_signupform">
						<form style="display:block;" action="<?php echo Base_url('user/registerDo');?>" method="POST" id="registerFormindx">
							<div class="sf_select" id="rselect1">
								<input type="hidden" name="roleId" id="roleId" value='4'>
							</div>
							<div class="sf_input" id="redfname">
								<input style="width:90%; margin-left:5%; margin-top:3%; background-color:inherit; height:35px; border:2px solid #ccc; padding-left:20px" id="firstName" type="text" value="" name="firstName" placeholder="<?php echo $lFIRSTNAME;?>" size="25" class="txtbox" />
								<span style="color:red;display:none;margin-left:5%;font-size:17px;padding-top:10px;" id="fname"><?php echo $enterfname;?></span> <span id="firstName_required" style="color:#DFC964;margin-left:5%;font-size:15px;display:none;"><b><?php echo $enterfname;?></b></span> </div>
							<div class="sf_input" id="redmail">
							<input style="width:90%; margin-left:5%; margin-top:3%; background-color:inherit; height:35px; border:2px solid #ccc; padding-left:20px" id="mail" type="text" value="" name="email" placeholder="<?php echo $lEMAIL;?>" size="25" class="txtbox"/>
							<span id="email_required" style="color:#DFC964;font-size:15px;font-size:15px;display:none;padding:1em;margin-left:5%; "><b><?php echo $enteremail;?></b></span> <span id="email_invalid" style="color:#DFC964;margin-left:5%;display:none;padding:1em"><b><?php echo $entervalidemail;?></b></span> <span style="color:red;display:none;font-size:17px;margin-top:10px; margin-left:5%;" id="remail"><?php echo $enteremail;?></span> <span style="color:red;display:none;margin-left:5%;font-size:17px;margin-top:10px;" id="vremail"><?php echo $entervalidemail;?></span> <span id="email_taken1" style="color:red;display:none;font-size:17px;margin-top:10px;margin-left:5%;"><b><?php echo $emailTaken;?></b></span> </div>
						  <div class="sf_input sf_input_pass" id="rpass">
							<input style="width:90%; margin-left:5%; margin-top:3%; background-color:inherit; height:35px; border:2px solid #ccc; padding-left:20px" type="password" value="" name="password" id="password" placeholder="<?php echo $lPASSWORD;?>" size="25" class="txtbox iposition fake_password"/>
							
							<span style="color:red;display:none;font-size:17px;margin-top:40px;margin-left:5%;" id="pass"><?php echo $enterpass;?></span> <span style="color:red;display:none;font-size:17px;margin-top:42px;margin-left:5%;" id="passlong1"><?php echo $sixmin;?></span> </div>
						  <div class="sf_input sf_input_pass" id="rcpass">
							<input style="width:90%; margin-left:5%; margin-top:3%; background-color:inherit; height:35px; border:2px solid #ccc; padding-left:20px" autocomplete="off" type="password" value=""  id="confirm_password" name="cpassword" placeholder="<?php echo $lCPASSWORD;?>" size="25" class="txtbox iposition" id="fake_confirm_password12"/>
							<input autocomplete="off" name="cpassword" type="password" size="25" class="txtbox iposition" id="confirm_password12" style="display:none;">
							<span style="color:red;display:none;font-size:17px;margin-top:40px;margin-left:5%;" id="cpass12"><?php echo $confpass;?></span> <span style="color:red;display:none;font-size:17px;margin-top:33px;margin-left:5%;" id="cpass12d"><?php echo $passmissmatch;?></span> </div>
						  <input style="margin-left:5%; background-color:#3399CC; border:none; color:#fff; border-radius:5px;" name="signup" type="button" onclick="return validateFrm();" value="<?php echo $lSIGN_UP;?>" class="signup_btn" id="registerButton" >
						  <input type="hidden" name="regPage"   value="ppc">
						  <input type="hidden" name="refid"   value="">
						  <input type="hidden" name="regReturn" value="<?php echo Base_url();//echo Base_url('index/index');?>">
						</form>
					</div>
				</div>
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