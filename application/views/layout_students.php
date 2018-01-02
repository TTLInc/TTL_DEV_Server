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
$arrVal 	= $this->lookup_model->getValue('470', $multi_lang);	$lEMAIL   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('471', $multi_lang);	$lPASSWORD   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('472', $multi_lang);	$lFIRSTNAME   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('473', $multi_lang);	$lIM_STUDENT   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('474', $multi_lang);	$lIM_TUTOR   	= $arrVal[$multi_lang];

/** added 25 Nov 13 */
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
$arrVal 	= $this->lookup_model->getValue('221', $multi_lang);
$lsign_up = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('939', $multi_lang);
$cnglang= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('541', $multi_lang);	$lIAMA   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('236', $multi_lang);	$iamaa   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('926', $multi_lang);	$stu   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('927', $multi_lang);	$PROGRAM   	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('110', $multi_lang);$tutor = $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('111', $multi_lang);$student =  $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('540', $multi_lang);	$lCPASSWORD   	= $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('977', $multi_lang);$schools = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('1015', $multi_lang);	$schoolProgram  = $arrVal[$multi_lang];
?>
<!doctype html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge" >
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
<link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,400italic,700,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light+Two' rel='stylesheet' type='text/css'>
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

<!--RESPONSIVE START -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/home/responsive.css');?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<script src="<?php echo base_url('js/home/jquery-1.8.2.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('js/home/responsive.js');?>"></script>
<!--RESPONSIVE END -->
<!-- New Home page Layout -->

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

<body onLoad="wireUpEvents()" class="stut-pg">
<?php include_once FCPATH."idle/idle.php";?>
	<!--HEADER START -->
	<?php if(!$login):?>
    <div class="header_login" id="header_login">
    	<div class="wrapper">
    		<form action="<?php echo Base_url("user/login");?>" method="post" id="formLogin">
        	<div class="top_login clearfix">
            	<span class="log_text"><!--Sign In--><?php echo $SIGN_IN;?></span>
                <div class="log_input"><input name="email" placeholder="<?php echo $lEMAIL;?>" value="<?php echo $lEMAIL;?>" type="text" size="25" id="email"></div>
                <div class="log_input">
                	<input name="password" value="<?php echo $lPASSWORD;?>"  type="password" size="25" class="iposition fake_password_1">
                	<input name="password" type="password" size="25" class="iposition password_1" style="display:none;">
                </div>                
                <input type="submit" value="<?php echo $llogin;?>" name="login" class="signin">
                <a href="<?php echo base_url('user/forget');?>" class="forgot_pass"><!--Forgot password--><?php echo $lforget;?></a>
                <a href="#" class="close_btn" id="close_btn"></a>
            </div>
            </form>
        </div>
    </div>
    <?php endif;?>
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
					<input type="hidden" name="refid"   value="<?php echo $current_uri1 ;?>">
				
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
            	<div class="navi_col top_link_hover">
                	<ul id="top_navi" class="tpNav1">
	                	<li><a href="<?php echo Base_url("students/index");?>" class="top_link students"><!--Students--><?php echo $BE_A; ?><span><?php echo $stu;?></span></a>
                        	
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

	<?php echo $content_for_layout?>

	<!--FOOTER START -->
    <div class="footer">
    	<div class="wrapper clearfix">
        	<div class="speak_like_native"><!--Speak English Like a Native--><?php echo $lSPEAK_EN_LIKE_NATIVE;?></div>
            <div class="socialize">
            	<span><!--Connect with us--><?php echo $lCONNNECT_WITH_US;?> :</span>
            	<?php if($multi_lang == 'ch') { ?>
            	<!--Chinese Social Icons-->
					<a href="https://weibo.com/5629851993/profile?topnav=1&wvr=6" target="_blank" ><img src="<?php echo Base_url("images/sina.png");?>" width="32" height="32" alt="social1" /></a>
					<!--<a href="https://user.qzone.qq.com/2977798206" target="_blank" ><img src="<?php echo Base_url("images/qq.png");?>" width="32" height="32" alt="social1" /></a>-->
				<!--Chinese Social Icons-->
				<?php } ?>
                <a href="https://www.linkedin.com/company/3126401?trk=tyah" class="ln" target="_blank" ></a>
	            <a href="https://www.facebook.com/TheTalkList" class="fb" target="_blank" ></a>
	            <a href="https://twitter.com/thetalklist" class="tw" target="_blank" ></a>
	            <!--<a href="https://plus.google.com/117271187089694253468/posts" class="gp" target="_blank" ></a>-->
	            <a href="https://www.youtube.com/user/TheTalkList" class="yt" target="_blank" ></a>
                <a href="<?php echo base_url('blog'); ?>" class="blog" target="_blank" ></a>
            </div>
            <div class="footer_links">
            	 <span><!--Copyright--><?php echo $lcopyright;?> 2016 &copy; TheTalkList. <?php echo $lallrightreserve;?><!--All Rights Reserved--></span>
            	 <a href="<?php echo Base_Url('article/privacy');?>"><!--Privacy Policy--><?php echo $lprivacy_policy;?></a>
            	 <a href="<?php echo Base_Url('article/terms');?>"><!--Terms of Use--><?php echo $lterms;?></a>
            	 <a href="<?php echo Base_Url('article/contact');?>"><!--Contact Us--><?php echo $lcontact;?></a>
            	 <a href="<?php echo Base_Url('article/about');?>"><!--About Us--><?php echo $labout;?></a>
            	 <a href="<?php echo Base_Url('affiliate/index');?>"><!--About Us--><?php echo $affiliate ;?></a>
				 <a href="#"><!--Site Map--><?php echo $lSITE_MAP;?></a>
            </div>
        </div>
    </div>
    <!--FOOTER END -->
	<?php /*?>
	<div class="home_footer">
    	<div class="main_wrap">
			<div class="text_img"><img src="<?php echo Base_url("images/text_img.png");?>" width="213" height="30" alt="text-img" /></div>
			<div class="footer_btm">
				<div class="left_footer">          
			        <ul>
			        	<li><!--Copyright--><?php echo $lcopyright;?> 2013 @ <a href="#">The TalkList</a>.  <?php echo $lallrightreserve;?><!--All Rights Reserved--></li>
			            <li><a href="<?php echo Base_Url('article/privacy');?>"><!--Privacy Policy--><?php echo $lprivacy_policy;?></a></li>
			            <li><a href="<?php echo Base_Url('article/terms');?>"><!--Terms of Use--><?php echo $lterms;?></a></li>
			            <li><a href="<?php echo Base_Url('article/contact');?>"><!--Contact Us--><?php echo $lcontact;?></a></li>
			            <li><a href="<?php echo Base_Url('article/about');?>"><!--About Us--><?php echo $labout;?></a></li>
			        </ul>
			    </div>
			    <div class="right_footer">
			    	<ul>
						<!--R&D@Oct-19-2013 : Chinese Social Icons-->
						<?php if($multi_lang == 'ch') { ?>
						<li><a href="https://weibo.com/3847933545/profile?rightmod=1&wvr=5&mod=personinfo"><img src="<?php echo Base_url("images/sina.png");?>" width="40" height="40" alt="social1" /></a></li>
						<li><a href="https://user.qzone.qq.com/2977798206"><img src="<?php echo Base_url("images/qq.png");?>" width="40" height="40" alt="social1" /></a></li>
						<?php } ?>
						<!--R&D@Oct-19-2013 : Chinese Social Icons-->				   
					   <li><a href="https://www.linkedin.com/company/3126401?trk=tyah"><img src="<?php echo Base_url("images/social1.png");?>" width="40" height="40" alt="social1" /></a></li>
			            <li><a href="https://www.facebook.com/TheTalkList"><img src="<?php echo Base_url("images/social2.png");?>" width="38" height="39" alt="social2" /></a></li>
			            <li><a href="https://twitter.com/thetalklist"><img src="<?php echo Base_url("images/social3.png");?>" width="39" height="39" alt="social3" /></a></li>
			            <li><a href="https://plus.google.com/117271187089694253468/posts"><img src="<?php echo Base_url("images/social4.png");?>" width="39" height="38" alt="social4" /></a></li>
			            <li><a href="https://www.youtube.com/user/TheTalkList"><img src="<?php echo Base_url("images/social5.png");?>" width="41" height="39" alt="social5" /></a></li>
			        </ul>
			    </div>
			</div>
		</div>
  	</div>
</div>
<?php */?>

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
	//var lgbycls = '<?php echo base_url();?>user/slogoutByBroserClose';
	function wireUpEvents() 
	{
		window.addEventListener('beforeunload',function u(e)
		{
		 if (!validNavigation) {
			window.onbeforeunload = null;
			$.ajax({
			  dataType:'json',
			  type: 'GET',
			  url: "<?php echo base_url();?>user/slogoutByBroserClose",
			  success: function(data, textStatus, jqXHR) {
				alert(data);
				// `data` contains parsed JSON
				
				//---R&D : JAN-22-2014
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
<script src="<?php echo base_url('js/home/jquery-1.7.1.min.js');?>"></script>
<script src="<?php echo base_url('js/home/global.js');?>"></script>
<script src="js/global.js"></script>
<script src="<?php echo base_url('js/jQueryRotate.js');?>" type="text/javascript"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
  $('#text4').rotate(-24);
});
</script>
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
<script>
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

</script>
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
		 	//$('html, body').animate({scrollTop:10}, 1900);
			$(window).scroll(function(){
				show_signup();
			})
			show_signup();
        });
        
var type = window.location.hash.substr(1);
if(type!=''){
showContent(type);	
}
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
		
		
		$( "#registerForm" ).submit(function( event ) {
		return true;
			event.preventDefault();
			var error 			= false;
			var $form 			= $( this );
			//var url 			= $form.attr( "action" );
			var url 			= window.location+'/user/registerDo';
			//url = url.replace("/students/index", "");
			
			url = url.replace("/students/index#select_tutor", "");
			url = url.replace("/students/index#buying_credit", "");
			url = url.replace("/students/index#guarantee", "");
			url = url.replace("/students/index", "");

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
		
		
		
		
		
		
		
		
		
		
</script>
<?php if(isset($_SESSION['isRegError']) &&$_SESSION['isRegError'] == TRUE){ ?>
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


<?php $_SESSION['isRegError'] == FALSE; unset($_SESSION['isRegError']); }  ?>



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
</body>
</html>