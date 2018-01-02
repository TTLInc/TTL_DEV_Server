<?php
$multi_lang = 'kr';
//echo $_SESSION['multi_lang'];
if(isset($_SESSION['multi_lang']))
{
	$multi_lang = $_SESSION['multi_lang'];
}
else
{
	$multi_lang = 'kr';	
}


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
$arrVal 	= $this->lookup_model->getValue('379', $multi_lang);
$byclick = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('470', $multi_lang);	$lEMAIL   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('471', $multi_lang);	$lPASSWORD   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('472', $multi_lang);	$lFIRSTNAME   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('473', $multi_lang);	$lIM_STUDENT   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('474', $multi_lang);	$lIM_TUTOR   	= $arrVal[$multi_lang];

/** added 25 Nov 13 */
$arrVal 	= $this->lookup_model->getValue('538', $multi_lang);	$lWORKS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('539', $multi_lang);	$lHOW_IT   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('540', $multi_lang);	$lCPASSWORD   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('541', $multi_lang);	$lIAMA   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('542', $multi_lang);	$lHELPING_U   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('543', $multi_lang);	$lBOOK_YOUR_FIRST_FREE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('544', $multi_lang);	$lSPEAK_EN_LIKE_NATIVE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('545', $multi_lang);	$lTHE_TALKLIST   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('546', $multi_lang);	$SIGN_IN   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('547', $multi_lang);	$lSIGN_IN   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('548', $multi_lang);	$lBUYING_CREDITS   	= $arrVal[$multi_lang];
//$arrVal 	= $this->lookup_model->getValue('544', $multi_lang);	$lSPEAK_EN_LIKE_NATIVE   	= $arrVal[$multi_lang];
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

$arrVal = $this->lookup_model->getValue('111', $multi_lang);$student =  $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('110', $multi_lang);$tutor = $arrVal[$multi_lang];


$arrVal 	= $this->lookup_model->getValue('660', $multi_lang);	$lTESTIMONIALS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('661', $multi_lang);	$lDETAILS   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('662', $multi_lang);	$lREGISTER_FREE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('663', $multi_lang);	$lSIGN_UP   	= $arrVal[$multi_lang];


$arrVal = $this->lookup_model->getValue('665', $multi_lang);$lSPEAK_ENGLISH =  $arrVal[$multi_lang];
$arrVal = $this->lookup_model->getValue('666', $multi_lang);$lLIKE_A_NATIVE = $arrVal[$multi_lang];

$arrVal 	= $this->lookup_model->getValue('670', $multi_lang);	$lREG_SELECT_TYPE   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('671', $multi_lang);	$lREG_FIRSTNAME_REQ   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('672', $multi_lang);	$lREG_FIRSTNAME_INVALID = $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('673', $multi_lang);	$lREG_EMAIL_REQ   		= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('674', $multi_lang);	$lREG_EMAIL_INVALID   	= $arrVal[$multi_lang];
$arrVal 	= $this->lookup_model->getValue('675', $multi_lang);	$lREG_PASSWORD   		= $arrVal[$multi_lang];



?>

	
	<!--HEADER START -->
    <script src="http://api.html5media.info/1.1.6/html5media.min.js"></script>
	<?php if(!$login):?>
    <div class="header_login" id="header_login">
    	<div class="wrapper">
    		<form action="<?php echo Base_url("user/login");?>" method="post" id="formLogin">
        	<div class="top_login clearfix">
            	<span class="log_text"><!--Sign In--><?php echo $SIGN_IN;?></span>
                <div class="log_input"><input name="email" placeholder="<?php echo $lEMAIL;?>" value="" type="text" size="25" id="email"></div>
                <div class="log_input">
                	<input autocomplete="off" name="password" placeholder="<?php echo $lPASSWORD;?>" value="" type="password" size="25" class="iposition fake_password_1">
                	<input autocomplete="off" name="password" type="password" size="25" class="iposition password_1" style="display:none;">
                </div>
                <input type="hidden" value="login" name="loginaction" />
                <input type="submit" value="<?php echo $llogin;?>" name="login" class="signin">
                <a href="<?php echo base_url('user/forget');?>" class="forgot_pass"><!--Forgot password--><?php echo $lforget;?></a>
                <a href="#" class="close_btn" id="close_btn"></a>
            </div>
            </form>
        </div>
    </div>
    <?php endif;?>
    <div class="header">
    	<div class="wrapper clearfix">
        	<a href="<?php echo base_url();?>"><img src="<?php echo Base_url("images/main/logo.gif");?>" alt="The TalkList" title="The TalkList" class="logo"></a>
            <div class="top_navi">
            	<div class="navi_col top_link_hover">
                	<ul id="top_navi">
	                	<li><a href="<?php echo Base_url("students/index");?>" class="top_link students"><!--Students--><?php echo $lStudents;?></a>
                        	<ul>
                                <li><a href="<?php echo Base_url("students/index#select_tutor");?>"><!--Selecting a Tutor--><?php echo $lSELECTING_TUTOR;?></a></li>
                                <li><a href="<?php echo Base_url("students/index#buying_credit");?>"><!--Buying Credits--><?php echo $lBUYING_CREDITS;?></a></li>
                                <li><a href="<?php echo Base_url("students/index#guarantee");?>"><!--Guarantee--><?php echo $lGUARANTEE?></a></li>
                                <li><a href="<?php echo Base_url("search/search");?>"><!--Tutor Search--><?php echo $lsearch;?></a></li>
                                <li><a href="<?php echo Base_url("support/faqs");?>"><?php echo $lFAQ;?></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            	<div class="navi_col">
                	<ul id="top_navi">
	                	<li><a href="<?php echo Base_url("tutor/index");?>" class="top_link tutors"><!--Tutors--><?php echo $lTutors;?></a>
                        	<ul>
                                <li><a href="<?php echo Base_url("tutor/index#overview");?>"><!--Overview--><?php echo $lOVERVIEW;?></a></li>
                                <li><a href="<?php echo Base_url("tutor/index#become_trust");?>"><!--Become a Tutor--><?php echo $lBECOME_TUTOR;?></a></li>
                                <li><a href="<?php echo Base_url("tutor/index#levels");?>"><!--Levels--><?php echo $lLEVELS;?></a></li>
                                <li><a href="<?php echo Base_url("tutor/index#make_money");?>"><!--Make Money--><?php echo $lMAKE_MONEY;?></a></li>
                                <li><a href="<?php echo Base_url("tutor/index#market_yourself");?>"><!--Market Yourself--><?php echo $lMARKET_YOURSELF;?></a></li>
                                <?php /*?><li><a href="<?php echo Base_url("support/faqs");?>"><?php echo $lFAQ;?></a></li><?php */?>
                            </ul>
                        </li>
                    </ul>
                </div>
            	<div class="navi_col">
                	<ul id="top_navi">
	                	<li><a href="javascript:void(0)" class="top_link language"><!--Language--><?php echo $lLang;?></a>
	                		<ul>
                                <li><a onclick="changeLanguage('en');" class="multi_lang_change">English</a></li>
                                <li><a onclick="changeLanguage('es');" class="multi_lang_change">Español</a></li>
                                <li><a onclick="changeLanguage('ch');" class="multi_lang_change">简体中文</a></li>
                                <li><a onclick="changeLanguage('tw');" class="multi_lang_change">繁體中文</a></li>
                                <li><a onclick="changeLanguage('jp');" class="multi_lang_change">日本語</a></li>
                                <li><a onclick="changeLanguage('kr');" class="multi_lang_change">한국어</a></li>
                                <li><a onclick="changeLanguage('pt');" class="multi_lang_change">Português</a></li>
                        	</ul>
	                	</li>
                    </ul>
                </div>
                <?php if(!$login):?>
                <div class="navi_col signinbtn">
                	<input name="signin" type="submit" value="<?php echo $lSIGN_IN;?>" class="signin" id="signin_btn">
                </div>
                <?php else:?>
				<div class="navi_col signinbtn">
					<?php /*?>
					<span class="hd_pic">
						<a href="<?php echo Base_url("user/profile/uid/".$uid);?>">
							<img src="<?php echo $pic?Base_url('/uploads/images/thumb/'.$pic):Base_url('images/base/hd-pic.png');?>" width="30" height="30" class="vAgn_m" />
		     			</a>
	      			</span>
	      			<?php */?>
					<div class="welcome_sec"><span><?php echo $lwelcome; ?>, <?php echo $this->session->userdata['welcomeuser'];?></span>  <em><br></em>  <a id="xOutUser" href="<?php echo Base_url("user/logout");?>"><?php echo $llogout; ?></a></div>
				</div>
                <?php endif;?>
            </div>
       	</div>
       	<?php /*?>
        <nav class="navigation">
        	<div class="wrapper clearfix">
                
        		<ul>
                	<?php if(!$login):?>
                    <li><a href="<?php echo Base_url("user/login");?>"><!--Buying Credits--><?php echo $lBUYING_CREDITS;?></a></li>
                    <?php else:?>
                    <li><a href="<?php echo Base_url("user/account");?>"><!--Buying Credits--><?php echo $lBUYING_CREDITS;?></a></li>
                    <?php endif;?>
                    <li><a href="#">Guarantee</a></li>
                    <li><a href="<?php echo Base_url("search/search");?>"><!--Tutor Search--><?php echo $lsearch;?></a></li>
                    <li><a href="<?php echo Base_url("support/faqs");?>"><?php echo $lFAQ;?></a></li>
                </ul>
                <?php /*?>
                <ul>
					<li class="nav_sel"><a href="<?php echo Base_url();?>"><!--Home--><?php echo $lhome;?></a></li>
					<li><a href="<?php echo Base_url("user/dashboard");?>"><!--My Profile--><?php echo $lmypages;?></a></li>
					<li><a href="<?php echo Base_url("search/search");?>"><!--Tutor Search--><?php echo $lsearch;?></a></li>
					<li><a href="<?php echo Base_url("search/videosearch");?>"><!--Video Search--><?php echo $vsearch;?></a></li>
					<li><a href="<?php echo Base_url("training/howItWorks");?>"><!--How it Works--><?php echo $lhowitworks;?></a></li>
					<li class="support-nav" ><a href="<?php echo Base_url("support/faqs");?>" ><?php echo $lSUPPORT;?></a>
						<?php /*?><ul class="support-drp">
							<li><a href="<?php echo Base_url("support/faqs");?>"><?php echo $lFAQ;?></a></li>
							<?php if($this->session->userdata('roleId') == '' || $this->session->userdata('roleId') == 0): ?>
							<li><a href="<?php echo base_url('support/resources');?>"><?php echo $lSTUDENT_RESOURCES;?></a></li>
							<?php else: ?>
							<li><a href="<?php echo base_url('support/resources');?>"><?php echo $lTUTOR_RESOURCES;?></a></li>
							<?php endif;?>
							<li class="last"><a href="<?php echo base_url('forum');?>"><?php echo $lFORUM;?></a></li>
						</ul>
					</li>
				  </ul><?php ?>
            </div>
        </nav>
    <?php */?>
    </div>
    <!--HEADER END -->



	<!--HOMEPAGE BANNER START -->
    <div class="main_banner">
    	<div class="wrapper clearfix">
            <div class="banner_slogan">
                <h2><?php echo $lHELPING_U;?> </h2>
                <h3><?php echo $lSPEAK_ENGLISH. " ".$lLIKE_A_NATIVE;?></h3>
            </div>
            <div class="banner_left">
            	<h2><?php echo $lBOOK_YOUR_FIRST_FREE;?></h2>
                <a href="<?php echo Base_url("user/register");?>" class="register_btn" id="register_btn"><?php echo $lREGISTER_FREE;?></a>
                <div class="risk_free"><!--Risk-Free Satisfaction Guaranteed--><?php echo $lrisk_free;?></div>
                <div class="or_fb clearfix">
                	<span class="or"><!--OR--><?php echo $lor;?></span>
                	<?php  if($multi_lang != 'ch'){?>
                    <a href="javascript:void(0);" class="fb_connect"></a>
                    <?php } else { ?>
                    <?php include_once(Base_url("weibo/index.php")); ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!--HOMEPAGE BANNER END -->
    
	<!--SIGNUP FORM START -->
	<?php if(!$login):?>
    <div class="signup_form" id="signup_form">
    	<div class="sf_padding">
    		<div class="sf_txt"><!--Sign Up--><?php echo $lsign_up; ?>:</div>
	            <form style="display:block;" action="<?php echo Base_url('user/registerDo');?>" method="POST" id="registerForm">
	            	<div class="sf_select">
		            	<span class="select_box_holder sel_width_215">
		                    <select id="roleId" name="roleId" class="cu_dds">
		                        <option value="0"><?php echo $lIAMA;?></option><!--I am a...-->
		                        <option value="0"><?php echo $student;?></option><!--Student-->
		                        <option value="1"><?php echo $tutor;?></option><!--Tutor-->
		                    </select>
		                </span>
						<span id="roleId_required" style="color:red;display:none;"><b>Select</b></span>

					</div>
		            <div class="sf_input">
		            	<!--<input name="username" type="text" value="First Name" size="25" class="txtbox">-->
		            	<input id="firstName" type="text" value="" name="firstName" placeholder="<?php echo $lFIRSTNAME;?>" size="25" class="txtbox" />
						<span id="firstName_required" style="color:red;display:none;"><b>Firstname is required</b></span>

					</div>
		            <div class="sf_input">
		            	<!--<input name="username" type="text" value="Email" size="25" class="txtbox">-->
		            	<input id="email" type="text" value="" name="email" placeholder="<?php echo $lEMAIL;?>" size="25" class="txtbox"/>
            		<span id="email_required" style="color:red;display:none;"><b>Email is required</b></span>
            		<span id="email_invalid" style="color:red;display:none;"><b>Email is invalid</b></span>

					</div>
		            <div class="sf_input sf_input_pass">
	                  	<input autocomplete="off" type="text" value="" name="password" placeholder="<?php echo $lPASSWORD;?>" size="25" class="txtbox iposition fake_password"/>
		            	<!--<input name="username" type="text" value="Password" size="25" class="txtbox iposition fake_password">-->
		                <input autocomplete="off" id="password" name="password" type="password" size="25" class="txtbox iposition password" style="display:none;">
		            </div>
		            <div class="sf_input sf_input_pass">
		            	<input autocomplete="off" type="text" value="" name="cpassword" placeholder="<?php echo $lCPASSWORD;?>" size="25" class="txtbox iposition" id="fake_confirm_password"/>
		            	<!--<input name="username" type="text" value="Confirm Password" size="25" class="txtbox iposition" id="fake_confirm_password">-->
		                <input autocomplete="off" name="cpassword" type="password" size="25" class="txtbox iposition" id="confirm_password" style="display:none;">
		            </div>
		            <!--<a class="signup_btn" id="registerButton" href="javascript:void(0)"><!--Sign Up--><?php //echo $lsign_up;?></a>-->
		            <input name="signup" type="submit" value="<?php echo $lSIGN_UP;?>" class="signup_btn" id="registerButton" >
	            
								<input type="hidden" name="regPage"   value="ppc">
				<input type="hidden" name="regReturn" value="<?php echo Base_url('index/index');?>">

				
				</form>
        </div>
    </div>
	<?php endif;?>
    <!--SIGNUP FORM END -->
    
	<!--CONTENT START -->
    <div class="wrapper">
		<div class="how_it_works clearfix">
    		<!--How it Works--><?php //echo $lhow_it_works;?>
        	<h2><!--How It--><?php echo $lHOW_IT;?> <span><!--Works--><?php echo $lWORKS;?></span></h2>
            <div class="hiw_col">
            	<div class="search">
	            	<h3><!--Search--><?php echo $lsearch;?></h3>
                    <div class="hiw_txt"><p><!--Choose the tutor of your choice, from a huge selection of American English Tutors--><?php echo $lchoose_tutor;?></p></div>
                </div>
            </div>
            <div class="hiw_col">
            	<div class="schedule">
	            	<h3><!--Schedule--><?php echo $lschedule;?></h3>
                    <div class="hiw_txt"><p><!--Look at any tutor's available calendar to book a session--><?php echo $llook_tutor;?></p></div>
                </div>
            </div>
            <div class="hiw_col hiw_col_last">
            	<div class="talk">
	            	<h3><!--Talk--><?php echo $ltalk;?></h3>
                    <div class="hiw_txt"><p><!--Use our custom Video Platform to speak online in a safe private setting--><?php echo $lcustom_video;?></p></div>
                </div>
            </div>
    	</div>
        
        <div class="testimonials">
        	<div id="testimonials">
        		<?php if(sizeof($qoute) > 1){
		    		for($i=0;$i<sizeof($qoute);$i++){
				 		$quotes  = stripslashes($qoute[$i]['quote']);
			 			$quoteby = stripslashes($qoute[$i]['quotedby']);?>
			 	<div>
                    <p><?php echo $quotes;?></p>
                    <span>- <?php echo $quoteby;?></span>
                </div>
			 	<?php
		    		}	
        		}?>
            </div>
			<div class="testimnl"><?php echo $lTESTIMONIALS;?></div>
        </div>
		
        
        <div class="why_talklist_vid clearfix">
        	<div class="why_talklist">
            	<h3><!--WhyThe TalkList--><?php echo $lwhy;?> <span><!--The TalkList?--><?php echo $lTHE_TALKLIST;?></span></h3>
                
                <div class="why_talklist_row american_tutors clearfix">
                	<h4><!--American Tutors--><?php echo $lamerican_tutor;?></h4>
                    <p><!--You get a tutor from around the USA or around the world that's been tested in our instructional learning method.--><?php echo $lyou_get_tutor;?></p>
                </div>
                
                <div class="why_talklist_row no_contract clearfix">
                	<h4><!--No Contracts--><?php echo $lno_contracts;?></h4>
                    <p><!--You get flexible scheduling and flexible payment with no contracts--><?php echo $lyou_get_flexible;?></p>
                </div>
                
                <div class="why_talklist_row your_topic clearfix">
                	<h4><!--Your Topic--><?php echo $lyour_topic;?></h4>
                    <p><!--You get to customize each conversation tutorial around your interest : test, school, work, or travel--><?php echo $lyou_get_customize;?></p>
                </div>
            </div>
            
            <div class="talklist_vid">
            	<div class="vid_box">
                    <video id="example_video_1" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" width="473" height="279" poster="<?php echo Base_url("images/main/video_cover.jpg");?>" data-setup='{}'>
                         <source src="<?php echo Base_Url('vedio/howItWorks-kr.mp4');?>" type='video/mp4' />
                    </video>
                </div>
                <div class="welcome_tutors clearfix">
                	<span><!--We welcome new tutors--><?php echo $lwe_welcome;?></span>
                    <a href="<?php echo Base_Url('tutors');?>" ><?php echo $lDETAILS;?></a>
                </div>
            </div>
        </div>
        
    </div>
    <!--CONTENT END -->
    
    <!--FOOTER START -->
    <div class="footer">
    	<div class="wrapper clearfix">
        	<div class="speak_like_native"><!--Speak English Like a Native--><?php echo $lSPEAK_ENGLISH. " ".$lLIKE_A_NATIVE;?></div>
            <div class="socialize">
            	<span><!--Connect with us--><?php echo $lCONNNECT_WITH_US;?> :</span>
            	<?php if($multi_lang == 'ch') { ?>
            	<!--Chinese Social Icons-->
					<a href="http://weibo.com/3847933545/profile?rightmod=1&wvr=5&mod=personinfo" target="_blank" ><img src="<?php echo Base_url("images/sina.png");?>" width="32" height="32" alt="social1" /></a>
					<a href="http://user.qzone.qq.com/2977798206" target="_blank" ><img src="<?php echo Base_url("images/qq.png");?>" width="32" height="32" alt="social1" /></a>
				<!--Chinese Social Icons-->
				<?php } ?>
                <a href="http://www.linkedin.com/company/3126401?trk=tyah" class="ln" target="_blank" ></a>
	            <a href="http://www.facebook.com/TheTalkList" class="fb" target="_blank" ></a>
	            <a href="https://twitter.com/thetalklist" class="tw" target="_blank" ></a>
	            <a href="https://plus.google.com/117271187089694253468/posts" class="gp" target="_blank" ></a>
	            <a href="http://www.youtube.com/user/TheTalkList" class="yt" target="_blank" ></a>
            </div>
            <div class="footer_links">
            	 <span><!--Copyright--><?php echo $lcopyright;?> 2013 &copy; TheTalkList. <?php echo $lallrightreserve;?><!--All Rights Reserved--></span>
            	 <a href="<?php echo Base_Url('article/privacy');?>"><!--Privacy Policy--><?php echo $lprivacy_policy;?></a>
            	 <a href="<?php echo Base_Url('article/terms');?>"><!--Terms of Use--><?php echo $lterms;?></a>
            	 <a href="<?php echo Base_Url('article/contact');?>"><!--Contact Us--><?php echo $lcontact;?></a>
            	 <a href="<?php echo Base_Url('article/about');?>"><!--About Us--><?php echo $labout;?></a>
            	 <a href="#"><!--Site Map--><?php echo $lSITE_MAP;?></a>
            </div>
        </div>
    </div>
    <!--FOOTER END -->