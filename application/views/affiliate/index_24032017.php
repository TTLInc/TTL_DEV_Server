<!doctype html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
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

$arrVal 	= $this->lookup_model->getValue('234', $multi_lang);
$lspeak_english = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('239', $multi_lang);
$lfree_session = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('211', $multi_lang);
$lflexible_pricing = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('212', $multi_lang);
$lalways = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('213', $multi_lang);
$lhuge_selection = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('214', $multi_lang);
$lthousand_selection = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('215', $multi_lang);
$lregistration_now = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('216', $multi_lang);
$lrisk_free = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('217', $multi_lang);
$lplay_sample_video = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('218', $multi_lang);
$lplay_how_it_works = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('219', $multi_lang);
$lwe_welcome = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('220', $multi_lang);
$ltutors = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('221', $multi_lang);
$lsign_up = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('222', $multi_lang);
$lsearch = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('223', $multi_lang);
$lschedule = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('224', $multi_lang);
$ltalk = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('225', $multi_lang);
$lchoose_tutor = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('226', $multi_lang);
$llook_tutor = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('227', $multi_lang);
$lcustom_video = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('228', $multi_lang);
$lamerican_tutor = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('229', $multi_lang);
$lyou_get_tutor = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('230', $multi_lang);
$lno_contracts = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('231', $multi_lang);
$lyou_get_flexible = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('232', $multi_lang);
$lyour_topic = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('233', $multi_lang);
$lyou_get_customize = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('240', $multi_lang);
$li_am_student = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('241', $multi_lang);
$li_am_tutor = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('4', $multi_lang);
$lhow_it_works = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('237', $multi_lang);
$lwhy = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('232', $multi_lang);
$lyour_topic = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('242', $multi_lang);
$lor = $arrVal[$multi_lang];
//---R&D@Oct-31-2013 : Set Language Variables
$arrVal 	= $this->lookup_model->getValue('470', $multi_lang);	$lEMAIL   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('471', $multi_lang);	$lPASSWORD   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('472', $multi_lang);	$lFIRSTNAME   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('473', $multi_lang);	$lIM_STUDENT   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('474', $multi_lang);	$lIM_TUTOR   	= $arrVal[$multi_lang];
//---R&D@Oct-31-2013 : Set Language Variables

/** added 25 Nov 13 */
$arrVal = $this->lookup_model->getValue('111', $multi_lang);$student =  $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('110', $multi_lang);$tutor = $arrVal[$multi_lang];
/*$lCPASSWORD = "Confirm Password";
$lIAMA ="I am a...";*/
$arrVal 	= $this->lookup_model->getValue('540', $multi_lang);	$lCPASSWORD   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('541', $multi_lang);	$lIAMA   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('617', $multi_lang);	$lTUTOR_DETAILS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('557', $multi_lang);	$lOVERVIEW   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('558', $multi_lang);	$lBECOME_TUTOR   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('559', $multi_lang);	$lLEVELS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('560', $multi_lang);	$lMAKE_MONEY   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('561', $multi_lang);	$lMARKET_YOURSELF   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('562', $multi_lang);	$lOVERVIEW_DESC   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('563', $multi_lang);	$lIT_FLEXIBLE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('564', $multi_lang);	$lSET_YOUR_RATE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('565', $multi_lang);	$lTECH_FROM_ANYWHERE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('566', $multi_lang);	$lIT_GIVES_YOU_EXPERIENCE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('567', $multi_lang);	$lINTERNATIONAL_EDU   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('568', $multi_lang);	$BUILD_YOUR_RESUME   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('569', $multi_lang);	$lIT_CUTTING_EDGE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('570', $multi_lang);	$lPRIVATE_1TO1   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('571', $multi_lang);	$lSOCIAL_NETWORKING_TOOLS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('572', $multi_lang);	$lLEARNING_WIDGETS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('573', $multi_lang);	$lIT_THE_COOLEST_PART   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('574', $multi_lang);	$lBECOME_TUTOR_DESC   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('575', $multi_lang);	$lMEET_REQUIRE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('576', $multi_lang);	$lHIGH_SPEED_INTERNET   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('577', $multi_lang);	$lWEBCAM_MIC   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('578', $multi_lang);	$lTAKE_E_TRAINING   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('579', $multi_lang);	$lLEARN_CONVERSATION   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('580', $multi_lang);	$lLEARN_TO_USE_OUR_PLATFORM   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('581', $multi_lang);	$lENJOY_THETALKLIST   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('582', $multi_lang);	$lDEVELOP_GLOBAL_REACH   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('583', $multi_lang);	$lSTARTING_MAKING_MONEY   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('584', $multi_lang);	$lLEVELS_DESC   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('585', $multi_lang);	$lLEVEL   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('586', $multi_lang);	$lFREE_PROFILE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('587', $multi_lang);	$lSELL_SESSIONS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('588', $multi_lang);	$lE_TRAINED   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('589', $multi_lang);	$lSELL_VIDEOS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('590', $multi_lang);	$lPREMIUM_RESULTS_PLACEMENT   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('591', $multi_lang);	$lFEE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('592', $multi_lang);	$lSTANDARD   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('593', $multi_lang);	$lFREE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('594', $multi_lang);	$lCERTIFIED   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('595', $multi_lang);	$lFEATURED   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('596', $multi_lang);	$l30_MO   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('597', $multi_lang);	$lMAKE_MONEY_DESC   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('598', $multi_lang);	$lMAKE_MONEY_DESC1   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('599', $multi_lang);	$lSET_YOUR_RATE_AND   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('600', $multi_lang);	$lTUTOR_SESSION   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('601', $multi_lang);	$lAUTO_PAYMENT   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('602', $multi_lang);	$lCREATE_TEACHING_VIDEOS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('603', $multi_lang);	$lSTUDENT_DOWNLOAD   	= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('604', $multi_lang);	$lMARKET_YOURSELF_DESC   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('605', $multi_lang);	$lBUILD_YOUR_PROFILE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('606', $multi_lang);	$lBRIGHT_FRONT   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('607', $multi_lang);	$lINTERESTING_BIOGRAPHY   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('608', $multi_lang);	$l15_SEC_VIDEO   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('609', $multi_lang);	$lBE_AVAILABLE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('610', $multi_lang);	$lOPEN_A_RECURRING   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('611', $multi_lang);	$lACCEPT_FREE_SESSIONS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('612', $multi_lang);	$lENABLE_ON_DEMAND   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('613', $multi_lang);	$lSOCIALIZE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('614', $multi_lang);	$lUSE_LIVE_CHAT   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('616', $multi_lang);	$lUSE_BEEPBOX   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('615', $multi_lang);	$lENGAGE_IN_OUR_SOCIAL   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('663', $multi_lang);	$lSIGN_UP   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('722', $multi_lang);	$lgoldtutor  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('723', $multi_lang);	$lsilvertutor  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('724', $multi_lang);	$lbronzetutor  	= $arrVal[$multi_lang];
$arrVal     = $this->lookup_model->getValue('726', $multi_lang);$school = $arrVal[$multi_lang];

$arrVal     = $this->lookup_model->getValue('868', $multi_lang);$thetalkaffiliate= $arrVal[$multi_lang];
$arrVal     = $this->lookup_model->getValue('869', $multi_lang);$becomeaffi = $arrVal[$multi_lang];
$arrVal     = $this->lookup_model->getValue('870', $multi_lang);$asaninternational = $arrVal[$multi_lang];
$arrVal     = $this->lookup_model->getValue('871', $multi_lang);$signups = $arrVal[$multi_lang];
$arrVal     = $this->lookup_model->getValue('872', $multi_lang);$providrinfo = $arrVal[$multi_lang];
$arrVal     = $this->lookup_model->getValue('873', $multi_lang);$receveaffi = $arrVal[$multi_lang];
$arrVal     = $this->lookup_model->getValue('874', $multi_lang);$deployadv = $arrVal[$multi_lang];
$arrVal     = $this->lookup_model->getValue('875', $multi_lang);$useexisting = $arrVal[$multi_lang];
$arrVal     = $this->lookup_model->getValue('876', $multi_lang);$requestcustom = $arrVal[$multi_lang];

$arrVal     = $this->lookup_model->getValue('877', $multi_lang);$pstAdda = $arrVal[$multi_lang];
$arrVal     = $this->lookup_model->getValue('878', $multi_lang);$minitorincome = $arrVal[$multi_lang];
$arrVal     = $this->lookup_model->getValue('879', $multi_lang);$viewqualify = $arrVal[$multi_lang];

$arrVal     = $this->lookup_model->getValue('880', $multi_lang);$recevemonth = $arrVal[$multi_lang];
$arrVal     = $this->lookup_model->getValue('881', $multi_lang);$stuclick = $arrVal[$multi_lang];
$arrVal     = $this->lookup_model->getValue('882', $multi_lang);$affiiscredited = $arrVal[$multi_lang];
$arrVal     = $this->lookup_model->getValue('883', $multi_lang);$afterfirstpaid = $arrVal[$multi_lang];
$arrVal     = $this->lookup_model->getValue('884', $multi_lang);$affidetail= $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('1016', $multi_lang);	$selectuser   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1017', $multi_lang);	$enterfname   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1018', $multi_lang);	$emailTaken  	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1019', $multi_lang);	$enteremail   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1020', $multi_lang);	$entervalidemail   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1021', $multi_lang);	$enterpass   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1022', $multi_lang);	$sixmin   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1023', $multi_lang);	$confpass   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1024', $multi_lang);	$passmissmatch   	= $arrVal[$multi_lang];
?>
<style>
.class_two
{
	border:1px solid red;
	border-radius: 10px;
}
</style>
<script>
$(function(){
	
	
	//$('input[placeholder]').placeholder();
});

function frmvalidate()
{

//alert($('#fake_confirm_password1').val());
if( $('#roleId1').val() == '9')
{
	document.getElementById('rselect').className += ' class_two';	
	// document.getElementById("rselect").style.border="1px solid red";
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
	//document.getElementById("fnamered").style.border="1px solid red";
	document.getElementById('fnamered').className += ' class_two';
	document.getElementById('fname1').style.display = 'block';
	return false;
}
else
{
	document.getElementById("fnamered").style.border="none";
	document.getElementById('fname1').style.display = 'none';
	
}

if( $('#email1').val() == '')
{
	document.getElementById('ered').className += ' class_two';
	//document.getElementById("ered").style.border="1px solid red";
	document.getElementById('remail1').style.display = 'block';
	return false;
}
else
{
	document.getElementById("ered").style.border="none";
	document.getElementById('remail1').style.display = 'none';
	
}
var mail=($('#email1').val());
var re = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(! re.test(mail))
    {
	 document.getElementById('ered').className += ' class_two';	
	 //document.getElementById("ered").style.border="1px solid red";
	 document.getElementById('vremail1').style.display = 'block';
	return false;
	
	}
	else
	{
		document.getElementById("ered").style.border="none";
		document.getElementById('vremail1').style.display = 'none';
		
	}
if( $('#password1').val() == '')
{
	document.getElementById('passred').className += ' class_two';
	//document.getElementById("passred").style.border="1px solid red";
	document.getElementById('pass1').style.display = 'block';
	return false;
}
else
{
	document.getElementById("passred").style.border="none";
	document.getElementById('pass1').style.display = 'none';
	
}
if( $('#fake_confirm_password1').val() == '')
{
	document.getElementById('cpassred').className += ' class_two';
	//document.getElementById("cpassred").style.border="1px solid red";
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
	//document.getElementById("cpassred").style.border="1px solid red";
	document.getElementById('cpassconf1').style.display = 'block';
	return false;
}
else
{
	document.getElementById("cpassred").style.border="none";
	document.getElementById('cpassconf1').style.display = 'none';
	
}
$('#registerForm1').submit();
/*alert($('#fake_confirm_password').val());
alert($('#cpassword').val());
if( $('#fake_confirm_password').val() == '')
{
	document.getElementById('cpass').style.display = 'block';
	return false;
}
else
{
	document.getElementById('cpass').style.display = 'none';
	
}
alert("d");
var a=$('#password').val();
var b=$('#fake_confirm_password').val()
if(a != b)
{
	alert("nk");
}*/

		return true;
}
</script>
<!--SIGNUP FORM START -->
	<?php if(!$login):?>
    <div class="floating_form" id="signup_form_floating">
        <div class="signup_form" id="signup_form1">
            <div class="sf_padding">
	    		<div class="sf_txt"><?php echo $lsign_up;?></div>
	            <form style="display:block;" action="<?php echo Base_url('user/registerDo');?>" method="POST" id="registerForm1">
	            	<div class="sf_select" id="rselect">
						<input type="hidden" name="roleId" id="roleId1" value='5'>
						
					</div>
		            <div class="sf_input" id="fnamered">
		            	<!--<input name="username" type="text" value="First Name" size="25" class="txtbox">-->
		            	<input id="firstName1" type="text" value="" name="firstName" placeholder="<?php echo $lFIRSTNAME;?>" size="25" class="txtbox" />
						<span id="firstName_required" style="color:red;display:none;"><b><?php echo $enterfname;?></b></span>
						<span style="color:red;display:none;font-size:14px;margin-top:10px;" id="fname1"><?php echo $enterfname;?></span>	

					</div>
		            <div class="sf_input" id="ered">
		            	<!--<input name="username" type="text" value="Email" size="25" class="txtbox">-->
		            	<input id="email1" type="text" value="" name="email" placeholder="<?php echo $lEMAIL;?>" size="25" class="txtbox"/>
            		<span id="email_required" style="color:red;display:none;"><b><?php echo $enteremail;?></b></span>
            		<span id="email_invalid" style="color:red;display:none;"><b><?php echo $entervalidemail;?></b></span>
					<span style="color:red;display:none;font-size:14px;margin-top:10px;" id="remail1"><?php echo $enteremail;?></span>
					<span style="color:red;display:none;font-size:14px;margin-top:10px;" id="vremail1"><?php echo $entervalidemail;?></span>	
					</div>
		            <div class="sf_input sf_input_pass" id="passred">
	                  	<input autocomplete="off" type="text" value="" name="password" placeholder="<?php echo $lPASSWORD;?>" size="25" class="txtbox iposition fake_password"/>
		            	<!--<input name="username" type="text" value="Password" size="25" class="txtbox iposition fake_password">-->
		                <input autocomplete="off" id="password1" name="password" type="password" size="25" class="txtbox iposition password" style="display:none;">
						<span style="color:red;display:none;font-size:14px;margin-top:40px;" id="pass1"><?php echo $enterpass;?></span>
		            </div>
		            <div class="sf_input sf_input_pass" id="cpassred">
		            	<input autocomplete="off" type="password" value="" name="cpassword" placeholder="<?php echo $lCPASSWORD;?>" size="25" class="txtbox iposition" id="fake_confirm_password1"/>
		            	<!--<input name="username" type="text" value="Confirm Password" size="25" class="txtbox iposition" id="fake_confirm_password">-->
		                <input autocomplete="off" name="cpassword" type="password" size="25" class="txtbox iposition" id="confirm_password1" style="display:none;">
		                <input autocomplete="off" name="cpassword" type="password" size="25" class="txtbox iposition" id="confirm_password111" style="display:none;">
						<span style="color:red;display:none;font-size:14px;margin-top:32px;" id="cpassconf"><?php echo $confpass;?></span>
						<span style="color:red;display:none;font-size:14px;margin-top:32px;" id="cpassconf1"><?php echo $passmissmatch;?></span>
		            </div>
		            <!--<a class="signup_btn" id="registerButton" href="javascript:void(0)"><!--Sign Up--><?php //echo $lsign_up;?></a>-->
		            <input name="signup" onclick="return frmvalidate();" type="button" value="<?php echo $lsign_up;?>" class="signup_btn" id="registerButton1" >
				<input type="hidden" name="regPage"   value="ppc">
				<input type="hidden" name="regReturn" value="<?php echo Base_url();//echo Base_url('index/index');?>">

				
				</form>
                <a href="#" class="close_btn" id="close_btn"></a>
	        </div>
        </div>
        
    </div>
	<?php endif;?>
    <!--SIGNUP FORM END -->
    
    <!--PAGE TITLE START -->
    <div class="page_title">
    	<div class="wrapper for-staticpg"><h1><!--Tutor Details--><?php echo $affidetail;;?></h1></div>
    </div>
    <!--PAGE TITLE END -->
    
    <!--CONTENT START -->
    <div class="content">
    	<div class="wrapperinner">
        	<h2 id="overview"><!--Overview--><?php echo $lOVERVIEW;?></h2>
            <div class="image_right vid_btn">
	            <?php /*?><a href="#">
                	<img src="<?php echo Base_url("images/main/tutor_img.jpg");?>" alt="">
                    <img src="<?php echo Base_url("images/main/play_btn.png");?>" alt="" class="play" width="25" height="29">
                </a><?php */?>
                <? /*<video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" width="305" height="187" poster="<?php echo Base_url("images/main/tutor_img.jpg");?>" data-setup='{}'>
                     <source src="<?php echo Base_url("vedio/JP_demo_vee_crop.mp4");?>" type='video/mp4' />
                </video>*/ ?>
            </div>
            <p><?php echo $thetalkaffiliate;?>
            	<?php // echo $lOVERVIEW_DESC;?>
            </p>
            <div class="overivew4_images">
            <a href="<?php echo base_url('user/signup?m=aff');?>"><img class="overivew4_images_01" src="http://www.thetalklist.com/images/main/enroll_now_btn.jpg"></a>
            <img class="overivew4_images_02" src="http://dev.thetalklist.com/images/main/affiliate-img01.jpg" width="157" height="157">
          	<img class="overivew4_images_03" src="http://dev.thetalklist.com/images/main/affiliate-img02.jpg" width="193" height="161">
          	<img class="overivew4_images_04" src="http://dev.thetalklist.com/images/main/affiliate-img03.jpg" width="157" height="157">
          </div>

            
                        
          <h2 id="become_trust"><!--Become a Tutor--><?php echo $becomeaffi;?></h2>
            
            <div class="image_left vid_btn">
	            <?php /*?><a href="#">
                	<img src="<?php echo Base_url("images/main/become_tutor.jpg");?>" alt="">
                    <img src="<?php echo Base_url("images/main/play_btn.png");?>" alt="" class="play" width="25" height="29">
                </a><?php */?>
                <? /*<video id="example_video_2" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" width="305" height="170" poster="<?php echo Base_url("images/main/become_tutor.jpg");?>" data-setup='{}'>
                     <source src="<?php echo Base_url("vedio/become_tutor.mp4");?>" type='video/mp4' />
                </video> */ ?>
          <img src="http://dev.thetalklist.com/images/main/become-affiliate-img.jpg" width="227" height="184"></div>
            <p><?php echo $asaninternational;?>
            	<?php //echo $lBECOME_TUTOR_DESC;?>
            </p>
            
            <div class="steps_inner clearfix" style="padding-top:0px;">
            
            	<div class="step step_1">
                	<div class="step_title"><!--Meet Requirements--><?php echo $signups;?></div>
                    <ul>
                    	<li><!--High speed internet--><?php echo $providrinfo;?></li>
                    	<li><!--Webcam/Mic--><?php echo $receveaffi;?></li>
                    </ul>
                </div>
                <div class="step step_2">
                	<div class="step_title"><!--Take e-Training--><?php echo $deployadv;?></div>
                    <ul>
                    	<li><!--Learn conversation tutoring--><?php echo $useexisting;?></li>
                        <li><!--Learn to use our platform--><?php echo $requestcustom;?></li>
                        <li><!--Learn to use our platform--><?php echo $pstAdda;?></li>
                    </ul>
                </div>
                <div class="step step_3">
                	<div class="step_title"><!--Enjoy TheTalkList<br>Experience--><?php echo $minitorincome;?></div>
                    <ul>
                    	<li><!--Develop a global reach--><?php echo $viewqualify;?></li>
                    	<li><!--Start making money--><?php echo $recevemonth;?></li>
                    </ul>
                </div>
                
            </div>
            
           
            
            
            <h2 id="make_money"><!--Make Money--><?php echo $lMAKE_MONEY;?></h2>
           
            
            
            
           
          
            
            
            <div class="steps_inner tenpercentimg clearfix">
            
            	<div class="step step_1 step-width" >
                	<div class="step_title step-gray"><?php echo $stuclick;?></div>
                    
                </div>
                <div class="step step_2 step-width" >
                	<div class="step_title step-gray"><?php echo $affiiscredited;?></div>
                    
                </div>
                <div class="step step_3 step-width">
                	<div class="step_title step-gray"><?php echo $afterfirstpaid; ?></div>
                    
                </div>
                
                <div class="enrollnow_btn_aff"><a href="<?php echo base_url('user/signup?m=aff');?>"><img class="" src="http://www.thetalklist.com/images/main/enroll_now_btn.jpg"></a></div>
            </div>
            
            
        </div>
    </div>
    <!--CONTENT END -->
